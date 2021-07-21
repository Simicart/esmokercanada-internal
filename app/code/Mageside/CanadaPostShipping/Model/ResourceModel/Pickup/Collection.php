<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Model\ResourceModel\Pickup;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'pickup_id';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(
            \Mageside\CanadaPostShipping\Model\Pickup::class,
            \Mageside\CanadaPostShipping\Model\ResourceModel\Pickup::class
        );
    }
}
