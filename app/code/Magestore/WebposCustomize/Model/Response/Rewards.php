<?php
/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

namespace Magestore\WebposCustomize\Model\Response;

/**
 * Class Rewards
 * @package Magestore\WebposCustomize\Model\Response
 */
class Rewards extends \Magento\Framework\Model\AbstractExtensibleModel
    implements \Magestore\WebposCustomize\Api\Response\RewardsInterface
{
    /**
     * Get used point
     *
     * @api
     * @return string
     */
    public function getUsedPoint()
    {
        return $this->getData(self::USED_POINT);
    }

    /**
     * Set used point
     *
     * @api
     * @param string $usedPoint
     * @return $this
     */
    public function setUsedPoint($usedPoint)
    {
        return $this->setData(self::USED_POINT, $usedPoint);
    }

    /**
     * Get balance
     *
     * @api
     * @return string
     */
    public function getBalance()
    {
        return $this->getData(self::BALANCE);
    }

    /**
     * Set balance
     *
     * @api
     * @param string $balance
     * @return $this
     */
    public function setBalance($balance)
    {
        return $this->setData(self::BALANCE, $balance);
    }

    /**
     * Get max points
     *
     * @api
     * @return string
     */
    public function getMaxPoints()
    {
        return $this->getData(self::MAX_POINTS);
    }

    /**
     * Set max points
     *
     * @api
     * @param string $maxPoints
     * @return $this
     */
    public function setMaxPoints($maxPoints)
    {
        return $this->setData(self::MAX_POINTS, $maxPoints);
    }

    /**
     * Get discount amount
     *
     * @api
     * @return string
     */
    public function getDiscountAmount() {
        return $this->getData(self::DISCOUNT_AMOUNT);
    }

    /**
     * Set discount amount
     *
     * @api
     * @param string $discountAmount
     * @return $this
     */
    public function setDiscountAmount($discountAmount) {
        return $this->setData(self::DISCOUNT_AMOUNT, $discountAmount);
    }

    /**
     * Get earned point
     *
     * @api
     * @return string
     */
    public function getEarnedPoint() {
        return $this->getData(self::EARNED_POINT);
    }

    /**
     * Set earned point
     *
     * @api
     * @param string $earnedPoint
     * @return $this
     */
    public function setEarnedPoint($earnedPoint) {
        return $this->setData(self::EARNED_POINT, $earnedPoint);
    }
}
