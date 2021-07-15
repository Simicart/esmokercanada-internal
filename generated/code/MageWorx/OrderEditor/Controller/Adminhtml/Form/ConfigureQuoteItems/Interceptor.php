<?php
namespace MageWorx\OrderEditor\Controller\Adminhtml\Form\ConfigureQuoteItems;

/**
 * Interceptor class for @see \MageWorx\OrderEditor\Controller\Adminhtml\Form\ConfigureQuoteItems
 */
class Interceptor extends \MageWorx\OrderEditor\Controller\Adminhtml\Form\ConfigureQuoteItems implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Catalog\Helper\Product $productHelper, \Magento\Framework\Escaper $escaper, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory, \Magento\Catalog\Helper\Product\Composite $productCompositeHelper, \Magento\Sales\Api\OrderItemRepositoryInterface $orderItemRepository, \Magento\Quote\Api\CartItemRepositoryInterface $cartItemRepository, \Magento\Framework\DataObjectFactory $dataObjectFactory, \Magento\Quote\Model\ResourceModel\Quote\Item\Option\CollectionFactory $quoteItemOptionCollectionFactory, \MageWorx\OrderEditor\Api\QuoteRepositoryInterface $quoteRepository, \Magento\Quote\Model\Quote\Item\CartItemOptionsProcessor $cartItemOptionsProcessor, \MageWorx\OrderEditor\Api\OrderRepositoryInterface $orderRepository, \MageWorx\OrderEditor\Helper\Data $helper)
    {
        $this->___init();
        parent::__construct($context, $productHelper, $escaper, $resultPageFactory, $resultForwardFactory, $productCompositeHelper, $orderItemRepository, $cartItemRepository, $dataObjectFactory, $quoteItemOptionCollectionFactory, $quoteRepository, $cartItemOptionsProcessor, $orderRepository, $helper);
    }

    /**
     * {@inheritdoc}
     */
    public function execute() : \Magento\Framework\View\Result\Layout
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
