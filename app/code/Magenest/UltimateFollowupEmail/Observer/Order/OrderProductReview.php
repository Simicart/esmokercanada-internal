<?php
namespace Magenest\UltimateFollowupEmail\Observer\Order;

use Magento\Framework\Event\ObserverInterface;
use Magento\Email\Model\Template as EmailTemplateModel;
use Magento\Quote\Model\Quote;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\OrderFactory;

class OrderProductReview extends \Magenest\UltimateFollowupEmail\Model\Processor\UltimateFollowupEmail implements ObserverInterface
{

    protected $type = 'order_product_review';

    /**
     * @var Order
     */
    protected $order;

    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $_customerFactory;

    /**
     * @var   \Magento\SalesRule\Model\RuleFactory
     */
    protected $_saleRuleFactory;

    /**
     * @var \Magento\Quote\Model\Quote\TotalsCollector
     */
    protected $_totalsCollector;

    /**
     * @var
     */
    protected $_customer;

    protected $orderFactory;


    public function __construct(
        \Magenest\UltimateFollowupEmail\Model\ResourceModel\Rule\CollectionFactory $rulesFactory,
        \Magenest\UltimateFollowupEmail\Model\MessageFactory $messageFactory,
        \Magenest\UltimateFollowupEmail\Model\SmsFactory $smsFactory,
        EmailTemplateModel $emailTemplateModel,
        \Magento\Quote\Model\Quote\TotalsCollector $totalsCollector,
        \Magenest\UltimateFollowupEmail\Model\MailFactory $mailFactory,
        \Magento\Quote\Model\QuoteFactory $quoteFactory,
        \Magento\Quote\Api\CartRepositoryInterface $cartRepositoryInterface,
        \Magento\SalesRule\Model\RuleFactory $ruleFactory,
        \Magento\Framework\Url $urlInterface,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\SalesRule\Model\Coupon\Massgenerator $massGenerator,
        \Magento\Store\Model\App\Emulation $appEmulation,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        OrderFactory $orderFactory
    ) {
        $this->_customerFactory = $customerFactory;
        $this->_saleRuleFactory = $ruleFactory;
        $this->orderFactory = $orderFactory;
        $this->_totalsCollector = $totalsCollector;
        parent::__construct($context, $rulesFactory, $mailFactory, $messageFactory, $smsFactory, $quoteFactory, $cartRepositoryInterface, $emailTemplateModel, $scopeConfig, $urlInterface, $massGenerator, $appEmulation);
    }


    public function run()
    {
        $this->createFollowUpEmail();
    }


    /**
     * @param $rule
     * @return boolean
     */
    public function isValidate($rule)
    {
        $isValidate = true;
        $order = $this->_emailTarget;
        if ($order instanceof Order) {
            $isValidate = $this->validateCustomerGroupAndWebsite($order->getCustomerGroupId(), $order->getStore()->getWebsiteId());
            if (!$isValidate) {
                return $isValidate;
            }
        }
        $saleRuleModel = $this->_saleRuleFactory->create();

        $saleRuleModel->setData('conditions_serialized', $rule->getData('conditions_serialized'));

        try {
            $saleRuleModel->getConditions();
        } catch (\InvalidArgumentException $e) {
            $saleRuleModel->setData('conditions_serialized', json_encode(unserialize($rule->getData('conditions_serialized'))));
        }

        /** @var Order $order */
        $order = $this->order;
        /** @var Quote $quote */
        $quote = $this->_quoteFactory->create()->load($order->getQuoteId());

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
    }

    public function prepareMail()
    {
        $this->_vars = [
            'customerFistName' => $this->_emailTarget->getCustomerFirstname(),
            'customerLastName' => $this->_emailTarget->getCustomerLastname(),
            'customerName'     => $this->_emailTarget->getCustomerFirstname().' '.$this->_emailTarget->getCustomerLastname(),
            'orderProductsGrid' => $this->getOrderProductGridHtml(),
            'relatedProductsGrid' => $this->getAllRelatedProductsGridHtml()
        ];
    }
    
    protected function getOrderProductGridHtml()
    {
        $items = $this->order->getAllItems();
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
        $items = $this->order->getAllItems();
        $relatedProductGridHtml = '';
        foreach ($items as $item) {
            $relatedProductGridHtml .= $this->getRelatedProductsGridHtml($item->getProduct());
        }
        return $relatedProductGridHtml;
    }

    public function postCreateMail()
    {
        $modify = $this->_activeMail->getData('schedule_time');

        $udpated = $this->_emailTarget->getData('updated_at');

        if ($udpated == '0000-00-00 00:00:00') {
            $udpated = $this->_emailTarget->getData('created_at');
        }

        $current_date_time = new \DateTime($udpated);

        $send_at = $current_date_time->modify($modify)->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT);

        $this->_activeMail->setData('send_date', $send_at)->save();
    }


    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        try {
            $this->order = $observer->getEvent()->getOrder();

            if ($this->order->getState() === Order::STATE_COMPLETE) {
                $this->_customer = $this->_customerFactory->create();

                $customerEmail = $this->order->getCustomerEmail();
                $firstName = $this->order->getCustomerFirstname();
                $lastName = $this->order->getCustomerLastname();
                $mobileNumber = '';
                if ($customerId = $this->order->getCustomerId()) {
                    $customer = $this->_customer->load($customerId);
                    $mobileNumber = $customer->getData('mobile_number');
                }
                $this->storeId = $this->order->getStoreId();
                $this->_emailTarget = $this->order;
                $this->_emailTarget->setId($this->order->getIncrementId());
                $this->_emailTarget->setData('customer_email', $customerEmail);
                $this->_emailTarget->setData('mobile_number', $mobileNumber);
                $this->_emailTarget->setData('customer_firstname', $firstName);
                $this->_emailTarget->setData('customer_lastname', $lastName);

                $this->run();
            }
        } catch (\Exception $e) {
            \Magento\Framework\App\ObjectManager::getInstance()->get(\Psr\Log\LoggerInterface::class)->debug($e->getMessage());
        }
    }
}
