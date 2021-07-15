<?php
namespace Magestore\PurchaseOrderSuccess\Model\ResourceModel\PurchaseOrder\Item\Transferred\Grid\Collection;

/**
 * Interceptor class for @see \Magestore\PurchaseOrderSuccess\Model\ResourceModel\PurchaseOrder\Item\Transferred\Grid\Collection
 */
class Interceptor extends \Magestore\PurchaseOrderSuccess\Model\ResourceModel\PurchaseOrder\Item\Transferred\Grid\Collection implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory, \Psr\Log\LoggerInterface $logger, \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Framework\App\RequestInterface $request, $mainTable = 'os_purchase_order_item_transferred', $resourceModel = 'Magestore\\PurchaseOrderSuccess\\Model\\ResourceModel\\PurchaseOrder\\Item\\Transferred')
    {
        $this->___init();
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $request, $mainTable, $resourceModel);
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
