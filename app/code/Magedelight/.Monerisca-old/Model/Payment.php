<?php
/**
* Magedelight
* Copyright (C) 2017 Magedelight <info@magedelight.com>
*
* @category Magedelight
* @package Magedelight_Monerisca
* @copyright Copyright (c) 2017 Mage Delight (http://www.magedelight.com/)
* @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
* @author Magedelight <info@magedelight.com>
*/

namespace Magedelight\Monerisca\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Phrase;
use Magento\Quote\Api\Data\CartInterface;
use Magento\Payment\Model\InfoInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Payment\Model\MethodInterface;

class Payment implements MethodInterface
{    
    const CODE = 'md_monerisca';
    const RESPONSE_CODE_SUCCESS             = 100;
    const CC_CARDTYPE_SS                    = 'SS';
    const REQUEST_TYPE_AUTH_CAPTURE         = 'AUTH_CAPTURE';
    const REQUEST_TYPE_AUTH_ONLY            = 'AUTH_ONLY';
    const REQUEST_TYPE_CAPTURE_ONLY         = 'CAPTURE_ONLY';
    const REQUEST_TYPE_CREDIT               = 'CREDIT';
    const REQUEST_TYPE_VOID                 = 'VOID';
    const REQUEST_TYPE_PRIOR_AUTH_CAPTURE   = 'PRIOR_AUTH_CAPTURE';
    const CHECK_USE_FOR_MULTISHIPPING       = 8;
    const CHECK_RECURRING_PROFILES          = 64;
   
    const STATUS_UNKNOWN                    = 'UNKNOWN';
    const STATUS_APPROVED                   = 'APPROVED';
    const STATUS_ERROR                      = 'ERROR';
    const STATUS_DECLINED                   = 'DECLINED';
    const STATUS_VOID                       = 'VOID';
    const STATUS_SUCCESS                    = 'SUCCESS';

    const RESPONSE_CODE_APPROVED                         = 1;
    const RESPONSE_CODE_DECLINED                         = 2;
    const RESPONSE_CODE_ERROR                            = 3;
    const RESPONSE_CODE_HELD                             = 4;
    const RESPONSE_REASON_CODE_APPROVED                  = 1;
    const RESPONSE_REASON_CODE_NOT_FOUND                 = 16;
    const RESPONSE_REASON_CODE_PARTIAL_APPROVE           = 295;
    const RESPONSE_REASON_CODE_PENDING_REVIEW_AUTHORIZED = 252;
    const RESPONSE_REASON_CODE_PENDING_REVIEW            = 253;
    const RESPONSE_REASON_CODE_PENDING_REVIEW_DECLINED   = 254;
    const PARTIAL_AUTH_CARDS_LIMIT                       = 5;
    const PARTIAL_AUTH_LAST_SUCCESS                      = 'last_success';
    const PARTIAL_AUTH_LAST_DECLINED                     = 'last_declined';
    const PARTIAL_AUTH_ALL_CANCELED                      = 'all_canceled';
    const PARTIAL_AUTH_CARDS_LIMIT_EXCEEDED              = 'card_limit_exceeded';
    const PARTIAL_AUTH_DATA_CHANGED                      = 'data_changed';
    const TRANSACTION_STATUS_EXPIRED                     = 'expired';

    public $code                       = self::CODE;
    public $formBlockType              = 'Magedelight\Monerisca\Block\Form';
    public $infoBlockType              = 'Magedelight\Monerisca\Block\Info';
    public $cardsStorage               = null;
    public $store                      = 0;
    public $customer                   = null;
    public $backend                    = false;
    public $configModel                = null;
    public $invoice                    = null;
    public $creditmemo                 = null;
    public $postData                   = [];
    public $infoInstance;
    public $storeId;
    public $realTransactionIdKey       = 'real_transaction_id';

     /**
      * @var ManagerInterface
      */
    private $eventManager;

    /**
     * @var Magento\Framework\Registry
     */
    public $registry;

    /**
     * @var Magento\Framework\App\Config\ScopeConfigInterface
     */
    public $scopeConfig;
    
    /**
     * @var Magedelight\Monerisca\Model\Config
     */
    public $monerisConfig;

    /**
     * @var Magedelight\Monerisca\Helper\Data
     */
    public $monerisHelper;
    
    /**
     * @var type
     */
    public $storeManager;

    /**
     * @var Magento\Framework\DataObjectFactory
     */
    public $objectFactory;

    /**
     * @var Magento\Checkout\Model\Session
     */
    public $checkoutsession;

    /**
     * @var Magento\Sales\Model\OrderFactory
     */
    public $ordermodelFactory;

    /**
     * @var Magento\Payment\Model\Config
     */
    public $paymentconfig;

    /**
     * @var CardsFactory
     */
    public $cardfactory;

    /**
     * @var Magento\Framework\Stdlib\DateTime\DateTime
     */
    public $date;

    /**
     * @var Magedelight\Monerisca\Model\Payment\Cards
     */
    public $cardpayment;

    /**
     * @var Magento\Customer\Model\Session
     */
    public $customerSession;

    /**
     * @var Magento\Framework\Encryption\Encryptor
     */
    public $encryptor;
    
   /**
    * @var \Magento\Backend\Model\Session\Quote
    */
    public $sessionQuote;

     /**
      * @var type
      */
    public $customerRepository;

    /**
     * @var Magedelight\Monerisca\Model\Api\Monerisca
     */
    public $monerisApi;

    /**
     * @param ManagerInterface $eventManager
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magedelight\Monerisca\Model\Config $monerisConfig
     * @param \Magedelight\Monerisca\Helper\Data $monerisHelper
     * @param \Magento\Store\Model\StoreManager $storeManager
     * @param \Magento\Framework\DataObjectFactory $objectFactory
     * @param \Magento\Checkout\Model\Session\Proxy $checkoutsession
     * @param \Magento\Sales\Model\OrderFactory $ordermodelFactory
     * @param \Magento\Payment\Model\Config $paymentconfig
     * @param \Magedelight\Monerisca\Model\CardsFactory $cardFactory
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param \Magedelight\Monerisca\Model\Payment\Cards $cardpayment
     * @param \Magento\Customer\Model\Session\Proxy $customerSession
     * @param \Magento\Framework\Encryption\Encryptor $encryptor
     * @param \Magento\Backend\Model\Session\Quote $sessionQuote
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        ManagerInterface $eventManager,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magedelight\Monerisca\Model\Config $monerisConfig,
        \Magedelight\Monerisca\Helper\Data $monerisHelper,
        \Magento\Store\Model\StoreManager $storeManager,
        \Magento\Framework\DataObjectFactory $objectFactory,
        \Magento\Checkout\Model\Session\Proxy $checkoutsession,
        \Magento\Sales\Model\OrderFactory $ordermodelFactory,
        \Magento\Payment\Model\Config $paymentconfig,
        CardsFactory $cardFactory,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magedelight\Monerisca\Model\Payment\Cards $cardpayment,
        \Magento\Customer\Model\Session\Proxy $customerSession,
        \Magento\Framework\Encryption\Encryptor $encryptor,
        \Magento\Backend\Model\Session\Quote $sessionQuote,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magedelight\Monerisca\Model\Api\Monerisca $monerisApi
    ) {
        $this->eventManager                      = $eventManager;
        $this->registry                          = $registry;
        $this->scopeConfig                       = $scopeConfig;
        $this->monerisConfig                     = $monerisConfig;
        $this->monerisHelper                     = $monerisHelper;
        $this->storeManager                      = $storeManager;
        $this->objectFactory                     = $objectFactory;
        $this->checkoutsession                   = $checkoutsession;
        $this->ordermodelFactory                 = $ordermodelFactory;
        $this->paymentconfig                     = $paymentconfig;
        $this->cardfactory                       = $cardFactory;
        $this->date                              = $date;
        $this->cardpayment                       = $cardpayment;
        $this->customerSession                   = $customerSession;
        $this->encryptor                         = $encryptor;
        $this->sessionQuote                      = $sessionQuote;
        $this->customerRepository                = $customerRepository;
        $this->monerisApi                        = $monerisApi;
    }

    public function _construct()
    {
        $this->backend = ($this->storeManager->getStore()->getId() == 0) ? true
                : false;
        if ($this->backend && $this->registry->registry('current_order')) {
            $this->setStore($this->registry->registry('current_order')->getStoreId());
        } elseif ($this->backend && $this->registry->registry('current_invoice')) {
            $this->setStore($this->registry->registry('current_invoice')->getStoreId());
        } elseif ($this->backend && $this->registry->registry('current_creditmemo')) {
            $this->setStore($this->registry->registry('current_creditmemo')->getStoreId());
        } elseif ($this->backend && $this->registry->registry('current_customer')
            != false) {
            $this->setStore($this->registry->registry('current_customer')->getStoreId());
        } elseif ($this->backend && $this->sessionQuote->getStoreId() > 0) {
            $this->setStore($this->sessionQuote->getStoreId());
        } else {
            $this->setStore($this->storeManager->getStore()->getId());
        }
    }
    // @codingStandardsIgnoreEnd
     /**
      * Retrieve payment method code
      *
      * @return string
      *
      */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Retrieve block type for method form generation
     *
     * @return string
     *
     * @deprecated
     */
    public function getFormBlockType()
    {
        return $this->formBlockType;
    }

    /**
     * Retrieve payment method title
     *
     * @return string
     *
     */
    public function getTitle()
    {
        return $this->monerisConfig->getMethodTitle();
    }

    /**
     * Store id getter
     * @return int
     */
    public function getStore()
    {
        return $this->storeId;
    }

    /**
     * Check order availability
     *
     * @return bool
     *
     */
    public function canOrder()
    {
        return true;
    }

    /**
     * Check authorize availability
     *
     * @return bool
     *
     */
    public function canAuthorize()
    {
        return true;
    }

    /**
     * Check capture availability
     *
     * @return bool
     *
     */
    public function canCapture()
    {
        return true;
    }

    /**
     * Check partial capture availability
     *
     * @return bool
     *
     */
    public function canCapturePartial()
    {
        return true;
    }

    /**
     * Check whether capture can be performed once and no further capture possible
     *
     * @return bool
     *
     */
    public function canCaptureOnce()
    {
        return false;
    }

    /**
     * Check refund availability
     *
     * @return bool
     *
     */
    public function canRefund()
    {
        return true;
    }

    /**
     * Check partial refund availability for invoice
     *
     * @return bool
     *
     */
    public function canRefundPartialPerInvoice()
    {
        return true;
    }

    /**
     * Check void availability
     * @return bool
     *
     */
    public function canVoid()
    {
        return true;
    }

    /**
     * Using internal pages for input payment data
     * Can be used in admin
     *
     * @return bool
     */
    public function canUseInternal()
    {
        return true;
    }

    /**
     * Can be used in regular checkout
     *
     * @return bool
     */
    public function canUseCheckout()
    {
        return true;
    }

    /**
     * Can be edit order (renew order)
     *
     * @return bool
     *
     */
    public function canEdit()
    {
        return true;
    }

    /**
     * Check fetch transaction info availability
     *
     * @return bool
     *
     */
    public function canFetchTransactionInfo()
    {
        return true;
    }

    /**
     * Fetch transaction info
     *
     * @param InfoInterface $payment
     * @param string $transactionId
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     */
    public function fetchTransactionInfo(InfoInterface $payment, $transactionId)
    {
        return false;
    }

    /**
     * Retrieve payment system relation flag
     *
     * @return bool
     *
     */
    public function isGateway()
    {
        return true;
    }

    /**
     * Retrieve payment method online/offline flag
     *
     * @return bool
     *
     */
    public function isOffline()
    {
        return false;
    }

    /**
     * Flag if we need to run payment initialize while order place
     *
     * @return bool
     *
     */
    public function isInitializeNeeded()
    {
        return false;
    }

    /**
     * To check billing country is allowed for the payment method
     *
     * @param string $country
     * @return bool
     */
    public function canUseForCountry($country)
    {
         /*
        for specific country, the flag will set up as 1
        */
        if ($this->getConfigData('allowspecific') == 1) {
            $availableCountries = explode(',', $this->getConfigData('specificcountry'));
            if (!in_array($country, $availableCountries)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Retrieve block type for display method information
     *
     * @return string
     *
     * @deprecated
     */
    public function getInfoBlockType()
    {
        return $this->infoBlockType;
    }

   /**
    * @inheritdoc
    */
    public function getInfoInstance()
    {
        return $this->infoInstance;
    }

    /**
     * @inheritdoc
     */
    public function setInfoInstance(InfoInterface $info)
    {
        $this->infoInstance = $info;
    }

    /**
     * Order payment abstract method
     *
     * @param InfoInterface $payment
     * @param float $amount
     * @return $this
     *
     */
    // @codingStandardsIgnoreStart
    public function order(\Magento\Payment\Model\InfoInterface $payment, $amount)
    {
        if (!$this->canOrder()) {
            throw new \Magento\Framework\Exception\LocalizedException(__('The order action is not available.'));
        }
        return $this;
    }
   // @codingStandardsIgnoreEnd
    /**
     * Whether this method can accept or deny payment
     * @return bool
     *
     */
    public function canReviewPayment()
    {
        return false;
    }

    /**
     * Attempt to accept a payment that us under review
     *
     * @param InfoInterface $payment
     * @return false
     * @throws \Magento\Framework\Exception\LocalizedException
     *
     */
    // @codingStandardsIgnoreStart
    public function acceptPayment(InfoInterface $payment)
    {
        if (!$this->canReviewPayment()) {
            throw new \Magento\Framework\Exception\LocalizedException(__('The payment '
                . 'review action is unavailable.'));
        }
        return false;
    }
    // @codingStandardsIgnoreEnd
    /**
     * Attempt to deny a payment that us under review
     *
     * @param InfoInterface $payment
     * @return false
     * @throws \Magento\Framework\Exception\LocalizedException
     *
     */
      // @codingStandardsIgnoreStart
    public function denyPayment(InfoInterface $payment)
    {
        if (!$this->canReviewPayment()) {
            throw new \Magento\Framework\Exception\LocalizedException(__('The payment '
                . 'review action is unavailable.'));
        }
        return false;
    }
  // @codingStandardsIgnoreEnd
    /**
     * Retrieve information from payment configuration
     *
     * @param string $field
     * @param int|string|null|\Magento\Store\Model\Store $storeId
     *
     * @return mixed
     */
    public function getConfigData($field, $storeId = null)
    {
        if (null === $storeId) {
            $storeId = $this->getStore();
        }
        $path = 'payment/' . $this->getCode() . '/' . $field;
        return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * Is active
     *
     * @param int|null $storeId
     * @return bool
     *
     */
    public function isActive($storeId = null)
    {
        return (bool)(int)$this->getConfigData('active', $storeId);
    }

    /**
     * Method that will be executed instead of authorize or capture
     * if flag isInitializeNeeded set to true
     *
     * @param string $paymentAction
     * @param object $stateObject
     *
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     */
    public function initialize($paymentAction, $stateObject)
    {
        return $this;
    }

    /**
     * Get config payment action url
     * Used to universalize payment actions when processing payment place
     *
     * @return string
     *
     */
    public function getConfigPaymentAction()
    {
        return $this->getConfigData('payment_action');
    }

    public function setStore($id)
    {
        $this->storeId = $id;

        return $this;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
        if ($customer->getStoreId() > 0) {
            $this->setStore($customer->getStoreId());
        }

        return $this;
    }

    public function getCustomer()
    {
        if (isset($this->customer)) {
            $customer = $this->customer;
        } elseif ($this->backend) {
            $customer = $this->customerRepository->getById($this->sessionQuote->getCustomerId());
        } else {
            $customer = $this->customerSession->getCustomer();
        }

        $this->setCustomer($customer);

        return $customer;
    }

    public function getCardInfo($datakey = null)
    {
        $card = null;
        if (!($datakey === null)) {
            $cardModel = $this->cardfactory->create();
            $card      = $cardModel->getCollection()
                ->addFieldToFilter('data_key', $datakey)
                ->getData();
        }

        return $card;
    }

    public function saveCustomerProfileData(
        $response,
        $payment,
        $customerid = null
    ) {
        $websiteId =  $this->monerisHelper->getWebsiteId();
        $data_key = $response->responseData["DataKey"];
        if (empty($customerid)) {
            $post       = $this->postData;
            $customer   = $this->getCustomer();
            $customerid = $customer->getId();
            $ccType     = $post['cc_type'];
            $ccExpMonth = $post['expiration'];
            $ccExpYear  = $post['expiration_yr'];
            $ccLast4    = substr($post['cc_number'], -4, 4);
        } else {
            $ccType     = $payment->getCcType();
            $ccExpMonth = $payment->getCcExpMonth();
            $ccExpYear  = $payment->getCcExpYear();
            $ccLast4    = $payment->getCcLast4();
        }

        if (!empty($data_key) && $customerid) {
            $billing = $payment->getOrder()->getBillingAddress();
            try {
                $model = $this->cardfactory->create();
                $model->setFirstname($billing->getFirstname())
                    ->setLastname($billing->getLastname())
                    ->setPostcode($billing->getPostcode())
                    ->setCountryId($billing->getCountryId())
                    ->setRegionId($billing->getRegionId())
                    ->setState($billing->getRegion())
                    ->setCity($billing->getCity())
                    ->setCompany($billing->getCompany())
                    ->setStreet($billing->getStreet()[0])
                    ->setTelephone($billing->getTelephone())
                    ->setCustomerId($customerid)
                    ->setDataKey($data_key)
                    ->setccType($ccType)
                    ->setcc_exp_month($ccExpMonth)
                    ->setcc_exp_year($ccExpYear)
                    ->setcc_last4($ccLast4)
                    ->setWebsiteId($websiteId)    
                    ->setCreatedAt($this->date->gmtDate())
                    ->setUpdatedAt($this->date->gmtDate());
                 $model->getResource()->save($model);
                return;
            } catch (\Exception $e) {
                // @codingStandardsIgnoreStart
                throw new LocalizedException(new Phrase(__('Unable to save '
                    . 'customer profile due to: '.$e->getMessage())));
                  // @codingStandardsIgnoreEnd
            }
        }
    }

    public function assignData(\Magento\Framework\DataObject $data)
    {
        $post = $data->getData()['additional_data'];
        if (!isset($post["save_card"])) {
            $post["save_card"]  = false;
        }
        if (empty($this->postData)) {
            $this->postData = $post;
        }

        $this->registry->register('postdata', $this->postData);

        if (isset($post['data_key']) && $post['data_key'] != 'new') {
            $dataKey = $this->encryptor->decrypt($post['data_key']);
            $creditCard          = $this->getCardInfo($dataKey);
            if ($creditCard != '' && !empty($creditCard)) {
                $this->getInfoInstance()->setCcLast4($creditCard[0]['cc_last_4'])
                    ->setCcType($creditCard[0]['cc_type'])
                    ->setAdditionalInformation(
                        'md_monerisca_data_key',
                        $post['data_key'],
                        'md_save_card',
                        $post['save_card']
                    );
                if (isset($post['cc_cid'])) {
                    $this->getInfoInstance()->setCcCid($post['cc_cid']);
                }
            }
            unset($this->postData['cc_type']);
            unset($this->postData['cc_number']);
            unset($this->postData['expiration']);
            unset($this->postData['expiration_yr']);
            $this->registry->unregister('postdata');
            $this->registry->register('postdata', $this->postData);
        } else {
            $this->getInfoInstance()->setCcType($post['cc_type'])
                ->setCcLast4(substr($post['cc_number'], -4))
                ->setCcNumber($post['cc_number'])
                ->setCcExpMonth($post['expiration'])
                ->setCcExpYear($post['expiration_yr'])
                ->setAdditionalInformation('md_save_card', $post['save_card']);
            if (isset($post['cc_cid'])) {
                $this->getInfoInstance()->setCcCid($post['cc_cid']);
            }
        }
        return $this;
    }

    public function validate()
    {
        if (empty($this->postData)) {
            $this->postData = $this->registry->registry('postdata');
        }
        $post = $this->postData;
        $datakey = (isset($post['data_key'])) ? $post['data_key'] : 'new';
        if ($datakey == 'new' || !empty($post['cc_number'])) {
            try {
                $this->parentValidate();
                $info           = $this->getInfoInstance();
                $initerrorMsg   = false;
                $availableTypes = explode(',', $this->getConfigData('cctypes'));
                $ccNumberInfo   = $info->getCcNumber();
                $ccNumber       = preg_replace('/[\-\s]+/', '', $ccNumberInfo);
                $info->setCcNumber($ccNumber);
                $ccTypeinit     = '';
                $result         = $this->checkValidate(
                    $initerrorMsg,
                    $ccTypeinit,
                    $info,
                    $availableTypes,
                    $ccNumber
                );
                $errorMsgg      = $result["error_msg"];
                $errorMsg       = $this->prepareValidate(
                    $errorMsgg,
                    $info
                );
                if ($errorMsg) {
                    // @codingStandardsIgnoreStart
                    throw new LocalizedException(new Phrase($errorMsg));
                    // @codingStandardsIgnoreEnd
                }

                return $this;
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            return true;
        }
    }
    public function checkValidate(
        $errorMsg,
        $ccType,
        $info,
        $availableTypes,
        $ccNumber
    ) {

        if (in_array($info->getCcType(), $availableTypes)) {
            if ($this->validateCcNum($ccNumber)) {
                $ccTypeRegExpList    = [
                    'SO' => '/(^(6334)[5-9](\d{11}$|\d{13,14}$))|(^(6767)(\d{12}$|\d{14,15}$))/',
                    'SM' => '/(^(5[0678])\d{11,18}$)|(^(6[^05])\d{11,18}$)|(^(601)[^1]\d{9,16}$)|(^(6011)\d{9,11}$)'.
                    '|(^(6011)\d{13,16}$)|(^(65)\d{11,13}$)|(^(65)\d{15,18}$)'.
                    '|(^(49030)[2-9](\d{10}$|\d{12,13}$))|(^(49033)[5-9](\d{10}$|\d{12,13}$))'.
                    '|(^(49110)[1-2](\d{10}$|\d{12,13}$))|(^(49117)[4-9](\d{10}$|\d{12,13}$))'.
                    '|(^(49118)[0-2](\d{10}$|\d{12,13}$))|(^(4936)(\d{12}$|\d{14,15}$))/',
                    'VI' => '/^4[0-9]{12}([0-9]{3})?$/',
                    'MC' => '/^5[1-5][0-9]{14}$/',
                    'AE' => '/^3[47][0-9]{13}$/',
                    'DI' => '/^6(?:011|5[0-9]{2})[0-9]{12}$/',
                    'JCB' => '/^(30[0-5][0-9]{13}|3095[0-9]{12}|35(2[8-9][0-9]{12}|[3-8][0-9]{13})|36[0-9]{12}'.
                    '|3[8-9][0-9]{14}|6011(0[0-9]{11}|[2-4][0-9]{11}|74[0-9]{10}|7[7-9][0-9]{10}'.
                    '|8[6-9][0-9]{10}|9[0-9]{11})|62(2(12[6-9][0-9]{10}|1[3-9][0-9]{11}|[2-8][0-9]{12}'.
                    '|9[0-1][0-9]{11}|92[0-5][0-9]{10})|[4-6][0-9]{13}|8[2-8][0-9]{12})|6(4[4-9][0-9]{13}'.
                    '|5[0-9]{14}))$/',
                    'DC' => '/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/',
                    'MAESTRO'=>
                    '/(^(5[0678])\d{11,18}$)|(^(6[^05])\d{11,18}$)|(^(601)[^1]\d{9,16}$)|(^(6011)\d{9,11}$)'.
                    '|(^(6011)\d{13,16}$)|(^(65)\d{11,13}$)|(^(65)\d{15,18}$)'.
                    '|(^(49030)[2-9](\d{10}$|\d{12,13}$))|(^(49033)[5-9](\d{10}$|\d{12,13}$))'.
                    '|(^(49110)[1-2](\d{10}$|\d{12,13}$))|(^(49117)[4-9](\d{10}$|\d{12,13}$))'.
                    '|(^(49118)[0-2](\d{10}$|\d{12,13}$))|(^(4936)(\d{12}$|\d{14,15}$))/',
                    'SWITCH' =>
                    '/(^(5[0678])\d{11,18}$)|(^(6[^05])\d{11,18}$)|(^(601)[^1]\d{9,16}$)|(^(6011)\d{9,11}$)'.
                    '|(^(6011)\d{13,16}$)|(^(65)\d{11,13}$)|(^(65)\d{15,18}$)'.
                    '|(^(49030)[2-9](\d{10}$|\d{12,13}$))|(^(49033)[5-9](\d{10}$|\d{12,13}$))'.
                    '|(^(49110)[1-2](\d{10}$|\d{12,13}$))|(^(49117)[4-9](\d{10}$|\d{12,13}$))'.
                    '|(^(49118)[0-2](\d{10}$|\d{12,13}$))|(^(4936)(\d{12}$|\d{14,15}$))/',
                ];
                $ccNumAndTypeMatches = isset(
                    $ccTypeRegExpList[$info->getCcType()]
                ) && preg_match(
                    $ccTypeRegExpList[$info->getCcType()],
                    $ccNumber
                );
                $ccType              = $ccNumAndTypeMatches ? $info->getCcType()
                        : 'OT';

                if (!$ccNumAndTypeMatches) {
                    $errorMsg = __('The credit card number doesn\'t match the credit card type.');
                }
            } else {
                $errorMsg = __('Invalid Credit Card Number');
            }
        } else {
            $errorMsg = __('This credit card type is not allowed for this payment method.');
        }
        $result["error_msg"] = $errorMsg;
        $result["cc_type"]   = $ccType;
        return $result;
    }

    /**
     * Validate credit card number
     *
     * @param   string $ccNumber
     * @return  bool
     * @api
     */
    public function validateCcNum($ccNumber)
    {
        $cardNumber = strrev($ccNumber);
        $numSum = 0;
        $line_length = strlen($cardNumber);
        for ($i = 0; $i < $line_length; $i++) {
            $currentNum = substr($cardNumber, $i, 1);

            /**
             * Double every second digit
             */
            if ($i % 2 == 1) {
                $currentNum *= 2;
            }

            /**
             * Add digits of 2-digit numbers together
             */
            if ($currentNum > 9) {
                $firstNum = $currentNum % 10;
                $secondNum = ($currentNum - $firstNum) / 10;
                $currentNum = $firstNum + $secondNum;
            }

            $numSum += $currentNum;
        }

        /**
         * If the total has no remainder it's OK
         */
        return $numSum % 10 == 0;
    }
     /**
      * @return bool
      * @api
      */
    public function hasVerification()
    {
        $configData = $this->getConfigData('useccv');
        if ($configData === null) {
            return true;
        }
        return (bool)$configData;
    }
    public function prepareValidate($errorMsg, $info)
    {
        if ($errorMsg === false && $this->hasVerification()) {
            $verifcationRegEx = $this->getVerificationRegEx();
            $regExp           = isset($verifcationRegEx[$info->getCcType()]) ? $verifcationRegEx[$info->getCcType()]
                    : '';
            if (!$info->getCcCid() || !$regExp || !preg_match(
                $regExp,
                $info->getCcCid()
            )) {
                $errorMsg = __('Please enter a valid credit card verification number.');
            }
        }

        return $errorMsg;
    }
    public function getVerificationRegEx()
    {
        $verificationExpList = [
            'VI' => '/^[0-9]{3}$/',
            'MC' => '/^[0-9]{3}$/',
            'AE' => '/^[0-9]{4}$/',
            'DI' => '/^[0-9]{3}$/',
            'SS' => '/^[0-9]{3,4}$/',
            'SM' => '/^[0-9]{3,4}$/',
            'SO' => '/^[0-9]{3,4}$/',
            'OT' => '/^[0-9]{3,4}$/',
            'JCB' => '/^[0-9]{3,4}$/',
            'MAESTRO' => '/^[0-9]{3}$/',
            'SWITCH' => '/^[0-9]{3}$/',
            'DC' => '/^[0-9]{3}$/',
        ];

        return $verificationExpList;
    }

    public function parentValidate()
    {
        $paymentInfo = $this->getInfoInstance();
        if ($paymentInfo instanceof \Magento\Sales\Model\Order\Payment) {
            $billingCountry = $paymentInfo->getOrder()->getBillingAddress()->getCountryId();
        } else {
            $billingCountry = $paymentInfo->getQuote()->getBillingAddress()->getCountryId();
        }
        if (!$this->canUseForCountry($billingCountry)) {
            // @codingStandardsIgnoreStart
            throw new LocalizedException(
                new Phrase(__('You can\'t use the payment type '
                    . 'you selected to make payments to the billing country.'))
            );
             // @codingStandardsIgnoreEnd
        }

        return $this;
    }
    public function authorize(
        \Magento\Payment\Model\InfoInterface $payment,
        $amount
    ) {
         $exceptionMessage = false;
        if ($amount <= 0) {
            // @codingStandardsIgnoreStart
            throw new LocalizedException(new Phrase(__('Invalid amount for authorization.')));
             // @codingStandardsIgnoreEnd
        }
        $this->_initCardsStorage($payment);
        if (empty($this->postData)) {
            $this->postData = $this->registry->registry('postdata');
        }
        $post = $this->postData;
        try {
            $isMultiShipping     = $this->checkoutsession->getQuote()->getData('is_multi_shipping');
            $dataKey = $payment->getData(
                'additional_information',
                'md_monerisca_data_key'
            );
            if ((!empty($dataKey) && empty($post['cc_number'])) || ($isMultiShipping
                == '1' && !empty($dataKey))) {
                $dataKey = $this->encryptor->decrypt($dataKey);
                $payment->setMdMoneriscaDataKey($dataKey);
                $payment->setAdditionalInformation(
                    'md_monerisca_data_key',
                    $dataKey
                );
                $response            = $this->monerisApi
                    ->prepareAuthorizeResponse($payment, $amount, true);
            } else {
                $response = $this->monerisApi
                    ->prepareAuthorizeResponse($payment, $amount, false);
            }
            $this->prepareResponse(
                $payment,
                $response,
                $dataKey,
                $post,
                $amount
            );
        } catch (\Exception $e) {
            // @codingStandardsIgnoreStart
            throw new LocalizedException(new Phrase('Moneris Gateway request error:'.$e->getMessage()));
             // @codingStandardsIgnoreEnd
        }
        if ($exceptionMessage !== false) {
            // @codingStandardsIgnoreStart
            throw new LocalizedException(new Phrase($exceptionMessage));
             // @codingStandardsIgnoreEnd
        }
        $payment->setSkipTransactionCreation(true);

        return $this;
    }

    public function prepareResponse(
        $payment,
        $response,
        $dataKey,
        $post,
        $amount
    ) {
          $transFlag = $response->responseData["Complete"];
          $code      = $response->responseData["ResponseCode"];
           $authcode      = $response->responseData["AuthCode"];
        if ($transFlag=="true" && $code < 50) {
            if (!empty($dataKey) && empty($post['cc_number'])) {
                $card = $this->getCardInfo($dataKey);
                $payment->setCcLast4($card[0]['cc_last_4']);
                $payment->setCcType($card[0]['cc_type']);
                $payment->setAdditionalInformation(
                    'md_monerisca_data_key',
                    $dataKey
                );
                $payment->setMdMoneriscaDataKey($dataKey);
            } else {
                $payment->setCcLast4(substr($post['cc_number'], -4, 4));
                $payment->setCcType($post['cc_type']);
            }
            $saveCard = $payment->getData(
                'additional_information',
                'md_save_card'
            );
            if (($saveCard == 'true' && isset($post['cc_number'])) && $post['cc_number']
                != '' && ($this->customerSession->getCustomerId() || ($this->monerisHelper->checkAdmin()
                && $this->sessionQuote->getQuote()->getCustomerId()))) {
                $this->prepareProfileResponse($payment);
            }
            $csToRequestMap     = self::REQUEST_TYPE_AUTH_ONLY;
            $payment->setAnetTransType($csToRequestMap);
            $payment->setAmount($amount);
            $newTransactionType = \Magento\Sales\Model\Order\Payment\Transaction::TYPE_AUTH;
            $card               = $this->_registerCard($response, $payment);

            $this->_addTransaction(
                $payment,
                $response->responseData['TransID'],
                $newTransactionType,
                ['is_transaction_closed' => 0],
                [$this->realTransactionIdKey => $response->responseData['TransID']],
                $this->monerisHelper->getTransactionMessage(
                    $payment,
                    $csToRequestMap,
                    $response->responseData['TransID'],
                    $card,
                    $amount
                )
            );

            $card->setLastTransId($response->responseData['TransID']);

            $payment->setLastTransId($response->responseData['TransID'])
                ->setCcTransId($response->responseData['TransID'])
                ->setTransactionId($response->responseData['TransID'])
                ->setMdMoneriscaRequestId($response->responseData['TransID'])
                ->setMoneriscaToken($response->responseData['TransID'])
                ->setStatus(self::STATUS_APPROVED)
                ->setCcAvsStatus($response->responseData['AuthCode']);
            if(isset($response->responseData['AvsResultCode'])){
                $payment->setAvsResultCode($response->responseData['AvsResultCode']);
            }
            if(isset($response->responseData['CvdResultCode'])){
                $payment->setCVNResultCode($response->responseData['CvdResultCode']);
            }
            /*
             * checking if we have cvCode in response bc
             * if we don't send cvn we don't get cvCode in response
             */
            if (isset($response->responseData['CvdResultCode'])) {
                $payment->setCcCidStatus($response->responseData['CvdResultCode']);
            }
        } else {
               $errorMessage = $this->monerisHelper->getErrorDescription($code);
            if (isset($errorMessage) && !empty($errorMessage)) {
                $exceptionMessage = $errorMessage;
            } else {
                $exceptionMessage = $response->responseData["Message"];
            }
                   $card               = $this->_registerCard($response, $payment);
                 $exceptionMessage = $this->monerisHelper->getTransactionMessage(
                     $payment,
                     self::REQUEST_TYPE_AUTH_ONLY,
                     $response->responseData['TransID'],
                     $card,
                     $amount,
                     $exceptionMessage
                 );
                 // @codingStandardsIgnoreStart
                 throw new LocalizedException(new Phrase($exceptionMessage));
                  // @codingStandardsIgnoreEnd
        }
    }

    public function prepareProfileResponse($payment)
    {
        $profileResponse      = $this->monerisApi
            ->createCustomerProfileFromTransaction($payment);
        $transFlag = $profileResponse->responseData["Complete"];
        $code       = $profileResponse->responseData["ResponseCode"];
       
        if ($transFlag=="true") {
            $customerid = $this->monerisHelper->checkAdmin() ? $this->sessionQuote->getQuote()->getCustomerId()
                    : $this->customerSession->getCustomer()->getId();
            $this->saveCustomerProfileData(
                $profileResponse,
                $payment,
                $customerid
            );
        } else {
            $errorMessage = $this->monerisHelper->getErrorDescription($code);
           
            if (isset($errorMessage) && !empty($errorMessage)) {
                // @codingStandardsIgnoreStart
                throw new LocalizedException(new Phrase('Error code: '.$code.' : '.$errorMessage));
                 // @codingStandardsIgnoreEnd
            } else {
                // @codingStandardsIgnoreStart
                throw new LocalizedException(new Phrase($profileResponse->responseData["Message"]));
                 // @codingStandardsIgnoreEnd
            }
        }
    }

    public function capture(
        \Magento\Payment\Model\InfoInterface $payment,
        $amount
    ) {
        
        if ($amount <= 0) {
            // @codingStandardsIgnoreStart
            throw new LocalizedException(new Phrase(__('Invalid amount for capture.')));
             // @codingStandardsIgnoreEnd
        }
        $this->_initCardsStorage($payment);

        if (empty($this->postData)) {
            $this->postData = $this->registry->registry('postdata');
        }
        $post = $this->postData;

        try {
            if ($this->_isPreauthorizeCapture($payment)) {
                $this->_preauthorizeCapture($payment, $amount);
            } else {
                $isMultiShipping     = $this->checkoutsession->getQuote()->getData('is_multi_shipping');
                $dataKey = $payment->getData(
                    'additional_information',
                    'md_monerisca_data_key'
                );
                $this->prepareCapResponse(
                    $payment,
                    $dataKey,
                    $post,
                    $isMultiShipping,
                    $amount
                );
            }
        } catch (\Exception $e) {
            // @codingStandardsIgnoreStart
            throw new LocalizedException(new Phrase(__('Gateway request error:'.$e->getMessage())));
             // @codingStandardsIgnoreEnd
        }
        $payment->setSkipTransactionCreation(true);

        return $this;
    }

    public function prepareCapResponse(
        $payment,
        $dataKey,
        $post,
        $isMultiShipping,
        $amount
    ) {

        if ((!empty($dataKey) && empty($post['cc_number'])) || ($isMultiShipping
            == '1' && !empty($dataKey))) {
            $dataKey = $this->encryptor->decrypt($dataKey);
            $payment->setMdMoneriscaDataKey($dataKey);
            $payment->setAdditionalInformation(
                'md_monerisca_data_key',
                $dataKey
            );
            $response            = $this->monerisApi
                ->prepareCaptureResponse($payment, $amount, true);
        } else {
            $response = $this->monerisApi
                ->prepareCaptureResponse($payment, $amount, false);
        }
         $transFlag = $response->responseData["Complete"];
         $code      = $response->responseData["ResponseCode"];
         $authcode      = $response->responseData["AuthCode"];
        if ($transFlag=="true" && $code < 50) {
            if (!empty($dataKey) && empty($post['cc_number'])) {
                $card = $this->getCardInfo($dataKey);
                $payment->setCcLast4($card[0]['cc_last_4']);
                $payment->setCcType($card[0]['cc_type']);
                $payment->setAdditionalInformation(
                    'md_monerisca_data_key',
                    $dataKey
                );
                $payment->setMdMoneriscaDataKey($dataKey);
            } else {
                $payment->setCcLast4(substr($post['cc_number'], -4, 4));
                $payment->setCcType($post['cc_type']);
            }
            $saveCard = $payment->getData(
                'additional_information',
                'md_save_card'
            );
            if (($saveCard == 'true' && isset($post['cc_number'])) && $post['cc_number']
              != '' && ($this->customerSession->getCustomerId() || ($this->monerisHelper->checkAdmin()
              && $this->sessionQuote->getQuote()->getCustomerId()))) {
                $this->prepareCapSuccessMsg($response, $payment);
            }

            $card                 = $this->_registerCard(
                $response,
                $payment
            );
            $csToRequestMap       = self::REQUEST_TYPE_AUTH_CAPTURE;
            $newTransactionType   = \Magento\Sales\Model\Order\Payment\Transaction::TYPE_CAPTURE;
            $this->_addTransaction(
                $payment,
                $response->responseData['TransID'],
                $newTransactionType,
                ['is_transaction_closed' => 0],
                [$this->realTransactionIdKey =>  $response->responseData['TransID']],
                $this->monerisHelper->getTransactionMessage(
                    $payment,
                    $csToRequestMap,
                    $response->responseData['TransID'],
                    $card,
                    $amount
                )
            );
            
            $card->setLastTransId($response->responseData['TransID']);
            $card->setCapturedAmount($card->getProcessedAmount());
            $captureTransactionId = $response->responseData['TransID'];
            $card->setLastCapturedTransactionId($captureTransactionId);
            $this->getCardsStorage()->updateCard($card);

            $payment->setLastTransId($response->responseData['TransID'])
              ->setLastMoneriscaToken($response->responseData['TransID'])
              ->setCcTransId($response->responseData['TransID'])
              ->setTransactionId($response->responseData['TransID'])
              ->setIsTransactionClosed(0)
              ->setMoneriscaToken($response->responseData['TransID']);
        } else {
               $errorMessage = $this->monerisHelper->getErrorDescription($code);
            if (isset($errorMessage) && !empty($errorMessage)) {
                $exceptionMessage = $errorMessage;
            } else {
                $exceptionMessage = $response->responseData["Message"];
            }

         // @codingStandardsIgnoreStart
            throw new LocalizedException(new Phrase($exceptionMessage));
            // @codingStandardsIgnoreEnd
        }
    }

    public function prepareCapSuccessMsg($response, $payment)
    {
        $profileResponse      = $this->monerisApi
            ->createCustomerProfileFromTransaction($payment);
        $transFlag = $profileResponse->responseData["Complete"];
        $code       = $profileResponse->responseData["ResponseCode"];
        $authcode      = $response->responseData["AuthCode"];
        if ($transFlag=="true" && $code < 50) {
            $customerid = $this->monerisHelper->checkAdmin() ? $this->sessionQuote->getQuote()->getCustomerId()
                  : $this->customerSession->getCustomer()->getId();
            $this->saveCustomerProfileData(
                $profileResponse,
                $payment,
                $customerid
            );
        } else {
            $errorMessage = $this->monerisHelper->getErrorDescription($code);

            if (isset($errorMessage) && !empty($errorMessage)) {
                // @codingStandardsIgnoreStart
                throw new LocalizedException(new Phrase('Error code: '.$code.' : '.$errorMessage));
                 // @codingStandardsIgnoreEnd
            } else {
                // @codingStandardsIgnoreStart
                throw new LocalizedException(new Phrase($profileResponse->responseData["Message"]));
                 // @codingStandardsIgnoreEnd
            }
        }
    }

    public function refund(
        \Magento\Payment\Model\InfoInterface $payment,
        $amount
    ) {
        $cardsStorage = $this->getCardsStorage($payment);
        if ($this->_formatAmount(
            $cardsStorage->getCapturedAmount() - $cardsStorage->getRefundedAmount()
        ) < $amount
        ) {
            // @codingStandardsIgnoreStart
            throw new LocalizedException(new Phrase(__('Invalid amount for refund.')));
            // @codingStandardsIgnoreEnd
        }

        $creditmemo = $this->registry->registry('current_creditmemo');
        if (!$creditmemo === null) {
            $this->invoice = $creditmemo->getInvoice();
        }

        if ($amount > 0) {
            $result       = $this->prepareRefund($cardsStorage, $payment, $amount);
            $payment      = $result["payment"];
            $messages     = $result["message"];
            $isFiled      = $result["is_field"];
            $isSuccessful = $result["isSuccessful"];
        } else {
            $payment->setSkipTransactionCreation(true);
            return $this;
        }

        if ($isFiled) {
            $this->_processFailureMultitransactionAction(
                $payment,
                $messages,
                $isSuccessful
            );
        }

        $payment->setSkipTransactionCreation(true);

        return $this;
    }

    public function prepareRefund($cardsStorage, \Magento\Payment\Model\InfoInterface $payment, $amount)
    {
        $messages     = [];
        $isSuccessful = false;
        $isFiled      = false;
        foreach ($cardsStorage->getCards() as $card) {
            $lastTransactionId = $payment->getData('cc_trans_id');
            $cardTransactionId = $card->getTransactionId();

            if ($lastTransactionId == $cardTransactionId) {
                $cardAmountForRefund = $this->_formatAmount($card->getCapturedAmount()
                    - $card->getRefundedAmount());
                if ($cardAmountForRefund <= 0) {
                    continue;
                }
                if ($cardAmountForRefund > $amount) {
                    $cardAmountForRefund = $amount;
                }
                try {
                    $newTransaction = $this->_refundCardTransaction(
                        $payment,
                        $cardAmountForRefund,
                        $card
                    );
                    if ($newTransaction != null) {
                        $messages[]   = $newTransaction->getMessage();
                        $isSuccessful = true;
                    }
                } catch (\Exception $e) {
                    $messages[] = $e->getMessage();
                    $isFiled    = true;
                    continue;
                }
                $card->setRefundedAmount($this->_formatAmount($card->getRefundedAmount()
                        + $cardAmountForRefund));
                $cardsStorage->updateCard($card);
                $amount = $this->_formatAmount($amount - $cardAmountForRefund);
            }
        }
        $result["payment"]      = $payment;
        $result["message"]      = $messages;
        $result["is_field"]     = $isFiled;
        $result["isSuccessful"] = $isSuccessful;
        return $result;
    }

    public function _refundCardTransaction($payment, $amount, $card)
    {
        $credit_memo          = $this->registry->registry('current_creditmemo');
        $captureTransactionId = $credit_memo->getInvoice()->getTransactionId();
        if ($payment->getCcTransId()) {
            $payment->setAnetTransType(self::REQUEST_TYPE_CREDIT);
            $payment->setXTransId($payment->getTransactionId());
            $payment->setAmount($amount);
            $orgtransactionId = $payment->getTransactionId();
            $transactionId = str_replace(['-capture','-void','-refund'], '', $captureTransactionId);
            $response = $this->monerisApi
                ->prepareRefundResponse(
                    $payment,
                    $amount,
                    $transactionId
                );

            $transFlag = $response->responseData["Complete"];
            $code      = $response->responseData["ResponseCode"];
             $authcode      = $response->responseData["AuthCode"];
            if ($transFlag=="true" && $code < 50) {
                $refundTransactionId           = $response->responseData['TransID'].'-refund';
                $shouldCloseCaptureTransaction = 0;

                if ($this->_formatAmount($card->getCapturedAmount() - $card->getRefundedAmount())
                    == $amount) {
                    $card->setLastTransId($refundTransactionId);
                    $shouldCloseCaptureTransaction = 1;
                }
                $this->_addTransaction(
                    $payment,
                    $refundTransactionId,
                    \Magento\Sales\Model\Order\Payment\Transaction::TYPE_REFUND,
                    [
                    'is_transaction_closed' => 1,
                    'should_close_parent_transaction' => $shouldCloseCaptureTransaction,
                    'parent_transaction_id' => $captureTransactionId,
                    ],
                    [$this->realTransactionIdKey => $response->responseData['TransID']],
                    $this->monerisHelper->getTransactionMessage(
                        $payment,
                        self::REQUEST_TYPE_CREDIT,
                        $response->responseData['TransID'],
                        $card,
                        $amount
                    )
                );
            } else {
                $errorMessage     = $this->monerisHelper->getErrorDescription($code);
                $exceptionMessage = $this->monerisHelper->getTransactionMessage(
                    $payment,
                    self::REQUEST_TYPE_CREDIT,
                    $orgtransactionId,
                    $card,
                    $amount,
                    $errorMessage
                );
                // @codingStandardsIgnoreStart
                throw new LocalizedException(new Phrase($exceptionMessage));
                // @codingStandardsIgnoreEnd
            }
        } else {
            return;
        }
    }

    public function void(\Magento\Payment\Model\InfoInterface $payment)
    {
        $cardsStorage = $this->getCardsStorage($payment);
        $messages     = [];
        $isSuccessful = false;
        $isFiled      = false;
        foreach ($cardsStorage->getCards() as $card) {
            $lastTransactionId = $payment->getData('cc_trans_id');
            $cardTransactionId = $card->getTransactionId();
            if ($lastTransactionId == $cardTransactionId) {
                try {
                    $newTransaction = $this->_voidCardTransaction(
                        $payment,
                        $card
                    );
                    if ($newTransaction != null) {
                        $messages[]   = $newTransaction->getMessage();
                        $isSuccessful = true;
                    }
                } catch (\Exception $e) {
                    $messages[] = $e->getMessage();
                    $isFiled    = true;
                    continue;
                }
                $cardsStorage->updateCard($card);
            }
        }
        if ($isFiled) {
            $this->_processFailureMultitransactionAction(
                $payment,
                $messages,
                $isSuccessful
            );
        }

        $payment->setSkipTransactionCreation(true);

        return $this;
    }

    public function _voidCardTransaction($payment, $card)
    {
        $authTransactionId = $card->getLastTransId();
        if ($payment->getCcTransId()) {
            $realAuthTransactionId = $payment->getTransactionId();
            $payment->setAnetTransType(self::REQUEST_TYPE_VOID);
            $orgtransactionId = $payment->getLastTransId();
            $transactionId = str_replace(['-capture','-void','-refund'], '', $orgtransactionId);
            $payment->setTransId($realAuthTransactionId);
            $response              = $this->monerisApi
                ->prepareVoidResponse($payment, $transactionId);
            $transFlag = $response->responseData["Complete"];
            $code      = $response->responseData["ResponseCode"];
             $authcode      = $response->responseData["AuthCode"];
            if ($transFlag=="true" && $code < 50) {
                $voidTransactionId = $response->responseData['TransID'].'-void';
                $card->setLastTransId($voidTransactionId);
                $payment->setTransactionId($response->responseData['TransID'])
                      ->setMoneriscaToken($response->responseData['TransID'])
                      ->setIsTransactionClosed(1);

                $this->_addTransaction(
                    $payment,
                    $voidTransactionId,
                    \Magento\Sales\Model\Order\Payment\Transaction::TYPE_VOID,
                    [
                    'is_transaction_closed' => 1,
                    'should_close_parent_transaction' => 1,
                    'parent_transaction_id' => $authTransactionId,
                    ],
                    [$this->realTransactionIdKey => $response->responseData['TransID']],
                    $this->monerisHelper->getTransactionMessage(
                        $payment,
                        self::REQUEST_TYPE_VOID,
                        $response->responseData['TransID'],
                        $card
                    )
                );
            } else {
                $errorMessage     = $this->monerisHelper->getErrorDescription($code);
                $exceptionMessage = $this->monerisHelper->getTransactionMessage(
                    $payment,
                    self::REQUEST_TYPE_VOID,
                    $realAuthTransactionId,
                    $card,
                    false,
                    $errorMessage
                );
                // @codingStandardsIgnoreStart
                throw new LocalizedException(new Phrase($exceptionMessage));
                // @codingStandardsIgnoreEnd
            }
        } else {
            return;
        }
    }

    public function cancel(\Magento\Payment\Model\InfoInterface $payment)
    {
        return $this;
    }

    /**
     * Payment method available? Yes.
     */
    public function getConfigModel()
    {
        return $this->monerisConfig;
    }

    public function isAvailable(CartInterface $quote = null)
    {
        $checkResult                   = $this->objectFactory->create();
        $isActive                      = $this->getConfigModel()->getIsActive();

        $checkResult->isAvailable      = $isActive;
        $checkResult->isDeniedInConfig = !$isActive;
        $checkResult->setData('is_available', $isActive);
        $this->eventManager->dispatch(
            'payment_method_is_active',
            [
                'result' => $checkResult,
                'method_instance' => $this,
                'quote' => $quote
            ]
        );

        return $checkResult->getData('is_available');
    }

    public function _isPreauthorizeCapture(\Magento\Sales\Model\Order\Payment $payment)
    {
        if ($this->getCardsStorage()->getCardsCount() <= 0) {
            return false;
        }
        foreach ($this->getCardsStorage()->getCards() as $card) {
            $lastTransactionId = $payment->getData('cc_trans_id');
            $cardTransactionId = $card->getTransactionId();
            if ($lastTransactionId == $cardTransactionId) {
                if ($payment->getCcTransId()) {
                    return true;
                }

                return false;
            }
        }
    }

    public function getCardsStorage($payment = null)
    {
        if ($payment === null) {
            $payment = $this->getInfoInstance();
        }
        if ($this->cardsStorage === null) {
            $this->_initCardsStorage($payment);
        }

        return $this->cardsStorage;
    }

    public function _initCardsStorage($payment)
    {
        $this->cardsStorage = $this->cardpayment->setPayment($payment);
    }

    public function _registerCard(
        $response,
        \Magento\Sales\Model\Order\Payment $payment
    ) {
        $cardsStorage   = $this->getCardsStorage($payment);
        $card           = $cardsStorage->registerCard();
        $datakey = $payment->getData(
            'additional_information',
            'md_monerisca_data_key'
        );
        if (empty($this->postData)) {
              $this->postData = $this->registry->registry('postdata');
        }
        $post = $this->postData;
        if ($datakey != '' && empty($post['cc_number'])) {
            $customerCard = $this->getCardInfo($datakey);
            $card->setCcType($customerCard[0]['cc_type'])
                ->setCcLast4($customerCard[0]['cc_last_4'])
                ->setCcExpMonth($customerCard[0]['cc_exp_month'])
                ->setCcOwner($customerCard[0]['firstname'])
                ->setCcExpYear($customerCard[0]['cc_exp_year']);
        } else {
            $card->setCcType($post['cc_type'])
                ->setCcLast4(substr($post['cc_number'], -4, 4))
                ->setCcExpMonth($post['expiration'])
                ->setCcExpYear($post['expiration_yr']);
        }

        $card->setCcApproval($response->responseData['TransID'])
             ->setLastTransId($response->responseData['TransID'])
             ->setTransactionId($response->responseData['TransID'])
            ->setMerchantReferenceCode($response->responseData['ReferenceNum'])
             ->setRequestedAmount($response->responseData['TransAmount'])
             ->setauthorizationCode($response->responseData['AuthCode'])
             ->setProcessedAmount($response->responseData['TransAmount'])
             ->setCcTransId($response->responseData['TransID'])
             ->setCcAvsStatus($response->responseData['AuthCode'])
             ->setCcCidStatus($response->responseData['ResponseCode']);
        if(isset($response->responseData['AvsResultCode'])){
                $card->setAvsResultCode($response->responseData['AvsResultCode']);
         }
         if(isset($response->responseData['CvdResultCode'])){
                $card->setCVNResultCode($response->responseData['CvdResultCode']);
         }
        $cardsStorage->updateCard($card);
        return $card;
    }

    public function _preauthorizeCapture($payment, $requestedAmount)
    {
        $cardsStorage = $this->getCardsStorage($payment);
        if ($this->_formatAmount(
            $cardsStorage->getProcessedAmount() - $cardsStorage->getCapturedAmount()
        ) < $requestedAmount
        ) {
            // @codingStandardsIgnoreStart
            throw new LocalizedException(new Phrase(__('Invalid amount for capture.')));
            // @codingStandardsIgnoreEnd
        }
        $result       = $this->getPreauthorizeCapture(
            $cardsStorage,
            $payment,
            $requestedAmount
        );
        $payment      = $result["payment"];
        $messages     = $result["message"];
        $isFiled      = $result["is_field"];
        $isSuccessful = $result["isSuccessful"];
        if ($isFiled) {
            $this->_processFailureMultitransactionAction(
                $payment,
                $messages,
                $isSuccessful
            );
        }
    }

    public function getPreauthorizeCapture(
        $cardsStorage,
        $payment,
        $requestedAmount
    ) {
        $messages     = [];
        $isSuccessful = false;
        $isFiled      = false;
        foreach ($cardsStorage->getCards() as $card) {
            $lastTransactionId = $payment->getData('cc_trans_id');
            $cardTransactionId = $card->getTransactionId();
            if ($lastTransactionId == $cardTransactionId) {
                if ($requestedAmount > 0) {
                    $prevCaptureAmount    = $card->getCapturedAmount();
                    $cardAmountForCapture = $card->getProcessedAmount();
                    if ($cardAmountForCapture > $requestedAmount) {
                        $cardAmountForCapture = $requestedAmount;
                    }
                    
                    try {
                        $newTransaction = $this->_preauthorizeCaptureCardTransaction(
                            $payment,
                            $cardAmountForCapture,
                            $card
                        );
                        if ($newTransaction != null) {
                            $messages[]   = $newTransaction->getMessage();
                            $isSuccessful = true;
                        }
                    } catch (\Exception $e) {
                        $messages[] = $e->getMessage();
                        $isFiled    = true;
                        continue;
                    }
                    $newCapturedAmount = $prevCaptureAmount + $cardAmountForCapture;
                    $card->setCapturedAmount($newCapturedAmount);
                    $cardsStorage->updateCard($card);
                    $requestedAmount   = $this->_formatAmount($requestedAmount - $cardAmountForCapture);
                    if ($isSuccessful) {
                        $balance = $card->getProcessedAmount() - $card->getCapturedAmount();
                        if ($balance > 0) {
                            $payment->setAnetTransType(self::REQUEST_TYPE_AUTH_ONLY);
                            $payment->setAmount($balance);
                        }
                    }
                }
            }
        }
        $result["payment"]      = $payment;
        $result["message"]      = $messages;
        $result["is_field"]     = $isFiled;
        $result["isSuccessful"] = $isSuccessful;
        return $result;
    }

    public function _preauthorizeCaptureCardTransaction(
        $payment,
        $amount,
        $card
    ) {
        $authTransactionId = $card->getLastTransId();
        if ($payment->getCcTransId()) {
            $newTransactionType = \Magento\Sales\Model\Order\Payment\Transaction::TYPE_CAPTURE;
            $payment->setAnetTransType(self::REQUEST_TYPE_PRIOR_AUTH_CAPTURE);

            $payment->setAmount($amount);
            $response = $this->monerisApi
                ->prepareAuthorizeCaptureResponse($payment, $amount);
            $transFlag = $response->responseData["Complete"];
            $code      = $response->responseData["ResponseCode"];
             $authcode      = $response->responseData["AuthCode"];
            if ($transFlag=="true" && $code < 50) {
                $captureTransactionId = $response->responseData['TransID'].'-capture';
                $card->setLastCapturedTransactionId($captureTransactionId);
                $this->_addTransaction(
                    $payment,
                    $captureTransactionId,
                    $newTransactionType,
                    [
                    'is_transaction_closed' => 0,
                    'parent_transaction_id' => $authTransactionId,
                    ],
                    [$this->realTransactionIdKey => $response->responseData['TransID']],
                    $this->monerisHelper->getTransactionMessage(
                        $payment,
                        self::REQUEST_TYPE_PRIOR_AUTH_CAPTURE,
                        $response->responseData['TransID'],
                        $card,
                        $amount
                    )
                );
            } else {
                $expMessage = $this->_wrapGatewayError($this->monerisHelper
                 ->getErrorDescription($code));
                $exceptionMessage = $this->monerisHelper->getTransactionMessage(
                    $payment,
                    self::REQUEST_TYPE_PRIOR_AUTH_CAPTURE,
                    $authTransactionId,
                    $card,
                    $amount,
                    $expMessage
                );
                // @codingStandardsIgnoreStart
                throw new LocalizedException(new Phrase($exceptionMessage));
                // @codingStandardsIgnoreEnd
            }
        } else {
            return;
        }
    }

    public function _formatAmount($amount, $asFloat = false)
    {
        $amount = sprintf('%.2F', $amount);
        return $asFloat ? (float) $amount : $amount;
    }

    public function _isGatewayActionsLocked($payment)
    {
        return $payment->getAdditionalInformation($this->isGatewayActionsLockedKey);
    }

    public function _generateChecksum(
        \Magento\Framework\DataObject $object,
        $checkSumDataKeys = []
    ) {
        $data = [];
        foreach ($checkSumDataKeys as $dataKey) {
            $data[] = $dataKey;
            $data[] = $object->getData($dataKey);
        }

        return hash('sha256', implode($data, '_'));
    }

    public function _processFailureMultitransactionAction(
        $payment,
        $messages,
        $isSuccessfulTransactions
    ) {
        if ($isSuccessfulTransactions) {
            $msg1 = 'Gateway actions are locked because the gateway cannot complete one or more of the ';
            $msg2 = 'transactions. Please log in to your Moneris account to manually resolve the issue(s).';
            $messages[]     = $msg1 .$msg2 ;
            $currentOrderId = $payment->getOrder()->getId();
            $orderModel     = $this->ordermodelFactory->create();
            $orderModel->getResource()->load($orderModel, $currentOrderId);
            $copyOrder      = $orderModel;
            $copyOrder->getPayment()->setAdditionalInformation(
                $this->isGatewayActionsLockedKey,
                1
            );
            foreach ($messages as $message) {
                $copyOrder->addStatusHistoryComment($message);
            }
            $copyOrder->getResource()->save($copyOrder);
        } else {
            // @codingStandardsIgnoreStart
            throw new LocalizedException(new Phrase(implode(
                ' | ',
                $messages
            )));
            // @codingStandardsIgnoreEnd
        }
    }

    public function _wrapGatewayError($text)
    {
        return __('Gateway error:'.$text);
    }

    private function _clearAssignedData($payment)
    {
        $payment->setCcType(null)
            ->setCcOwner(null)
            ->setCcLast4(null)
            ->setCcNumber(null)
            ->setCcCid(null)
            ->setCcExpMonth(null)
            ->setCcExpYear(null)
            ->setCcSsIssue(null)
            ->setCcSsStartMonth(null)
            ->setCcSsStartYear(null);

        return $this;
    }

    public function _addTransaction(
        \Magento\Sales\Model\Order\Payment $payment,
        $transactionId,
        $transactionType,
        array $transactionDetails = [],
        array $transactionAdditionalInfo = [],
        $message = false
    ) {
        $payment->setTransactionId($transactionId);
        $payment->setLastTransId($transactionId);

        foreach ($transactionDetails as $key => $value) {
            $payment->setData($key, $value);
        }
        foreach ($transactionAdditionalInfo as $key => $value) {
            $payment->setTransactionAdditionalInfo($key, $value);
        }
        $transaction = $payment->addTransaction(
            $transactionType,
            null,
            false,
            $message
        );

        $transaction->setMessage($message);

        return $transaction;
    }

    public function processInvoice($invoice, $payment)
    {
        $lastCaptureTransId = '';
        $cardsStorage       = $this->getCardsStorage($payment);
        foreach ($cardsStorage->getCards() as $card) {
            $lastTransactionId = $payment->getData('cc_trans_id');
            $cardTransactionId = $card->getTransactionId();
            if ($lastTransactionId == $cardTransactionId) {
                $lastCapId = $card->getData('last_captured_transaction_id');
                if ($lastCapId && !empty($lastCapId) && !($lastCapId === null)) {
                    $lastCaptureTransId = $lastCapId;
                    break;
                }
            }
        }

        $invoice->setTransactionId($lastCaptureTransId);

        return $this;
    }

    public function processCreditmemo($creditmemo, $payment)
    {
        $lastRefundedTransId = '';
        $cardsStorage        = $this->getCardsStorage($payment);
        foreach ($cardsStorage->getCards() as $card) {
            $lastTransactionId = $payment->getData('cc_trans_id');
            $cardTransactionId = $card->getTransactionId();
            if ($lastTransactionId == $cardTransactionId) {
                $lastCardTransId = $card->getData('last_refunded_transaction_id');
                if ($lastCardTransId && !empty($lastCardTransId) && !($lastCardTransId
                    === null)) {
                    $lastRefundedTransId = $lastCardTransId;
                    break;
                }
            }
        }
        $creditmemo->setTransactionId($lastRefundedTransId);

        return $this;
    }

    public function canUseForCurrency($currencyCode)
    {
        return true;
    }

    public function isApplicableToQuote($quote, $checksBitMask)
    {
        if ($checksBitMask & MethodInterface::CHECK_USE_FOR_COUNTRY) {
            if (!$this->canUseForCountry($quote->getBillingAddress()->getCountry())) {
                return false;
            }
        }
        if ($checksBitMask & MethodInterface::CHECK_USE_FOR_CURRENCY) {
            if (!$this->canUseForCurrency($quote->getStore()->getBaseCurrencyCode())) {
                return false;
            }
        }
        return $this->checkApplicableToQuote($quote, $checksBitMask);
    }

    public function checkApplicableToQuote($quote, $checksBitMask)
    {
        if ($checksBitMask & MethodInterface::CHECK_USE_CHECKOUT) {
            if (!$this->canUseCheckout()) {
                return false;
            }
        }
        if ($checksBitMask & MethodInterface::CHECK_USE_INTERNAL) {
            if (!$this->canUseInternal()) {
                return false;
            }
        }
        if ($checksBitMask & MethodInterface::CHECK_ORDER_TOTAL_MIN_MAX) {
            $total    = $quote->getBaseGrandTotal();
            $minTotal = $this->getConfigData('min_order_total');
            $maxTotal = $this->getConfigData('max_order_total');
            if (!empty($minTotal) && $total < $minTotal || !empty($maxTotal) && $total
                > $maxTotal) {
                return false;
            }
        }
        return true;
    }

    public function _formatCcType($ccType)
    {
        $allTypes = $this->paymentconfig->getCcTypes();
        $allTypes = array_flip($allTypes);

        if (isset($allTypes[$ccType]) && !empty($allTypes[$ccType])) {
            return $allTypes[$ccType];
        }
        return $ccType;
    }
}