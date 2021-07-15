<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 30/09/2015
 * Time: 15:36
 */

namespace Magenest\UltimateFollowupEmail\Model\Processor;

use Magento\Catalog\Model\Product;
use Magento\Email\Model\Template as EmailTemplateModel;
use Magento\Wishlist\Model\Wishlist;
use Symfony\Component\Config\Definition\Exception\Exception;

class WishlistReminder extends UltimateFollowupEmail
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
     * @var \Magento\Wishlist\Model\Wishlist
     */
    protected $wishlist;

    protected $_vars;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $_logger;

    /**
     * @var \Magenest\UltimateFollowupEmail\Helper\WishlistHelper
     */
    protected $_wishlistHelper;

    /**
     * @var \Magento\Wishlist\Model\WishlistFactory
     */
    protected $_wishlistFactory;

    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $_customerFactory;

    /**
     * @var \Magento\CatalogRule\Model\RuleFactory
     */
    protected $_catalogRuleFactory;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $_productFactory;

    /**
     * @var Product
     */
    protected $wishlistProduct;

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
        \Magenest\UltimateFollowupEmail\Helper\WishlistHelper $wishlistHelper,
        \Magento\Wishlist\Model\WishlistFactory $wishlistFactory,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\CatalogRule\Model\RuleFactory $catalogRuleFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory
    ) {
        $this->type = 'wishlist_reminder';

        $this->_aggegator = $abandonedCart;

        $this->_quotesFactory = $quotesFactory;

        $this->_quoteFactory = $quoteFactory;

        $this->_saleRuleFactory = $ruleFactory;

        $this->_totalsCollector = $totalsCollector;

        $this->_wishlistHelper = $wishlistHelper;

        $this->_wishlistFactory = $wishlistFactory;

        $this->_customerFactory = $customerFactory;

        $this->_catalogRuleFactory = $catalogRuleFactory;

        $this->_productFactory = $productFactory;

        $this->_logger = $context->getLogger();

        parent::__construct($context, $rulesFactory, $mailFactory, $messageFactory, $smsFactory, $quoteFactory, $cartRepositoryInterface, $emailTemplateModel, $scopeConfig, $urlInterface, $massGenerator, $appEmulation);
    }//end __construct()


    public function run()
    {
        $wishlistProductReminders = $this->_wishlistHelper->getCustomersProductWishlist();

        foreach ($wishlistProductReminders as $wishlistProductReminder) {
            if (isset($wishlistProductReminder['wishlist_id']) && $wishlistProductReminder['wishlist_id']) {
                /** @var Wishlist $wishlist */
                $this->wishlist = $this->_wishlistFactory->create()->load($wishlistProductReminder['wishlist_id']);
                $this->_emailTarget = $this->wishlist;

                //set duplicate key
                $this->wishlist->setId(implode(',', [
                    $wishlistProductReminder['customer_id'],
                    $wishlistProductReminder['product_id']
                ]));
                $customer = $this->_customerFactory->create()->load($this->wishlist->getCustomerId());
                $this->wishlist->setData('customer_firstname', $customer->getFirstname());
                $this->wishlist->setData('customer_lastname', $customer->getLastname());
                $this->wishlist->setData('customer_email', $customer->getEmail());

                $this->wishlistProduct = $this->_productFactory->create()->load($wishlistProductReminder['product_id']);
                $this->createFollowUpEmail();
            }
        }
    }//end run()


    /**
     * @param $rule
     * @return boolean
     */
    public function isValidate($rule)
    {
        $catalogRule = $this->_catalogRuleFactory->create();
        $catalogRule->setData('conditions_serialized', $rule->getData('conditions_serialized'));
        $isValidate = $catalogRule->validate($this->wishlistProduct);
        return $isValidate;
    }//end isValidate()

    public function prepareMail()
    {
        if (!$this->_activeMail) {
            return;
        }

//        $utc = $this->_emailTarget->getId();
//        $resumeLinkWithSecurityKey = $this->_urlBuilder->getUrl('ultimatefollowupemail/track/restore', ['_current' => false, 'utc' => $utc]);

//        $pattern    = '/\/\?SID.*/';
//        $resumeLink = preg_replace($pattern, '', $resumeLinkWithSecurityKey);

        // get the customer of abandoned cart
        $customer = $this->_customerFactory->create()->load($this->wishlist->getCustomerId());
        $customerId        = $customer->getId();
        $customerFirstName = $customer->getFirstname();
        $customerLastName  = $customer->getLastname();
        $customerName      = $customer->getName();

        $this->_vars = [
//            'quote'            => $this->_abandonedCart,
//            'cart'             => htmlspecialchars_decode($cartHtml),
//            'resumeLink'       => $resumeLink,
            'customerFistName' => $customerFirstName,
            'customerLastName' => $customerLastName,
            'customerName'     => $customerName,
            'wishlistProduct' => $this->getProductHtml($this->wishlistProduct->getId()),
            'relatedProductsGrid' => $this->getRelatedProductsGridHtml($this->wishlistProduct)
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
        if ($this->_activeMail->getData('recipient_email') =='') {
            $customer = $this->_customerFactory->create()->load($this->wishlist->getCustomerId());
            $this->_activeMail->setData('recipient_email', $customer->getEmail());
            $this->_activeMail->setData('recipient_name', __('valued customer'));
        }

        $this->_activeMail->setData('send_date', $send_at)->save();
    }//end postCreateMail()
}//end class
