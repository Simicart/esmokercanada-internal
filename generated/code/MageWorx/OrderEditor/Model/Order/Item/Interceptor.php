<?php
namespace MageWorx\OrderEditor\Model\Order\Item;

/**
 * Interceptor class for @see \MageWorx\OrderEditor\Model\Order\Item
 */
class Interceptor extends \MageWorx\OrderEditor\Model\Order\Item implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory, \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory, \Magento\Sales\Model\OrderFactory $orderFactory, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Catalog\Api\ProductRepositoryInterface $productRepository, \MageWorx\OrderEditor\Helper\Data $helper, \Magento\Downloadable\Model\Link\PurchasedFactory $purchasedFactory, \Magento\Downloadable\Model\Link\Purchased\ItemFactory $purchasedItemFactory, \Magento\Downloadable\Model\ResourceModel\Link\Purchased\CollectionFactory $linkPurchasedCollectionFactory, \Magento\Downloadable\Model\ResourceModel\Link\Purchased\Item\CollectionFactory $linkPurchasedItemsCollectionFactory, \Magento\Framework\DataObject\Copy $objectCopyService, \Magento\Downloadable\Model\Link $downloadableLink, \MageWorx\OrderEditor\Model\Invoice $invoice, \MageWorx\OrderEditor\Api\TaxManagerInterface $taxManager, \Magento\Framework\DB\TransactionFactory $transactionFactory, \MageWorx\OrderEditor\Api\QuoteItemRepositoryInterface $quoteItemRepository, \Magento\Framework\Message\ManagerInterface $messageManager, \MageWorx\OrderEditor\Model\Edit\QuoteFactory $orderEditorQuoteFactory, \MageWorx\OrderEditor\Api\OrderItemRepositoryInterface $oeOrderItemRepository, \Magento\Framework\Api\SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory, \Magento\Quote\Model\Quote\Item\ToOrderItem $quoteItemToOrderItemConverter, \Magento\Framework\Serialize\Serializer\Json $serializerJson, \Magento\Quote\Model\Quote\Item\Updater $quoteItemUpdater, \MageWorx\OrderEditor\Api\StockManagerInterface $stockManager, ?\Magento\Framework\Model\ResourceModel\AbstractResource $resource = null, ?\Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $registry, $extensionFactory, $customAttributeFactory, $orderFactory, $storeManager, $productRepository, $helper, $purchasedFactory, $purchasedItemFactory, $linkPurchasedCollectionFactory, $linkPurchasedItemsCollectionFactory, $objectCopyService, $downloadableLink, $invoice, $taxManager, $transactionFactory, $quoteItemRepository, $messageManager, $orderEditorQuoteFactory, $oeOrderItemRepository, $searchCriteriaBuilderFactory, $quoteItemToOrderItemConverter, $serializerJson, $quoteItemUpdater, $stockManager, $resource, $resourceCollection, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getQtyToCancel()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getQtyToCancel');
        return $pluginInfo ? $this->___callPlugins('getQtyToCancel', func_get_args(), $pluginInfo) : parent::getQtyToCancel();
    }

    /**
     * {@inheritdoc}
     */
    public function isProcessingAvailable()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isProcessingAvailable');
        return $pluginInfo ? $this->___callPlugins('isProcessingAvailable', func_get_args(), $pluginInfo) : parent::isProcessingAvailable();
    }
}
