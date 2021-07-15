<?php
namespace MageWorx\OrderEditor\Api\Data\OrderManager;

/**
 * Factory class for @see \MageWorx\OrderEditor\Api\Data\OrderManager\PaymentMethodDataInterface
 */
class PaymentMethodDataInterfaceFactory
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
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\MageWorx\\OrderEditor\\Api\\Data\\OrderManager\\PaymentMethodDataInterface')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \MageWorx\OrderEditor\Api\Data\OrderManager\PaymentMethodDataInterface
     */
    public function create(array $data = [])
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
