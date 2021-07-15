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
namespace  Itoris\GroupedProductConfiguration\Plugin;
class Renderer {
    public function beforeGetProductUrl(\Magento\Checkout\Block\Cart\Item\Renderer $subject){
        $item = $subject->getItem();
        if($item && $item->getId()){
            $byreq = $item->getOptionByCode('info_buyRequest');
            $children = $item->getChildren();
            if(count($children)){
                $grpOption = false;
                foreach($children as $child){
                    $option = $child->getOptionByCode('product_type');
                    if($option && $option->getProductId()){
                        if($option->getProduct()->getTypeId()=='grouped'){
                            $grpOption = $option;
                            break;
                        }

                    }
                }
                if ($grpOption) {
                    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                    $product = $objectManager->create('Magento\Catalog\Model\Product')->load($grpOption->getProduct()->getId());
                    $subject->overrideProductUrl($grpOption->getProduct()->getProductUrl());
                }

            }
        }

    }
}