<?php
namespace MageWorx\OrdersGrid\Controller\Adminhtml\Order\Grid\MassShipInvoiceCapture;

/**
 * Interceptor class for @see \MageWorx\OrdersGrid\Controller\Adminhtml\Order\Grid\MassShipInvoiceCapture
 */
class Interceptor extends \MageWorx\OrdersGrid\Controller\Adminhtml\Order\Grid\MassShipInvoiceCapture implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Ui\Component\MassAction\Filter $filter, \Magento\Sales\Api\InvoiceOrderInterface $invoiceOrder, \Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory $invoiceCollectionFactory, \Magento\Sales\Model\ResourceModel\Order\Shipment\CollectionFactory $shipmentCollectionFactory, \Magento\Framework\Stdlib\DateTime\DateTime $dateTime, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Sales\Model\Order\Pdf\Invoice $pdfInvoice, \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory, \Magento\Sales\Api\ShipOrderInterface $shipOrder, \Magento\Framework\DB\TransactionFactory $transactionFactory, \Magento\Sales\Api\InvoiceManagementInterfaceFactory $invoiceManagementFactory, \Magento\Sales\Model\Order\Invoice\NotifierInterface $notifier, \Magento\Sales\Api\Data\InvoiceCommentCreationInterfaceFactory $invoiceCommentFactory, \Magento\Sales\Api\Data\ShipmentCommentCreationInterfaceFactory $shipmentCommentFactory, \Magento\Sales\Model\Order\Email\Sender\InvoiceCommentSender $invoiceCommentSender, \MageWorx\OrdersGrid\Helper\Data $helper)
    {
        $this->___init();
        parent::__construct($context, $filter, $invoiceOrder, $invoiceCollectionFactory, $shipmentCollectionFactory, $dateTime, $fileFactory, $pdfInvoice, $orderCollectionFactory, $shipOrder, $transactionFactory, $invoiceManagementFactory, $notifier, $invoiceCommentFactory, $shipmentCommentFactory, $invoiceCommentSender, $helper);
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
