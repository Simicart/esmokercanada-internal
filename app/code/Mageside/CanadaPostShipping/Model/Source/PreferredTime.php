<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Model\Source;

class PreferredTime implements \Magento\Framework\Option\ArrayInterface
{
    protected $startTime = '12:00';

    protected $endTime = '16:00';

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        $options = [];

        $i = 0;
        $start = $current = strtotime($this->startTime);
        $end = strtotime($this->endTime);
        while ($current <= $end) {
            $current = $start + (15 * 60 * $i);
            if ($current <= $end) {
                $time = date("H:i", $current);
                $options[] = [
                    'value' => $time,
                    'label' => $time
                ];
            }
            $i++;
        }

        return $options;
    }
}
