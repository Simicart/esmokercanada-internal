<?php
namespace MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategoryfilter\Csv;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategoryfilter\Csv
 */
class Interceptor extends \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatecategoryfilter\Csv implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Registry $registry, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \MageWorx\SeoXTemplates\Model\Template\CategoryFilterFactory $templateCategoryFilterFactory, \MageWorx\SeoXTemplates\Model\CsvWriterCategoryFilterFactory $csvWriterCategoryFilterFactory, \MageWorx\SeoXTemplates\Helper\Data $helperData, \MageWorx\SeoXTemplates\Helper\Store $helperStore, \Magento\Framework\Controller\Result\RawFactory $resultRawFactory, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \MageWorx\SeoXTemplates\Helper\CategoryFilterGenerator $categoryFilterGenerator, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($registry, $resultPageFactory, $templateCategoryFilterFactory, $csvWriterCategoryFilterFactory, $helperData, $helperStore, $resultRawFactory, $fileFactory, $categoryFilterGenerator, $context);
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
