<?php
/**
 * Copyright © 2018 Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Model\Source;

class ShipmentOptions implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'COD', 'label' => __('Collect on delivery')],
            ['value' => 'PA18', 'label' => __('Proof of age required - 18')],
            ['value' => 'PA19', 'label' => __('Proof of age required - 19')],
            ['value' => 'HFP', 'label' => __('Card for pickup')],
            ['value' => 'DNS', 'label' => __('Do not safe drop')],
            ['value' => 'LAD', 'label' => __('Leave at door - do not card')]
        ];
    }
}
