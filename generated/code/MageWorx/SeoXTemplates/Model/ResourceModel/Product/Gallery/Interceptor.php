<?php
namespace MageWorx\SeoXTemplates\Model\ResourceModel\Product\Gallery;

/**
 * Interceptor class for @see \MageWorx\SeoXTemplates\Model\ResourceModel\Product\Gallery
 */
class Interceptor extends \MageWorx\SeoXTemplates\Model\ResourceModel\Product\Gallery implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context, \Magento\Framework\EntityManager\MetadataPool $metadataPool, \Magento\Store\Model\StoreManagerInterface $storeManager, ?string $connectionName = null)
    {
        $this->___init();
        parent::__construct($context, $metadataPool, $storeManager, $connectionName);
    }

    /**
     * {@inheritdoc}
     */
    public function createBatchBaseSelect($storeId, $attributeId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'createBatchBaseSelect');
        return $pluginInfo ? $this->___callPlugins('createBatchBaseSelect', func_get_args(), $pluginInfo) : parent::createBatchBaseSelect($storeId, $attributeId);
    }

    /**
     * {@inheritdoc}
     */
    public function duplicate($attributeId, $newFiles, $originalProductId, $newProductId)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'duplicate');
        return $pluginInfo ? $this->___callPlugins('duplicate', func_get_args(), $pluginInfo) : parent::duplicate($attributeId, $newFiles, $originalProductId, $newProductId);
    }
}
