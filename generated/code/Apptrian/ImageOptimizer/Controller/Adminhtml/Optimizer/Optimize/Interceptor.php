<?php
namespace Apptrian\ImageOptimizer\Controller\Adminhtml\Optimizer\Optimize;

/**
 * Interceptor class for @see \Apptrian\ImageOptimizer\Controller\Adminhtml\Optimizer\Optimize
 */
class Interceptor extends \Apptrian\ImageOptimizer\Controller\Adminhtml\Optimizer\Optimize implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Apptrian\ImageOptimizer\Helper\Data $dataHelper)
    {
        $this->___init();
        parent::__construct($context, $dataHelper);
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
