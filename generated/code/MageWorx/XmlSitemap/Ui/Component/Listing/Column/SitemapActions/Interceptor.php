<?php
namespace MageWorx\XmlSitemap\Ui\Component\Listing\Column\SitemapActions;

/**
 * Interceptor class for @see \MageWorx\XmlSitemap\Ui\Component\Listing\Column\SitemapActions
 */
class Interceptor extends \MageWorx\XmlSitemap\Ui\Component\Listing\Column\SitemapActions implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\UrlInterface $urlBuilder, \Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, \MageWorx\SeoAll\Helper\MagentoVersion $helperVersion, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($urlBuilder, $context, $uiComponentFactory, $helperVersion, $components, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function prepare()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'prepare');
        return $pluginInfo ? $this->___callPlugins('prepare', func_get_args(), $pluginInfo) : parent::prepare();
    }
}
