<?php
namespace Magestore\InventorySuccess\Ui\Component\Listing\Columns\Warehouse\Store;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Ui\Component\Listing\Columns\Warehouse\Store
 */
class Interceptor extends \Magestore\InventorySuccess\Ui\Component\Listing\Columns\Warehouse\Store implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, \Magento\Store\Model\System\Store $systemStore, \Magento\Framework\Escaper $escaper, \Magestore\InventorySuccess\Helper\Data $inventoryHelper, array $components = [], array $data = [], $storeKey = 'store_id')
    {
        $this->___init();
        parent::__construct($context, $uiComponentFactory, $systemStore, $escaper, $inventoryHelper, $components, $data, $storeKey);
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
