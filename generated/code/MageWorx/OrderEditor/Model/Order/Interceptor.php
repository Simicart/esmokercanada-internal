<?php
namespace MageWorx\OrderEditor\Model\Order;

/**
 * Interceptor class for @see \MageWorx\OrderEditor\Model\Order
 */
class Interceptor extends \MageWorx\OrderEditor\Model\Order implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory, \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Sales\Model\Order\Config $orderConfig, \Magento\Catalog\Api\ProductRepositoryInterface $productRepository, \Magento\Catalog\Model\Product\Visibility $productVisibility, \Magento\Sales\Api\InvoiceManagementInterface $invoiceManagement, \Magento\Directory\Model\CurrencyFactory $currencyFactory, \Magento\Eav\Model\Config $eavConfig, \Magento\Sales\Model\Order\Status\HistoryFactory $orderHistoryFactory, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, \Magento\Tax\Model\Config $taxConfig, \MageWorx\OrderEditor\Model\Order\Sales $sales, \MageWorx\OrderEditor\Api\QuoteRepositoryInterface $quoteRepository, \MageWorx\OrderEditor\Model\Invoice $invoice, \MageWorx\OrderEditor\Model\Shipment $shipment, \MageWorx\OrderEditor\Model\Creditmemo $creditmemo, \MageWorx\OrderEditor\Api\OrderRepositoryInterface $orderRepository, \MageWorx\OrderEditor\Api\QuoteItemRepositoryInterface $oeQuoteItemRepository, \MageWorx\OrderEditor\Api\OrderItemRepositoryInterface $oeOrderItemRepository, \Magento\Framework\DataObjectFactory $dataObjectFactory, \Magento\Framework\Message\ManagerInterface $messageManager, \MageWorx\OrderEditor\Model\OrderCollectionFactoryBox $collectionFactoryBox, ?\Magento\Framework\Model\ResourceModel\AbstractResource $resource = null, ?\Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $registry, $extensionFactory, $customAttributeFactory, $timezone, $storeManager, $orderConfig, $productRepository, $productVisibility, $invoiceManagement, $currencyFactory, $eavConfig, $orderHistoryFactory, $priceCurrency, $taxConfig, $sales, $quoteRepository, $invoice, $shipment, $creditmemo, $orderRepository, $oeQuoteItemRepository, $oeOrderItemRepository, $dataObjectFactory, $messageManager, $collectionFactoryBox, $resource, $resourceCollection, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function canInvoice()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'canInvoice');
        return $pluginInfo ? $this->___callPlugins('canInvoice', func_get_args(), $pluginInfo) : parent::canInvoice();
    }

    /**
     * {@inheritdoc}
     */
    public function place()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'place');
        return $pluginInfo ? $this->___callPlugins('place', func_get_args(), $pluginInfo) : parent::place();
    }
}
