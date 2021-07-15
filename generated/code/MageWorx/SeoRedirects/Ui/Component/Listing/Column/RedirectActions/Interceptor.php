<?php
namespace MageWorx\SeoRedirects\Ui\Component\Listing\Column\RedirectActions;

/**
 * Interceptor class for @see \MageWorx\SeoRedirects\Ui\Component\Listing\Column\RedirectActions
 */
class Interceptor extends \MageWorx\SeoRedirects\Ui\Component\Listing\Column\RedirectActions implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\UrlInterface $urlBuilder, \Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($urlBuilder, $context, $uiComponentFactory, $components, $data);
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
