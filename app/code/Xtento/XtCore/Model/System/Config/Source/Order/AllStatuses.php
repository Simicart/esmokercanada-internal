<?php

/**
 * Product:       Xtento_XtCore (2.0.9)
 * ID:            F0RIhapXqgQvfHUiSDvtff3tZxXjZ8OzKkh6+M6Rq88=
 * Packaged:      2017-08-19T02:11:09+00:00
 * Last Modified: 2017-07-20T19:42:52+00:00
 * File:          app/code/Xtento/XtCore/Model/System/Config/Source/Order/AllStatuses.php
 * Copyright:     Copyright (c) 2017 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

namespace Xtento\XtCore\Model\System\Config\Source\Order;

/**
 * Class AllStatuses
 *
 * Order Statuses source model
 *
 * @package Xtento\XtCore\Model\System\Config\Source\Order
 */
class AllStatuses extends \Magento\Sales\Model\Config\Source\Order\Status
{
    protected $_stateStatuses = false; // Get all statuses, see \Magento\Sales\Model\Config\Source\Order\Status

    /**
     * Function to just put all order status "codes" into an array.
     *
     * @return array
     */
    public function toArray()
    {
        $statuses = $this->toOptionArray();
        $statusArray = [];
        foreach ($statuses as $status) {
            array_push($statusArray, $status['value']);
        }
        return $statusArray;
    }

}
