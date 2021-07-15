<?php
namespace MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\MassDisable;

/**
 * Interceptor class for @see \MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\MassDisable
 */
class Interceptor extends \MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\MassDisable implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Ui\Component\MassAction\Filter $filter, \MageWorx\SeoRedirects\Model\ResourceModel\Redirect\CustomRedirect\CollectionFactory $collectionFactory, \Magento\Framework\Registry $registry, \MageWorx\SeoRedirects\Model\Redirect\CustomRedirectRepository $customRedirectRepository, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($filter, $collectionFactory, $registry, $customRedirectRepository, $context);
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
