<?php
namespace MageWorx\XmlSitemap\Controller\Adminhtml\Sitemap\MassGenerate;

/**
 * Interceptor class for @see \MageWorx\XmlSitemap\Controller\Adminhtml\Sitemap\MassGenerate
 */
class Interceptor extends \MageWorx\XmlSitemap\Controller\Adminhtml\Sitemap\MassGenerate implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $registry, \MageWorx\XmlSitemap\Model\SitemapFactory $sitemapFactory, \MageWorx\XmlSitemap\Model\Spi\SitemapResourceInterface $sitemapResource, \MageWorx\XmlSitemap\Model\ResourceModel\Sitemap\CollectionFactory $collectionFactory, \Magento\Ui\Component\MassAction\Filter $filter)
    {
        $this->___init();
        parent::__construct($context, $registry, $sitemapFactory, $sitemapResource, $collectionFactory, $filter);
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
