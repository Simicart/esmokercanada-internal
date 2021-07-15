<?php
/**
 * ITORIS
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the ITORIS's Magento Extensions License Agreement
 * which is available through the world-wide-web at this URL:
 * http://www.itoris.com/magento-extensions-license.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to sales@itoris.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the extensions to newer
 * versions in the future. If you wish to customize the extension for your
 * needs please refer to the license agreement or contact sales@itoris.com for more information.
 *
 * @category   ITORIS
 * @package    ITORIS_M2_Itoris_GroupedProductConfiguration
 * @copyright  Copyright (c) 2016 ITORIS INC. (http://www.itoris.com)
 * @license    http://www.itoris.com/magento-extensions-license.html  Commercial License
 */

namespace Itoris\GroupedProductConfiguration\Model\Observer;


class ItemsUpdate implements \Magento\Framework\Event\ObserverInterface
{
    protected $_objectManager;
    public function __construct()
    {
        $this->_objectManager=\Magento\Framework\App\ObjectManager::getInstance();
            //Magento\Checkout\Model
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        /*$contrller=$observer->getControllerAction();
        $cart=$this->_objectManager->create('Magento\Checkout\Model\Cart');
        $id=$observer->getRequest()->getParam('id');
        $quoteItem = $cart->getQuote()->getItemById($id);*/

    }
}