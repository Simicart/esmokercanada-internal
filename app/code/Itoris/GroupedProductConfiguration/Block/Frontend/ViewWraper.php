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
namespace Itoris\GroupedProductConfiguration\Block\Frontend;


/**
 * Product View block
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ViewWraper extends \Magento\Catalog\Block\Product\View
{
    public function getProductOption()
    {
        return $this->_coreRegistry->registry('productBundleOption');
    }
    public function setProductOption($product)
    {
        $this->_coreRegistry->unregister('productBundleOption');

            $this->_coreRegistry->register('productBundleOption', $product);

    }
    public function hasRequiredOptions()
    {
        return $this->getProductOption()->getTypeInstance()->hasRequiredOptions($this->getProductOption());
    }
    public function getChildHtml($alias = '', $useCache = true)
    {
        $layout = $this->getLayout();
        if (!$layout) {
            return '';
        }
        $name = $this->getNameInLayout();
        /*if(!$productBundle && $productBundle->getType()=='Magento\Catalog\Block\Product\View'){

        }*/
        $out = '';
        if ($alias) {
            $childName = $layout->getChildName($name, $alias);
            if ($childName) {
                $out = $layout->renderElement($childName, $useCache);
            }
        } else {
            foreach ($layout->getChildNames($name) as $child) {
                $out .= $layout->renderElement($child, false);
            }
        }

        return $out;
    }
}
