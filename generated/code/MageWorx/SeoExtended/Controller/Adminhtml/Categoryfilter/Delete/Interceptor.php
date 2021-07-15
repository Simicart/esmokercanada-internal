<?php
namespace MageWorx\SeoExtended\Controller\Adminhtml\Categoryfilter\Delete;

/**
 * Interceptor class for @see \MageWorx\SeoExtended\Controller\Adminhtml\Categoryfilter\Delete
 */
class Interceptor extends \MageWorx\SeoExtended\Controller\Adminhtml\Categoryfilter\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoExtended\Api\CategoryFilterRepositoryInterface $categoryFilterRepository, \Magento\Framework\View\Result\PageFactory $pageFactory, \MageWorx\SeoExtended\Controller\Adminhtml\CategoryFilterHelper $categoryFilterHelper, \Magento\Framework\Registry $registry, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($categoryFilterRepository, $pageFactory, $categoryFilterHelper, $registry, $context);
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
