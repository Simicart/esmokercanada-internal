<?php
namespace Magestore\InventorySuccess\Ui\Component\Listing\Columns\SupplyNeeds\Columns\Image;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Ui\Component\Listing\Columns\SupplyNeeds\Columns\Image
 */
class Interceptor extends \Magestore\InventorySuccess\Ui\Component\Listing\Columns\SupplyNeeds\Columns\Image implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magestore\InventorySuccess\Helper\Data $helper, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($context, $uiComponentFactory, $storeManager, $helper, $components, $data);
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
