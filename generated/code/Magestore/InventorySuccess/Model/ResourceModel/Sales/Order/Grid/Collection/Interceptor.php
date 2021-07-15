<?php
namespace Magestore\InventorySuccess\Model\ResourceModel\Sales\Order\Grid\Collection;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Model\ResourceModel\Sales\Order\Grid\Collection
 */
class Interceptor extends \Magestore\InventorySuccess\Model\ResourceModel\Sales\Order\Grid\Collection implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory, \Psr\Log\LoggerInterface $logger, \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Framework\App\RequestInterface $requestInterface, \Magento\Sales\Model\ResourceModel\Order\Collection $orderCollection, \Magento\Framework\Module\Manager $moduleManager, $mainTable = 'sales_order_grid', $resourceModel = '\\Magento\\Sales\\Model\\ResourceModel\\Order')
    {
        $this->___init();
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $requestInterface, $orderCollection, $moduleManager, $mainTable, $resourceModel);
    }

    /**
     * {@inheritdoc}
     */
    public function load($printQuery = false, $logQuery = false)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'load');
        return $pluginInfo ? $this->___callPlugins('load', func_get_args(), $pluginInfo) : parent::load($printQuery, $logQuery);
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