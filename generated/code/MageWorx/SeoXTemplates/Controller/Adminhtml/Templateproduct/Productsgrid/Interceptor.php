<?php
namespace MageWorx\SeoXTemplates\Controller\Adminhtml\Templateproduct\Productsgrid;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Controller\Adminhtml\Templateproduct\Productsgrid
 */
class Interceptor extends \MageWorx\SeoXTemplates\Controller\Adminhtml\Templateproduct\Productsgrid implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Controller\Result\RawFactory $resultRawFactory, \Magento\Framework\View\LayoutFactory $layoutFactory, \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory, \Magento\Framework\Registry $registry, \MageWorx\SeoXTemplates\Model\Template\ProductFactory $templateProductFactory)
    {
        $this->___init();
        parent::__construct($context, $resultRawFactory, $layoutFactory, $resultLayoutFactory, $registry, $templateProductFactory);
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
