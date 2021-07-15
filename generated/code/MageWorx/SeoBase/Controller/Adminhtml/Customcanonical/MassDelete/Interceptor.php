<?php
namespace MageWorx\SeoBase\Controller\Adminhtml\Customcanonical\MassDelete;

/**
 * Interceptor class for @see \MageWorx\SeoBase\Controller\Adminhtml\Customcanonical\MassDelete
 */
class Interceptor extends \MageWorx\SeoBase\Controller\Adminhtml\Customcanonical\MassDelete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Ui\Component\MassAction\Filter $filter, \Psr\Log\LoggerInterface $logger, \MageWorx\SeoBase\Model\ResourceModel\CustomCanonical\CollectionFactory $collectionFactory, \MageWorx\SeoBase\Api\CustomCanonicalRepositoryInterface $customCanonicalRepository)
    {
        $this->___init();
        parent::__construct($context, $filter, $logger, $collectionFactory, $customCanonicalRepository);
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
