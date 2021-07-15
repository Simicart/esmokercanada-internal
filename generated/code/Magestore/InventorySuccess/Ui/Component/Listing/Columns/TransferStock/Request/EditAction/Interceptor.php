<?php
namespace Magestore\InventorySuccess\Ui\Component\Listing\Columns\TransferStock\Request\EditAction;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Ui\Component\Listing\Columns\TransferStock\Request\EditAction
 */
class Interceptor extends \Magestore\InventorySuccess\Ui\Component\Listing\Columns\TransferStock\Request\EditAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, \Magento\Framework\UrlInterface $urlBuilder, \Magestore\InventorySuccess\Model\TransferStockFactory $transferStockFactory, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($context, $uiComponentFactory, $urlBuilder, $transferStockFactory, $components, $data);
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
