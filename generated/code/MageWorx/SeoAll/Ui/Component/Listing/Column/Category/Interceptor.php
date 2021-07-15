<?php
namespace MageWorx\SeoAll\Ui\Component\Listing\Column\Category;

/**
 * Interceptor class for @see \MageWorx\SeoAll\Ui\Component\Listing\Column\Category
 */
class Interceptor extends \MageWorx\SeoAll\Ui\Component\Listing\Column\Category implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\UrlInterface $urlBuilder, \MageWorx\SeoAll\Model\Source\Category $categoryOptions, \Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, $showTitleForUnknownCategory = true, $targetField = 'category_id', array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($urlBuilder, $categoryOptions, $context, $uiComponentFactory, $showTitleForUnknownCategory, $targetField, $components, $data);
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
