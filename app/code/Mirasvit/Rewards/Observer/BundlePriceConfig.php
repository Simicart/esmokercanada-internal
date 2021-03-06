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


namespace Mirasvit\Rewards\Observer;

use Magento\Framework\Registry;
use Magento\Framework\Event\ObserverInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Bundle\Model\Product\Type;
use Mirasvit\Rewards\Helper\Balance\Earn;
use Mirasvit\Rewards\Model\Config;

class BundlePriceConfig implements ObserverInterface
{
    /**
     * @var array
     */
    private $prodConfig = [];

    public function __construct(
        Registry $registry,
        Config $config,
        ProductFactory $productFactory,
        Earn $earnHelper
    ) {
        $this->registry       = $registry;
        $this->config         = $config;
        $this->productFactory = $productFactory;
        $this->earnHelper     = $earnHelper;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     *
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\Framework\DataObject $configObj */
        $configObj = $observer->getEvent()->getData('configObj');
        $this->prodConfig = $configObj->getConfig();

        if ($this->isBundle()) {
            $this->getBundleOptions();
        } else {
            $this->getCustomOptions();
        }

        $configObj->setConfig($this->prodConfig);
    }

    /**
     * @return bool
     */
    private function isBundle()
    {
        if ($this->registry->registry('current_product')) {
            /** @var \Magento\Catalog\Model\Product $product */
            $product = $this->registry->registry('current_product');

            return $product->getTypeId() == Type::TYPE_CODE;
        } else {
            return isset($this->prodConfig['options']);
        }
    }

    /**
     * @return void
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    private function getBundleOptions()
    {
        $config = $this->prodConfig;
        $config['rewardLabel'] = $this->config->getGeneralPointUnitName();
        $config['rounding']    = $this->config->getAdvancedEarningRoundingStype();
        if (isset($config['options'])) {
            foreach ($config['options'] as $selectionId => $option) {
                foreach ($option['selections'] as $optionId => $data) {
                    $productId = $data['optionId'];
                    $product   = $this->productFactory->create()->loadByAttribute('entity_id', $productId);
                    $rules     = $this->earnHelper->getProductRulesCoefficient($product);
                    $points    = $this->earnHelper->getRoundingProductPoints($product);
                    $config['options'][$selectionId]['selections'][$optionId]['rewardRules'] = $rules;
                    if ($points) {
                        $config['options'][$selectionId]['selections'][$optionId]['prices']['Rewards']['amount'] =
                            $points;
                    }
                }
            }
        }

        $this->prodConfig = $config;
    }

    /**
     * @return void
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    private function getCustomOptions()
    {
        if ($this->registry->registry('current_product')) {
            /** @var \Magento\Catalog\Model\Product $product */
            $product = $this->registry->registry('current_product');
        }
        $config = $this->prodConfig;
        foreach ($config as $optionId => $data) {
            $rules = $this->earnHelper->getProductRulesCoefficient($product);
            $config[$optionId]['prices']['rewardRules'] = $rules;
        }
        $config['rewardLabel'] = $this->config->getGeneralPointUnitName();
        $config['rounding']    = $this->config->getAdvancedEarningRoundingStype();
        $this->prodConfig = $config;
    }
}
