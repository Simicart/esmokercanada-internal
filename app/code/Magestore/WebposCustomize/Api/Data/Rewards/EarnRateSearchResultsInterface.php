<?php

/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
namespace Magestore\WebposCustomize\Api\Data\Rewards;

/**
 * @api
 */
interface EarnRateSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Magestore\WebposCustomize\Api\Data\Rewards\EarnRateInterface[]
     */
    public function getItems();
}
