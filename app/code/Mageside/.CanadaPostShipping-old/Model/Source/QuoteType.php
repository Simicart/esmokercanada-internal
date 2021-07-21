<?php
/**
 * Copyright © 2018 Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Model\Source;

class QuoteType implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 'commercial',
                'label' => __('Commercial'),
            ],
            [
                'value' => 'counter',
                'label' => __('Counter')
            ]
        ];
    }
}
