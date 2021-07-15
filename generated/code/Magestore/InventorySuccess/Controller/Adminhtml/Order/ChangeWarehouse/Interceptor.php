<?php
namespace Magestore\InventorySuccess\Controller\Adminhtml\Order\ChangeWarehouse;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\Adminhtml\Order\ChangeWarehouse
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\Adminhtml\Order\ChangeWarehouse implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\InventorySuccess\Controller\Adminhtml\Context $context, \Magento\Sales\Api\OrderRepositoryInterface $orderRepository, \Magestore\InventorySuccess\Api\OrderProcess\ChangeOrderWarehouseInterface $changeOrderWarehouse)
    {
        $this->___init();
        parent::__construct($context, $orderRepository, $changeOrderWarehouse);
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