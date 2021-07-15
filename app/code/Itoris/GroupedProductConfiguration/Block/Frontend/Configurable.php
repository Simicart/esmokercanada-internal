<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Itoris\GroupedProductConfiguration\Block\Frontend;

/**
 * Swatch renderer block in Category page
 *
 * @codeCoverageIgnore
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Configurable extends \Magento\Swatches\Block\Product\Renderer\Listing\Configurable
{
    /**
     * @return string
     */
    protected function getRendererTemplate()
    {
        return $this->_template;
    }

    /**
     * @return string
     */
    protected function getHtmlOutput()
    {
        $output = '';
        if ($this->isProductHasSwatchAttribute) {
            $output = parent::getHtmlOutput();
        }

        return $output;
    }

    /**
     * @return array
     */
    protected function getSwatchAttributesData()
    {

        return $this->swatchHelper->getSwatchAttributesAsArray($this->getProduct());


    }

    /**
     * Composes configuration for js
     *
     * @return string
     */
    public function getJsonConfig()
    {
        $this->unsetData('allow_products');
        return parent::getJsonConfig();
    }
}
