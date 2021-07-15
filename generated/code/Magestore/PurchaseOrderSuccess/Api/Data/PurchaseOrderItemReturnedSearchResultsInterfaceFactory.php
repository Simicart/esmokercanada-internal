<?php
namespace Magestore\PurchaseOrderSuccess\Api\Data;

/**
 * Factory class for @see \Magestore\PurchaseOrderSuccess\Api\Data\PurchaseOrderItemReturnedSearchResultsInterface
 */
class PurchaseOrderItemReturnedSearchResultsInterfaceFactory
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
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Magestore\\PurchaseOrderSuccess\\Api\\Data\\PurchaseOrderItemReturnedSearchResultsInterface')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Magestore\PurchaseOrderSuccess\Api\Data\PurchaseOrderItemReturnedSearchResultsInterface
     */
    public function create(array $data = [])
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
