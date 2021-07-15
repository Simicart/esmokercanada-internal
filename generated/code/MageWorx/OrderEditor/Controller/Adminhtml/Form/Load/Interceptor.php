<?php
namespace MageWorx\OrderEditor\Controller\Adminhtml\Form\Load;

/**
 * Interceptor class for @see \MageWorx\OrderEditor\Controller\Adminhtml\Form\Load
 */
class Interceptor extends \MageWorx\OrderEditor\Controller\Adminhtml\Form\Load implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $pageFactory, \Magento\Framework\Controller\Result\RawFactory $rawFactory, \MageWorx\OrderEditor\Helper\Data $helperData, \Magento\Framework\Registry $registry, \MageWorx\OrderEditor\Block\Adminhtml\Sales\Order\Edit\Form\Payment\Method $method, \MageWorx\OrderEditor\Api\OrderRepositoryInterface $orderRepository, \MageWorx\OrderEditor\Api\QuoteRepositoryInterface $quoteRepository, \MageWorx\OrderEditor\Model\Address $address, \MageWorx\OrderEditor\Model\InventoryDetectionStatusManager $inventoryDetectionStatusManager, \MageWorx\OrderEditor\Model\MsiStatusManager $msiStatusManager, \Magento\Framework\Serialize\Serializer\Json $serializer)
    {
        $this->___init();
        parent::__construct($context, $pageFactory, $rawFactory, $helperData, $registry, $method, $orderRepository, $quoteRepository, $address, $inventoryDetectionStatusManager, $msiStatusManager, $serializer);
    }

    /**
     * {@inheritdoc}
     */
    public function execute() : \Magento\Framework\Controller\ResultInterface
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
