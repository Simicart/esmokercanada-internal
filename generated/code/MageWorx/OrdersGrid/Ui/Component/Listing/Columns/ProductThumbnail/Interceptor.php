<?php
namespace MageWorx\OrdersGrid\Ui\Component\Listing\Columns\ProductThumbnail;

/**
 * Interceptor class for @see \MageWorx\OrdersGrid\Ui\Component\Listing\Columns\ProductThumbnail
 */
class Interceptor extends \MageWorx\OrdersGrid\Ui\Component\Listing\Columns\ProductThumbnail implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Element\UiComponent\ContextInterface $context, \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory, \Magento\Catalog\Helper\Image $imageHelper, \Magento\Framework\UrlInterface $urlBuilder, \Magento\Catalog\Api\ProductRepositoryInterface $productRepository, \Magento\Framework\Api\SearchCriteriaInterface $criteria, \Magento\Framework\Api\Search\FilterGroupBuilder $filterGroupBuilder, \Magento\Framework\Api\FilterBuilder $filterBuilder, \Magento\Framework\DataObjectFactory $dataObjectFactory, \Magento\Catalog\Model\Product $productModel, array $components = [], array $data = [])
    {
        $this->___init();
        parent::__construct($context, $uiComponentFactory, $imageHelper, $urlBuilder, $productRepository, $criteria, $filterGroupBuilder, $filterBuilder, $dataObjectFactory, $productModel, $components, $data);
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
