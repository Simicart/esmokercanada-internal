<?php
namespace Magestore\InventorySuccess\Model\ResourceModel\StockMovement\StockTransfer\Grid\Collection;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Model\ResourceModel\StockMovement\StockTransfer\Grid\Collection
 */
class Interceptor extends \Magestore\InventorySuccess\Model\ResourceModel\StockMovement\StockTransfer\Grid\Collection implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory, \Psr\Log\LoggerInterface $logger, \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Framework\App\RequestInterface $requestInterface, $mainTable = 'os_stock_transfer', $resourceModel = 'Magestore\\InventorySuccess\\Model\\ResourceModel\\StockMovement\\StockTransfer')
    {
        $this->___init();
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $requestInterface, $mainTable, $resourceModel);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurPage($displacement = 0)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCurPage');
        return $pluginInfo ? $this->___callPlugins('getCurPage', func_get_args(), $pluginInfo) : parent::getCurPage($displacement);
    }
}