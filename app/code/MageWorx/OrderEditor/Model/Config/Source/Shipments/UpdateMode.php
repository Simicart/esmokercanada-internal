<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace MageWorx\OrderEditor\Model\Config\Source\Shipments;

use \Magento\Framework\Option\ArrayInterface;

class UpdateMode implements ArrayInterface
{
    const MODE_UPDATE_NOTHING = 'nothing';
    const MODE_UPDATE_ADD     = 'add';
    const MODE_UPDATE_REBUILD = 'rebuild';

    /**
     * Options getter
     * @return string[]
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => self::MODE_UPDATE_NOTHING,
                'label' => __('Do not touch')
            ], [
                'value' => self::MODE_UPDATE_ADD,
                'label' => __('Add new shipment')
            ], [
                'value' => self::MODE_UPDATE_REBUILD,
                'label' => __('Delete shipment(s) and create new')
            ],
        ];
    }
}
