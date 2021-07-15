<?php
namespace MageWorx\OrderEditor\Model\Invoice;

/**
 * Interceptor class for @see \MageWorx\OrderEditor\Model\Invoice
 */
class Interceptor extends \MageWorx\OrderEditor\Model\Invoice implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory, \Magento\Framework\Api\AttributeValueFactory $customAttributeFactory, \Magento\Sales\Model\Order\Invoice\Config $invoiceConfig, \Magento\Sales\Model\OrderFactory $orderFactory, \Magento\Framework\Math\CalculatorFactory $calculatorFactory, \Magento\Sales\Model\ResourceModel\Order\Invoice\Item\CollectionFactory $invoiceItemCollectionFactory, \Magento\Sales\Model\Order\Invoice\CommentFactory $invoiceCommentFactory, \Magento\Sales\Model\ResourceModel\Order\Invoice\Comment\CollectionFactory $commentCollectionFactory, ?\Magento\Framework\Model\ResourceModel\AbstractResource $resource = null, ?\Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $registry, $extensionFactory, $customAttributeFactory, $invoiceConfig, $orderFactory, $calculatorFactory, $invoiceItemCollectionFactory, $invoiceCommentFactory, $commentCollectionFactory, $resource, $resourceCollection, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function setTotalQty($qty)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'setTotalQty');
        return $pluginInfo ? $this->___callPlugins('setTotalQty', func_get_args(), $pluginInfo) : parent::setTotalQty($qty);
    }
}
