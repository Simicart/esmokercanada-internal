<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 14/06/2016
 * Time: 13:27
 */
namespace Magenest\UltimateFollowupEmail\Model\ResourceModel\Message;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{


    /**
     * set model and resource for this
     */
    protected function _construct()
    {
        $this->_init('Magenest\UltimateFollowupEmail\Model\Message', 'Magenest\UltimateFollowupEmail\Model\ResourceModel\Message');
    }//end _construct()


    /**
     * get the sms collection using in condition
     */
    public function getSMSCollectionByIds($ids)
    {
        if (is_array($ids) && !empty($ids)) {
            $idsCondition = '('.implode(',', $ids).')';

            $this->_select->where("`sms_id` IN $idsCondition ");
            return $this;
        } else {
            return null;
        }
    }//end getSMSCollectionByIds()
}//end class
