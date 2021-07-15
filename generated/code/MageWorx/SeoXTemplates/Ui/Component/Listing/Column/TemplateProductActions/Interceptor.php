<?php
namespace MageWorx\SeoXTemplates\Ui\Component\Listing\Column\TemplateProductActions;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Ui\Component\Listing\Column\TemplateProductActions
 */
class Interceptor extends \MageWorx\SeoXTemplates\Ui\Component\Listing\Column\TemplateProductActions implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\UrlInterface $urlBuilder, \Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \MageWorx\SeoAll\Helper\MagentoVersion $helperVersion, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($urlBuilder, $context, $uiComponentFactory, $storeManager, $helperVersion, $components, $data);
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
