<?php
namespace MageWorx\SeoXTemplates\Controller\Adminhtml\Templatelandingpage\LandingpagesGrid;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatelandingpage\LandingpagesGrid
 */
class Interceptor extends \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatelandingpage\LandingpagesGrid implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory, \Magento\Framework\Registry $registry, \MageWorx\SeoXTemplates\Model\Template\LandingPageFactory $templateLandingPageFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($resultLayoutFactory, $registry, $templateLandingPageFactory, $context);
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
