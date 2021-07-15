<?php
namespace MageWorx\SeoXTemplates\Controller\Adminhtml\Templatebrand\MassDelete;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatebrand\MassDelete
 */
class Interceptor extends \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatebrand\MassDelete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\SeoXTemplates\Model\ResourceModel\Template\Brand\CollectionFactory $collectionFactory, \Magento\Ui\Component\MassAction\Filter $filter, \Magento\Framework\Registry $registry, \MageWorx\SeoXTemplates\Model\Template\BrandFactory $templateBrandFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($collectionFactory, $filter, $registry, $templateBrandFactory, $context);
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
