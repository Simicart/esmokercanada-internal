<?php
namespace Magento\InventorySales\Model\IsProductSalableCondition\IsSalableWithReservationsCondition;

/**
 * Interceptor class for @see \Magento\InventorySales\Model\IsProductSalableCondition\IsSalableWithReservationsCondition
 */
class Interceptor extends \Magento\InventorySales\Model\IsProductSalableCondition\IsSalableWithReservationsCondition implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\InventorySalesApi\Model\GetStockItemDataInterface $getStockItemData, \Magento\InventoryReservationsApi\Model\GetReservationsQuantityInterface $getReservationsQuantity, \Magento\InventoryConfigurationApi\Api\GetStockItemConfigurationInterface $getStockItemConfiguration, \Magento\InventoryConfigurationApi\Model\IsSourceItemManagementAllowedForProductTypeInterface $isSourceItemManagementAllowedForProductType, \Magento\InventoryCatalogApi\Model\GetProductTypesBySkusInterface $getProductTypesBySkus)
    {
        $this->___init();
        parent::__construct($getStockItemData, $getReservationsQuantity, $getStockItemConfiguration, $isSourceItemManagementAllowedForProductType, $getProductTypesBySkus);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(string $sku, int $stockId) : bool
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute($sku, $stockId);
    }
}
