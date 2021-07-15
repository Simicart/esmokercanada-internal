<?php
namespace Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\Product\Import;

/**
 * Interceptor class for @see \Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\Product\Import
 */
class Interceptor extends \Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\Product\Import implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\PurchaseOrderSuccess\Controller\Adminhtml\Context $context, \Magestore\PurchaseOrderSuccess\Service\PurchaseOrder\Item\ItemService $itemService, \Magestore\PurchaseOrderSuccess\Service\PurchaseOrder\Item\ImportService $importService, \Magestore\SupplierSuccess\Service\Supplier\ProductService $supplierProductService, \Magestore\PurchaseOrderSuccess\Service\PurchaseOrder\PurchaseOrderService $purchaseService, \Magestore\PurchaseOrderSuccess\Api\PurchaseOrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->___init();
        parent::__construct($context, $itemService, $importService, $supplierProductService, $purchaseService, $orderRepositoryInterface);
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
