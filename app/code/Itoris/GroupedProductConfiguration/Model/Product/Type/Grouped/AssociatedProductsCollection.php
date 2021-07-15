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

namespace Itoris\GroupedProductConfiguration\Model\Product\Type\Grouped;

class AssociatedProductsCollection  extends \Magento\GroupedProduct\Model\ResourceModel\Product\Type\Grouped\AssociatedProductsCollection
{
    public function _initSelect()
    {
        parent::_initSelect();
        $objectManager =$this->_objectManager= \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $objectManager->create('Itoris\GroupedProductConfiguration\Helper\ExtensionConfig');
        if ($helper->isEnabled()) {
            $this->setProduct(
                $this->_getProduct()
            )->addAttributeToSelect(
                'name'
            )->addAttributeToSelect(
                'price'
            )->addAttributeToSelect(
                'sku'
            )->addFilterByRequiredOptionsCustom()->addAttributeToFilter(
                'type_id',
                [['neq' =>'grouped']]

            )/*->addAttributeToFilter(
                'type_id',
                [['neq' =>'downloadable']])*/;
        }
        return $this;
    }
    public function addFilterByRequiredOptionsCustom(){
        $this->addAttributeToFilter('required_options', [['eq' => 1],['eq' => 0], ['null' => true]], 'left');
        return $this;
    }

}