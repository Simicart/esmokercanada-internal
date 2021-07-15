<?php
namespace Magenest\UltimateFollowupEmail\Model\Processor;

class Birthday extends UltimateFollowupEmail
{

    protected $_customerFactory;

    protected $_aggregator;


    public function __construct(
        \Magenest\UltimateFollowupEmail\Model\ResourceModel\Rule\CollectionFactory $rulesFactory,
        \Magenest\UltimateFollowupEmail\Model\MessageFactory $messageFactory,
        \Magenest\UltimateFollowupEmail\Model\SmsFactory $smsFactory,
        \Magento\Reports\Model\ResourceModel\Quote\CollectionFactory $quotesFactory,
        \Magento\Quote\Model\QuoteFactory $quoteFactory,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Email\Model\Template $emailTemplateModel,
        \Magenest\UltimateFollowupEmail\Model\Aggregator\Birthday $birthdayAgg,
        \Magenest\UltimateFollowupEmail\Model\MailFactory $mailFactory,
        \Magento\Quote\Api\CartRepositoryInterface $cartRepositoryInterface,
        \Magento\SalesRule\Model\RuleFactory $ruleFactory,
        \Magento\Framework\Url $urlInterface,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\SalesRule\Model\Coupon\Massgenerator $massGenerator,
        \Magento\Store\Model\App\Emulation $appEmulation
    ) {
        $this->type = 'customer_birthday';

        $this->_aggregator = $birthdayAgg;

        $this->_quoteFactory = $quoteFactory;

        $this->_saleRuleFactory = $ruleFactory;

        $this->_customerFactory = $customerFactory;

        parent::__construct($context, $rulesFactory, $mailFactory, $messageFactory, $smsFactory, $quoteFactory, $cartRepositoryInterface, $emailTemplateModel, $scopeConfig, $urlInterface, $massGenerator, $appEmulation);
    }

    public function run()
    {
        $rules = $this->getMatchingRule();
        if ($rules) {
            /** @var  $rule */
            foreach ($rules as $rule) {
                $this->_activeRule = $rule;

                $emailInChains = $rule->getMailChain();

                foreach ($emailInChains as $emailInChain) {
                    $sendBeforeXdays = $emailInChain['day']?:0;

                    $this->_aggregator->_xDay = $sendBeforeXdays;
                    $customeIds              = $this->_aggregator->collectCustomerHaveBirthdayInXdays();

                    if ($customeIds) {
                        foreach ($customeIds as $customerId) {
                            $customer           = $this->_customerFactory->create()->load($customerId);
                            $this->_emailTarget = $customer;
                            $firstName          = $customer->getFirstname();
                            $lastName           = $customer->getLastname();
                            $customerEmail      = $customer->getEmail();
                            $this->_emailTarget->setData('customer_email', $customerEmail);
                            $this->_emailTarget->setData('customer_firstname', $firstName);
                            $this->_emailTarget->setData('customer_lastname', $lastName);
                            $this->createFollowUpEmail();
                        }
                    }
                }
            }
        }
    }

    public function getDuplicatedKey()
    {
        return $this->_emailTarget->getId().date("Y");
    }


    public function isValidate($rule)
    {
        $isValidate = false;
        $customer = $this->_emailTarget;
        if ($customer instanceof \Magento\Customer\Model\Customer) {
            $isValidate = $this->validateCustomerGroupAndWebsite($customer->getGroupId(), $customer->getWebsiteId());
        }
        return $isValidate;
    }

    public function isDuplicate($rule)
    {
        if (!$this->_emailTarget) {
            return true;
        }

        $rule_id = $rule->getId();

        $key = $this->_emailTarget->getId().date("Y");

        $mailModel = $this->_mailFactory->create();
        $isDuplicate = $mailModel->getIsRuleProcessed($rule_id, $key);
        return $isDuplicate;
    }


    public function prepareMail()
    {
        /*
            * @var  $customer \Magento\Customer\Model\Customer
        */
        $customer          = $this->_emailTarget;
        $customerFirstName = $customer->getFirstname();
        $customerLastName  = $customer->getLastname();
        $customerName      = $customerFirstName.' '.$customerLastName;
        $this->_vars       = [
                              'customer'          => $this->_emailTarget,
                              'customerFirstName' => $customerFirstName,
                              'customerLastName'  => $customerLastName,
                              'customerName'      => $customerName,
                             ];
    }


    public function postCreateMail()
    {
    }
}
