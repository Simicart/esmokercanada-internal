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

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    const MONERIS_ACTIVE                = 'payment/md_monerisca/active';
    const MONERIS_TITLE                 = 'payment/md_monerisca/title';
    const MONERIS_STORE_ID              = 'payment/md_monerisca/store_id';
    const MONERIS_API_TOKEN             = 'payment/md_monerisca/api_token';
    const MONERIS_ORDER_TOKEN           = 'payment/md_monerisca/order_token';
    const MONERIS_TEST                  = 'payment/md_monerisca/test';
    const MONERIS_PAYMENT_ACTION        = 'payment/md_monerisca/payment_action';
    const MONERIS_DEBUG                 = 'payment/md_monerisca/debug';
    const MONERIS_CCTYPES               = 'payment/md_monerisca/cctypes';
    const MONERIS_CCV                   = 'payment/md_monerisca/useccv';
    const MONERIS_CARD_SAVE_OPTIONAL    = 'payment/md_monerisca/save_optional';
    const MONERIS_NEW_ORDER_STATUS      = 'payment/md_monerisca/order_status';
    const MONERIS_VALIDATION_NONE = 'none';
    const MONERIS_VALIDATION_TEST = 'testMode';
    const MONERIS_VALIDATION_LIVE = 'liveMode';

    public $storeId = null;
    public $backend = false;
    public $coreRegistry = null;
    public $session;
    public $adminsession;
    public $scopeConfig;
    public $encryptor;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Model\Session\Quote $quoteSession,
        \Magento\Backend\Model\Session\Proxy $adminsession,
        \Magento\Framework\Encryption\Encryptor $encryptor,
        ScopeConfigInterface $scopeConfig,
        \Magento\Customer\Model\Config\Share $customerScope, 
        \Magento\Sales\Api\Data\OrderInterface $order,
        \Magento\Framework\App\Request\Http $request     
    ) {
    
        $this->_storeManager = $storeManager;
        $this->coreRegistry = $registry;
        $this->session      = $quoteSession;
        $this->adminsession = $adminsession;
        $this->scopeConfig   = $scopeConfig;
        $this->encryptor     = $encryptor;
        $this->customerScope        = $customerScope;
        $this->request              = $request;
        $this->order                = $order;
        $this->storeId              = $this->getStoreId();
        $this->backend              = $this->checkAdmin() ? true : false;
    }

    public function _construct()
    {
        if ($this->backend && $this->coreRegistry->registry('current_order') != false) {
            $this->setStoreId($this->coreRegistry->registry('current_order')->getStoreId());
            $this->adminsession->setCustomerStoreId(null);
        } elseif ($this->backend && $this->coreRegistry->registry('current_invoice')
            != false) {
            $this->setStoreId($this->coreRegistry->registry('current_invoice')->getStoreId());
            $this->adminsession->setCustomerStoreId(null);
        } elseif ($this->backend && $this->coreRegistry->registry('current_creditmemo')
            != false) {
            $this->setStoreId($this->coreRegistry->registry('current_creditmemo')->getStoreId());
            $this->adminsession->setCustomerStoreId(null);
        } elseif ($this->backend && $this->coreRegistry->registry('current_customer')
            != false) {
            $this->setStoreId($this->coreRegistry->registry('current_customer')->getStoreId());
            $this->adminsession->setCustomerStoreId($this->coreRegistry->registry('current_customer')
                ->getStoreId());
        } elseif ($this->backend && $this->session->getStore()->getId() > 0) {
            $this->setStoreId($this->session->getStore()->getId());
            $this->adminsession->setCustomerStoreId(null);
        } else {
            $customerStoreSessionId = $this->adminsession->getCustomerStoreId();
            if ($this->backend && $customerStoreSessionId != null) {
                $this->setStoreId($customerStoreSessionId);
            } else {
                $this->setStoreId($this->_storeManager->getStore()->getId());
            }
        }
    }

    public function setStoreId($storeId = 0)
    {
        $this->storeId = $this->getStoreId();

        return $this;
    }

    public function getMoneriscaStoreId()
    {
         return $this->encryptor->decrypt($this->getConfigData(self::MONERIS_STORE_ID, $this->storeId));
    }
    public function getApiToken()
    {
         return $this->encryptor->decrypt($this->getConfigData(self::MONERIS_API_TOKEN, $this->storeId));
    }
    public function getOrderToken()
    {
         return $this->getConfigData(self::MONERIS_ORDER_TOKEN, $this->storeId);
    }

    public function getConfigData($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getIsActive()
    {
        return $this->getConfigData(self::MONERIS_ACTIVE, $this->storeId);
    }

    /**
     * This method will return whether test mode is enabled or not.
     * @return bool
     */
    public function getIsTestMode()
    {
        return $this->getConfigData(self::MONERIS_TEST, $this->storeId);
    }

    /**
     * This methos will return Monerisca payment method title set by admin to display
     * on onepage checkout payment step.
     * @return string
     */
    public function getMethodTitle()
    {
        return (string) $this->getConfigData(
            self::MONERIS_TITLE,
            $this->storeId
        );
    }

    /**
     * This will returne payment action whether it is authorized or authorize and capture.
     * @return string
     */
    public function getPaymentAction()
    {
        return (string) $this->getConfigData(
            self::MONERIS_PAYMENT_ACTION,
            $this->storeId
        );
    }

    /**
     * This method will return whether debug is enabled from config.
     * @return bool
     */
    public function getIsDebugEnabled()
    {
        return (boolean) $this->getConfigData(
            self::MONERIS_DEBUG,
            $this->storeId
        );
    }

    /**
     * This method return whether card verification is enabled or not.
     * @return bool
     */
    public function isCardVerificationEnabled()
    {
        return (boolean) $this->getConfigData(
            self::MONERIS_CCV,
            $this->storeId
        );
    }

    /**
     * Method which will return whether customer must save credit card as profile of not.
     * @return bool
     */
    public function getSaveCardOptional()
    {
        return (boolean) $this->getConfigData(
            self::MONERIS_CARD_SAVE_OPTIONAL,
            $this->storeId
        );
    }

    public function getCcTypes()
    {
        return $this->getConfigData(self::MONERIS_CCTYPES, $this->storeId);
    }

    public function getDefaultFormat()
    {
        return $this->getConfigData(
            'customer/address_templates/html',
            $this->storeId
        );
    }
    
    public function checkAdmin()
    {
        $om = \Magento\Framework\App\ObjectManager::getInstance();
        $app_state = $om->get('Magento\Framework\App\State');
        $area_code = $app_state->getAreaCode();
        if ($app_state->getAreaCode() == \Magento\Backend\App\Area\FrontNameResolver::AREA_CODE) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getCustomerAccountShare()
    {
       return $this->customerScope->isWebsiteScope();
    }
    
    public function getStoreId() 
    {
        
        if($this->checkAdmin()){
           $controller =  $this->request->getControllerName(); 
           if($controller == 'order_invoice' || $controller == 'order_creditmemo')
           {
               $order_id = $this->request->getParam('order_id');
               $order = $this->order->load($order_id);
               $storeId = $order->getStoreId();
           } else {
               $storeId =  $this->session->getQuote()->getStoreId();
           }
        } else {
            $storeId =  $this->_storeManager->getStore()->getId();
        }
        return  $storeId;  
    }
}
