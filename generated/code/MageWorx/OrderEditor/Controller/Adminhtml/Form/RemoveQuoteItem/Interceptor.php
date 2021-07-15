<?php
namespace MageWorx\OrderEditor\Controller\Adminhtml\Form\RemoveQuoteItem;

/**
 * Interceptor class for @see \MageWorx\OrderEditor\Controller\Adminhtml\Form\RemoveQuoteItem
 */
class Interceptor extends \MageWorx\OrderEditor\Controller\Adminhtml\Form\RemoveQuoteItem implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\DataObjectFactory $dataObjectFactory, \MageWorx\OrderEditor\Api\QuoteItemRepositoryInterface $quoteItemRepository)
    {
        $this->___init();
        parent::__construct($context, $dataObjectFactory, $quoteItemRepository);
    }

    /**
     * {@inheritdoc}
     */
    public function execute() : \Magento\Framework\Controller\Result\Json
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
