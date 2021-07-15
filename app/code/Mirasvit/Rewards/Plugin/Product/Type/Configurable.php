<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at https://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   mirasvit/module-rewards
 * @version   2.0.0
 * @copyright Copyright (C) 2017 Mirasvit (https://mirasvit.com/)
 */


namespace Mirasvit\Rewards\Plugin\Product\Type;

use Magento\ConfigurableProduct\Block\Product\View\Type\Configurable as ProductConfigurable;
use Magento\SalesRule\Model\Validator;
use Magento\Catalog\Model\ProductFactory;
use Mirasvit\Rewards\Helper\Balance\Earn;
use Mirasvit\Rewards\Model\Config;

/**
 * @package Mirasvit\Rewards\Plugin
 */
class Configurable
{
    public function __construct(
        \Magento\Framework\Json\DecoderInterface $jsonDecoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        Config $config,
        Earn $earnHelper,
        ProductFactory $productFactory
    ) {
        $this->jsonDecoder    = $jsonDecoder;
        $this->jsonEncoder    = $jsonEncoder;
        $this->config         = $config;
        $this->earnHelper     = $earnHelper;
        $this->productFactory = $productFactory;
    }

    /**
     * @param ProductConfigurable $configurable
     * @param \callable     $proceed
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function aroundGetJsonConfig(ProductConfigurable $configurable, $proceed)
    {
        $returnValue = $proceed();

        $data = $this->jsonDecoder->decode($returnValue);

        foreach ($data['optionPrices'] as $productId => $prices) {
            /** @var \Magento\Catalog\Model\Product $product */
            $product = $this->productFactory->create()->loadByAttribute('entity_id', $productId);
            if (!$product) {
                continue;
            }
            $data['optionPrices'][$productId]['rewardRules']['amount'] = $this->earnHelper
                ->getRoundingProductPoints($product);
            $data['prices']['rewardRules'] = [
                'amount' => $this->earnHelper->getRoundingProductPoints($product)
            ];
        }

        return $this->jsonEncoder->encode($data);
    }
}