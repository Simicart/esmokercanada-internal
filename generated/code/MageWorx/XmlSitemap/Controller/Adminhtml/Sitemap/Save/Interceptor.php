<?php
namespace MageWorx\XmlSitemap\Controller\Adminhtml\Sitemap\Save;

/**
 * Interceptor class for @see \MageWorx\XmlSitemap\Controller\Adminhtml\Sitemap\Save
 */
class Interceptor extends \MageWorx\XmlSitemap\Controller\Adminhtml\Sitemap\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Stdlib\DateTime\DateTime $date, \Magento\Backend\Helper\Js $jsHelper, \Magento\Framework\Registry $registry, \MageWorx\XmlSitemap\Model\SitemapFactory $sitemapFactory, \MageWorx\XmlSitemap\Model\Spi\SitemapResourceInterface $sitemapResource, \Magento\Framework\Validator\StringLength $stringValidator, \Magento\MediaStorage\Model\File\Validator\AvailablePath $pathValidator, \MageWorx\XmlSitemap\Helper\MagentoSitemap $helperMagentoSitemap)
    {
        $this->___init();
        parent::__construct($context, $date, $jsHelper, $registry, $sitemapFactory, $sitemapResource, $stringValidator, $pathValidator, $helperMagentoSitemap);
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
