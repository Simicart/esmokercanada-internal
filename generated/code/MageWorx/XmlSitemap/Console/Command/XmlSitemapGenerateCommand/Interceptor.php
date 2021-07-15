<?php
namespace MageWorx\XmlSitemap\Console\Command\XmlSitemapGenerateCommand;

/**
 * Interceptor class for @see \MageWorx\XmlSitemap\Console\Command\XmlSitemapGenerateCommand
 */
class Interceptor extends \MageWorx\XmlSitemap\Console\Command\XmlSitemapGenerateCommand implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Event\ManagerInterface $eventManager, \MageWorx\XmlSitemap\Model\ResourceModel\Sitemap\CollectionFactory $sitemapCollectionFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\State $appState)
    {
        $this->___init();
        parent::__construct($eventManager, $sitemapCollectionFactory, $storeManager, $appState);
    }

    /**
     * {@inheritdoc}
     */
    public function run(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'run');
        return $pluginInfo ? $this->___callPlugins('run', func_get_args(), $pluginInfo) : parent::run($input, $output);
    }
}
