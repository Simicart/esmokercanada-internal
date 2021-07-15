<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Custom\SalesPlugin\Model\Indexer\Category\Product\Action;

class Full extends \Magento\Catalog\Model\Indexer\Category\Product\Action\Full {

    public function isRangingNeeded() {
        return false; // true by default mage 2.2.2
    }
}
