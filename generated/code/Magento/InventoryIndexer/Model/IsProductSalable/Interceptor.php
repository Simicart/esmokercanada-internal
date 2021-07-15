<?php
namespace Magento\InventoryIndexer\Model\IsProductSalable;

/**
 * Interceptor class for @see \Magento\InventoryIndexer\Model\IsProductSalable
 */
class Interceptor extends \Magento\InventoryIndexer\Model\IsProductSalable implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\InventorySalesApi\Model\GetStockItemDataInterface $getStockItemData, \Psr\Log\LoggerInterface $logger)
    {
        $this->___init();
        parent::__construct($getStockItemData, $logger);
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
