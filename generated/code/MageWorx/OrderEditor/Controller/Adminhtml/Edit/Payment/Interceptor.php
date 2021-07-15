<?php
namespace MageWorx\OrderEditor\Controller\Adminhtml\Edit\Payment;

/**
 * Interceptor class for @see \MageWorx\OrderEditor\Controller\Adminhtml\Edit\Payment
 */
class Interceptor extends \MageWorx\OrderEditor\Controller\Adminhtml\Edit\Payment implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Controller\Result\RawFactory $resultRawFactory, \MageWorx\OrderEditor\Helper\Data $helper, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \MageWorx\OrderEditor\Api\QuoteRepositoryInterface $quoteRepository, \MageWorx\OrderEditor\Model\Shipping $shipping, \MageWorx\OrderEditor\Model\Payment $payment, \MageWorx\OrderEditor\Api\OrderRepositoryInterface $orderRepository, \MageWorx\OrderEditor\Model\MsiStatusManager $msiStatusManager, \MageWorx\OrderEditor\Model\InventoryDetectionStatusManager $inventoryDetectionStatusManager, \Magento\Framework\Serialize\Serializer\Json $serializer, \Magento\Quote\Api\CartManagementInterface $cartManagement, \Magento\Framework\DataObjectFactory $dataObjectFactory, \Magento\Checkout\Model\Type\Onepage $onepageCheckout, \Magento\Framework\Json\Helper\Data $jsonHelper, \Psr\Log\LoggerInterface $logger)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $resultRawFactory, $helper, $scopeConfig, $quoteRepository, $shipping, $payment, $orderRepository, $msiStatusManager, $inventoryDetectionStatusManager, $serializer, $cartManagement, $dataObjectFactory, $onepageCheckout, $jsonHelper, $logger);
    }

    /**
     * {@inheritdoc}
     */
    public function execute() : \Magento\Framework\Controller\Result\Raw
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
