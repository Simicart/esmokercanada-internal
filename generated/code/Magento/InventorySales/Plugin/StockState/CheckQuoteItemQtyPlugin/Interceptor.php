<?php
namespace Magento\InventorySales\Plugin\StockState\CheckQuoteItemQtyPlugin;

/**
 * Interceptor class for @see \Magento\InventorySales\Plugin\StockState\CheckQuoteItemQtyPlugin
 */
class Interceptor extends \Magento\InventorySales\Plugin\StockState\CheckQuoteItemQtyPlugin implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\DataObject\Factory $objectFactory, \Magento\Framework\Locale\FormatInterface $format, \Magento\InventorySalesApi\Api\AreProductsSalableForRequestedQtyInterface $areProductsSalableForRequestedQty, \Magento\InventorySalesApi\Api\Data\IsProductSalableForRequestedQtyRequestInterfaceFactory $isProductSalableForRequestedQtyRequestFactory, \Magento\InventoryCatalogApi\Model\GetSkusByProductIdsInterface $getSkusByProductIds, \Magento\InventorySalesApi\Api\StockResolverInterface $stockResolver, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\InventorySales\Model\IsProductSalableCondition\BackOrderNotifyCustomerCondition $backOrderNotifyCustomerCondition)
    {
        $this->___init();
        parent::__construct($objectFactory, $format, $areProductsSalableForRequestedQty, $isProductSalableForRequestedQtyRequestFactory, $getSkusByProductIds, $stockResolver, $storeManager, $backOrderNotifyCustomerCondition);
    }

    /**
     * {@inheritdoc}
     */
    public function aroundCheckQuoteItemQty(\Magento\CatalogInventory\Api\StockStateInterface $subject, \Closure $proceed, $productId, $itemQty, $qtyToCheck, $origQty, $scopeId = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'aroundCheckQuoteItemQty');
        return $pluginInfo ? $this->___callPlugins('aroundCheckQuoteItemQty', func_get_args(), $pluginInfo) : parent::aroundCheckQuoteItemQty($subject, $proceed, $productId, $itemQty, $qtyToCheck, $origQty, $scopeId);
    }
}
