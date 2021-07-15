<?php
namespace MageWorx\SeoCategoryGrid\Controller\Adminhtml\Categorygrid\Index;

/**
 * Interceptor class for @see \MageWorx\SeoCategoryGrid\Controller\Adminhtml\Categorygrid\Index
 */
class Interceptor extends \MageWorx\SeoCategoryGrid\Controller\Adminhtml\Categorygrid\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Result\PageFactory $pageFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($pageFactory, $context);
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
