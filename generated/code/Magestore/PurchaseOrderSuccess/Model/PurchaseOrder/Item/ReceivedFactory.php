<?php
namespace Magestore\PurchaseOrderSuccess\Model\PurchaseOrder\Item;

/**
 * Factory class for @see \Magestore\PurchaseOrderSuccess\Model\PurchaseOrder\Item\Received
 */
class ReceivedFactory
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
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Magestore\\PurchaseOrderSuccess\\Model\\PurchaseOrder\\Item\\Received')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Magestore\PurchaseOrderSuccess\Model\PurchaseOrder\Item\Received
     */
    public function create(array $data = [])
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
