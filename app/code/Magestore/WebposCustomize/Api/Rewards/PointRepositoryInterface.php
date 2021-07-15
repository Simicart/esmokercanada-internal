<?php

/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
namespace Magestore\WebposCustomize\Api\Rewards;

/**
 * Interface PointRepositoryInterface
 * @package Magestore\WebposCustomize\Api\Rewards
 */
interface PointRepositoryInterface
{
    /**
     * @param string $customerId
     * @return string
     */
    public function getBalance($customerId);

    /**
     *
     * @return \Magestore\WebposCustomize\Api\Data\Rewards\SearchResultsInterface
     */
    public function getList();
}
