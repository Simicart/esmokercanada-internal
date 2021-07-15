<?php
namespace MageWorx\OrdersGrid\Controller\Adminhtml\Order\Grid\Synchronize;

/**
 * Interceptor class for @see \MageWorx\OrdersGrid\Controller\Adminhtml\Order\Grid\Synchronize
 */
class Interceptor extends \MageWorx\OrdersGrid\Controller\Adminhtml\Order\Grid\Synchronize implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \MageWorx\OrdersGrid\Model\ResourceModel\Order\Grid\CollectionFactory $collectionFactory, \Magento\Ui\Component\MassAction\Filter $filter, \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory)
    {
        $this->___init();
        parent::__construct($context, $collectionFactory, $filter, $orderCollectionFactory);
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
