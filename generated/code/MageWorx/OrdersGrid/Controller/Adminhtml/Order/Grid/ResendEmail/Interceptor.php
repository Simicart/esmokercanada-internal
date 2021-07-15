<?php
namespace MageWorx\OrdersGrid\Controller\Adminhtml\Order\Grid\ResendEmail;

/**
 * Interceptor class for @see \MageWorx\OrdersGrid\Controller\Adminhtml\Order\Grid\ResendEmail
 */
class Interceptor extends \MageWorx\OrdersGrid\Controller\Adminhtml\Order\Grid\ResendEmail implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Ui\Component\MassAction\Filter $filter, \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $collectionFactory, \Magento\Sales\Api\OrderManagementInterface $orderManagement, \Magento\Sales\Api\ShipmentManagementInterface $shipmentManagement, \Magento\Sales\Api\InvoiceManagementInterface $invoiceManagement, \Magento\Sales\Api\InvoiceRepositoryInterface $invoiceRepository, \Magento\Sales\Api\ShipmentRepositoryInterface $shipmentRepository, \Magento\Framework\Api\SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory)
    {
        $this->___init();
        parent::__construct($context, $filter, $collectionFactory, $orderManagement, $shipmentManagement, $invoiceManagement, $invoiceRepository, $shipmentRepository, $searchCriteriaBuilderFactory);
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
