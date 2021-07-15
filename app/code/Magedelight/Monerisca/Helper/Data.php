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

namespace Magedelight\Monerisca\Helper;

use Magento\Payment\Model\Config as PaymentConfig;
use Magento\Payment\Model\InfoInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const REQUEST_TYPE_AUTH_ONLY          = 'AUTH_ONLY';
    const REQUEST_TYPE_AUTH_CAPTURE       = 'AUTH_CAPTURE';
    const REQUEST_TYPE_PRIOR_AUTH_CAPTURE = 'PRIOR_AUTH_CAPTURE';
    const REQUEST_TYPE_CREDIT             = 'CREDIT';
    const REQUEST_TYPE_VOID               = 'VOID';
    public $today = null;
    public $errorMessage = [
        '50' => 'Decline',
        '51' => 'Expired Card',
        '52' => 'PIN retries exceeded',
        '53' => 'No sharing',
        '54' => 'No security module',
        '55' => 'Invalid transaction',
        '56' => 'No Support',
        '57' => 'Lost or stolen card',
        '58' => 'Invalid status',
        '59' => 'Restricted Card',
        '60' => 'No Chequing account',
        '60' => 'No Savings account',
        '61' => 'No PBF',
        '62' => 'PBF update error',
        '63' => 'Invalid authorization type',
        '64' => 'Bad Track 2',
        '65' => 'Adjustment not allowed',
        '66' => 'Invalid credit card advance increment',
        '67' => 'Invalid transaction date',
        '68' => 'PTLF error',
        '69' => 'Bad message error',
        '70' => 'No IDF',
        '71' => 'Invalid route authorization',
        '72' => 'Card on National NEG file ',
        '73' => 'Invalid route service (destination)',
        '74' => 'Unable to authorize',
        '75' => 'Invalid PAN length',
        '76' => 'Low funds',
        '77' => 'Pre-auth full',
        '78' => 'Duplicate transaction',
        '79' => 'Maximum online refund reached',
        '80' => 'Maximum offline refund reached',
        '81' => 'Maximum credit per refund reached',
        '82' => 'Number of times used exceeded',
        '83' => 'Maximum refund credit reached',
        '84' => 'Duplicate transaction - authorization number has already been corrected by host. ',
        '85' => 'Inquiry not allowed',
        '86' => 'Over floor limit ',
        '87' => 'Maximum number of refund credit by retailer',
        '88' => 'Place call',
        '89' => 'CAF status inactive or closed',
        '90' => 'Referral file full',
        '91' => 'NEG file problem',
        '92' => 'Advance less than minimum',
        '93' => 'Delinquent',
        '94' => 'Over table limit',
        '95' => 'Amount over maximum',
        '96' => 'PIN required',
        '97' => 'Mod 10 check failure',
        '98' => 'Force Post',
        '99' => 'Bad PBF',
        '100' => 'Unable to process transaction',
        '101' => 'Place call',
        '102' => 'Place call',
        '103' => 'NEG file problem',
        '104' => 'CAF problem',
        '105' => 'Card not supported',
        '106' => 'Amount over maximum',
        '107' => 'Over daily limit',
        '108' => 'CAF Problem',
        '109' => 'Advance less than minimum',
        '110' => 'Number of times used exceeded',
        '111' => 'Delinquent',
        '112' => 'Over table limit',
        '113' => 'Timeout',
        '115' => 'PTLF error',
        '121' => 'Administration file problem',
        '122' => 'Unable to validate PIN: security module down',
        '150' => 'Merchant not on file',
        '200' => 'Invalid account',
        '201' => 'Incorrect PIN',
        '202' => 'Advance less than minimum',
        '203' => 'Administrative card needed',
        '204' => 'Amount over maximum ',
        '205' => 'Invalid Advance amount',
        '206' => 'CAF not found',
        '207' => 'Invalid transaction date',
        '208' => 'Invalid expiration date',
        '209' => 'Invalid transaction code',
        '210' => 'PIN key sync error',
        '212' => 'Destination not available',
        '251' => 'Error on cash amount',
        '252' => 'Debit not supported',
        '426' => 'AMEX - Denial 12',
        '427' => 'AMEX - Invalid merchant',
        '429' => 'AMEX - Account error',
        '430' => 'AMEX - Expired card',
        '431' => 'AMEX - Call Amex',
        '434' => 'AMEX - Call 03',
        '435' => 'AMEX - System down',
        '436' => 'AMEX - Call 05',
        '437' => 'AMEX - Declined',
        '438' => 'AMEX - Declined',
        '439' => 'AMEX - Service error',
        '440' => 'AMEX - Call Amex',
        '441' => 'AMEX - Amount error',
        '475' => 'CREDIT CARD - Invalid expiration date',
        '476' => 'CREDIT CARD - Invalid transaction, rejected',
        '477' => 'CREDIT CARD - Refer Call',
        '478' => 'CREDIT CARD - Decline, Pick up card, Call',
        '479' => 'CREDIT CARD - Decline, Pick up card',
        '480' => 'CREDIT CARD - Decline, Pick up card',
        '481' => 'CREDIT CARD - Decline',
        '482' => 'CREDIT CARD - Expired Card',
        '483' => 'CREDIT CARD - Refer',
        '484' => 'CREDIT CARD - Expired card - refer',
        '485' => 'CREDIT CARD - Not authorized',
        '486' => 'CREDIT CARD - CVV Cryptographic error',
        '487' => 'CREDIT CARD - Invalid CVV',
        '489' => 'CREDIT CARD - Invalid CVV',
        '490' => 'CREDIT CARD - Invalid CVV',
        '800' => 'Bad format',
        '801' => 'Bad data',
        '802' => 'Invalid Clerk ID',
        '809' => 'Bad close ',
        '810' => 'System timeout',
        '811' => 'System error',
        '821' => 'Bad response length',
        '877' => 'Invalid PIN block',
        '878' => 'PIN length error',
        '880' => 'Final packet of a multi-packet transaction',
        '881' => 'Intermediate packet of a multi-packet transaction',
        '889' => 'MAC key sync error',
        '898' => 'Bad MAC value',
        '899' => 'Bad sequence number - resend transaction',
        '900' => 'Capture - PIN Tries Exceeded',
        '901' => 'Capture - Expired Card',
        '902' => 'Capture - NEG Capture',
        '903' => 'Capture - CAF Status 3',
        '904' => 'Capture - Advance < Minimum',
        '905' => 'Capture - Num Times Used',
        '906' => 'Capture - Delinquent',
        '907' => 'Capture - Over Limit Table',
        '908' => 'Capture - Amount Over Maximum',
        '909' => 'Capture - Capture',
        '960' => 'Initialization failure - merchant number mismatch',
        '961' => 'Initialization failure - pinpad  mismatch',
        '963' => 'No match on Poll code',
        '964' => 'No match on Concentrator ID',
        '965' => 'Invalid software version',
        '966' => 'Duplicate terminal name',
                '981' => 'Data error',
                '982' => 'Duplicate Order ID',
                '983' => 'Invalid Transaction',
                '984' => 'Previously asserted',
                '985' => 'Invalid activity description',
                '986'=> 'Invalid impact description',
                '987' => 'Invalid Confidence description',
                '988' => 'Cannot find Previous'

    ];

   /**
    * @var \Magento\Framework\App\State
    */
    public $appState;

    /**
     * Magedelight\Monerisca\Model\ResourceModel\Mdsalesorderpayment\CollectionFactory
     */
    public $mdpaymentCollFactory;

    /**
     * @var type
     */
    public $objectFactory;
    
    public $sessionquote;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Customer\Model\Address\Config $addressConfig
     * @param \Magento\Framework\Stdlib\DateTime $dateFormat
     * @param PaymentConfig $paymentConfig
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     * @param \Magedelight\Monerisca\Model\Config $monerisConfig
     * @param \Magento\Framework\App\State $appState
     * @param \Magento\Framework\DataObjectFactory $objectFactory
     * @param \Magento\Directory\Api\Data\RegionInformationInterface $regionInformation
     * @param \Magedelight\Monerisca\Model\ResourceModel\Mdsalesorderpayment\CollectionFactory $mdpaymentCollFactory
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Customer\Model\Address\Config $addressConfig,
        \Magento\Framework\Stdlib\DateTime $dateFormat,
        PaymentConfig $paymentConfig,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        \Magedelight\Monerisca\Model\Config $monerisConfig,
        \Magento\Framework\App\State $appState,
        \Magento\Framework\DataObjectFactory $objectFactory,
        \Magento\Directory\Model\RegionFactory $regionInformation,
        \Magedelight\Monerisca\Model\ResourceModel\Mdsalesorderpayment\CollectionFactory $mdpaymentCollFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Backend\Model\Session\Quote $sessionquote    
    ) {
        $this->addressConfig           = $addressConfig;
        $this->objectFactory           = $objectFactory;
        $this->regionFactory           = $regionInformation;
        $this->paymentConfig           = $paymentConfig;
        $this->monerisConfig           = $monerisConfig;
        $this->dateFormat              = $dateFormat;
        $this->dateTime                = $dateTime;
        $this->appState                = $appState;
        $this->mdpaymentCollFactory    = $mdpaymentCollFactory;
        $this->_storeManager           = $storeManager;
         $this->sessionquote           = $sessionquote;
        parent::__construct($context);
    }

    /**
     * @param type $code
     * @return string
     */
    public function getErrorDescription($code)
    {
        if (!empty($code)) {
            if (isset($this->errorMessage[$code])) {
                return $this->errorMessage[$code];
            } else {
                return __("Please Try Again");
            }
        }
    }

    /**
     * @param type $card
     * @return customer address
     */
    public function getFormatedAddress($card)
    {
        $address  = $this->objectFactory->create();
        $regionId = $card['region_id'];
        $regionModel = $this->regionFactory->create();
        if ($regionId) :
             $regionModel->getResource()->load($regionModel, $regionId);
             $regionName = $regionModel->getName();
        else :
                $regionName = $card['state'];
        endif;
          $address->addData([
          'firstname' => (string) $card['firstname'],
          'lastname' => (string) $card['lastname'],
          'company' => (string) $card['company'],
          'street1' => (string) $card['street'],
          'city' => (string) $card['city'],
          'region' => (string) $regionName,
          'postcode' => (string) $card['postcode'],
          'telephone' => (string) $card['telephone'],
          'country' => (string) $card['country_id'],
          ]);

          $renderer = $this->addressConfig->getFormatByCode('html')->getRenderer();

          return $renderer->renderArray($address->getData());
    }
    /**
     * get today year
     * @return date
     */
    public function getTodayYear()
    {
        if (!$this->today) {
            $this->today = $this->dateTime->gmtTimestamp();
        }

        return $this->dateTime->date('Y', $this->today);
    }

     /**
      * get today month
      * @return date
      */
    public function getTodayMonth()
    {
        if (!$this->today) {
            $this->today = $this->dateTime->gmtTimestamp();
        }

        return $this->dateTime->date('m', $this->today);
    }

     /**
      *
      * @return boolean
      */
    public function checkAdmin()
    {
        $area_code = $this->appState->getAreaCode();
        if ($area_code == \Magento\Backend\App\Area\FrontNameResolver::AREA_CODE) {
            return true;
        } else {
            return false;
        }
    }

    public function getCcAvailableCardTypes()
    {
        $types       = array_flip(explode(
            ',',
            $this->monerisConfig->getCcTypes()
        ));
        $mergedArray = [];

        if (is_array($types)) {
            foreach (array_keys($types) as $type) {
                $types[$type] = $this->getCcTypeNameByCode($type);
            }
        }
        $allTypes = $this->getCcTypes();
        if (is_array($allTypes)) {
            foreach ($allTypes as $ccTypeCode => $ccTypeName) {
                if (array_key_exists($ccTypeCode, $types)) {
                    $mergedArray[$ccTypeCode] = $ccTypeName;
                }
            }
        }

        return $mergedArray;
    }

    public function getCcTypeNameByCode($code)
    {
        $ccTypes = $this->paymentConfig->getCcTypes();
        if (isset($ccTypes[$code])) {
            return $ccTypes[$code];
        } else {
            return false;
        }
    }

    public function getCcTypes()
    {
        $ccTypes = $this->paymentConfig->getCcTypes();
        if (is_array($ccTypes)) {
            return $ccTypes;
        } else {
            return false;
        }
    }

    public function getTransactionMessage(
        $payment,
        $requestType,
        $lastTransactionId,
        $card,
        $amount = false,
        $exception = false
    ) {

        return $this->getExtendedTransactionMessage(
            $payment,
            $requestType,
            $lastTransactionId,
            $card,
            $amount,
            $exception
        );
    }

    public function getExtendedTransactionMessage(
        $payment,
        $requestType,
        $lastTransactionId,
        $card,
        $amount = false,
        $exception = false,
        $additionalMessage = false
    ) {

        $operation = $this->_getOperation($requestType);

        if (!$operation) {
            return false;
        }

        if ($amount) {
            $amount = sprintf(
                'amount %s',
                $this->_formatPrice($payment, $amount)
            );
        }

        if ($exception) {
            $result = sprintf('failed');
        } else {
            $result = sprintf('successful');
        }

        $card = sprintf('Credit Card: xxxx-%s', $card->getCcLast4());

        $pattern = '%s %s %s - %s.';
        $texts   = [$card, $amount, $operation, $result];

        if ($lastTransactionId !== null) {
            $pattern .= ' %s.';
            $texts[] = sprintf(
                'Monerisca Transaction ID %s',
                $lastTransactionId
            );
        }

        if ($additionalMessage) {
            $pattern .= ' %s.';
            $texts[] = $additionalMessage;
        }
        $pattern .= ' %s';
        $texts[] = $exception;
        // @codingStandardsIgnoreStart
        return call_user_func_array('sprintf', array_merge([$pattern], $texts));
        // @codingStandardsIgnoreEnd
    }

    public function _getOperation($requestType)
    {
        switch ($requestType) {
            case self::REQUEST_TYPE_AUTH_ONLY:
                return __('authorize');
            case self::REQUEST_TYPE_AUTH_CAPTURE:
                return __('authorize and capture');
            case self::REQUEST_TYPE_PRIOR_AUTH_CAPTURE:
                return __('capture');
            case self::REQUEST_TYPE_CREDIT:
                return __('refund');
            case self::REQUEST_TYPE_VOID:
                return __('void');
            default:
                return false;
        }
    }

    public function _formatPrice($payment, $amount)
    {
        return $payment->getOrder()->getBaseCurrency()->formatTxt($amount);
    }

     /**
      * @param InfoInterface $payment
      */
    public function addCustomTableAttr(InfoInterface $payment)
    {
        $paymentId = $payment->getId();
        
        $mdPayCollection = $this->mdpaymentCollFactory->create()->addFieldToFilter("order_payment_id", $paymentId);
        if ($mdPayCollection->getSize()>0) {
            $mdPayCollectionData = $mdPayCollection->getData();
            $payment->setMdMoneriscaDataKey($mdPayCollectionData[0]["md_monerisca_data_key"]);
            $payment->setMoneriscaToken($mdPayCollectionData[0]["txn_number"]);
        }
        return $payment;
    }

    public function isEnabled()
    {
         return $this->getConfig('payment/md_monerisca/active');
    }

    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    
    public function getWebsiteId(){
        if($this->checkAdmin()){
            $storeId =  $this->sessionquote->getQuote()->getStoreId();
            $store = $this->_storeManager->getStore($storeId);
            $website_id = $store->getWebsiteId();
        } else {
            $website_id =  $this->_storeManager->getStore()->getWebsiteId();
        }
        return $website_id;
    }
    
    public function getCustomerAccountScope()
    {
        return $this->monerisConfig->getCustomerAccountShare();
    }
}
