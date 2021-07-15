<?php
namespace MageWorx\OrdersGrid\Controller\Adminhtml\Order\Grid\Complete;

/**
 * Interceptor class for @see \MageWorx\OrdersGrid\Controller\Adminhtml\Order\Grid\Complete
 */
class Interceptor extends \MageWorx\OrdersGrid\Controller\Adminhtml\Order\Grid\Complete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Ui\Component\MassAction\Filter $filter, \Magento\Sales\Api\InvoiceOrderInterface $invoiceOrder, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $collectionFactory, \Magento\Sales\Api\ShipOrderInterface $shipOrder)
    {
        $this->___init();
        parent::__construct($context, $filter, $invoiceOrder, $fileFactory, $collectionFactory, $shipOrder);
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
