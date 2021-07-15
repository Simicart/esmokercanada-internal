<?php
/**
 * Magedelight
 * Copyright (C) 2016 Magedelight <info@magedelight.com>.
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html.
 *
 * @category Magedelight
 *
 * @copyright Copyright (c) 2016 Mage Delight (http://www.magedelight.com/)
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author Magedelight <info@magedelight.com>
 */

namespace Magedelight\Monerisca\Model\Api;

use Magento\Framework\Exception\LocalizedException;

class Monerisca extends \Magedelight\Monerisca\Model\Api\Abstractmodel
{
    
    public $orderRequest = [];
    public $request = null;
    public $zendlogger;
    public $soaplog;

    /**
     * @var Magento\Customer\Model\Session
     */
    public $customer;

    /**
     * @var Magento\Directory\Api\Data\RegionInformationInterface
     */
    public $region;

    /**
     * @var Magento\Store\Model\StoreManagerInterface
     */
    public $storeManager;

    /**
     * @var Magento\Framework\Math\Random
     */
    public $random;

    /**
     * @var Psr\Log\LoggerInterface
     */
    public $logger;

    /**
     * @var Magedelight\Monerisca\Model\Api\Abstractmodel
     */
    public $abstractModel;

    /**
     * @var Magento\Checkout\Model\Session
     */
    public $checkoutsession;

    /**
     * @var Magedelight\Monerisca\Helper\Data
     */
    public $monerisHelper;

    /**
     * @var Magento\Framework\App\RequestInterface
     */
    public $requestHttp;

    /**
     * @var Magento\Framework\HTTP\PhpEnvironment\RemoteAddress
     */
    public $remotaddress;

    /**
     * @var Magedelight\Monerisca\Model\Api\SoapClient
     */
    public $soapClient;

    /**
     *
     * @var type
     */
    public $objectFactory;

    /**
     * Magedelight\Monerisca\Model\Api\Moneris\MpgAvsInfoFactory
     */
    public $mpgAvsInfo;

    /**
     * @var Magedelight\Monerisca\Model\Api\Moneris\MpgTransaction
     */
    public $mpgTransaction;

    /**
     * @var Magedelight\Monerisca\Model\Api\Moneris\MpgCvdInfo
     */
    public $mpgCvdInfo;

    /**
     * @var \Magedelight\Monerisca\Model\Api\Moneris\MpgRequest
     */
    public $mpgRequest;

    /**
     * @var Magedelight\Monerisca\Model\Api\Moneris\MpgHttpsPost
     */
    public $mpgHttpsPost;

    /**
     * @var Magedelight\Monerisca\Model\Api\Moneris\MpgCustInfoFactory
     */
    public $mpgCustInfo;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    public $httpRequest;

     /**
      * @var Magento\Framework\Encryption\Encryptor
      */
    public $encryptor;
    
    /**
     * @var EventManager
     */
    private $eventManager;
    
    /**
     *
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Customer\Model\Session\Proxy $customer
     * @param \Magedelight\Monerisca\Helper\Data $monerisHelper
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Math\Random $random
     * @param \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $remotaddress
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\App\RequestInterface $requestHttp
     * @param \Magento\Checkout\Model\Session\Proxy $checkoutsession
     * @param \Magedelight\Monerisca\Model\Api\Abstractmodel $abstractModel
     * @param \Magento\Framework\DataObjectFactory $objectFactory
     * @param \Magento\Directory\Model\RegionFactory $regionFactory
     * @param \Magedelight\Monerisca\Model\Config $configModel
     */
    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Model\Session\Proxy $customer,
        \Magedelight\Monerisca\Helper\Data $monerisHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Math\Random $random,
        \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $remotaddress,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\RequestInterface $requestHttp,
        \Magento\Checkout\Model\Session\Proxy $checkoutsession,
        \Magedelight\Monerisca\Model\Api\Abstractmodel $abstractModel,
        \Magento\Framework\DataObjectFactory $objectFactory,
        \Magento\Directory\Model\RegionFactory $regionFactory,
        \Magedelight\Monerisca\Model\Config $configModel,
        \Magedelight\Monerisca\Model\Api\Moneris\MpgAvsInfoFactory $mpgAvsInfo,
        \Magedelight\Monerisca\Model\Api\Moneris\MpgTransactionFactory $mpgTransaction,
        \Magedelight\Monerisca\Model\Api\Moneris\MpgCvdInfoFactory $mpgCvdInfo,
        \Magedelight\Monerisca\Model\Api\Moneris\MpgRequestFactory $mpgRequest,
        \Magedelight\Monerisca\Model\Api\Moneris\MpgHttpsPostFactory $mpgHttpsPost,
        \Magedelight\Monerisca\Model\Api\Moneris\MpgCustInfoFactory $mpgCustInfo,
        \Magedelight\Monerisca\Model\Api\Moneris\MpgResponseFactory $mpgResponsefactory,
        \Magedelight\Monerisca\Model\Api\Moneris\HttpsPostFactory $httpsPostfactory,
        \Magedelight\Monerisca\Model\Api\Moneris\MpgGlobalsFactory $mpgglobalsfactory,
        \Magento\Framework\App\RequestInterface $httpRequest,
        \Magento\Framework\Encryption\Encryptor $encryptor,
        \Magento\Framework\Event\Manager $eventManager
    ) {    
        $this->customer             = $customer;
        $this->regionFactory        = $regionFactory;
        $this->monerisHelper        = $monerisHelper;
        $this->storeManager         = $storeManager;
        $this->random               = $random;
        $this->remotaddress         = $remotaddress;
        $this->registry             = $registry;
        $this->logger               = $logger;
        $this->streamFactory        = new \Zend\Log\Writer\Stream(BP.'/var/log/md_moneris.log');
        $this->zendlogger           = new \Zend\Log\Logger();
        $this->checkoutsession      = $checkoutsession;
        $this->abstractModel        = $abstractModel;
        $this->requestHttp          = $requestHttp;
        $this->objectFactory        = $objectFactory;
        $this->_configModel         = $configModel;
        $this->mpgAvsInfo           = $mpgAvsInfo;
        $this->mpgTransaction       = $mpgTransaction;
        $this->mpgCvdInfo           = $mpgCvdInfo;
        $this->mpgRequest           = $mpgRequest;
        $this->mpgHttpsPost         = $mpgHttpsPost;
        $this->mpgCustInfo          = $mpgCustInfo;
        $this->httpRequest          = $httpRequest;
        $this->encryptor            = $encryptor;
        $this->mpgResponsefactory   = $mpgResponsefactory;
        $this->httpsPostfactory     = $httpsPostfactory;
        $this->mpgglobalsfactory    = $mpgglobalsfactory;
        $this->eventManager         = $eventManager;
    }
    
    
    public function getCustomer()
    {
        return $this->customer;
    }
    
    public function modifyOrderToken($ordertoken,$order){
        return $ordertoken;
    }
    
    public function prepareAuthorizeResponse(\Magento\Payment\Model\InfoInterface $paymentobj, $amount, $datakey)
    {
        $payment         = $this->monerisHelper->addCustomTableAttr($paymentobj);
        $order = $payment->getOrder();
        $ordertoken = '';
        if ($this->abstractModel->testMode) {
            $ordertoken = $this->abstractModel->orderToken;
        }
        
    $ordertoken = $this->modifyOrderToken($ordertoken,$order);
        
        $billingAddress = $payment->getOrder()->getBillingAddress();
        $shippingAddress = $payment->getOrder()->getShippingAddress();
       
        if ($datakey == false) {
             $post = $this->httpRequest->getParam('payment');
             $ccNumber = $payment->getCcNumber();
             $expMonth = $payment->getCcExpMonth();
             $exp_year = $payment->getCcExpYear();
             $expYear = empty($exp_year) ? $post['expiration_yr'] : $exp_year;
             $year =   (strlen($expYear) > 2) ? substr($expYear, -2)
                : $expYear;

             $expMonth = empty($expMonth) ? $post['expiration'] : $expMonth;
             $monthNum = ($expMonth < 10 && strlen($expMonth)<2) ? '0' . $expMonth : $expMonth;
             $txnArray  =   ['type'=>'preauth',
                                        'order_id'=> $order->getIncrementId() . $ordertoken,
                                        'cust_id'=> $order->getCustomerEmail(),
                                        'amount'=> number_format($amount, 2, '.', ''),
                                        'pan'=> empty($ccNumber) ? $post['cc_number'] : $ccNumber,
                                        'expdate'=> $year . $monthNum,
                                        'crypt_type'=>7
                             ];
        } else {
            $txnArray  =  ['type'=>'res_preauth_cc',
                            'data_key'=>$payment->getMdMoneriscaDataKey(),
                            'order_id'=>$order->getIncrementId() . $ordertoken,
                            'cust_id'=>$order->getCustomerEmail(),
                            'amount'=>number_format($amount, 2, '.', ''),
                            'crypt_type'=>1
                     ];
        }

        $billregionId  = $billingAddress->getRegionId();
        $regionModel = $this->regionFactory->create();
        if ($billregionId) :
             $regionModel->getResource()->load($regionModel, $billregionId);
             $regionCode = $regionModel->getCode();
        else :
             $regionCode = $billingAddress->getRegion();
        endif;
 /********************* Create Billing Array and set it **********/
        $mpgCustInfo = $this->mpgCustInfo->create();
        $mpgCustInfo->setEmail($order->getCustomerEmail());
        if($billingAddress)
        {
            

            $billing =[ 'first_name' => $billingAddress->getFirstname(),
            'last_name' => $billingAddress->getLastname(),
            'company_name' => $billingAddress->getCompany(),
            'address' =>  (is_array($billingAddress->getStreet()))
                        ?implode(",", $billingAddress->getStreet()):$billingAddress->getStreet(),
            'city' => $billingAddress->getCity(),
            'province' => $regionCode,
            'postal_code' => $billingAddress->getPostcode(),
            'country' => $billingAddress->getCountryId(),
            'phone_number' => $billingAddress->getTelephone(),
            'fax' => $billingAddress->getFax(),
                    'tax1' => '0.00',
            'tax2' => '0.00',
            'tax3' => '0.00',
            'shipping_cost' => '0.00'
                   ];
            
            $mpgCustInfo->setBilling($billing);
        }   

/********************* Create Shipping Array and set it **********/
        
        if($shippingAddress)
        {
            $regionId  = $shippingAddress->getRegionId();
            if ($regionId) :
                 $regionModel->getResource()->load($regionModel, $regionId);
                 $regionCode = $regionModel->getCode();
            else :
                 $regionCode = $billingAddress->getRegion();
            endif;
            $shipping = ['first_name' => $shippingAddress->getFirstname(),
            'last_name' => $shippingAddress->getLastname(),
            'company_name' => $shippingAddress->getCompany(),
            'address' => (is_array($shippingAddress->getStreet()))
                        ?implode(",", $shippingAddress->getStreet()):$shippingAddress->getStreet(),
            'city' => $shippingAddress->getCity(),
            'province' => $regionCode,
            'postal_code' => $shippingAddress->getPostcode(),
            'country' => $shippingAddress->getCountry(),
            'phone_number' => $shippingAddress->getTelephone(),
            'fax' => $shippingAddress->getFax(),
                    'tax1' => '0.00',
                    'tax2' => '0.00',
                    'tax3' => '0.00',
                    'shipping_cost' => '0.0'
                ];
        } else {
            
            $shipping =[ 'first_name' => $billingAddress->getFirstname(),
            'last_name' => $billingAddress->getLastname(),
            'company_name' => $billingAddress->getCompany(),
            'address' =>  (is_array($billingAddress->getStreet()))
                        ?implode(",", $billingAddress->getStreet()):$billingAddress->getStreet(),
            'city' => $billingAddress->getCity(),
            'province' => $regionCode,
            'postal_code' => $billingAddress->getPostcode(),
            'country' => $billingAddress->getCountryId(),
            'phone_number' => $billingAddress->getTelephone(),
            'fax' => $billingAddress->getFax(),
                    'tax1' => '0.00',
            'tax2' => '0.00',
            'tax3' => '0.00',
            'shipping_cost' => '0.00'
                   ];
            
        }

        $mpgCustInfo->setShipping($shipping);

//********************* Create Item Arrays and set them **********/
        
        foreach ($order->getAllVisibleItems() as $_item) {
            $item = ['name'=>$_item->getName(),
               'quantity'=>(int) $_item->getQtyOrdered(),
               'product_code'=> $_item->getSku(),
               'extended_amount'=>$_item->getBasePrice()];
            $mpgCustInfo->setItems($item);
        }
/************************ Transaction Object *******************************/

        $mpgTxn = $this->mpgTransaction->create(['txn'=>$txnArray]);
        $mpgTxn->setCustInfo($mpgCustInfo);
        if ($this->abstractModel->cvvEnabled) {
             $cvdTemplate = [
                    'cvd_indicator' => 1,
                    'cvd_value' => $payment->getCcCid(),
                    ];
             $mpgCvdInfo = $this->mpgCvdInfo->create(["params"=>$cvdTemplate]);
             $mpgTxn->setCvdInfo($mpgCvdInfo);
        }

        $mpgRequest = $this->mpgRequest->create(["txn"=>$mpgTxn,"mpgglobals"=>$this->mpgglobalsfactory]);
        $mpgRequest->setProcCountryCode("CA"); 
        if ($this->abstractModel->testMode) {
             $mpgRequest->setTestMode(true); //false or comment out this line for production transactions
        } else {
             $mpgRequest->setTestMode(false);
        }
        
        /***************************** HTTPS Post Object *****************************/
        $mpgHttpPost  = $this->mpgHttpsPost->create(['storeid' => $this->abstractModel->monerisStoreId,
                                                     'apitoken' => $this->abstractModel->apiToken,
                                                     'mpgRequestOBJ' => $mpgRequest,
                                                     'httppostfactory'=> $this->httpsPostfactory,
                                                     'mpgresponsefactory'=> $this->mpgResponsefactory]);

        /******************************* Response ************************************/
        $mpgResponse = $mpgHttpPost->getMpgResponse();

        if ($this->_configModel->getIsDebugEnabled()) {
            $this->prepareDebug($mpgTxn, $mpgResponse);
        }
       
        return $mpgResponse;
    }

    public function prepareCaptureResponse(\Magento\Payment\Model\InfoInterface $paymentobj, $amount, $datakey)
    {
        $payment         = $this->monerisHelper->addCustomTableAttr($paymentobj);
        $order = $payment->getOrder();
        $ordertoken = '';
        if ($this->abstractModel->testMode) {
            $ordertoken = $this->abstractModel->orderToken;
        }
        
        $ordertoken = $this->modifyOrderToken($ordertoken,$order);
        
         $billingAddress = $payment->getOrder()->getBillingAddress();
         $shippingAddress = $payment->getOrder()->getShippingAddress();

        if ($datakey == false) {
             $post = $this->httpRequest->getParam('payment');
             $ccNumber = $payment->getCcNumber();
             $expMonth = $payment->getCcExpMonth();
             $exp_year = $payment->getCcExpYear();
             $expYear = empty($exp_year) ? $post['expiration_yr'] : $exp_year;
             $year =   (strlen($expYear) > 2) ? substr($expYear, -2)
                : $expYear;
             $expMonth = empty($expMonth) ? $post['expiration'] : $expMonth;
             $monthNum = ($expMonth < 10 && strlen($expMonth)<2) ? '0' . $expMonth : $expMonth;
             $txnArray  =   ['type'=>'purchase',
                                        'order_id'=> $order->getIncrementId() . $ordertoken,
                                        'cust_id'=> $order->getCustomerEmail(),
                                        'amount'=> number_format($amount, 2, '.', ''),
                                        'pan'=> empty($ccNumber) ? $post['cc_number'] : $ccNumber,
                                        'expdate'=> $year . $monthNum,
                                        'crypt_type'=>7
                             ];
        } else {
            $txnArray  =  ['type'=>'res_purchase_cc',
                            'data_key'=>$payment->getMdMoneriscaDataKey(),
                            'order_id'=>$order->getIncrementId() . $ordertoken,
                            'cust_id'=>$order->getCustomerEmail(),
                            'amount'=>number_format($amount, 2, '.', ''),
                            'crypt_type'=>1
                     ];
        }

        $billregionId  = $billingAddress->getRegionId();
        $regionModel = $this->regionFactory->create();
        if ($billregionId) :
             $regionModel->getResource()->load($regionModel, $billregionId);
             $regionCode = $regionModel->getCode();
        else :
             $regionCode = $billingAddress->getRegion();
        endif;
// /********************* Create Billing Array and set it **********/
        
        $mpgCustInfo = $this->mpgCustInfo->create();
        $mpgCustInfo->setEmail($order->getCustomerEmail());
        if($billingAddress)
        {
            

            $billing =[ 'first_name' => $billingAddress->getFirstname(),
            'last_name' => $billingAddress->getLastname(),
            'company_name' => $billingAddress->getCompany(),
            'address' =>  (is_array($billingAddress->getStreet()))
                        ?implode(",", $billingAddress->getStreet()):$billingAddress->getStreet(),
            'city' => $billingAddress->getCity(),
            'province' => $regionCode,
            'postal_code' => $billingAddress->getPostcode(),
            'country' => $billingAddress->getCountryId(),
            'phone_number' => $billingAddress->getTelephone(),
            'fax' => $billingAddress->getFax(),
                    'tax1' => '0.00',
            'tax2' => '0.00',
            'tax3' => '0.00',
            'shipping_cost' => '0.00'
                   ];
            
            $mpgCustInfo->setBilling($billing);
        }    

///********************* Create Shipping Array and set it **********/
       if($shippingAddress)
        {
            $regionId  = $shippingAddress->getRegionId();
            if ($regionId) :
                 $regionModel->getResource()->load($regionModel, $regionId);
                 $regionCode = $regionModel->getCode();
            else :
                 $regionCode = $billingAddress->getRegion();
            endif;
            $shipping = ['first_name' => $shippingAddress->getFirstname(),
            'last_name' => $shippingAddress->getLastname(),
            'company_name' => $shippingAddress->getCompany(),
            'address' => (is_array($shippingAddress->getStreet()))
                        ?implode(",", $shippingAddress->getStreet()):$shippingAddress->getStreet(),
            'city' => $shippingAddress->getCity(),
            'province' => $regionCode,
            'postal_code' => $shippingAddress->getPostcode(),
            'country' => $shippingAddress->getCountry(),
            'phone_number' => $shippingAddress->getTelephone(),
            'fax' => $shippingAddress->getFax(),
                    'tax1' => '0.00',
                    'tax2' => '0.00',
                    'tax3' => '0.00',
                    'shipping_cost' => '0.0'
                ];
        } else {
            
            $shipping =[ 'first_name' => $billingAddress->getFirstname(),
            'last_name' => $billingAddress->getLastname(),
            'company_name' => $billingAddress->getCompany(),
            'address' =>  (is_array($billingAddress->getStreet()))
                        ?implode(",", $billingAddress->getStreet()):$billingAddress->getStreet(),
            'city' => $billingAddress->getCity(),
            'province' => $regionCode,
            'postal_code' => $billingAddress->getPostcode(),
            'country' => $billingAddress->getCountryId(),
            'phone_number' => $billingAddress->getTelephone(),
            'fax' => $billingAddress->getFax(),
                    'tax1' => '0.00',
            'tax2' => '0.00',
            'tax3' => '0.00',
            'shipping_cost' => '0.00'
                   ];
            
        }
        
        $mpgCustInfo->setShipping($shipping);

///********************* Create Item Arrays and set them **********/
        
        foreach ($order->getAllVisibleItems() as $_item) {
            $item = ['name'=>$_item->getName(),
               'quantity'=>(int) $_item->getQtyOrdered(),
               'product_code'=> $_item->getSku(),
               'extended_amount'=>$_item->getBasePrice()];
            $mpgCustInfo->setItems($item);
        }

 /************************ Transaction Object *******************************/
        
        $mpgTxn = $this->mpgTransaction->create(['txn'=>$txnArray]);
        $mpgTxn->setCustInfo($mpgCustInfo);
        if ($this->abstractModel->cvvEnabled) {
             $cvdTemplate = [
                    'cvd_indicator' => 1,
                    'cvd_value' => $payment->getCcCid(),
                    ];
             $mpgCvdInfo = $this->mpgCvdInfo->create(["params"=>$cvdTemplate]);
             $mpgTxn->setCvdInfo($mpgCvdInfo);
        }

        $mpgRequest = $this->mpgRequest->create(["txn"=>$mpgTxn,"mpgglobals"=>$this->mpgglobalsfactory]);
        $mpgRequest->setProcCountryCode("CA");
        if ($this->abstractModel->testMode) {
             $mpgRequest->setTestMode(true);
        } else {
             $mpgRequest->setTestMode(false);
        }

        /***************************** HTTPS Post Object *****************************/
        $mpgHttpPost  = $this->mpgHttpsPost->create(['storeid'=>$this->abstractModel->monerisStoreId,
                                                     'apitoken'=>$this->abstractModel->apiToken,
                                                     'mpgRequestOBJ'=>$mpgRequest,
                                                     'httppostfactory'=> $this->httpsPostfactory,
                                                     'mpgresponsefactory'=> $this->mpgResponsefactory]);

        /******************************* Response ************************************/
        $mpgResponse = $mpgHttpPost->getMpgResponse();

        if ($this->_configModel->getIsDebugEnabled()) {
            $this->prepareDebug($mpgTxn, $mpgResponse);
        }

        return $mpgResponse;
    }
    
    
    
    /**
     * function for create customer profile
     * @return type
     */
    public function createCustomerProfile()
    {
        $inputData = $this->getInputData();
        $regionId  = $inputData->getRegionId();
        $regionModel = $this->regionFactory->create();
        if ($regionId) :
             $regionModel->getResource()->load($regionModel, $regionId);
             $regionCode = $regionModel->getCode();
        else :
                $regionCode = $inputData->getState();
        endif;
        $year =   (strlen($inputData->getCcExpYear()) > 2) ? substr($inputData->getCcExpYear(), -2)
            : $inputData->getCcExpYear();
        $txnArray=['type'=>'res_add_cc',
                'cust_id'=>$inputData->getCustomerId(),
                'phone'=>$inputData->getTelephone(),
                'email'=>$inputData->getEmail(),
                                'pan'=>$inputData->getCcNumber(),
                    'expdate'=> $year . $inputData->getCcExpMonth(),
                                'crypt_type'=>7
                ];

/********************** AVS Associative Array *********************************/

        $avsTemplate = [
                'avs_street_number' => (is_array($inputData->getStreet()))?
                        implode(",", $inputData->getStreet()):$inputData->getStreet(),
                'avs_street_name' => (is_array($inputData->getStreet()))?
                        implode(",", $inputData->getStreet()):$inputData->getStreet(),
                'avs_zipcode' => $inputData->getPostcode()
                ];

        $mpgAvsInfo = $this->mpgAvsInfo->create(['params'=>$avsTemplate]);

        /**************************** Transaction Object *****************************/

        $mpgTxn = $this->mpgTransaction->create(['txn'=>$txnArray]);

        /************************ Set AVS *****************************/

        $mpgTxn->setAvsInfo($mpgAvsInfo);
       
        /****************************** Request Object *******************************/
        $mpgRequest = $this->mpgRequest->create(["txn"=>$mpgTxn,"mpgglobals"=>$this->mpgglobalsfactory]);
        $mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
        if ($this->abstractModel->testMode) {
             $mpgRequest->setTestMode(true); //false or comment out this line for production transactions
        } else {
             $mpgRequest->setTestMode(false);
        }
       /***************************** HTTPS Post Object *****************************/

        $mpgHttpPost  = $this->mpgHttpsPost->create(['storeid'=>$this->abstractModel->monerisStoreId,
                                                     'apitoken'=>$this->abstractModel->apiToken,
                                                     'mpgRequestOBJ'=>$mpgRequest,
                                                     'httppostfactory'=> $this->httpsPostfactory,
                                                     'mpgresponsefactory'=> $this->mpgResponsefactory]);

        /******************************* Response ************************************/
        $mpgResponse = $mpgHttpPost->getMpgResponse();

        if ($this->_configModel->getIsDebugEnabled()) {
            $this->prepareDebug($mpgTxn, $mpgResponse);
        }
        
        return $mpgResponse;
    }    
    
    public function prepareAuthorizeCaptureResponse(\Magento\Payment\Model\InfoInterface $paymentobj, $amount)
    {
        $payment         = $this->monerisHelper->addCustomTableAttr($paymentobj);
        $order = $payment->getOrder();
        $ordertoken = '';
        if ($this->abstractModel->testMode) {
            $ordertoken = $this->abstractModel->orderToken;
        }
        
        $ordertoken = $this->modifyOrderToken($ordertoken,$order);
        
        /************************ Transaction Array **********************************/
        
        $txnArray=  ['type' => 'completion',
                     'order_id'=> $order->getIncrementId() . $ordertoken,
                     'comp_amount'=>$amount,
                     'txn_number'=>$payment->getMoneriscaToken(),
                     'crypt_type'=>'7'
                   ];

        /************************ Transaction Object *********************************/
        $mpgTxn = $this->mpgTransaction->create(['txn'=>$txnArray]);

        /************************ Request Object *************************************/
        
        $mpgRequest = $this->mpgRequest->create(["txn"=>$mpgTxn,"mpgglobals"=>$this->mpgglobalsfactory]);
        
        $mpgRequest->setProcCountryCode("CA"); 
        if ($this->abstractModel->testMode) {
             $mpgRequest->setTestMode(true); //false or comment out this line for production transactions
        } else {
             $mpgRequest->setTestMode(false);
        }
        
        /***************************** HTTPS Post Object *****************************/
        $mpgHttpPost  = $this->mpgHttpsPost->create(['storeid'=>$this->abstractModel->monerisStoreId,
                                                     'apitoken'=>$this->abstractModel->apiToken,
                                                     'mpgRequestOBJ'=>$mpgRequest,
                                                     'httppostfactory'=> $this->httpsPostfactory,
                                                     'mpgresponsefactory'=> $this->mpgResponsefactory]);

        /******************************* Response ************************************/
        $mpgResponse = $mpgHttpPost->getMpgResponse();

        if ($this->_configModel->getIsDebugEnabled()) {
            $this->prepareDebug($mpgTxn, $mpgResponse);
        }
        
        return $mpgResponse;
    }
    
    public function prepareVoidResponse(\Magento\Payment\Model\InfoInterface $paymentobj, $realAuthorizeTransactionId)
    {
        $payment         = $this->monerisHelper->addCustomTableAttr($paymentobj);
        $order = $payment->getOrder();
        $ordertoken = '';
        if ($this->abstractModel->testMode) {
            $ordertoken = $this->abstractModel->orderToken;
        }
        
        $ordertoken = $this->modifyOrderToken($ordertoken,$order);
        
        $txnArray   =   ['type' => 'purchasecorrection',
                        'order_id' => $order->getIncrementId() . $ordertoken,
                        'txn_number' => $realAuthorizeTransactionId,
                        'crypt_type' => '7',
                       ];

     /************************ Transaction Object *********************************/
        $mpgTxn = $this->mpgTransaction->create(['txn'=>$txnArray]);

     /************************ Request Object *************************************/

        $mpgRequest = $this->mpgRequest->create(["txn"=>$mpgTxn,"mpgglobals"=>$this->mpgglobalsfactory]);
        $mpgRequest->setProcCountryCode("CA");
        if ($this->abstractModel->testMode) {
             $mpgRequest->setTestMode(true);
        } else {
             $mpgRequest->setTestMode(false);
        }
     
    /***************************** HTTPS Post Object *****************************/
        $mpgHttpPost  = $this->mpgHttpsPost->create(['storeid'=>$this->abstractModel->monerisStoreId,
                                                     'apitoken'=>$this->abstractModel->apiToken,
                                                     'mpgRequestOBJ'=>$mpgRequest,
                                                     'httppostfactory'=> $this->httpsPostfactory,
                                                     'mpgresponsefactory'=> $this->mpgResponsefactory]);

     /******************************* Response ************************************/

        $mpgResponse = $mpgHttpPost->getMpgResponse();

        if ($this->_configModel->getIsDebugEnabled()) {
            $this->prepareDebug($mpgTxn, $mpgResponse);
        }
        return $mpgResponse;
    }

    
    public function prepareRefundResponse(
        \Magento\Payment\Model\InfoInterface $paymentobj,
        $amount,
        $realCaptureTransactionId
    ) {

        $payment         = $this->monerisHelper->addCustomTableAttr($paymentobj);
        $order = $payment->getOrder();
        $ordertoken = '';
        if ($this->abstractModel->testMode) {
            $ordertoken = $this->abstractModel->orderToken;
        }
        
        $ordertoken = $this->modifyOrderToken($ordertoken,$order);
        
       /************************ Transaction Array **********************************/
        $txnArray=  ['type' => 'refund',
                     'order_id'=> $order->getIncrementId() . $ordertoken,
                     'amount'=>$amount,
                     'txn_number'=>$realCaptureTransactionId,
                     'crypt_type'=>'7'
                   ];

    /************************ Transaction Object *********************************/
        $mpgTxn = $this->mpgTransaction->create(['txn'=>$txnArray]);

     /************************ Request Object *************************************/

        $mpgRequest = $this->mpgRequest->create(["txn"=>$mpgTxn,"mpgglobals"=>$this->mpgglobalsfactory]);
        $mpgRequest->setProcCountryCode("CA"); 
        if ($this->abstractModel->testMode) {
             $mpgRequest->setTestMode(true); //false or comment out this line for production transactions
        } else {
             $mpgRequest->setTestMode(false);
        }
       
        /***************************** HTTPS Post Object *****************************/
        $mpgHttpPost  = $this->mpgHttpsPost->create(['storeid'=>$this->abstractModel->monerisStoreId,
                                                     'apitoken'=>$this->abstractModel->apiToken,
                                                     'mpgRequestOBJ'=>$mpgRequest,
                                                     'httppostfactory'=> $this->httpsPostfactory,
                                                     'mpgresponsefactory'=> $this->mpgResponsefactory]);

        /******************************* Response ************************************/
        $mpgResponse = $mpgHttpPost->getMpgResponse();
       
        if ($this->_configModel->getIsDebugEnabled()) {
            $this->prepareDebug($mpgTxn, $mpgResponse);
        }

        return $mpgResponse;
    }
    
    public function createCustomerProfileFromTransaction($payment)
    {

        $billingAddress = $payment->getOrder()->getBillingAddress();
        $order = $payment->getOrder();
        $regionId  = $billingAddress->getRegionId();
        $regionModel = $this->regionFactory->create();
        if ($regionId) :
             $regionModel->getResource()->load($regionModel, $regionId);
             $regionCode = $regionModel->getCode();
        else :
                $regionCode = $billingAddress->getRegion();
        endif;
        $year =   (strlen($payment->getCcExpYear()) > 2) ? substr($payment->getCcExpYear(), -2)
            : $payment->getCcExpYear();
        $monthNum = ($payment->getCcExpMonth() < 10 && strlen($payment->getCcExpMonth())<2)
            ? '0' . $payment->getCcExpMonth() : $payment->getCcExpMonth();
        $txnArray=['type'=>'res_add_cc',
                'cust_id'=>$order->getCustomerEmail(),
                'phone'=>$billingAddress->getTelephone(),
                'email'=>$billingAddress->getEmail(),
                                'pan'=>$payment->getCcNumber(),
                    'expdate'=> $year . $monthNum,
                                'crypt_type'=>7
                ];

/********************** AVS Associative Array *********************************/

        $avsTemplate = [
                'avs_street_number' => (is_array($billingAddress->getStreet()))?
                        implode(",", $billingAddress->getStreet()):$billingAddress->getStreet(),
                'avs_street_name' => (is_array($billingAddress->getStreet()))?
                        implode(",", $billingAddress->getStreet()):$billingAddress->getStreet(),
                'avs_zipcode' => $billingAddress->getPostcode()
                ];

        $mpgAvsInfo = $this->mpgAvsInfo->create(['params'=>$avsTemplate]);

        /**************************** Transaction Object *****************************/

        $mpgTxn = $this->mpgTransaction->create(['txn'=>$txnArray]);

        /************************ Set AVS *****************************/

        $mpgTxn->setAvsInfo($mpgAvsInfo);

     /****************************** Request Object *******************************/
        $mpgRequest = $this->mpgRequest->create(["txn"=>$mpgTxn,"mpgglobals"=>$this->mpgglobalsfactory]);
        $mpgRequest->setProcCountryCode("CA");
        if ($this->abstractModel->testMode) {
             $mpgRequest->setTestMode(true);
        } else {
             $mpgRequest->setTestMode(false);
        }
   /***************************** HTTPS Post Object *****************************/

        $mpgHttpPost  = $this->mpgHttpsPost->create(['storeid'=>$this->abstractModel->monerisStoreId,
                                                     'apitoken'=>$this->abstractModel->apiToken,
                                                     'mpgRequestOBJ'=>$mpgRequest,
                                                     'httppostfactory'=> $this->httpsPostfactory,
                                                     'mpgresponsefactory'=> $this->mpgResponsefactory]);

        /******************************* Response ************************************/
        $mpgResponse = $mpgHttpPost->getMpgResponse();

        if ($this->_configModel->getIsDebugEnabled()) {
            $this->prepareDebug($mpgTxn, $mpgResponse);
        }

        return $mpgResponse;
    }

    
    public function deleteCustomerPaymentProfile()
    {
        $inputData = $this->getInputData();
        $regionId  = $inputData->getRegionId();
        $regionModel = $this->regionFactory->create();
        if ($regionId) :
             $regionModel->getResource()->load($regionModel, $regionId);
             $regionCode = $regionModel->getCode();
        else :
             $regionCode = $inputData->getState();
        endif;
         $year =   (strlen($inputData->getCcExpYear()) > 2) ? substr($inputData->getCcExpYear(), -2) :
         $inputData->getCcExpYear();
         $cardUpdateCheck = $inputData->getcc_action();
                $txnArray  =       ['type'=>'res_delete',
                                    'data_key'=>$inputData->getCustomerDataKey()
                             ];
                $mpgTxn = $this->mpgTransaction->create(['txn'=>$txnArray]);
                $mpgRequest = $this->mpgRequest->create(["txn"=>$mpgTxn,"mpgglobals"=>$this->mpgglobalsfactory]);
                $mpgRequest->setProcCountryCode("CA"); //"CA" for sending transaction to Canadian environment
                if ($this->abstractModel->testMode) {
                           $mpgRequest->setTestMode(true); //false or comment out this line for production transactions
                } else {
                           $mpgRequest->setTestMode(false);
                }
       /***************************** HTTPS Post Object *****************************/

                $mpgHttpPost  = $this->mpgHttpsPost->create(['storeid'=>$this->abstractModel->monerisStoreId,
                                                     'apitoken'=>$this->abstractModel->apiToken,
                                                     'mpgRequestOBJ'=>$mpgRequest,
                                                     'httppostfactory'=> $this->httpsPostfactory,
                                                     'mpgresponsefactory'=> $this->mpgResponsefactory]);

       /******************************* Response ************************************/
                $mpgResponse = $mpgHttpPost->getMpgResponse();
      
                return $mpgResponse;
    }
    
    public function updateCustomerProfile()
    {
        $inputData = $this->getInputData();
        $regionId  = $inputData->getRegionId();
        $regionModel = $this->regionFactory->create();
        if ($regionId) :
             $regionModel->getResource()->load($regionModel, $regionId);
             $regionCode = $regionModel->getCode();
        else :
             $regionCode = $inputData->getState();
        endif;
        $year =   (strlen($inputData->getCcExpYear()) > 2) ? substr($inputData->getCcExpYear(), -2) :
        $inputData->getCcExpYear();
        $cardUpdateCheck = $inputData->getcc_action();
            $txnArray  =       ['type'=>'res_update_cc',
                                'data_key'=>$inputData->getCustomerDataKey(),
                'cust_id'=>$inputData->getCustomerId(),
                'phone'=>$inputData->getTelephone(),
                'email'=>$inputData->getEmail(),
                                'crypt_type'=>7
                ];
            if ($cardUpdateCheck != 'existing') {
                  $txnArray['pan']      =  $inputData->getCcNumber();
                  $txnArray['expdate']  =  $year . $inputData->getCcExpMonth();
            }
/********************** AVS Associative Array *********************************/

            $avsTemplate = [
                'avs_street_number' => (is_array($inputData->getStreet()))?
                        implode(",", $inputData->getStreet()):$inputData->getStreet(),
                'avs_street_name' => (is_array($inputData->getStreet()))?
                        implode(",", $inputData->getStreet()):$inputData->getStreet(),
                'avs_zipcode' => $inputData->getPostcode()
                ];
            $mpgAvsInfo = $this->mpgAvsInfo->create(['params'=>$avsTemplate]);

        /**************************** Transaction Object *****************************/

            $mpgTxn = $this->mpgTransaction->create(['txn'=>$txnArray]);
            if ($this->abstractModel->cvvEnabled) {
                if ($cardUpdateCheck != 'existing') {
                    $cvdTemplate = [
                          'cvd_indicator' => 1,
                          'cvd_value' => $inputData->getCcCid(),
                          ];
                     $mpgCvdInfo = $this->mpgCvdInfo->create(["params"=>$cvdTemplate]);
                    ;
                     $mpgTxn->setCvdInfo($mpgCvdInfo);
                }
            }

        /************************ Set AVS *****************************/

            $mpgTxn->setAvsInfo($mpgAvsInfo);

        /****************************** Request Object *******************************/

            $mpgRequest = $this->mpgRequest->create(["txn"=>$mpgTxn,"mpgglobals"=>$this->mpgglobalsfactory]);
            $mpgRequest->setProcCountryCode("CA"); //"CA" for sending transaction to Canadian environment
            if ($this->abstractModel->testMode) {
                 $mpgRequest->setTestMode(true); //false or comment out this line for production transactions
            } else {
                 $mpgRequest->setTestMode(false);
            }

        /***************************** HTTPS Post Object *****************************/
            $mpgHttpPost  = $this->mpgHttpsPost->create(['storeid'=>$this->abstractModel->monerisStoreId,
                                                     'apitoken'=>$this->abstractModel->apiToken,
                                                     'mpgRequestOBJ'=>$mpgRequest,
                                                     'httppostfactory'=> $this->httpsPostfactory,
                                                     'mpgresponsefactory'=> $this->mpgResponsefactory]);

        /******************************* Response ************************************/
            $mpgResponse = $mpgHttpPost->getMpgResponse();
            return $mpgResponse;
    }
    
// @codingStandardsIgnoreStart
    public function prepareDebug($request, $response)
    {
        $requstArray                = json_decode(json_encode($request), true);
        $responseArray              = (array)$response;
        $monerisRequest             = new \SimpleXMLElement('<?xml version="1.0"?><moneris_request_info></moneris_request_info>');
        $this->arrayToXml($requstArray, $monerisRequest);
      
        $monerisRequestXMLFile  = $monerisRequest->asXML();

        $dom                        = new \DOMDocument();
        $dom->loadXML($monerisRequestXMLFile);
        $dom->formatOutput          = true;
        $RequestXML                 = '';
        $ResponseXML                = '';
        $RequestXML .= "Request:\n\n";
        $RequestXML .= $dom->saveXML();
        /* print request log */
        $logger = $this->zendlogger;
        $logger->addWriter($this->streamFactory);
        $logger->info("$RequestXML");
        $monerisResponse = new \SimpleXMLElement('<?xml version="1.0"?><moneris_response_info></moneris_response_info>');
        $this->arrayToXml($responseArray, $monerisResponse);
        $monerisResponseXMLFile = $monerisResponse->asXML();
        $dom                        = new \DOMDocument();
        $dom->loadXML($monerisResponseXMLFile);
        $dom->formatOutput          = true;
        $ResponseXML .= "Response:\n\n";
        $ResponseXML .= $dom->saveXML();
        $logger->info("$ResponseXML");
    }
    // @codingStandardsIgnoreEnd
    public function arrayToXml($array, &$xml_user_info)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (!is_numeric($key)) {
                    $subnode = $xml_user_info->addChild("$key");
                    $this->arrayToXml($value, $subnode);
                } else {
                    $subnode = $xml_user_info->addChild("item$key");
                    $this->arrayToXml($value, $subnode);
                }
            } else {
                if (is_numeric($key)) {
                    continue;
                }
                if ($key == 'pan') {
                    $value = substr($value, -4, 4);
                    $value = 'XXXX-'.$value;
                }
                if ($key == 'expdate') {
                    $value = 'XXXX';
                }
                if ($key == 'cvd') {
                    $value = 'XX';
                }
                if ($key == 'DataKey') {
                    $value = 'XXXXXXXXXXXX';
                }
                $xml_user_info->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }
}
