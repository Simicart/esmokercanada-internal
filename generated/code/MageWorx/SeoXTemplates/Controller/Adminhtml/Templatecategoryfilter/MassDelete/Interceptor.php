<?php
namespace MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategoryfilter\MassDelete;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategoryfilter\MassDelete
 */
class Interceptor extends \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategoryfilter\MassDelete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoXTemplates\Model\ResourceModel\Template\CategoryFilter\CollectionFactory $collectionFactory, \Magento\Ui\Component\MassAction\Filter $filter, \Magento\Framework\Registry $registry, \MageWorx\SeoXTemplates\Model\Template\CategoryFilterFactory $templateCategoryFilterFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($collectionFactory, $filter, $registry, $templateCategoryFilterFactory, $context);
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
