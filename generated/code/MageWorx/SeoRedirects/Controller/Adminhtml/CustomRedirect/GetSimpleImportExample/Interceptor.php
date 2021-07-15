<?php
namespace MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\GetSimpleImportExample;

/**
 * Interceptor class for @see \MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\GetSimpleImportExample
 */
class Interceptor extends \MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\GetSimpleImportExample implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Framework\Component\ComponentRegistrar $componentRegistrar)
    {
        $this->___init();
        parent::__construct($context, $fileFactory, $componentRegistrar);
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
