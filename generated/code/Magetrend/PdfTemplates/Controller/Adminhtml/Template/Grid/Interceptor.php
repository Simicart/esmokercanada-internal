<?php
namespace Magetrend\PdfTemplates\Controller\Adminhtml\Template\Grid;

/**
 * Interceptor class for @see \Magetrend\PdfTemplates\Controller\Adminhtml\Template\Grid
 */
class Interceptor extends \Magetrend\PdfTemplates\Controller\Adminhtml\Template\Grid implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magetrend\PdfTemplates\Helper\Data $moduleHelper, \Magetrend\PdfTemplates\Model\TemplateManager $templateManager)
    {
        $this->___init();
        parent::__construct($context, $moduleHelper, $templateManager);
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
