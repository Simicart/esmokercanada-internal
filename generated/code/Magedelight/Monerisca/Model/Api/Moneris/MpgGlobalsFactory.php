<?php
namespace Magedelight\Monerisca\Model\Api\Moneris;

/**
 * Factory class for @see \Magedelight\Monerisca\Model\Api\Moneris\MpgGlobals
 */
class MpgGlobalsFactory
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
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Magedelight\\Monerisca\\Model\\Api\\Moneris\\MpgGlobals')
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return \Magedelight\Monerisca\Model\Api\Moneris\MpgGlobals
     */
    public function create(array $data = [])
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}
