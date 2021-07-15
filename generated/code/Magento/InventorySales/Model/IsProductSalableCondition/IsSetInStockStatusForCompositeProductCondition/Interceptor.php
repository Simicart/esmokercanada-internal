<?php
namespace Magento\InventorySales\Model\IsProductSalableCondition\IsSetInStockStatusForCompositeProductCondition;

/**
 * Interceptor class for @see \Magento\InventorySales\Model\IsProductSalableCondition\IsSetInStockStatusForCompositeProductCondition
 */
class Interceptor extends \Magento\InventorySales\Model\IsProductSalableCondition\IsSetInStockStatusForCompositeProductCondition implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\InventoryConfigurationApi\Model\IsSourceItemManagementAllowedForSkuInterface $isSourceItemManagementAllowedForSku, \Magento\InventoryConfigurationApi\Api\GetStockItemConfigurationInterface $getStockItemConfiguration)
    {
        $this->___init();
        parent::__construct($isSourceItemManagementAllowedForSku, $getStockItemConfiguration);
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
