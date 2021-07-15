<?php
namespace Magento\InventorySales\Model\IsProductSalableCondition\ManageStockCondition;

/**
 * Interceptor class for @see \Magento\InventorySales\Model\IsProductSalableCondition\ManageStockCondition
 */
class Interceptor extends \Magento\InventorySales\Model\IsProductSalableCondition\ManageStockCondition implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\CatalogInventory\Api\StockConfigurationInterface $configuration, \Magento\InventoryConfigurationApi\Api\GetStockItemConfigurationInterface $getStockItemConfiguration)
    {
        $this->___init();
        parent::__construct($configuration, $getStockItemConfiguration);
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
