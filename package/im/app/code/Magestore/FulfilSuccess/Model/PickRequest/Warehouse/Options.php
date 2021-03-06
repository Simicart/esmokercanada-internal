<?php

/**
 * Copyright © 2016 Magestore. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magestore\FulfilSuccess\Model\PickRequest\Warehouse;

use Magestore\FulfilSuccess\Api\PermissionManagementInterface;
use Magestore\FulfilSuccess\Model\Warehouse\Options as WarehouseOptions;

class Options extends WarehouseOptions
{
    /**
     * Get permission of current task
     * 
     * @return string
     */
    protected function getPermission()
    {
        return PermissionManagementInterface::PICK_ITEM;
    }

}