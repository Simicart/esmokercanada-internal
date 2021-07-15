<?php
namespace MageWorx\OrderEditor\Model\Order\OrderItemRepository;

/**
 * Interceptor class for @see \MageWorx\OrderEditor\Model\Order\OrderItemRepository
 */
class Interceptor extends \MageWorx\OrderEditor\Model\Order\OrderItemRepository implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\MageWorx\OrderEditor\Model\ResourceModel\Order\Item $resource, \MageWorx\OrderEditor\Model\Order\ItemFactory $entityFactory, \MageWorx\OrderEditor\Api\Data\OrderItemSearchResultInterfaceFactory $searchResultsFactory, \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor, \Magento\Catalog\Model\ProductOptionFactory $productOptionFactory, \Magento\Catalog\Api\Data\ProductOptionExtensionFactory $productOptionExtensionFactory, \Magento\Framework\Api\SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory, array $processorPool = [])
    {
        $this->___init();
        parent::__construct($resource, $entityFactory, $searchResultsFactory, $collectionProcessor, $productOptionFactory, $productOptionExtensionFactory, $searchCriteriaBuilderFactory, $processorPool);
    }

    /**
     * {@inheritdoc}
     */
    public function save(\Magento\Sales\Api\Data\OrderItemInterface $entity) : \Magento\Sales\Api\Data\OrderItemInterface
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'save');
        return $pluginInfo ? $this->___callPlugins('save', func_get_args(), $pluginInfo) : parent::save($entity);
    }

    /**
     * {@inheritdoc}
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria) : \Magento\Sales\Api\Data\OrderItemSearchResultInterface
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getList');
        return $pluginInfo ? $this->___callPlugins('getList', func_get_args(), $pluginInfo) : parent::getList($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(\Magento\Sales\Api\Data\OrderItemInterface $entity) : bool
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'delete');
        return $pluginInfo ? $this->___callPlugins('delete', func_get_args(), $pluginInfo) : parent::delete($entity);
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'get');
        return $pluginInfo ? $this->___callPlugins('get', func_get_args(), $pluginInfo) : parent::get($id);
    }
}
