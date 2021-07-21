<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Model\System\Config\Backend;

use Magento\Config\Model\Config\Backend\Serialized\ArraySerialized;

class FreeMethods extends ArraySerialized
{
    /**
     * Process data after load
     *
     * @return void
     */
    protected function _afterLoad()
    {
        parent::_afterLoad();
        $values = $this->getValue();
        $values = empty($values) ? [] : $values;
        unset($values['__empty']);
        foreach ($values as $key => $row) {
            if (empty($row['price'])) {
                $values[$key]['price'] = 0;
            }
        }
        $this->setValue($values);
    }
}
