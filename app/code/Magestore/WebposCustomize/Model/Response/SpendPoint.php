<?php
/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

namespace Magestore\WebposCustomize\Model\Response;

/**
 * Class SpendPointInterface
 * @package Magestore\WebposCustomize\Api\Response
 */
class SpendPoint extends \Magento\Framework\Model\AbstractExtensibleModel
    implements \Magestore\WebposCustomize\Api\Response\SpendPointInterface
{
    /**
     * Get spend points
     *
     * @api
     * @return boolean
     */
    public function getSuccess() {
        return $this->getData(self::SUCCESS);
    }

    /**
     * Set success
     *
     * @api
     * @param boolean $success
     * @return $this
     */
    public function setSuccess($success) {
        return $this->setData(self::SUCCESS, $success);
    }

    /**
     * Get message
     *
     * @api
     * @return string
     */
    public function getMessage() {
        return $this->getData(self::MESSAGE);
    }

    /**
     * Set message
     *
     * @api
     * @param string $message
     * @return $this
     */
    public function setMessage($message) {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * Get spend points
     *
     * @api
     * @return string
     */
    public function getSpendPoints() {
        return $this->getData(self::SPEND_POINTS);
    }

    /**
     * Set spend points
     *
     * @api
     * @param string $spendPoints
     * @return $this
     */
    public function setSpendPoints($spendPoints) {
        return $this->setData(self::SPEND_POINTS, $spendPoints);
    }

    /**
     * Get spend amount
     *
     * @api
     * @return string
     */
    public function getSpendAmount() {
        return $this->getData(self::SPEND_AMOUNT);
    }

    /**
     * Set spend amount
     *
     * @api
     * @param string $spendAmount
     * @return $this
     */
    public function setSpendAmount($spendAmount) {
        return $this->setData(self::SPEND_AMOUNT, $spendAmount);
    }

    /**
     * Get spend points formated
     *
     * @api
     * @return string
     */
    public function getSpendPointsFormated() {
        return $this->getData(self::SPEND_POINTS_FORMATED);
    }

    /**
     * Set spend points formated
     *
     * @api
     * @param string $spendPointsFormated
     * @return $this
     */
    public function setSpendPointsFormated($spendPointsFormated) {
        return $this->setData(self::SPEND_POINTS_FORMATED, $spendPointsFormated);
    }

//    /**
//     * Get quote data
//     *
//     * @api
//     * @return \Magestore\Webpos\Api\Data\Cart\CheckoutInterface
//     */
//    public function getQuoteData() {
//        return $this->getData(self::QUOTE_DATA);
//    }
//
//    /**
//     * Set quote data
//     *
//     * @api
//     * @param \Magestore\Webpos\Api\Data\Cart\CheckoutInterface $quoteData
//     * @return $this
//     */
//    public function setQuoteData($quoteData) {
//        return $this->setData(self::QUOTE_DATA, $quoteData);
//    }
}