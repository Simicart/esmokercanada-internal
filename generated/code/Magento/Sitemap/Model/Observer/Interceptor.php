<?php
namespace Magento\Sitemap\Model\Observer;

/**
 * Interceptor class for @see \Magento\Sitemap\Model\Observer
 */
class Interceptor extends \Magento\Sitemap\Model\Observer implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Sitemap\Model\ResourceModel\Sitemap\CollectionFactory $collectionFactory, \Magento\Sitemap\Model\EmailNotification $emailNotification, \Magento\Store\Model\App\Emulation $appEmulation)
    {
        $this->___init();
        parent::__construct($scopeConfig, $collectionFactory, $emailNotification, $appEmulation);
    }

    /**
     * {@inheritdoc}
     */
    public function scheduledGenerateSitemaps()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'scheduledGenerateSitemaps');
        return $pluginInfo ? $this->___callPlugins('scheduledGenerateSitemaps', func_get_args(), $pluginInfo) : parent::scheduledGenerateSitemaps();
    }
}
