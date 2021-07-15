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


namespace Mirasvit\Rewards\Pricing\Render;

use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\Pricing\Render\AbstractAdjustment;
use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;
use Magento\Catalog\Helper\Data as CatalogData;
use Magento\Catalog\Pricing\Price\CustomOptionPrice;
use Magento\Weee\Helper\Data as WeeData;

use Mirasvit\Rewards\Model\Config;
use Mirasvit\Rewards\Helper\Balance\Spend;
use \Mirasvit\Rewards\Helper\Balance\Earn;
use Mirasvit\Rewards\Helper\Data;

/**
 * @method string getIdSuffix()
 * @method string getDisplayLabel()
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Adjustment extends AbstractAdjustment
{
    /**
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Config                 $config,
        Earn                   $earnHelper,
        Spend                  $spendHelper,
        Data                   $rewardsDataHelper,
        CatalogData            $catalogData,
        WeeData                $weeData,
        Session                $customerSession,
        PriceCurrencyInterface $priceCurrency,
        Template\Context       $context,
        array                  $data = []
    ) {
        $this->earnHelper        = $earnHelper;
        $this->spendHelper       = $spendHelper;
        $this->rewardsDataHelper = $rewardsDataHelper;
        $this->catalogData       = $catalogData;
        $this->weeData           = $weeData;
        $this->customerSession   = $customerSession;
        $this->config            = $config;

        parent::__construct($context, $priceCurrency, $data);
    }

    /**
     * {@inheritdoc}
     */
    protected function apply()
    {
        return $this->toHtml();
    }

    /**
     * {@inheritdoc}
     */
    public function getAdjustmentCode()
    {
        return \Mirasvit\Rewards\Pricing\Adjustment::ADJUSTMENT_CODE;
    }

    /**
     * Define if both prices should be displayed
     *
     * @return bool
     */
    public function isShowPoints()
    {
        if ($this->isProductPage()) {
            $isAllowToShow = $this->config->getDisplayOptionsIsShowPointsOnProductPage();
        } else {
            $isAllowToShow = $this->config->getDisplayOptionsIsShowPointsOnFrontend();
        }

        return $isAllowToShow && $this->getPointsFormatted() && !$this->isOptionPrice();
    }

    /**
     * @return bool
     */
    public function isOptionPrice()
    {
        return $this->getAmountRender()->getPrice()->getPriceCode() == CustomOptionPrice::PRICE_CODE;
    }

    /**
     * @return bool
     */
    public function isIncludeTax()
    {
        return (bool)$this->config->getGeneralIsIncludeTaxEarning();
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        if (
            $this->config->getGeneralIsDisplayMaxForConfigurableProduct() &&
            $this->getSaleableItem()->getTypeId() == Configurable::TYPE_CODE &&
            $this->isProductPage()
        ) {
            return $this->getMaxPointsForConfigurableProduct();
        }

        return $this->getCurrentPoints();
    }

    /**
     * @return int
     */
    public function getCurrentPoints()
    {
        return $this->earnHelper->getRoundingProductPoints(
            $this->getSaleableItem(),
            $this->customerSession->getCustomerGroupId(),
            $this->_storeManager->getStore()->getWebsiteId(),
            false,
            $this->getProductPrice()
        );
    }

    /**
     * @return int
     */
    private function getMaxPointsForConfigurableProduct()
    {
        $max  = [0];
        $item = $this->getSaleableItem();

        $products = $item->getTypeInstance()->getUsedProducts($item);

        foreach ($products as $product) {
            $max[] = $this->earnHelper->getRoundingProductPoints(
                $product,
                $this->customerSession->getCustomerGroupId(),
                $this->_storeManager->getStore()->getWebsiteId(),
                false,
                $this->getProductPrice($product)
            );
        }

        return max($max);
    }

    /**
     * @param \Magento\Framework\Pricing\SaleableInterface|null $item
     * @return float|null
     */
    protected function getProductPrice($item = null)
    {
        if (!$item) {
            /** @var \Magento\Catalog\Model\Product $item */
            $item = $this->getSaleableItem();
        }
        $price = null;
        if ($this->getData('price_type')) {
            $priceType = 'get' . ucfirst($this->getData('price_type'));
            if ($this->getData('price_type_code')) {
                $price = $item->getPriceInfo()->getPrice($this->getData('price_type_code'))->getValue();
            } else {
                $price = $item->$priceType();
            }

            if (in_array($priceType, ['getMinPrice', 'getMaxPrice']) && $this->isBundle()) {
                return $item->$priceType();
            }

            $price = $this->catalogData->getTaxPrice($item, $price, $this->isIncludeTax());
            if ($this->isIncludeTax()) {
                $price += $this->weeData->getAmountExclTax($item);
            }
        }

        return $price;
    }

    /**
     * @return bool
     */
    private function isBundle()
    {
        return $this->getSaleableItem()->getTypeId() == \Magento\Bundle\Model\Product\Type::TYPE_CODE;
    }

    /**
     * @return string|bool
     */
    public function getPointsFormatted()
    {
        $websiteId       = $this->_storeManager->getStore()->getWebsiteId();
        $customerGroupId = $this->customerSession->getCustomer()->getGroupId();

        $points = $this->getPoints();
        if (!$points) {
            return false;
        }

        $money = $this->spendHelper
            ->getProductPointsAsMoney($points, $websiteId, $customerGroupId, $this->getProductPrice());
        if ($points != $money) {
            return __('Possible discount '.$this->getLabel().' %1', $money);
        }

        $label = __('Earn '.$this->getLabel().' %1', $this->rewardsDataHelper->formatPoints($points));
        if ($this->isVariantPoints()) {
            $label = __('Earn up to '.$this->getLabel().' %1', $this->rewardsDataHelper->formatPoints($points));
        }

        return $label;
    }

    /**
     * @return bool
     */
    private function isVariantPoints()
    {
        return (
            $this->isBundle() ||
            (
                $this->config->getGeneralIsDisplayMaxForConfigurableProduct() &&
                $this->getSaleableItem()->getTypeId() == Configurable::TYPE_CODE
            )
        ) &&
        $this->isProductPage();
    }

    /**
     * Build identifier with prefix
     *
     * @param string $prefix
     * @return string
     */
    public function buildIdWithPrefix($prefix)
    {
        $priceId = $this->getPriceId();
        if (!$priceId) {
            $priceId = $this->getSaleableItem()->getId();
        }
        return $prefix . $priceId . $this->getIdSuffix();
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        $label = '';
        if (!$this->getAmountRender()) {
            return $label;
        }

        switch ($this->getAmountRender()->getTypeId()) {
            case \Magento\GroupedProduct\Model\Product\Type\Grouped::TYPE_CODE:
                $label = 'starting at';
                break;
            case \Magento\Catalog\Model\Product\Type::TYPE_BUNDLE:
                $label = 'Up to';
                break;
        }

        return $label;
    }

    /**
     * @return bool
     */
    private function isProductPage()
    {
        return !$this->getData('list_category_page') ||
            $this->getData('zone') == \Magento\Framework\Pricing\Render::ZONE_ITEM_VIEW;
    }
}
