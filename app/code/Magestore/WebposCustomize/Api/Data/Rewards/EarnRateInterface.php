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
interface EarnRateInterface
{
    /**
     * @param $earningRuleId
     * @return mixed
     */
    public function setEarningRuleId($earningRuleId);

    /**
     * @return mixed
     */
    public function getEarningRuleId();
    
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
     * @param $earningStyle
     * @return mixed
     */
    public function setEarningStyle($earningStyle);

    /**
     * @return mixed
     */
    public function getEarningStyle();

    /**
     * @param $earnPoints
     * @return mixed
     */
    public function setEarnPoints($earnPoints);

    /**
     * @return mixed
     */
    public function getEarnPoints();

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
     * @param $pointsLimit
     * @return mixed
     */
    public function setPointsLimit($pointsLimit);

    /**
     * @return mixed
     */
    public function getPointsLimit();

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

    /**
     * @param $param1
     * @return mixed
     */
    public function setParam1($param1);

    /**
     * @return mixed
     */
    public function getParam1();

    /**
     * @param $historyMessage
     * @return mixed
     */
    public function setHistoryMessage($historyMessage);

    /**
     * @return mixed
     */
    public function getHistoryMessage();

    /**
     * @param $emailMessage
     * @return mixed
     */
    public function setEmailMessage($emailMessage);

    /**
     * @return mixed
     */
    public function getEmailMessage();

    /**
     * @param $productNotification
     * @return mixed
     */
    public function setProductNotification($productNotification);

    /**
     * @return mixed
     */
    public function getProductNotification();
}