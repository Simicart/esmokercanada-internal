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

class Option extends \Magento\Bundle\Block\Catalog\Product\View\Type\Bundle\Option
{

    public function getProductBundle()
    {
        $id_product= $this->_coreRegistry->registry('itoris_id_product_custom');
        $product = $this->_coreRegistry->registry('productBundle-custom_'.$id_product);
        return $product;
    }

    public function renderPriceString($selection, $includeContainer = true)
    {

        /** @var \Magento\Bundle\Pricing\Price\BundleOptionPrice $price */
            $price = $this->getProductBundle()->getPriceInfo()->getPrice('bundle_option');
            $amount = $price->getOptionSelectionAmount($selection);
        if($this->getLayout()->getBlock('product.price.render.default')) {

            $priceHtml = $this->getLayout()->getBlock('product.price.render.default')->renderAmount(
                $amount,
                $price,
                $selection,
                [
                    'include_container' => $includeContainer
                ]
            );
        }else{
            $priceHtml = $this->getLayout()->createBlock('Magento\Framework\Pricing\Render','product.price.render.default')->renderAmount(
                $amount,
                $price,
                $selection,
                [
                    'include_container' => $includeContainer
                ]
            );
        }

        return $priceHtml;
    }
}
