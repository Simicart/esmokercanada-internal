<?php
namespace MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategoryfilter\Apply;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategoryfilter\Apply
 */
class Interceptor extends \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategoryfilter\Apply implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Registry $registry, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \MageWorx\SeoXTemplates\Model\Template\CategoryFilterFactory $templateCategoryFilterFactory, \Magento\Framework\Stdlib\DateTime\DateTime $date, \MageWorx\SeoXTemplates\Model\DbWriterCategoryFilterFactory $dbWriterCategoryFilterFactory, \MageWorx\SeoXTemplates\Helper\Store $helperStore, \MageWorx\SeoXTemplates\Helper\Data $helperData, \MageWorx\SeoXTemplates\Helper\CategoryFilterGenerator $categoryFilterGenerator, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($registry, $resultPageFactory, $templateCategoryFilterFactory, $date, $dbWriterCategoryFilterFactory, $helperStore, $helperData, $categoryFilterGenerator, $context);
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
