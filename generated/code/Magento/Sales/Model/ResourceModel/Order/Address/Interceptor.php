<?php
namespace Magento\Sales\Model\ResourceModel\Order\Address;

/**
 * Interceptor class for @see \Magento\Sales\Model\ResourceModel\Order\Address
 */
class Interceptor extends \Magento\Sales\Model\ResourceModel\Order\Address implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context, \Magento\Framework\Model\ResourceModel\Db\VersionControl\Snapshot $entitySnapshot, \Magento\Framework\Model\ResourceModel\Db\VersionControl\RelationComposite $entityRelationComposite, \Magento\Sales\Model\ResourceModel\Attribute $attribute, \Magento\SalesSequence\Model\Manager $sequenceManager, \Magento\Sales\Model\Order\Address\Validator $validator, \Magento\Sales\Model\ResourceModel\GridPool $gridPool, $connectionName = null)
    {
        $this->___init();
        parent::__construct($context, $entitySnapshot, $entityRelationComposite, $attribute, $sequenceManager, $validator, $gridPool, $connectionName);
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
