<?php
namespace Magestore\PurchaseOrderSuccess\Model\ResourceModel\PurchaseOrder\Grid\Quotation;

/**
 * Interceptor class for @see \Magestore\PurchaseOrderSuccess\Model\ResourceModel\PurchaseOrder\Grid\Quotation
 */
class Interceptor extends \Magestore\PurchaseOrderSuccess\Model\ResourceModel\PurchaseOrder\Grid\Quotation implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory, \Psr\Log\LoggerInterface $logger, \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Framework\App\RequestInterface $request, $mainTable = 'os_purchase_order', $resourceModel = 'Magestore\\PurchaseOrderSuccess\\Model\\ResourceModel\\PurchaseOrder')
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
