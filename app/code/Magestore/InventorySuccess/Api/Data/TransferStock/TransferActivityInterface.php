<?php
/**
 * Copyright © 2016 Magestore. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Created by PhpStorm.
 * User: steve
 * Date: 09/08/2016
 * Time: 14:24
 */

namespace Magestore\InventorySuccess\Api\Data\TransferStock;


interface TransferActivityInterface
{
    const ACTIVITY_TYPE_DELIVERY = "delivery";
    const ACTIVITY_TYPE_RECEIVING = "receiving";
    const ACTIVITY_TYPE_RETURN = "return";
}