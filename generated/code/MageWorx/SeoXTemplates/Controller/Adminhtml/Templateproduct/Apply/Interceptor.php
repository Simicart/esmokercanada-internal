<?php
namespace MageWorx\SeoXTemplates\Controller\Adminhtml\Templateproduct\Apply;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Controller\Adminhtml\Templateproduct\Apply
 */
class Interceptor extends \MageWorx\SeoXTemplates\Controller\Adminhtml\Templateproduct\Apply implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Registry $registry, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \MageWorx\SeoXTemplates\Model\Template\ProductFactory $templateProductFactory, \Magento\Framework\Stdlib\DateTime\DateTime $date, \MageWorx\SeoXTemplates\Model\DbWriterProductFactory $dbWriterProductFactory, \MageWorx\SeoXTemplates\Helper\Data $helperData, \MageWorx\SeoXTemplates\Helper\Store $helperStore, \Magento\Backend\App\Action\Context $context, \MageWorx\SeoXTemplates\Controller\Adminhtml\Validator\Helper $templateValidator)
    {
        $this->___init();
        parent::__construct($registry, $resultPageFactory, $templateProductFactory, $date, $dbWriterProductFactory, $helperData, $helperStore, $context, $templateValidator);
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
