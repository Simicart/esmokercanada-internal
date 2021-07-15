<?php
namespace MageWorx\SeoReports\Controller\Adminhtml\Product\Generate;

/**
 * Interceptor class for @see \MageWorx\SeoReports\Controller\Adminhtml\Product\Generate
 */
class Interceptor extends \MageWorx\SeoReports\Controller\Adminhtml\Product\Generate implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoReports\Model\GeneratorFactory $generatorFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($generatorFactory, $context);
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
