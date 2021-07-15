<?php
namespace Magestore\InventorySuccess\Controller\Adminhtml\Permission\Warehouse\Assign;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\Adminhtml\Permission\Warehouse\Assign
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\Adminhtml\Permission\Warehouse\Assign implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magestore\InventorySuccess\Model\WarehouseFactory $warehouseFactory, \Magento\Framework\View\LayoutFactory $layoutFactory, \Magestore\InventorySuccess\Api\Permission\PermissionManagementInterface $permissionManagementInterface)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $warehouseFactory, $layoutFactory, $permissionManagementInterface);
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
