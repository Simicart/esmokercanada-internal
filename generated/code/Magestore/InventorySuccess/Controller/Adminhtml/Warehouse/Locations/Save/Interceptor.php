<?php
namespace Magestore\InventorySuccess\Controller\Adminhtml\Warehouse\Locations\Save;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Controller\Adminhtml\Warehouse\Locations\Save
 */
class Interceptor extends \Magestore\InventorySuccess\Controller\Adminhtml\Warehouse\Locations\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\InventorySuccess\Controller\Adminhtml\Context $context, \Magestore\InventorySuccess\Api\Permission\PermissionManagementInterface $permissionManagement, \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor, \Magestore\InventorySuccess\Api\Warehouse\Location\MappingManagementInterface $mappingManagement)
    {
        $this->___init();
        parent::__construct($context, $permissionManagement, $dataPersistor, $mappingManagement);
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
