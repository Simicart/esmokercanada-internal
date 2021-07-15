<?php
namespace Magestore\InventorySuccess\Ui\Component\Listing\Columns\TransferStock\Activity\ExportAction;

/**
 * Interceptor class for @see \Magestore\InventorySuccess\Ui\Component\Listing\Columns\TransferStock\Activity\ExportAction
 */
class Interceptor extends \Magestore\InventorySuccess\Ui\Component\Listing\Columns\TransferStock\Activity\ExportAction implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, \Magento\Framework\UrlInterface $urlBuilder, \Magestore\InventorySuccess\Model\TransferStock\TransferActivityFactory $transferActivityFactory, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($context, $uiComponentFactory, $urlBuilder, $transferActivityFactory, $components, $data);
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
