<?php
namespace MageWorx\SeoAll\Ui\Component\Listing\Column\Product;

/**
 * Interceptor class for @see \MageWorx\SeoAll\Ui\Component\Listing\Column\Product
 */
class Interceptor extends \MageWorx\SeoAll\Ui\Component\Listing\Column\Product implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\UrlInterface $urlBuilder, \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, \Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, $showTitleForUnknownCategory = true, $targetField = 'product_sku', array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($urlBuilder, $productCollectionFactory, $context, $uiComponentFactory, $showTitleForUnknownCategory, $targetField, $components, $data);
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
