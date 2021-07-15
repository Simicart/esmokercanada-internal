<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 15/10/2015
 * Time: 10:17
 */

namespace Magenest\UltimateFollowupEmail\Model\ResourceModel;

class AbandonedCart extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{


    protected function _construct()
    {
        $this->_init('magenest_ultimatefollowupemail_guest_abandoned_cart', 'id');
    }//end _construct()


    public function getTimePeriodCondition($modify)
    {
        $now = new \DateTime();

        $now->modify($modify);

        $downLimit = $now->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT);

        return $downLimit;
    }//end getTimePeriodCondition()


    public function getAbandonedCartForInsertOperation($downLimit)
    {
        $downLimit = $this->getTimePeriodCondition($downLimit);
        $adapter   = $this->_getConnection('read');

        $mainTable = $this->getTable('quote');

        $followUpAbandonedCartTable = $this->getTable('magenest_ultimatefollowupemail_guest_abandoned_cart');

        $select = $adapter->select()->from(
            ['m' => $mainTable],
            '*'
        )->joinLeft(
            ['a' => $followUpAbandonedCartTable],
            'm.entity_id = a.quote_id'
        )->where(
            'a.quote_id is null AND m.is_active = 1 AND m.customer_id  is not null  AND m.items_count != 0'
        )->where(
            'm.updated_at < ? or (m.created_at < "'.$downLimit.'"  and m.updated_at ="0000-00-00 00:00:00")',
            $downLimit
        );

        //$debugSelect = clone $select;
        $debugString = (string)$select;


        $row = $adapter->fetchAssoc($select);

        return $row;
    }//end getAbandonedCartForInsertOperation()


    /**
     * Get abandoned cart of guest(unregistered customer)
     * @param $downLimit
     * @return array
     */
    public function getAbandonedCartOfGuest($downLimit)
    {
        $downLimit = $this->getTimePeriodCondition($downLimit);
        $adapter = $this->_getConnection('read');

        $mainTable = $this->getTable('quote');

        $guestTable = $this->getTable('magenest_ultimatefollowupemail_guest_capture');
        $followUpAbandonedCartTable = $this->getTable('magenest_ultimatefollowupemail_guest_abandoned_cart');

        $select = $adapter->select()->from(
            ['m' => $mainTable]
        )->joinLeft(['a' => $guestTable], 'm.entity_id = a.quote_id')
            ->joinLeft(['b' => $followUpAbandonedCartTable], 'm.entity_id = b.quote_id')
            ->where(
                'a.quote_id is null AND b.quote_id is  null AND m.is_active = 1 AND m.customer_id  is  null  AND m.items_count != 0'
            )->where('m.updated_at < ? or (m.created_at < "' . $downLimit . '"  and m.updated_at ="0000-00-00 00:00:00")', $downLimit);
        $debugString = (string)$select;

        $row = $adapter->fetchAssoc($select);

        return $row;
    }

    public function getCurrentTime()
    {
        $rs = $this->_getConnection('read')->fetchAll('select now()');

        return $rs;
    }//end getCurrentTime()


    public function getQuoteTime()
    {
        $adapter = $this->_getConnection('read');

        $mainTable = $this->getTable('quote');

        $select = $adapter->select()->from(
            ['m' => $mainTable],
            'm.created_at'
        );

        $row = $adapter->fetchAssoc($select);

        return $row;
    }//end getQuoteTime()
}//end class
