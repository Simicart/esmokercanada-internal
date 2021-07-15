<?php
/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
namespace Magestore\WebposCustomize\Api\Data\Rewards;

interface PointInterface
{
    /**#@+
     * Constants for keys of data array
     */
    const CUSTOMER_ID = 'customer_id';
    const POINT_BALANCE = 'point_balance';
    /**#@-*/
    
    /**
     * Get customer ID
     *
     * @api
     * @return string
     */
    public function getCustomerId();

    /**
     * Set customer ID
     *
     * @api
     * @param string $customerId
     * @return $this
     */
    public function setCustomerId($customerId);

    /**
     * Get point balance
     *
     * @api
     * @return string
     */
    public function getPointBalance();

    /**
     * Set point balance
     *
     * @api
     * @param string $pointBalance
     * @return $this
     */
    public function setPointBalance($pointBalance);
}
