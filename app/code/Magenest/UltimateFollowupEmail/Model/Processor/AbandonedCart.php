<?php
namespace Magenest\UltimateFollowupEmail\Model\Processor;

use Magento\Email\Model\Template as EmailTemplateModel;
use Magento\Framework\Encryption\Encryptor;
use Magento\Quote\Model\Quote;

class AbandonedCart extends UltimateFollowupEmail
{

    protected $_rulesFactory;

    protected $_aggregator;

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
        $this->_aggregator = $abandonedCart;
        $this->_quotesFactory = $quotesFactory;
        $this->_quoteFactory = $quoteFactory;
        $this->_saleRuleFactory = $ruleFactory;
        $this->_totalsCollector = $totalsCollector;
        $this->_encryptor = $encryptor;
        $this->_logger = $context->getLogger();
        parent::__construct($context, $rulesFactory, $mailFactory, $messageFactory, $smsFactory, $quoteFactory, $cartRepositoryInterface, $emailTemplateModel, $scopeConfig, $urlInterface, $massGenerator, $appEmulation);
    }

    public function run()
    {
        $cart = $this->_aggregator->collect();

        /** @var \Magenest\UltimateFollowupEmail\Model\AbandonedCart $abandoned_cart */
        foreach ($cart as $abandoned_cart) {
            $this->cart = $abandoned_cart;
            $abandonedCart = $this->_quoteFactory->create()->loadByIdWithoutStore($this->cart->getQuoteId());
            $this->storeId = $abandonedCart->getStoreId();
            $this->_abandonedCart = $abandonedCart;
            $this->_emailTarget = $abandonedCart;
            if (!$abandonedCart->getData('customer_email')) {
                $this->_emailTarget->setData('customer_email', $abandoned_cart->getEmail());
            }
            if (!$abandonedCart->getData('customer_firstname')) {
                $this->_emailTarget->setData('customer_firstname', 'Guest');
            }
            $this->createFollowUpEmail();
        }
    }


    /**
     * @param \Magenest\UltimateFollowupEmail\Model\Rule $rule
     * @return boolean
     */
    public function isValidate($rule)
    {
        $isValidate = true;
        /** @var Quote $quote */
        $quote = $this->_emailTarget;
        if ($quote instanceof Quote) {
            $isValidate = $this->validateCustomerGroupAndWebsite($quote->getCustomerGroupId(), $quote->getStore()->getWebsiteId());
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
        $this->_abandonedCart->setTotalsCollectedFlag(false);
        $this->_abandonedCart->collectTotals();
        foreach ($this->_abandonedCart->getAllAddresses() as $address) {
            $this->_totalsCollector->collectAddressTotals($this->_abandonedCart, $address);
            $isValidate = $saleRuleModel->validate($address);
        }
        return $isValidate;
    }


    /**
     * @param $cart
     * @return string
     */
    public function getCartHtml($cart)
    {
        $html = '<table>';
        $items = $cart->getAllItems();
        /** @var \Magento\Quote\Model\ResourceModel\Quote\Item $item */
        foreach ($items as $item) {
            $productName = $item->getData('product_name');
            $html .= "<tr><td>$productName</td></tr>";
        }
        return $html;
    }


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
        $autoLoginKey = self::base64UrlEncode($this->_encryptor->encrypt($key));

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

        // get the customer of the abandoned cart
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
    }


    public function postCreateMail()
    {
        //if the customer is guest
        if ($this->_activeMail->getData('recipient_email') == '') {
            $recipient_email = $this->cart->getData('email');
            $recipient_name = $this->cart->getCustomerFirstname(). ' ' .$this->cart->getCustomerLastname();
            $data = [
                'recipient_email' => $recipient_email,
                'recipient_name' => $recipient_name
            ];
            $this->_activeMail->addData($data)->save();
        }
    }
}
