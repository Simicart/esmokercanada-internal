<?php
namespace MageWorx\SeoRedirects\Ui\Component\Listing\Column\Category\PriorityCategory;

/**
 * Interceptor class for @see \MageWorx\SeoRedirects\Ui\Component\Listing\Column\Category\PriorityCategory
 */
class Interceptor extends \MageWorx\SeoRedirects\Ui\Component\Listing\Column\Category\PriorityCategory implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\UrlInterface $urlBuilder, \MageWorx\SeoRedirects\Model\Redirect\Source\Category $categoryOptions, \Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($urlBuilder, $categoryOptions, $context, $uiComponentFactory, $components, $data);
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
