<?php
namespace MageWorx\OrderEditor\Controller\Adminhtml\Form\Add;

/**
 * Interceptor class for @see \MageWorx\OrderEditor\Controller\Adminhtml\Form\Add
 */
class Interceptor extends \MageWorx\OrderEditor\Controller\Adminhtml\Form\Add implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Controller\Result\RawFactory $resultFactory, \MageWorx\OrderEditor\Model\Edit\Quote $processor, \MageWorx\OrderEditor\Api\OrderRepositoryInterface $orderRepository, \MageWorx\OrderEditor\Model\InventoryDetectionStatusManager $inventoryDetectionStatusManager)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $resultFactory, $processor, $orderRepository, $inventoryDetectionStatusManager);
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
