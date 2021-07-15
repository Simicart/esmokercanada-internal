<?php
namespace Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\PrintBrowser;

/**
 * Interceptor class for @see \Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\PrintBrowser
 */
class Interceptor extends \Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\PrintBrowser implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\PurchaseOrderSuccess\Controller\Adminhtml\Context $context, \Magestore\PurchaseOrderSuccess\Api\PurchaseOrderRepositoryInterface $purchaseOrderRepository, \Magestore\SupplierSuccess\Api\SupplierRepositoryInterface $supplierRepository, \Magestore\PurchaseOrderSuccess\Service\PurchaseOrder\PurchaseOrderService $purchaseOrderService)
    {
        $this->___init();
        parent::__construct($context, $purchaseOrderRepository, $supplierRepository, $purchaseOrderService);
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
