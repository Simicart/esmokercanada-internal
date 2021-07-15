<?php
namespace Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\Invoice\Payment;

/**
 * Interceptor class for @see \Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\Invoice\Payment
 */
class Interceptor extends \Magestore\PurchaseOrderSuccess\Controller\Adminhtml\PurchaseOrder\Invoice\Payment implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magestore\PurchaseOrderSuccess\Controller\Adminhtml\Context $context, \Magestore\PurchaseOrderSuccess\Service\PurchaseOrder\Invoice\InvoiceService $invoiceService, \Magestore\PurchaseOrderSuccess\Service\PurchaseOrder\Invoice\Payment\PaymentService $paymentService, \Magestore\PurchaseOrderSuccess\Model\Repository\PurchaseOrder\InvoiceRepository $invoiceRepository, \Magestore\PurchaseOrderSuccess\Model\Repository\PurchaseOrder\Invoice\PaymentRepository $paymentRepository, \Magestore\PurchaseOrderSuccess\Model\PurchaseOrder\Invoice\PaymentFactory $paymentFactory)
    {
        $this->___init();
        parent::__construct($context, $invoiceService, $paymentService, $invoiceRepository, $paymentRepository, $paymentFactory);
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
