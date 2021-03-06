<?php

/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
namespace Magestore\Webpos\Model\Pos;

use Magestore\Webpos\Api\Data\Denomination\DenominationInterface;

/**
 * Class Pos
 * @package Magestore\Webpos\Model\Pos
 */
class Pos extends \Magento\Framework\Model\AbstractModel implements \Magestore\Webpos\Api\Data\Pos\PosInterface
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'webpos_pos';

    /**
     * @var \Magestore\Webpos\Model\ResourceModel\Denomination\Denomination\CollectionFactory
     */
    protected $denominationCollectionFactory;

    /**
     * Pos constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magestore\Webpos\Model\ResourceModel\Denomination\Denomination\CollectionFactory $denominationCollectionFactory
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magestore\Webpos\Model\ResourceModel\Denomination\Denomination\CollectionFactory $denominationCollectionFactory,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [])
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->denominationCollectionFactory = $denominationCollectionFactory;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magestore\Webpos\Model\ResourceModel\Pos\Pos');
    }

    /**
     * get option array
     *
     * return array
     */
    public function toOptionArray()
    {
        $collection = $this->getCollection()->getAvailablePos();
        $options = array();
        if ($collection->getSize() > 0) {
            foreach ($collection as $pos) {
                $options[] = array('value' => $pos->getId(), 'label' => $pos->getData('pos_name'));
            }
        }
        return $options;
    }

    /**
     * get option array
     *
     * return array
     */
    public function getAvailableStaff($posId = 0)
    {
        $collection = $this->getCollection()->getAvailabeStaff($posId);
        $options = array();
        if ($collection->getSize() > 0) {
            foreach ($collection as $staff) {
                $options[] = array('value' => $staff->getId(), 'label' => $staff->getData('display_name'));
            }
        }
        return $options;
    }

    /**
     * get pos list for form select element
     * return array
     */
    public function getValuesForForm($posId = 0)
    {
        $options = array();
        $options[] = array('value' => null, 'label' => ' ');
        $optionsArr = $this->getAvailableStaff($posId);
        $options = array_merge($options, $optionsArr);
        return $options;
    }

    /**
     *  Get Pos Id
     * @return string|null
     */
    public function getPosId()
    {
        return $this->getData(self::POS_ID);
    }

    /**
     * Set Pos Id
     *
     * @param string $posId
     * @return $this
     */
    public function setPosId($posId)
    {
        return $this->setData(self::POS_NAME, $posId);
    }

    /**
     *  Get Pos Name
     * @return string|null
     */
    public function getPosName()
    {
        return $this->getData(self::POS_NAME);
    }

    /**
     * Set Pos Name
     *
     * @param string $posName
     * @return $this
     */
    public function setPosName($posName)
    {
        return $this->setData(self::POS_NAME, $posName);
    }
    /**
     *  location_id
     * @return int|null
     */
    public function getLocationId()
    {
        return $this->getData(self::LOCATION_ID);
    }

    /**
     * Set Location Id
     *
     * @param int $locationId
     * @return $this
     */
    public function setLocationId($locationId)
    {
        return $this->setData(self::LOCATION_ID, $locationId);
    }

    /**
     *  get store id
     * @return int|null
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * Set Store Id
     *
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     *  Staff Id
     * @return int|null
     */
    public function getStaffId()
    {
        return $this->getData(self::STAFF_ID);
    }

    /**
     * Set Staff Id
     *
     * @param int $staff_id
     * @return $this
     */
    public function setStaffId($staff_id)
    {
        return $this->setData(self::STAFF_ID, $staff_id);
    }

    /**
     * status
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * set Status
     * @param int $status
     * @return $this
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Denominations
     * @param string $denominationIds
     * @return $this
     */
    public function setDenominationIds($denominationIds)
    {
        return $this->setData(self::DENOMINATION_IDS, $denominationIds);
    }

    /**
     * Denominations
     * @return string
     */
    public function getDenominationIds(){
        return $this->getData(self::DENOMINATION_IDS);
    }


    /**
     * Denominations
     * @return \Magestore\Webpos\Api\Data\Denomination\DenominationInterface[]
     */
    public function getDenominations()
    {
        $denominationIds = $this->getDenominationIds();
        $denominations = $this->denominationCollectionFactory->create();
        $denominations->setOrder(DenominationInterface::SORT_ORDER, 'ASC');
        if($denominationIds){
            $denominationIds = explode(',',$denominationIds);
            if(!empty($denominationIds) && !in_array(self::ALL, $denominationIds)){
                $denominations->addFieldToFilter(DenominationInterface::DENOMINATION_ID, ['in' => $denominationIds]);
            }
        }
        return $denominations->getData();
    }

    /**
     * @param string $key
     * @param null $index
     * @return mixed
     */
    public function getData($key = '', $index = null)
    {
        $data = parent::getData($key, $index);
        if ('' === $key) {
            $data[self::DENOMINATIONS] = $this->getDenominations();
        }
        return $data;
    }
}