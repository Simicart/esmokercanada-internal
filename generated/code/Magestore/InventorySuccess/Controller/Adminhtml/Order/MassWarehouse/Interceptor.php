<?php
namespace Magestore\InventorySuccess\Controller\Adminhtml\Order\MassWarehouse;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\Adminhtml\Order\MassWarehouse
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\Adminhtml\Order\MassWarehouse implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\InventorySuccess\Controller\Adminhtml\Context $context, \Magestore\InventorySuccess\Api\OrderProcess\ChangeOrderWarehouseInterface $changeOrderWarehouse, \Magento\Ui\Component\MassAction\Filter $filter, \Magento\Sales\Model\ResourceModel\Order\Grid\CollectionFactory $orderGridCollection, \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollection)
    {
        $this->___init();
        parent::__construct($context, $changeOrderWarehouse, $filter, $orderGridCollection, $orderCollection);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}
