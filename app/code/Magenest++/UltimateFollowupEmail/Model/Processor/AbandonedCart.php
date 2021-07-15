<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 30/09/2015
 * Time: 15:36
 */

namespace Magenest\UltimateFollowupEmail\Model\Processor;

use Magento\Email\Model\Template as EmailTemplateModel;
use Magento\Framework\Encryption\Encryptor;
use Magento\Quote\Model\Quote;
use Symfony\Component\Config\Definition\Exception\Exception;

class AbandonedCart extends UltimateFollowupEmail
{

    protected $_rulesFactory;

    protected $_aggegator;

    protected $_quotesFactory;

    protected $_activeMailChain;

    /**
     * @var \Magento\Quote\Model\Quote\TotalsCollector
     */
    protected $_totalsCollector;

    /**
     * @var  \Magento\Quote\Model\QuoteFactory
     */
    protected $_quoteFactory;

    /**
     * @var   \Magento\SalesRule\Model\RuleFactory
     */
    protected $_saleRuleFactory;

    /**
     * @var  \Magento\Quote\Model\Quote
     */
    protected $_abandonedCart;

    /**
     * @var Quote
     */
    protected $cart;

    protected $_vars;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $_logger;

    /**
     * @var Encryptor
     */
    protected $_encryptor;

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
        Encryptor $encryptor
    ) {
    
        $this->type = 'abandoned_cart';

        $this->_aggegator = $abandonedCart;

        $this->_quotesFactory = $quotesFactory;

        $this->_quoteFactory = $quoteFactory;

        $this->_saleRuleFactory = $ruleFactory;

        $this->_totalsCollector = $totalsCollector;

        $this->_encryptor = $encryptor;

        $this->_logger = $context->getLogger();

        parent::__construct($context, $rulesFactory, $mailFactory, $messageFactory, $smsFactory, $quoteFactory, $cartRepositoryInterface, $emailTemplateModel, $scopeConfig, $urlInterface, $massGenerator, $appEmulation);
    }//end __construct()


    public function run()
    {
        $cart = $this->_aggegator->collect();

        foreach ($cart as $abandoned_cart) {
            $this->cart = $abandoned_cart;

            $abandonedCart = $this->_quoteFactory->create()->loadByIdWithoutStore($this->cart->getQuoteId());
            
            $this->storeId = $abandonedCart->getStoreId();

            $this->_abandonedCart = $abandonedCart;

            $this->_emailTarget = $abandonedCart;

            $this->createFollowUpEmail();
        }
    }//end run()


    /**
     * @param $rule
     * @return boolean
     */
    public function isValidate($rule)
    {
        $isValidate = true;
        $saleRuleModel = $this->_saleRuleFactory->create();

        $saleRuleModel->setData('conditions_serialized', $rule->getData('conditions_serialized'));

        $this->_abandonedCart->setTotalsCollectedFlag(false);

        $this->_abandonedCart->collectTotals();
        foreach ($this->_abandonedCart->getAllAddresses() as $address) {
            $addressTotal = $this->_totalsCollector->collectAddressTotals($this->_abandonedCart, $address);

            $isValidate = $saleRuleModel->validate($address);
        }

        return $isValidate;
    }//end isValidate()


    /**
     * @param $cart \Magento\Quote\Model\Quote
     */
    public function getCartHtml($cart)
    {
        $html = '<table>';
        $items = $cart->getAllItems();
        /*
            * @var \Magento\Quote\Model\ResourceModel\Quote\Item $item
        */

        foreach ($items as $item) {
            $productName = $item->getData('product_name');
            $html .= "<tr><td>$productName</td></tr>";
        }

        return $html;
    }//end getCartHtml()


    public function prepareMail()
    {
        if (!$this->_activeMail) {
            return;
        }

        /** @var Quote $emailTarget */
        $emailTarget = $this->_emailTarget;

        // Quote Id
        $utc = $emailTarget->getId();

        // Customer Auto Login Encrypted Key
        $key = $emailTarget->getCustomerId() . $emailTarget->getCustomerEmail();
        $autoLoginKey = base64_encode($this->_encryptor->encrypt($key));

        $resumeLinkWithSecurityKey = $this->_urlBuilder->getUrl(
            'ultimatefollowupemail/track/restore',
            ['_current' => false, 'utc' => $utc, 'u' => $autoLoginKey]
        );

        $pattern = '/\/\?SID.*/';
        $resumeLink = preg_replace($pattern, '', $resumeLinkWithSecurityKey);
        // get the cart html to render in email reminder
        $items = $this->_abandonedCart->getAllItems();
        $relatedProductHtml = '';
        $cartHtml = "<ul style='list-style: none; margin:0; padding: 0;'>";
        foreach ($items as $item) {
            $cartHtml .= '<li style=" float: left;margin: 0; display: inline;">';
            $cartHtml .= $this->getProductHtml($item->getProduct()->getId());
            $cartHtml .= '</li>';
            $relatedProductHtml .= $this->getRelatedProductsGridHtml($item->getProduct());
        }
        $cartHtml .= '<li style="list-style:none; clear: both;"></li>';
        $cartHtml .= '</ul>';


        // get the customer of abandoned cart
        $customerId = $this->_abandonedCart->getCustomerId();
        $customerFirstName = $this->_abandonedCart->getCustomerFirstname();
        $customerLastName = $this->_abandonedCart->getCustomerLastname();
        $customerName = $customerFirstName . ' ' . $customerLastName;

        $this->_vars = [
            'quote' => $this->_abandonedCart,
            'cart' => htmlspecialchars_decode($cartHtml),
            'resumeLink' => $resumeLink,
            'customerFistName' => $customerFirstName,
            'customerLastName' => $customerLastName,
            'customerName' => $customerName,
            'relatedProductsGrid' => $relatedProductHtml
        ];
    }//end prepareMail()


    public function postCreateMail()
    {
        $modify = $this->_activeMail->getData('schedule_time');

        $udpated = $this->_emailTarget->getData('updated_at');

        if ($udpated == '0000-00-00 00:00:00') {
            $udpated = $this->_emailTarget->getData('created_at');
        }

        $current_date_time = new \DateTime($udpated);

        $send_at = $current_date_time->modify($modify)->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT);

        //if the customer is guest
        if ($this->_activeMail->getData('recipient_email') == '') {
            $recipient_email = $this->cart->getData('email');
            $recipient_name = $this->cart->getCustomerFirstname(). ' ' .$this->cart->getCustomerLastname();
            $data = [
                'recipient_email' => $recipient_email,
                'recipient_name' => $recipient_name
            ];
        }
        $data['send_date'] = $send_at;
        $this->_activeMail->addData($data)->save();
    }//end postCreateMail()
}//end class
