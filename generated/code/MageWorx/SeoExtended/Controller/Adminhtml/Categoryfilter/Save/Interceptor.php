<?php
namespace MageWorx\SeoExtended\Controller\Adminhtml\Categoryfilter\Save;

/**
 * Interceptor class for @see \MageWorx\SeoExtended\Controller\Adminhtml\Categoryfilter\Save
 */
class Interceptor extends \MageWorx\SeoExtended\Controller\Adminhtml\Categoryfilter\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoExtended\Controller\Adminhtml\CategoryFilterHelper $categoryFilterHelper, \Magento\Framework\Registry $registry, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($categoryFilterHelper, $registry, $resultPageFactory, $context);
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
