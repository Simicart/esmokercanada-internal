<?php
namespace Magestore\PurchaseOrderSuccess\Ui\Component\Listing\Columns\PurchaseOrder\Invoice\Code;

/**
 * Interceptor class for @see \Magestore\PurchaseOrderSuccess\Ui\Component\Listing\Columns\PurchaseOrder\Invoice\Code
 */
class Interceptor extends \Magestore\PurchaseOrderSuccess\Ui\Component\Listing\Columns\PurchaseOrder\Invoice\Code implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($context, $uiComponentFactory, $components, $data);
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
