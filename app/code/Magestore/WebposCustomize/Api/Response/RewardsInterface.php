<?php
/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
namespace Magestore\WebposCustomize\Api\Response;

/**
 * Interface RewardsInterface
 * @package Magestore\WebposCustomize\Api\Response
 */
interface RewardsInterface
{

    const EARNED_POINT = 'earned_point';
    const USED_POINT = 'used_point';
    const BALANCE = 'balance';
    const MAX_POINTS = 'max_points';
    const DISCOUNT_AMOUNT = 'discount_amount';

    /**
     * Get used point
     *
     * @api
     * @return string
     */
    public function getUsedPoint();

    /**
     * Set used point
     *
     * @api
     * @param string $usedPoint
     * @return $this
     */
    public function setUsedPoint($usedPoint);

    /**
     * Get balance
     *
     * @api
     * @return string
     */
    public function getBalance();

    /**
     * Set balance
     *
     * @api
     * @param string $balance
     * @return $this
     */
    public function setBalance($balance);

    /**
     * Get max points
     *
     * @api
     * @return string
     */
    public function getMaxPoints();

    /**
     * Set max points
     *
     * @api
     * @param string $maxPoints
     * @return $this
     */
    public function setMaxPoints($maxPoints);

    /**
     * Get discount amount
     *
     * @api
     * @return string
     */
    public function getDiscountAmount();

    /**
     * Set discount amount
     *
     * @api
     * @param string $discountAmount
     * @return $this
     */
    public function setDiscountAmount($discountAmount);

    /**
     * Get earned point
     *
     * @api
     * @return string
     */
    public function getEarnedPoint();

    /**
     * Set earned point
     *
     * @api
     * @param string $earnedPoint
     * @return $this
     */
    public function setEarnedPoint($earnedPoint);
}
