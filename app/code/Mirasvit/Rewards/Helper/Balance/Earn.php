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



namespace Mirasvit\Rewards\Helper\Balance;

use Mirasvit\Rewards\Model\Config as Config;
use Magento\CatalogInventory\Api\StockRegistryInterface;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Earn extends \Magento\Framework\App\Helper\AbstractHelper
{
    const PRICE = 'price';
    const PRICE_WITH_TAX = 'tax_price';

    /**
     * @var array
     */
    private $productMessages = [];

    /**
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
     */
    public function __construct(
        StockRegistryInterface $stockRegistry,
        \Magento\Checkout\Model\CartFactory $cartFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Mirasvit\Rewards\Model\ResourceModel\Earning\Rule\CollectionFactory $earningRuleCollectionFactory,
        \Mirasvit\Rewards\Model\Config $config,
        \Magento\Catalog\Helper\Data $catalogData,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\Helper\Context $context
    ) {
        $this->stockRegistry                = $stockRegistry;
        $this->cartFactory                  = $cartFactory;
        $this->productFactory               = $productFactory;
        $this->earningRuleCollectionFactory = $earningRuleCollectionFactory;
        $this->config                       = $config;
        $this->catalogData                  = $catalogData;
        $this->storeManager                 = $storeManager;
        $this->customerFactory              = $customerFactory;
        $this->customerSession              = $customerSession;
        $this->context                      = $context;

        parent::__construct($context);
    }

    /**
     * @return \Mirasvit\Rewards\Model\Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param float $points
     * @return float
     */
    public function roundPoints($points)
    {
        if ($this->getConfig()->getAdvancedEarningRoundingStype()) {
            return floor($points);
        } else {
            return ceil($points);
        }
    }

    /**
     * @return bool
     */
    public function isIncludeTax()
    {
        return $this->getConfig()->getGeneralIsIncludeTaxEarning();
    }

    /**
     * @param \Magento\Quote\Model\Quote           $quote
     * @param \Mirasvit\Rewards\Model\Earning\Rule $rule
     *
     * @return float
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    protected function getLimitedSubtotal($quote, $rule)
    {
        $priceIncludesTax = $this->isIncludeTax($quote);

        $subtotal = 0;
        foreach ($quote->getItemsCollection() as $item) {
            /** @var \Magento\Quote\Model\Quote\Item $item */
            if ($item->getParentItemId()) {
                continue;
            }
            if ($rule->getActions()->validate($item)) {
                $subtotal += $this->getItemPrice($item, $priceIncludesTax);
            }
        }

        if ($this->getConfig()->getGeneralIsEarnShipping()) {
            if ($priceIncludesTax) {
                $shipping = $quote->getShippingAddress()->getBaseShippingInclTax();
            } else {
                $shipping = $quote->getShippingAddress()->getBaseShippingInclTax() -
                    $quote->getShippingAddress()->getBaseShippingTaxAmount();
            }

            $subtotal += $shipping;
        }

        if ($this->context->getModuleManager()->isEnabled('Mirasvit_Credit')) {
            if ($credit = $quote->getShippingAddress()->getBaseCreditAmount()) {
                $subtotal -= $credit;
            }
        }

        if ($subtotal < 0) {
            $subtotal = 0;
        }

        return $subtotal;
    }

    /**
     * @param \Magento\Quote\Model\Quote $quote
     *
     * @return int number of points
     */
    public function getPointsEarned($quote)
    {
        $totalPoints = 0;
        foreach ($quote->getAllItems() as $item) {
            $productId = $item->getProductId();
            $product = $this->productFactory->create()->load($productId);

            if ($item->getParentItemId() && $product->getTypeID() == 'simple') {
                continue;
            }

            $productPoints = $this->getProductPoints(
                    $product,
                    $quote->getCustomerGroupId(),
                    $quote->getStore()->getWebsiteId(),
                    $item
                );

            $totalPoints += $productPoints;
        }

        $totalPoints += $this->getCartPoints($quote);

        return $this->roundPoints($totalPoints);
    }

    /**
     * Function returns true for grouped or bundled products if after adding to the cart
     * customer may receive product points
     *
     * @param \Magento\Catalog\Model\Product       $product
     * @param int|bool                             $customerGroupId
     * @param int|bool                             $websiteId
     * @return bool|true
     */
    public function getIsProductPointsPossible($product, $customerGroupId = false, $websiteId = false)
    {
        $possibleNotstandardProducts = [
            \Magento\Catalog\Model\Product\Type::TYPE_BUNDLE,
            \Magento\GroupedProduct\Model\Product\Type\Grouped::TYPE_CODE,
        ];

        if (!in_array($product->getTypeId(), $possibleNotstandardProducts)) {
            return false;
        }

        if ($customerGroupId === false) {
            $customerGroupId = $this->customerFactory->create()
                ->load($this->customerSession->getCustomerId())
                ->getGroupId();
        }

        if ($websiteId === false) {
            $websiteId = $this->storeManager->getWebsite()->getId();
        }

        $rules = $this->earningRuleCollectionFactory->create()
            ->addWebsiteFilter($websiteId)
            ->addCustomerGroupFilter($customerGroupId)
            ->addCurrentFilter()
            ->addFieldToFilter('type', \Mirasvit\Rewards\Model\Earning\Rule::TYPE_PRODUCT)
            ->setOrder('sort_order')
        ;
        return $rules->count() > 0;
    }

    /**
     * Calculates the number of points for some product.
     *
     * @param \Magento\Catalog\Model\Product       $product
     * @param int|bool                             $customerGroupId
     * @param int|bool                             $websiteId
     * @param \Magento\Quote\Model\Quote\Item|bool $item
     * @param string|bool                          $price
     *
     * @return int number of points
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function getProductPoints(
        $product,
        $customerGroupId = false,
        $websiteId = false,
        $item = false,
        $price = false
    ) {
        $product = $this->productFactory->create()->load($product->getId());
        if ($customerGroupId === false) {
            $customerGroupId = $this->customerFactory->create()
                ->load($this->customerSession->getCustomerId())
                ->getGroupId();
        }

        if ($websiteId === false) {
            $websiteId = $this->storeManager->getWebsite()->getId();
        }

        $rules = $this->earningRuleCollectionFactory->create()
            ->addWebsiteFilter($websiteId)
            ->addCustomerGroupFilter($customerGroupId)
            ->addCurrentFilter()
            ->addFieldToFilter('type', \Mirasvit\Rewards\Model\Earning\Rule::TYPE_PRODUCT)
            ->setOrder('sort_order')
        ;
        $total = 0;
        foreach ($rules as $rule) {
            $rule->afterLoad();
            if ($rule->validate($product)) {
                switch ($rule->getEarningStyle()) {
                    case Config::EARNING_STYLE_GIVE:
                        $total += $rule->getEarnPoints();
                        break;

                    case Config::EARNING_STYLE_AMOUNT_PRICE:
                        $rulePrice = $price ?: $this->getProductPrice($product, $item);
                        $amount    = $rulePrice / $rule->getMonetaryStep() * $rule->getEarnPoints();
                        if ($rule->getPointsLimit() && $amount > $rule->getPointsLimit()) {
                            $amount = $rule->getPointsLimit();
                        }
                        $total += $amount;
                        break;
                }
                $this->productMessages[$product->getId()][$rule->getId()] = $rule->getProductNotification();

                if ($rule->getIsStopProcessing()) {
                    break;
                }
            }
        }

        return $total;
    }

    /**
     * Calculates the number of points for some product.
     *
     * @param \Magento\Catalog\Model\Product       $product
     * @param int|bool                             $customerGroupId
     * @param int|bool                             $websiteId
     * @param \Magento\Quote\Model\Quote\Item|bool $item
     * @param string|bool                          $price
     *
     * @return int number of points
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function getRoundingProductPoints(
        $product,
        $customerGroupId = false,
        $websiteId = false,
        $item = false,
        $price = false
    ) {
        return $this->roundPoints(
            $this->getProductPoints($product, $customerGroupId, $websiteId, $item, $price)
        );
    }

    /**
     * @param int $productId
     * @return array
     */
    public function getProductMessages($productId = 0)
    {
        if ($productId) {
            return isset($this->productMessages[$productId]) ? $this->productMessages[$productId] : [];
        }

        return $this->productMessages;
    }

    /**
     * @param \Magento\Catalog\Model\Product       $product
     * @param \Magento\Quote\Model\Quote\Item|bool $item
     *
     * @return string
     */
    public function getProductPrice($product, $item)
    {
        if ($item) {
            $price = $this->getItemPrice($item);
        } else {
            $store = $this->storeManager->getStore();
            $finalPrice = $product->getPriceInfo()->getPrice('final_price')->getMaximalPrice()->getValue();
            $store->setCalculateRewardsTax(1);
            $price = $this->catalogData
                ->getTaxPrice($product, $finalPrice, null, null, null, null, null, !$this->isIncludeTax());
            $store->setCalculateRewardsTax(0);
        }

        return $price < 0 ? 0 : $price;
    }

    /**
     * @param \Magento\Quote\Model\Quote $quote
     *
     * @return int number of points
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    protected function getCartPoints($quote)
    {
        $total = 0;
        $customerGroupId = $quote->getCustomerGroupId();
        $websiteId = $quote->getStore()->getWebsiteId();
        $rules = $this->earningRuleCollectionFactory->create()
                    ->addWebsiteFilter($websiteId)
                    ->addCustomerGroupFilter($customerGroupId)
                    ->addCurrentFilter()
                    ->addFieldToFilter('type', \Mirasvit\Rewards\Model\Earning\Rule::TYPE_CART)
                    ->setOrder('sort_order')
                    ;
        /** @var \Mirasvit\Rewards\Model\Earning\Rule $rule */
        foreach ($rules as $rule) {
            $rule->afterLoad();
            /** @var \Magento\Quote\Model\Quote\Address $address */
            if ($quote->isVirtual()) {
                $address = $quote->getBillingAddress();
            } else {
                $address = $quote->getShippingAddress();
            }
            foreach ($address->getAllItems() as $item) {// total_qty - allowed only in total collection process
                $address->setTotalQty($address->getTotalQty() + $item->getQty());
            }
            if ($rule->validate($address)) {
                switch ($rule->getEarningStyle()) {
                    case Config::EARNING_STYLE_GIVE:
                        $total += $rule->getEarnPoints();
                        break;

                    case Config::EARNING_STYLE_AMOUNT_SPENT:
                        $subtotal = $this->getLimitedSubtotal($quote, $rule);
                        $steps = $subtotal / $rule->getMonetaryStep();
                        $amount = $steps * $rule->getEarnPoints();
                        if ($rule->getPointsLimit() && $amount > $rule->getPointsLimit()) {
                            $amount = $rule->getPointsLimit();
                        }
                        $total += $amount;
                        break;
                    case Config::EARNING_STYLE_QTY_SPENT:
                        $amount = $quote->getItemsQty() * $rule->getEarnPoints();
                        if ($rule->getPointsLimit() && $amount > $rule->getPointsLimit()) {
                            $amount = $rule->getPointsLimit();
                        }
                        $total += $amount;
                        break;
                }
                if ($rule->getIsStopProcessing()) {
                    break;
                }
            }
        }

        return $total;
    }

    /**
     * @param int $productId
     * @return array
     */
    public function getProductRulesCoefficient($productId)
    {
        if (is_object($productId)) {
            $productId = $productId->getId();
        }
        $product = $this->productFactory->create()->load($productId);
        $customerGroupId = $this->customerFactory->create()
            ->load($this->customerSession->getCustomerId())
            ->getGroupId();

        $websiteId = $this->storeManager->getWebsite()->getId();

        $stockItem = $this->stockRegistry->getStockItem(
            $product->getId(),
            $product->getStore()->getWebsiteId()
        );
        $minAllowed = max((float)$stockItem->getQtyMinAllowed(), 1);

        $rules = $this->earningRuleCollectionFactory->create()
            ->addWebsiteFilter($websiteId)
            ->addCustomerGroupFilter($customerGroupId)
            ->addCurrentFilter()
            ->addFieldToFilter('type', \Mirasvit\Rewards\Model\Earning\Rule::TYPE_PRODUCT)
            ->setOrder('sort_order')
        ;
        $data = [];
        foreach ($rules as $rule) {
            $rule->afterLoad();
            if ($rule->validate($product)) {
                switch ($rule->getEarningStyle()) {
                    case Config::EARNING_STYLE_GIVE:
                        $data[$product->getId()][$rule->getId()] = [
                                'points'      => $rule->getEarnPoints(),
                                'coefficient' => 0,
                            ];
                        break;

                    case Config::EARNING_STYLE_AMOUNT_PRICE:
                        $data[$product->getId()][$rule->getId()] = [
                            'points'      => 0,
                            'coefficient' => $rule->getMonetaryStep() / $rule->getEarnPoints(),
                            'options'     => [
                                'limit'    => (int)$rule->getPointsLimit(),
                            ],
                        ];
                        break;
                }

                if ($rule->getIsStopProcessing()) {
                    break;
                }
            }
        }
        if ($data) {
            $data['minAllowed'] = $minAllowed;
            $data['rounding']   = $this->config->getAdvancedEarningRoundingStype();
        }

        return $data;
    }

    /**
     * @param \Magento\Quote\Model\Quote\Item $item
     * @param bool|null                       $priceIncludesTax
     * @return float
     */
    public function getItemPrice($item, $priceIncludesTax = null)
    {
        if ($priceIncludesTax === null) {
            $priceIncludesTax = $this->isIncludeTax();
        }
        $store = $this->storeManager->getStore();
        $price = $item->getBasePrice() * $item->getQty();
        if (!$this->getConfig()->getGeneralIsIncludeDiscountEarning()) {
            $price -= $item->getTotalDiscountAmount();
        }
        $store->setCalculateRewardsTax(1);
        $price = $this->catalogData
            ->getTaxPrice($item->getProduct(), $price, $priceIncludesTax, null, null, null, $store, false);
        $store->setCalculateRewardsTax(0);
        if ($priceIncludesTax) {
            $price += (float)$item->getWeeeTaxAppliedAmountInclTax() * $item->getQty();
        }

        return $price;
    }
}
