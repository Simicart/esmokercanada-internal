<?php
namespace Magento\Sales\Model\ResourceModel\Order\Shipment\Track;

/**
 * Interceptor class for @see \Magento\Sales\Model\ResourceModel\Order\Shipment\Track
 */
class Interceptor extends \Magento\Sales\Model\ResourceModel\Order\Shipment\Track implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context, \Magento\Framework\Model\ResourceModel\Db\VersionControl\Snapshot $entitySnapshot, \Magento\Framework\Model\ResourceModel\Db\VersionControl\RelationComposite $entityRelationComposite, \Magento\Sales\Model\ResourceModel\Attribute $attribute, \Magento\SalesSequence\Model\Manager $sequenceManager, \Magento\Sales\Model\Order\Shipment\Track\Validator $validator, $connectionName = null)
    {
        $this->___init();
        parent::__construct($context, $entitySnapshot, $entityRelationComposite, $attribute, $sequenceManager, $validator, $connectionName);
    }

    /**
     * {@inheritdoc}
     */
    public function save(\Magento\Framework\Model\AbstractModel $object)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'save');
        return $pluginInfo ? $this->___callPlugins('save', func_get_args(), $pluginInfo) : parent::save($object);
    }
}
