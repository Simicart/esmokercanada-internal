<?php
/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
namespace Magestore\WebposCustomize\Api\Data\Rewards;

/**
 * Interface SearchResultsInterface
 * @package Magestore\WebposCustomize\Api\Data\Rewards
 */
interface SearchResultsInterface
{
    /**
     * Get items list.
     *
     * @return \Magestore\WebposCustomize\Api\Data\Rewards\PointInterface[]
     */
    public function getItems();

    /**
     * Set items list.
     *
     * @param \Magestore\WebposCustomize\Api\Data\Rewards\PointInterface[] $items
     * @return $this
     */
    public function setItems(array $items);


    /**
     * Set total count
     *
     * @param int $count
     * @return $this
     */
    public function setTotalCount($count);

    /**
     * Get total count
     *
     * @return int
     */
    public function getTotalCount();

}
