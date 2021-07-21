<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Model\Source;

class Province extends \Magento\Directory\Model\ResourceModel\Region\Collection
{
    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $this->addCountryFilter('CA');
        $options = [];
        foreach ($this as $item) {
            $options[] = [
                'value' => $item->getCode(),
                'label' => $item->getName(),
            ];
        }

        if (count($options) > 0) {
            array_unshift(
                $options,
                ['value' => '', 'label' => __('Please select a region, state or province.')]
            );
        }

        return $options;
    }
}
