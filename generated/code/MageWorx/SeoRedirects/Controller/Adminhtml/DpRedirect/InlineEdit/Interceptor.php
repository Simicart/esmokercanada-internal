<?php
namespace MageWorx\SeoRedirects\Controller\Adminhtml\DpRedirect\InlineEdit;

/**
 * Interceptor class for @see \MageWorx\SeoRedirects\Controller\Adminhtml\DpRedirect\InlineEdit
 */
class Interceptor extends \MageWorx\SeoRedirects\Controller\Adminhtml\DpRedirect\InlineEdit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Controller\Result\JsonFactory $jsonFactory, \Magento\Framework\Registry $registry, \MageWorx\SeoRedirects\Model\Redirect\DpRedirectFactory $dpRedirectFactory, \Magento\Backend\App\Action\Context $context, \MageWorx\SeoRedirects\Controller\Adminhtml\CategoryStoreValidator $categoryStoreValidator)
    {
        $this->___init();
        parent::__construct($jsonFactory, $registry, $dpRedirectFactory, $context, $categoryStoreValidator);
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