<?php
namespace Magestore\InventorySuccess\Ui\Component\Listing\Columns\StockMovement\Reference;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Ui\Component\Listing\Columns\StockMovement\Reference
 */
class Interceptor extends \Magestore\InventorySuccess\Ui\Component\Listing\Columns\StockMovement\Reference implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, \Magento\Framework\UrlInterface $urlBuilder, \Magestore\InventorySuccess\Model\StockActivity\StockMovementProvider $stockMovementProvider, \Magento\Framework\ObjectManagerInterface $objectManagerInterface, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($context, $uiComponentFactory, $urlBuilder, $stockMovementProvider, $objectManagerInterface, $components, $data);
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
