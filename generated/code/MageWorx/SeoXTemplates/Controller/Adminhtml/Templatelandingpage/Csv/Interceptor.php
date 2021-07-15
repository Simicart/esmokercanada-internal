<?php
namespace MageWorx\SeoXTemplates\Controller\Adminhtml\Templatelandingpage\Csv;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatelandingpage\Csv
 */
class Interceptor extends \MageWorx\SeoXTemplates\Controller\Adminhtml\Templatelandingpage\Csv implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Registry $registry, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \MageWorx\SeoXTemplates\Model\Template\LandingPageFactory $templateLandingPageFactory, \MageWorx\SeoXTemplates\Model\CsvWriterLandingPageFactory $csvWriterLandingPageFactory, \MageWorx\SeoXTemplates\Helper\Data $helperData, \MageWorx\SeoXTemplates\Helper\Store $helperStore, \Magento\Framework\Controller\Result\RawFactory $resultRawFactory, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Magento\Backend\App\Action\Context $context, \MageWorx\SeoXTemplates\Controller\Adminhtml\Validator\Helper $templateValidator)
    {
        $this->___init();
        parent::__construct($registry, $resultPageFactory, $templateLandingPageFactory, $csvWriterLandingPageFactory, $helperData, $helperStore, $resultRawFactory, $fileFactory, $context, $templateValidator);
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
