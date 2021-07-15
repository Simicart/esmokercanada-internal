<?php
namespace MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategory\MassDelete;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategory\MassDelete
 */
class Interceptor extends \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategory\MassDelete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoXTemplates\Model\ResourceModel\Template\Category\CollectionFactory $collectionFactory, \Magento\Ui\Component\MassAction\Filter $filter, \Magento\Framework\Registry $registry, \MageWorx\SeoXTemplates\Model\Template\CategoryFactory $templateCategoryFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($collectionFactory, $filter, $registry, $templateCategoryFactory, $context);
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
