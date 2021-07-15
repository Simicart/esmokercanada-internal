<?php
namespace Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\Product\ReloadTotal;

/**
 * Interceptor class for @see \Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\Product\ReloadTotal
 */
class Interceptor extends \Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\Product\ReloadTotal implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\PurchaseOrderSuccess\Controller\Adminhtml\Context $context, \Magestore\PurchaseOrderSuccess\Api\PurchaseOrderRepositoryInterface $purchaseOrderRepository, \Magestore\PurchaseOrderSuccess\Service\PurchaseOrder\PurchaseOrderService $purchaseOrderService, \Magento\Framework\Controller\Result\RawFactory $resultRawFactory, \Magento\Framework\View\LayoutFactory $layoutFactory)
    {
        $this->___init();
        parent::__construct($context, $purchaseOrderRepository, $purchaseOrderService, $resultRawFactory, $layoutFactory);
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
