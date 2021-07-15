<?php
namespace MageWorx\OrderEditor\Controller\Adminhtml\Form\Options;

/**
 * Interceptor class for @see \MageWorx\OrderEditor\Controller\Adminhtml\Form\Options
 */
class Interceptor extends \MageWorx\OrderEditor\Controller\Adminhtml\Form\Options implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Catalog\Helper\Product $productHelper, \Magento\Framework\Escaper $escaper, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory, \MageWorx\OrderEditor\Model\Edit\Quote $quote, \MageWorx\OrderEditor\Helper\Data $helper, \Magento\Framework\DataObjectFactory $dataObjectFactory, \Magento\Backend\Model\Session $backendSession, \MageWorx\OrderEditor\Api\OrderRepositoryInterface $orderRepository, \MageWorx\OrderEditor\Model\InventoryDetectionStatusManager $inventoryDetectionStatusManager, \MageWorx\OrderEditor\Model\MsiStatusManager $msiStatusManager)
    {
        $this->___init();
        parent::__construct($context, $productHelper, $escaper, $resultPageFactory, $resultForwardFactory, $quote, $helper, $dataObjectFactory, $backendSession, $orderRepository, $inventoryDetectionStatusManager, $msiStatusManager);
    }

    /**
     * {@inheritdoc}
     */
    public function execute() : \Magento\Backend\Model\View\Result\Redirect
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
