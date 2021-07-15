<?php
namespace Magestore\PurchaseOrderSuccess\Model\PurchaseOrder\Invoice;

/**
 * Factory class for @see \Magestore\PurchaseOrderSuccess\Model\PurchaseOrder\Invoice\Item
 */
class ItemFactory
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Factory constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Magestore\\PurchaseOrderSuccess\\Model\\PurchaseOrder\\Invoice\\Item')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Magestore\PurchaseOrderSuccess\Model\PurchaseOrder\Invoice\Item
     */
    public function create(array $data = [])
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
