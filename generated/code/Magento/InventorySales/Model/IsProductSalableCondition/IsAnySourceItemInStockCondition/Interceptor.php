<?php
namespace Magento\InventorySales\Model\IsProductSalableCondition\IsAnySourceItemInStockCondition;

/**
 * Interceptor class for @see \Magento\InventorySales\Model\IsProductSalableCondition\IsAnySourceItemInStockCondition
 */
class Interceptor extends \Magento\InventorySales\Model\IsProductSalableCondition\IsAnySourceItemInStockCondition implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\InventoryApi\Api\SourceItemRepositoryInterface $sourceItemRepository, \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder, \Magento\InventoryApi\Api\GetSourcesAssignedToStockOrderedByPriorityInterface $getSourcesAssignedToStockOrderedByPriority, \Magento\InventoryConfigurationApi\Model\IsSourceItemManagementAllowedForSkuInterface $isSourceItemManagementAllowedForSku, \Magento\InventorySales\Model\IsProductSalableCondition\ManageStockCondition $manageStockCondition, \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor, \Magento\Inventory\Model\ResourceModel\SourceItem\CollectionFactory $sourceItemCollectionFactory)
    {
        $this->___init();
        parent::__construct($sourceItemRepository, $searchCriteriaBuilder, $getSourcesAssignedToStockOrderedByPriority, $isSourceItemManagementAllowedForSku, $manageStockCondition, $collectionProcessor, $sourceItemCollectionFactory);
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
