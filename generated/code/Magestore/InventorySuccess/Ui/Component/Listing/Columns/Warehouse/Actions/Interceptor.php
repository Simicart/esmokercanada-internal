<?php
namespace Magestore\InventorySuccess\Ui\Component\Listing\Columns\Warehouse\Actions;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Ui\Component\Listing\Columns\Warehouse\Actions
 */
class Interceptor extends \Magestore\InventorySuccess\Ui\Component\Listing\Columns\Warehouse\Actions implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, \Magento\Framework\UrlInterface $urlBuilder, \Magestore\InventorySuccess\Api\Permission\PermissionManagementInterface $permissionManagement, \Magestore\InventorySuccess\Model\WarehouseFactory $warehouseFactory, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($context, $uiComponentFactory, $urlBuilder, $permissionManagement, $warehouseFactory, $components, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function prepare()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'prepare');
        return $pluginInfo ? $this->___callPlugins('prepare', func_get_args(), $pluginInfo) : parent::prepare();
    }
}
