<?php
namespace MageWorx\SeoBase\Controller\Adminhtml\Customcanonical\Save;

/**
 * Interceptor class for @see \MageWorx\SeoBase\Controller\Adminhtml\Customcanonical\Save
 */
class Interceptor extends \MageWorx\SeoBase\Controller\Adminhtml\Customcanonical\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry, \Psr\Log\LoggerInterface $logger, \Magento\Store\Model\StoreManagerInterface $storeManager, \MageWorx\SeoBase\Api\CustomCanonicalRepositoryInterface $customCanonicalRepository, \MageWorx\SeoBase\Helper\CustomCanonical $helperCustomCanonical)
    {
        $this->___init();
        parent::__construct($context, $coreRegistry, $logger, $storeManager, $customCanonicalRepository, $helperCustomCanonical);
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
