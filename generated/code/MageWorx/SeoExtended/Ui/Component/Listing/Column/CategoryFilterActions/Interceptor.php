<?php
namespace MageWorx\SeoExtended\Ui\Component\Listing\Column\CategoryFilterActions;

/**
 * Interceptor class for @see \MageWorx\SeoExtended\Ui\Component\Listing\Column\CategoryFilterActions
 */
class Interceptor extends \MageWorx\SeoExtended\Ui\Component\Listing\Column\CategoryFilterActions implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\UrlInterface $urlBuilder, \Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, \Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory $productAttributeCollectionFactory, \Magento\Catalog\Model\ResourceModel\Category $categoryResourceModel, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($urlBuilder, $context, $uiComponentFactory, $productAttributeCollectionFactory, $categoryResourceModel, $components, $data);
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
