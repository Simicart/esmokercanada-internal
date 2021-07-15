<?php

/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
namespace Magestore\WebposCustomize\Api\Rewards;

/**
 * Interface RateRepositoryInterface
 * @package Magestore\WebposCustomize\Api\Rewards
 */
interface RateRepositoryInterface
{
    /**
     * @param string $websiteId
     * @param string $customerGroupId
     * @return \Magestore\WebposCustomize\Api\Data\Rewards\EarnRateSearchResultsInterface
     */
    public function getEarningPointRates($websiteId, $customerGroupId);

    /**
     * @param string $websiteId
     * @param string $customerGroupId
     * @return \Magestore\WebposCustomize\Api\Data\Rewards\SpendRateSearchResultsInterface
     */
    public function getSpendingPointRates($websiteId, $customerGroupId);
}