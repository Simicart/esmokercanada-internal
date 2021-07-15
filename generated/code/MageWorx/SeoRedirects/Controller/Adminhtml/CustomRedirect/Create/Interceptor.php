<?php
namespace MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\Create;

/**
 * Interceptor class for @see \MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\Create
 */
class Interceptor extends \MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirect\Create implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Registry $registry, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \MageWorx\SeoRedirects\Model\Redirect\CustomRedirectRepository $customRedirectRepository, \MageWorx\SeoRedirects\Model\Redirect\CustomRedirectFactory $customRedirectFactory, \MageWorx\SeoRedirects\Controller\Adminhtml\CustomRedirectHelper $customRedirectHelper, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($registry, $resultPageFactory, $customRedirectRepository, $customRedirectFactory, $customRedirectHelper, $context);
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
