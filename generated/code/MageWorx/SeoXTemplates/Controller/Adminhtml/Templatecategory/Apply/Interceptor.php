<?php
namespace MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategory\Apply;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategory\Apply
 */
class Interceptor extends \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategory\Apply implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Registry $registry, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \MageWorx\SeoXTemplates\Model\Template\CategoryFactory $templateCategoryFactory, \Magento\Framework\Stdlib\DateTime\DateTime $date, \MageWorx\SeoXTemplates\Model\DbWriterCategoryFactory $dbWriterCategoryFactory, \MageWorx\SeoXTemplates\Helper\Store $helperStore, \MageWorx\SeoXTemplates\Helper\Data $helperData, \Magento\Backend\App\Action\Context $context, \MageWorx\SeoXTemplates\Controller\Adminhtml\Validator\Helper $templateValidator)
    {
        $this->___init();
        parent::__construct($registry, $resultPageFactory, $templateCategoryFactory, $date, $dbWriterCategoryFactory, $helperStore, $helperData, $context, $templateValidator);
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
