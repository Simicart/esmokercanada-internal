<?php
namespace MageWorx\SeoCrossLinks\Ui\Component\Listing\Column\CrosslinkActions;

/**
 * Interceptor class for @see \MageWorx\SeoCrossLinks\Ui\Component\Listing\Column\CrosslinkActions
 */
class Interceptor extends \MageWorx\SeoCrossLinks\Ui\Component\Listing\Column\CrosslinkActions implements \Magento\Framework\Interception\InterceptorInterface
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
