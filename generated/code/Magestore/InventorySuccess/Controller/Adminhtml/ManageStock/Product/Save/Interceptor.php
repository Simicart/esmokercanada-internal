<?php
namespace Magestore\InventorySuccess\Controller\Adminhtml\ManageStock\Product\Save;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\Adminhtml\ManageStock\Product\Save
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\Adminhtml\ManageStock\Product\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\InventorySuccess\Controller\Adminhtml\Context $context, \Magestore\InventorySuccess\Api\Permission\PermissionManagementInterface $permissionManagement, \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor, \Magento\Framework\Controller\Result\RawFactory $resultRawFactory, \Magento\Framework\View\LayoutFactory $layoutFactory)
    {
        $this->___init();
        parent::__construct($context, $permissionManagement, $dataPersistor, $resultRawFactory, $layoutFactory);
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
