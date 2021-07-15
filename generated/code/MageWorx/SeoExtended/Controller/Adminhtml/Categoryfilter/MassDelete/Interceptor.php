<?php
namespace MageWorx\SeoExtended\Controller\Adminhtml\Categoryfilter\MassDelete;

/**
 * Interceptor class for @see \MageWorx\SeoExtended\Controller\Adminhtml\Categoryfilter\MassDelete
 */
class Interceptor extends \MageWorx\SeoExtended\Controller\Adminhtml\Categoryfilter\MassDelete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoExtended\Api\CategoryFilterRepositoryInterface $categoryFilterRepository, \Magento\Ui\Component\MassAction\Filter $filter, \MageWorx\SeoExtended\Model\CategoryFilterFactory $categoryFilterFactory, \MageWorx\SeoExtended\Model\ResourceModel\CategoryFilter\CollectionFactory $categoryFilterCollectionFactory, \Magento\Framework\Registry $registry, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($categoryFilterRepository, $filter, $categoryFilterFactory, $categoryFilterCollectionFactory, $registry, $context);
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
