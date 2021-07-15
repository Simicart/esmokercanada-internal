<?php
namespace Magenest\UltimateFollowupEmail\Observer\Newsletter;

use Magento\Customer\Model\Group;
use Magento\Customer\Model\Session;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Email\Model\Template as EmailTemplateModel;
use Magento\Store\Model\StoreManagerInterface;

class Subscribe extends \Magenest\UltimateFollowupEmail\Model\Processor\UltimateFollowupEmail implements ObserverInterface
{

    protected $_customerFactory;

    /**
     * @var   \Magento\Customer\Model\Customer
     */
    protected $_customer;

    protected $_subscribe;

    protected $heper;


    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magenest\UltimateFollowupEmail\Model\ResourceModel\Rule\CollectionFactory $rulesFactory,
        \Magenest\UltimateFollowupEmail\Model\MailFactory $mailFactory,
        \Magenest\UltimateFollowupEmail\Model\MessageFactory $messageFactory,
        \Magenest\UltimateFollowupEmail\Model\SmsFactory $smsFactory,
        \Magento\Quote\Model\QuoteFactory $quoteFactory,
        \Magento\Quote\Api\CartRepositoryInterface $cartRepositoryInterface,
        \Magento\Email\Model\Template $emailTemplateModel,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Url $urlInterface,
        \Magento\SalesRule\Model\Coupon\Massgenerator $massGenerator,
        \Magento\Store\Model\App\Emulation $appEmulation,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magenest\UltimateFollowupEmail\Helper\Data $data
    ) {
        $this->heper            = $data;
        $this->_customerFactory = $customerFactory;
        parent::__construct($context, $rulesFactory, $mailFactory, $messageFactory, $smsFactory, $quoteFactory, $cartRepositoryInterface, $emailTemplateModel, $scopeConfig, $urlInterface, $massGenerator, $appEmulation);
    }


    /**
     * build email target and
     *
     * @return mixed
     */
    public function run()
    {
        $this->createFollowUpEmail();
    }


    public function isValidate($rule)
    {
        $customerGroup = $this->_customer->getId()
            ? $this->_customer->getGroupId()
            : Group::NOT_LOGGED_IN_ID;
        $websiteId = ObjectManager::getInstance()->get(StoreManagerInterface::class)->getWebsite()->getId();
        // validate the customer group and website
        $isValidate = parent::validateCustomerGroupAndWebsite($customerGroup, $websiteId);

        if ($isValidate) {
            $gender    = $this->_customer->getGender();
            $condition = unserialize($this->_activeRule->getConditionsSerialized());

            if ($condition['gender']) {
                if ($gender == $condition['gender']) {
                    $isValidate = true;
                } else {
                    $isValidate = false;
                }
            }
        }

        return $isValidate;
    }


    public function prepareMail()
    {
        $this->_vars = [
                        'customer'         => $this->_customer,
                        'customerFistName' => $this->_emailTarget->getCustomerFirstname(),
                        'customerLastName' => $this->_emailTarget->getCustomerLastname(),
                        'customerName'     => $this->_emailTarget->getCustomerFirstname().' '.$this->_emailTarget->getCustomerLastname(),
                       ];
    }


    public function postCreateMail()
    {
    }


    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var $request \Magento\Framework\App\Request\Http\Proxy */
        $request       = $this->heper->getRequest();
        $params        = $request->getParams();
        $is_subscribed = 1;
        if (isset($params['is_subscribed'])) {
            $is_subscribed = $params['is_subscribed'];
        }

        /** @var $subscriber \Magento\Newsletter\Model\Subscriber */
        $subscriber = $observer->getEvent()->getSubscriber();

        $this->_subscribe = $subscriber;
        $this->_emailTarget = $subscriber;
        /** @var $customer \Magento\Customer\Model\Customer **/
        $this->_customer = $this->_customerFactory->create();

        if ($customerId   = $subscriber->getCustomerId()) {
            $this->_customer->load($customerId);
            $firstName       = $this->_customer->getFirstname();
            $lastName        = $this->_customer->getLastname();
            $customerEmail   = $this->_customer->getEmail();
            $mobileNumber    = $this->_customer->getData('mobile_number');
            $this->_emailTarget->setData('customer_email', $customerEmail);
            $this->_emailTarget->setData('mobile_number', $mobileNumber);
            $this->_emailTarget->setData('customer_firstname', $firstName);
            $this->_emailTarget->setData('customer_lastname', $lastName);

        } else {
            $this->_emailTarget->setData('customer_email', $subscriber->getEmail());
            $this->_emailTarget->setData('mobile_number', null);
            $this->_emailTarget->setData('customer_firstname', 'Guest');
            $this->_emailTarget->setData('customer_lastname', '');
        }


        if ($is_subscribed == 1) {
            $this->type = 'newsletter_subscribe';
        } else {
            $this->type = 'newsletter_unsubscribe';
        }

        $this->run();
    }
}
