<?php
namespace MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\InlineEdit;

/**
 * Interceptor class for @see \MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\InlineEdit
 */
class Interceptor extends \MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\InlineEdit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Controller\Result\JsonFactory $jsonFactory, \Magento\Framework\Registry $registry, \MageWorx\SeoRedirects\Model\Redirect\CustomRedirectRepository $customRedirectRepository, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($jsonFactory, $registry, $customRedirectRepository, $context);
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
