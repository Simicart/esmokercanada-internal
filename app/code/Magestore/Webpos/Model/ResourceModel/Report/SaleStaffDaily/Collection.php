<?php
/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

namespace Magestore\Webpos\Model\ResourceModel\Report\SaleStaffDaily;

/**
 * Report order collection
 *
 * @author      Magestore Developer
 */
class Collection extends \Magestore\Webpos\Model\ResourceModel\Report\Collection
{
     /**
     * constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_timeColumnGroup = 'created_at';
        $this->_firstColumnGroup = 'webpos_staff_id';
    }

}