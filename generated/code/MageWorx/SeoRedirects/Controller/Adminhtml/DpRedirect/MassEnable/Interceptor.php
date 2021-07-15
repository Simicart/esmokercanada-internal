<?php
namespace MageWorx\SeoRedirects\Controller\Adminhtml\DpRedirect\MassEnable;

/**
 * Interceptor class for @see \MageWorx\SeoRedirects\Controller\Adminhtml\DpRedirect\MassEnable
 */
class Interceptor extends \MageWorx\SeoRedirects\Controller\Adminhtml\DpRedirect\MassEnable implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Ui\Component\MassAction\Filter $filter, \MageWorx\SeoRedirects\Model\ResourceModel\Redirect\DpRedirect\CollectionFactory $collectionFactory, \Magento\Framework\Registry $registry, \MageWorx\SeoRedirects\Model\Redirect\DpRedirectFactory $DpRedirectFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($filter, $collectionFactory, $registry, $DpRedirectFactory, $context);
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
