<?php
namespace MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\ExportCsv;

/**
 * Interceptor class for @see \MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\ExportCsv
 */
class Interceptor extends \MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\ExportCsv implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \MageWorx\SeoRedirects\Model\Redirect\CustomRedirect\Export\CsvDataProvider $csvDataProvider)
    {
        $this->___init();
        parent::__construct($context, $fileFactory, $csvDataProvider);
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
