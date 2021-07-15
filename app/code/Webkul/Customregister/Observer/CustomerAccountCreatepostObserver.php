<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_Customregister
 * @author    Webkul
 * @copyright Copyright (c) 2010-2017 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */

namespace Webkul\Customregister\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

/**
 * Webkul Customregister CustomerAccountCreatepostObserver Observer.
 */
class CustomerAccountCreatepostObserver implements ObserverInterface
{
    /**
     * @var ObjectManagerInterface
     */
    protected $_objectManager;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    private $_messageManager;

    /**
     * @param \Magento\Framework\ObjectManagerInterface   $objectManager
     * @param \Magento\Store\Model\StoreManagerInterface  $storeManager
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\App\ResponseFactory $responseFactory
    ) {
        $this->_objectManager = $objectManager;
        $this->_storeManager = $storeManager;
        $this->_messageManager = $messageManager;
        $this->_responseFactory = $responseFactory;
    }

    /**
     * customer register event handler.
     *
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $paramData = $observer->getEvent()->getRequest()->getParams();
        try {
          if(isset($paramData['wk_custom_register'])){
            if($paramData['wk_custom_register'] == 1 && !empty($paramData['wk_custom_register'])){
            $paramData['password_confirmation'] = $paramData['password'];
            $observer->getEvent()->getRequest()->setParams($paramData);
            return $observer;
          }
        }
        } catch (\Exception $e) {
            $this->_messageManager->addError($e->getMessage());
        }
    }

}
