<?php
namespace MageWorx\SeoCrossLinks\Controller\Adminhtml\Crosslink\Save;

/**
 * Interceptor class for @see \MageWorx\SeoCrossLinks\Controller\Adminhtml\Crosslink\Save
 */
class Interceptor extends \MageWorx\SeoCrossLinks\Controller\Adminhtml\Crosslink\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Registry $registry, \MageWorx\SeoCrossLinks\Model\CrosslinkFactory $crosslinkFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($registry, $crosslinkFactory, $context);
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
