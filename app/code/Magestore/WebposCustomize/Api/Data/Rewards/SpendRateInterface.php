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
interface SpendRateInterface
{
    /**
     * @param $spendingRuleId
     * @return mixed
     */
    public function setSpendingRuleId($spendingRuleId);

    /**
     * @return mixed
     */
    public function getSpendingRuleId();

    /**
     * @param $name
     * @return mixed
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param $description
     * @return mixed
     */
    public function setDescription($description);

    /**
     * @return mixed
     */
    public function getDescription();

    /**
     * @param $isActive
     * @return mixed
     */
    public function setIsActive($isActive);

    /**
     * @return mixed
     */
    public function getIsActive();

    /**
     * @param $activeFrom
     * @return mixed
     */
    public function setActiveFrom($activeFrom);

    /**
     * @return mixed
     */
    public function getActiveFrom();

    /**
     * @param $activeTo
     * @return mixed
     */
    public function setActiveTo($activeTo);

    /**
     * @return mixed
     */
    public function getActiveTo();

    /**
     * @param $type
     * @return mixed
     */
    public function setType($type);

    /**
     * @return mixed
     */
    public function getType();

    /**
     * @param $spendingStyle
     * @return mixed
     */
    public function setSpendingStyle($spendingStyle);

    /**
     * @return mixed
     */
    public function getSpendingStyle();

    /**
     * @param $spendPoints
     * @return mixed
     */
    public function setSpendPoints($spendPoints);

    /**
     * @return mixed
     */
    public function getSpendPoints();

    /**
     * @param $monetaryStep
     * @return mixed
     */
    public function setMonetaryStep($monetaryStep);

    /**
     * @return mixed
     */
    public function getMonetaryStep();

    /**
     * @param $spendMinPoints
     * @return mixed
     */
    public function setSpendMinPoints($spendMinPoints);

    /**
     * @return mixed
     */
    public function getSpendMinPoints();

    /**
     * @param $spendMaxPoints
     * @return mixed
     */
    public function setSpendMaxPoints($spendMaxPoints);

    /**
     * @return mixed
     */
    public function getSpendMaxPoints();

    /**
     * @param $sortOrder
     * @return mixed
     */
    public function setSortOrder($sortOrder);

    /**
     * @return mixed
     */
    public function getSortOrder();

    /**
     * @param $isStopProcessing
     * @return mixed
     */
    public function setIsStopProcessing($isStopProcessing);

    /**
     * @return mixed
     */
    public function getIsStopProcessing();
}