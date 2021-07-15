<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 19/01/2016
 * Time: 11:28
 */

namespace Magenest\UltimateFollowupEmail\Model\Observer\Order;

use Magento\Framework\Stdlib\DateTime;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Email\Model\Template as EmailTemplateModel;
use Magento\Quote\Model\Quote;
use Magento\Sales\Model\Order;

class StatusChange extends \Magenest\UltimateFollowupEmail\Model\Processor\UltimateFollowupEmail implements ObserverInterface
{

    protected $_quote;
    protected $_customerFactory;
    protected $_quoteId;

    /**
     * @var   \Magento\SalesRule\Model\RuleFactory
     */
    protected $_saleRuleFactory;
    /**
     * @var \Magento\Quote\Model\Quote\TotalsCollector
     */
    protected $_totalsCollector;

    public function __construct(
        \Magenest\UltimateFollowupEmail\Model\ResourceModel\Rule\CollectionFactory $rulesFactory,
        \Magento\Reports\Model\ResourceModel\Quote\CollectionFactory $quotesFactory,
        \Magenest\UltimateFollowupEmail\Model\MessageFactory $messageFactory,
        \Magenest\UltimateFollowupEmail\Model\SmsFactory $smsFactory,
        EmailTemplateModel $emailTemplateModel,
        \Magento\Quote\Model\Quote\TotalsCollector $totalsCollector,
        \Magenest\UltimateFollowupEmail\Model\Aggregator\AbandonedCart $abandonedCart,
        \Magenest\UltimateFollowupEmail\Model\MailFactory $mailFactory,
        \Magento\Quote\Model\QuoteFactory $quoteFactory,
        \Magento\Quote\Api\CartRepositoryInterface $cartRepositoryInterface,
        \Magento\SalesRule\Model\RuleFactory $ruleFactory,
        \Magento\Framework\Url $urlInterface,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\SalesRule\Model\Coupon\Massgenerator $massGenerator,
        \Magento\Store\Model\App\Emulation $appEmulation,
        \Magento\Customer\Model\CustomerFactory $customerFactory
    ) {
    
        $this->_customerFactory = $customerFactory;
        $this->_saleRuleFactory = $ruleFactory;
        $this->_totalsCollector = $totalsCollector;
        parent::__construct($context, $rulesFactory, $mailFactory, $messageFactory, $smsFactory, $quoteFactory, $cartRepositoryInterface, $emailTemplateModel, $scopeConfig, $urlInterface, $massGenerator, $appEmulation);
    }//end __construct()

    /**
     * build email target and
     *
     * @return mixed
     */
    public function run()
    {
        $this->createFollowUpEmail();
    }//end run()


    public function isValidate($rule)
    {
        $isValidate = true;
        $saleRuleModel = $this->_saleRuleFactory->create();

        $saleRuleModel->setData('conditions_serialized', $rule->getData('conditions_serialized'));
        /** @var Order $order */
        $order = $this->_emailTarget;
        /** @var Quote $quote */
        $quote = $this->_quoteFactory->create()->load($order->getId());

        $quote->setTotalsCollectedFlag(false);

        $quote->collectTotals();
        foreach ($quote->getAllAddresses() as $address) {
            $addressTotal = $this->_totalsCollector->collectAddressTotals($quote, $address);

            $isValidate = $saleRuleModel->validate($address);
            if ($isValidate) {
                return true;
            }
        }

        return $isValidate;
    }//end isValidate()


    public function prepareMail()
    {
        $this->_vars = [
            'order' => $this->_emailTarget,
            'customerFistName' => $this->_emailTarget->getCustomerFirstname(),
            'customerLastName' => $this->_emailTarget->getCustomerLastname(),
            'customerName' => $this->_emailTarget->getCustomerFirstname() . ' ' . $this->_emailTarget->getCustomerLastname(),
            'orderProductsGrid' => $this->getOrderProductGridHtml(),
            'relatedProductsGrid' => $this->getAllRelatedProductsGridHtml()
        ];
    }//end prepareMail()

    protected function getOrderProductGridHtml()
    {
        $items = $this->_emailTarget->getAllItems();
        $productGridHtml = "<ul style='list-style: none; margin:0; padding: 0;'>";
        foreach ($items as $item) {
            $productGridHtml .= '<li style=" float: left;margin: 0; display: inline;">';
            $productGridHtml .= $this->getProductHtml($item->getProduct()->getId());
            $productGridHtml .= '</li>';
        }
        $productGridHtml .= '<li style="list-style:none; clear: both;"></li>';
        $productGridHtml .= '</ul>';
        return $productGridHtml;
    }

    protected function getAllRelatedProductsGridHtml()
    {
        $items = $this->_emailTarget->getAllItems();
        $relatedProductGridHtml = '';
        foreach ($items as $item) {
            $relatedProductGridHtml .= $this->getRelatedProductsGridHtml($item->getProduct());
        }
        return $relatedProductGridHtml;
    }

    public function postCreateMail()
    {
    }//end postCreateMail()


    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /*
            * @var  $orderItem  \Magento\Sales\Model\Order\Item
        */
        $orderItem = $observer->getEvent()->getItem();

        /** @var  $order \Magento\Sales\Model\Order */
        $order = $orderItem->getOrder();
        $quoteId = $order->getQuoteId();
        // run the case the order is place
        $this->setType('order_is_placed');

        $this->_emailTarget = $order;
        $customerEmail = $order->getCustomerEmail();
        $firstName = $order->getCustomerFirstname();
        $lastName = $order->getCustomerLastname();

        if ($order->getBillingAddress()) {
            $mobileNumber = $order->getBillingAddress()->getTelephone();
        }

        if (empty($mobileNumber) && $order->getShippingAddress()) {
            $mobileNumber = $order->getShippingAddress()->getTelephone();
        }

        $this->storeId = $order->getStoreId();
        $this->_emailTarget = $order;
        $this->_emailTarget->setData('customer_email', $customerEmail);
        $this->_emailTarget->setData('mobile_number', $mobileNumber);
        $this->_emailTarget->setData('recipient_name', $firstName.' '.$lastName);
        $this->_emailTarget->setData('customer_firstname', $firstName);
        $this->_emailTarget->setData('customer_lastname', $lastName);
        $this->_quoteId = $quoteId;
        $this->_quote = $this->_quoteFactory->create();
        $this->_quote = $this->quoteRepository->get($this->_quoteId);
        $this->run();

        $orderStatus = $order->getStatus();

        $orderState = $order->getState();

        $this->setType('order_status_' . $orderState);

        $this->_emailTarget = $order;
        $customerEmail = $order->getCustomerEmail();
        $firstName = $order->getCustomerFirstname();
        $lastName = $order->getCustomerLastname();

        $this->_emailTarget = $order;
        $this->_emailTarget->setData('customer_email', $customerEmail);
        $this->_emailTarget->setData('customer_firstname', $firstName);
        $this->_emailTarget->setData('customer_lastname', $lastName);
        $this->_quoteId = $quoteId;
        $this->_quote = $this->_quoteFactory->create();
        $this->_quote = $this->quoteRepository->get($this->_quoteId);
        $this->run();
    }//end execute()
}//end class
