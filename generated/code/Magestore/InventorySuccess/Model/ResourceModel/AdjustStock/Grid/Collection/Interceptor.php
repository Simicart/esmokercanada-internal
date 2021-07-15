<?php
namespace Magestore\InventorySuccess\Model\ResourceModel\AdjustStock\Grid\Collection;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Model\ResourceModel\AdjustStock\Grid\Collection
 */
class Interceptor extends \Magestore\InventorySuccess\Model\ResourceModel\AdjustStock\Grid\Collection implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory, \Psr\Log\LoggerInterface $logger, \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy, \Magento\Framework\Event\ManagerInterface $eventManager, $mainTable = 'os_adjuststock', $resourceModel = 'Magestore\\InventorySuccess\\Model\\ResourceModel\\AdjustStock')
    {
        $this->___init();
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
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
