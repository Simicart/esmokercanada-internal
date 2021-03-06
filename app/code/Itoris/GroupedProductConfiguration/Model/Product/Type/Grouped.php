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
namespace Itoris\GroupedProductConfiguration\Model\Product\Type;
class Grouped extends \Magento\GroupedProduct\Model\Product\Type\Grouped {

    public function getAssociatedProducts($product)    {
        /*$this->getDataHelper()->isEnabled()*/
        $objectManager =$this->_objectManager= \Magento\Framework\App\ObjectManager::getInstance();
        $helper = $objectManager->create('Itoris\GroupedProductConfiguration\Helper\ExtensionConfig');
        if ($helper->isEnabled()){
            if (!$product->hasData($this->_keyAssociatedProducts)) {
                $associatedProducts = [];
                    $this->setSaleableStatus($product);
                $collection = $this->getAssociatedProductCollection($product)
                    ->addAttributeToSelect('*')
                    ->setPositionOrder()
                    ->addStoreFilter($this->getStoreFilter($product))
                    ->addAttributeToFilter('status', ['in' => $this->getStatusFilters($product)])
                    ->addUrlRewrite()
                    ->setGroupBy('e.entity_id');
                foreach ($collection as $item) {
                    $associatedProducts[] = $item;
                }
                $product->setData($this->_keyAssociatedProducts, $associatedProducts);
            }
            return $product->getData($this->_keyAssociatedProducts);
        } else {
            return parent::getAssociatedProducts($product);
        }

    }



    /**
     * @return Itoris_GroupedProductConfiguration_Helper_Data
     */
    public function getDataHelper() {
        $objectManager= \Magento\Framework\App\ObjectManager::getInstance();
        return $objectManager->create('Itoris\GroupedProductConfiguration\Helper\Data');

    }
}
