<?php
namespace MageWorx\XmlSitemap\Controller\Adminhtml\Sitemap\Edit;

/**
 * Interceptor class for @see \MageWorx\XmlSitemap\Controller\Adminhtml\Sitemap\Edit
 */
class Interceptor extends \MageWorx\XmlSitemap\Controller\Adminhtml\Sitemap\Edit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \MageWorx\XmlSitemap\Model\Spi\SitemapResourceInterface $sitemapResource, \MageWorx\XmlSitemap\Model\SitemapFactory $sitemapFactory)
    {
        $this->___init();
        parent::__construct($context, $registry, $resultPageFactory, $sitemapResource, $sitemapFactory);
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
