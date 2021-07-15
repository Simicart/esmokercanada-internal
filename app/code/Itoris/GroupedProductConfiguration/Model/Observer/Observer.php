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
use Magento\Backend\Block\Widget\Grid;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Block\Product\View\Description;
use Magento\Framework\View\Result\Layout;
class Observer implements ObserverInterface{
    protected $_scopeConfig;
    protected $tabs=false;
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->_scopeConfig = $scopeConfig;
    }
    protected $bool=true;
    protected $_objectManager;
    public function execute(\Magento\Framework\Event\Observer $observer)
    {

        /** @var \Magento\Framework\View\Layout $layout */
        $layout = $observer->getLayout();
        $block=$layout->getBlock('product.info.grouped');
        $objectManager =$this->_objectManager= \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $objectManager->create('Itoris\GroupedProductConfiguration\Helper\ExtensionConfig');
        if($helper->isEnabled()) {
            if ($block && $block->getType() == 'Magento\GroupedProduct\Block\Product\View\Type\Grouped\Interceptor') {
                $block->setTemplate('Itoris_GroupedProductConfiguration::grouped.phtml');


            }
        }
        $handles = $layout->getUpdate()->getHandles();
        $blockForm=$layout->getBlock('product.info');
        $blockCart=$layout->getBlock('product.info.addtocart');
        if($blockCart && in_array('catalog_product_view_type_grouped',$handles) && $blockForm->getType()=='Magento\Catalog\Block\Product\View\Interceptor'){
            $blockCart->setTemplate('Itoris_GroupedProductConfiguration::addtocart.phtml');
        }
        $blockWraper=$layout->getBlock('product.info.options.wrapper');
       if($blockWraper && in_array('catalog_product_view_type_grouped',$handles))
       {
           $layout->unsetElement('product.info.options.wrapper');
       }
        if($blockForm && in_array('catalog_product_view_type_grouped',$handles) && $blockForm->getType()=='Magento\Catalog\Block\Product\View\Interceptor'){
            $blockForm->setTemplate('Itoris_GroupedProductConfiguration::form.phtml');
        }

    }


}