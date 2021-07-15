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

namespace Itoris\GroupedProductConfiguration\Plugin;
class ItemQuuoteUpdate
{
 protected $_option=false;
 protected $_addProductUrl=false;
 protected $_itemLast=false;
 protected $_helperProd;
 protected $_buyRequest;
 protected $_params;
 protected $_childOption=false;
 public function beforeUpdateItem($subject,$itemId, $buyRequest, $params = null){
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();    
    $this->_helperProd = $objectManager->create('Magento\Catalog\Helper\Product');
    $itemQuote = $subject->getItemById($itemId);
    $option = $itemQuote->getOptionByCode('product_type');
    if($option){
        $this->_option=$option;
    }
             if($itemQuote->getChildren() && !$option){
                 $childItems = $itemQuote->getChildren();
                 foreach($childItems as $chl) {
                     $optionCh = $chl->getOptionByCode('product_type');
                     if ($optionCh && $optionCh->getProduct()->getTyPeId() == 'grouped') {
                         $this->_childOption = $optionCh;
                         break;
                     }
                 }
             }
    return $subject;
 }
    public function afterUpdateItem($subject){
        $itemLast=$subject->getItemsCollection()->getLastItem();
        if (!$itemLast) return $subject;
        if($this->_option && $this->_option->getProduct()->getTypeId()=='grouped'){
            $itemLast->addOption([
                 'code' => 'product_type',
                 'value' => 'grouped',
                 'product_id' => intval($this->_option->getProductId())
                ]
            );
        }
        if($this->_childOption) {
                $product = $itemLast->getProduct();
                $itemLast->addOption([
                    'code' => 'product_type',
                    'value' => 'grouped',
                    'product_id' => intval($this->_childOption->getProductId())
                ]
            );

        }

        return $itemLast;

    }
}