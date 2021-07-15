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

class BundlePriceCorrect
{
    protected $objectManager;
  public function aroundGetValue($subject, \Closure $proceed){
            $this->objectManager=\Magento\Framework\App\ObjectManager::getInstance();
            $request = $this->objectManager->get('Magento\Framework\App\RequestInterface');
             /** @var  $layout \Magento\Framework\View\LayoutInterface */
             $layout = $this->objectManager->get('Magento\Framework\View\LayoutInterface');
             $handle = $layout->getUpdate()->getHandles();
            $helper = $this->objectManager->create('Itoris\GroupedProductConfiguration\Helper\ExtensionConfig');
           if($subject->getProduct()->getTypeId()=='bundle' && $helper->isEnabled() && in_array('catalog_product_view_type_grouped',$handle )){
               $product = $subject->getProduct();
               return $proceed() - $product->getPriceInfo()->getPrice('bundle_option')->getValue();

           }else{

               return $proceed();
           }


  }
}