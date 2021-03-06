<?php

/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

namespace Magestore\WebposStripe\Helper;


/**
 * class \Magestore\WebposStripe\Helper\Data
 *
 * WebposStripe Data helper
 * Methods:
 *  getModel
 *  getStore
 *  getStoreConfig
 *  getStripeConfig
 *
 * @category    Magestore
 * @package     Magestore_WebposStripe
 * @module      Webpos
 * @author      Magestore Developer
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     *
     * @var \Magento\Framework\App\ObjectManager
     */
    protected $_objectManager;

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ){
        $this->_storeManager = $storeManager;
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        parent::__construct($context);
    }

    /**
     * get store
     *
     * @return \Magento\Store\Api\Data\StoreInterface
     */
    public function getStore(){
        return $this->_storeManager->getStore();
    }

    /**
     * get store config
     *
     * @param string $path
     * @return string
     */
    public function getStoreConfig($path){
        return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * get class name
     *
     * @params string $class
     * @return mixed
     */
    public function getModel($class){
        return $this->_objectManager->get($class);
    }

    /**
     * @return array
     */
    public function getStripeConfig() {
        $configData = array();
        $configItems = array(
            'enable',
            'publishable_key',
            'api_key'
        );
        foreach ($configItems as $configItem) {
            $configData[$configItem] = $this->getStoreConfig('webpos/payment/stripe/' . $configItem);
        }
        return $configData;
    }

    /**
     * @return bool
     */
    public function isAllowCustomerPayWithEmail(){
        $enable = $this->getStoreConfig('webpos/payment/stripe/enable_send_invoice');
        return ($enable == 1)?true:false;
    }

    /**
     * @return bool
     */
    public function isEnableStripe(){
        $enable = $this->getStoreConfig('webpos/payment/stripe/enable');
        return ($enable == 1)?true:false;
    }

    public function isZeroDecimal($currency)
    {
        return in_array(strtolower($currency), array(
            'bif', 'djf', 'jpy', 'krw', 'pyg', 'vnd', 'xaf',
            'xpf', 'clp', 'gnf', 'kmf', 'mga', 'rwf', 'vuv', 'xof'));
    }

}