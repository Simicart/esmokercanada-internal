<?php
namespace MageWorx\SeoXTemplates\Controller\Adminhtml\Templateproduct\Save;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Controller\Adminhtml\Templateproduct\Save
 */
class Interceptor extends \MageWorx\SeoXTemplates\Controller\Adminhtml\Templateproduct\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Stdlib\DateTime\DateTime $date, \Magento\Framework\Registry $registry, \MageWorx\SeoXTemplates\Model\Template\ProductFactory $templateProductFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($date, $registry, $templateProductFactory, $context);
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
