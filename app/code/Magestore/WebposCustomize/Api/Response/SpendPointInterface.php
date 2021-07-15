<?php
/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
namespace Magestore\WebposCustomize\Api\Response;

interface SpendPointInterface
{
    /**#@+
     * Constants for keys of data array
     */
    const SUCCESS = 'success';
    const MESSAGE = 'message';
    const SPEND_POINTS = 'spend_points';
    const SPEND_AMOUNT = 'spend_amount';
    const SPEND_POINTS_FORMATED = 'spend_points_formated';
    const QUOTE_DATA = 'quote_data';
    /**#@-*/

    /**
     * Get spend points
     *
     * @api
     * @return boolean
     */
    public function getSuccess();

    /**
     * Set success
     *
     * @api
     * @param boolean $success
     * @return $this
     */
    public function setSuccess($success);

    /**
     * Get message
     *
     * @api
     * @return string
     */
    public function getMessage();

    /**
     * Set message
     *
     * @api
     * @param string $message
     * @return $this
     */
    public function setMessage($message);

    /**
     * Get spend points
     *
     * @api
     * @return string
     */
    public function getSpendPoints();

    /**
     * Set spend points
     *
     * @api
     * @param string $spendPoints
     * @return $this
     */
    public function setSpendPoints($spendPoints);

    /**
     * Get spend amount
     *
     * @api
     * @return string
     */
    public function getSpendAmount();

    /**
     * Set spend amount
     *
     * @api
     * @param string $spendAmount
     * @return $this
     */
    public function setSpendAmount($spendAmount);

    /**
     * Get spend points formated
     *
     * @api
     * @return string
     */
    public function getSpendPointsFormated();

    /**
     * Set spend points formated
     *
     * @api
     * @param string $spendPointsFormated
     * @return $this
     */
    public function setSpendPointsFormated($spendPointsFormated);

//    /**
//     * Get quote data
//     *
//     * @api
//     * @return \Magestore\Webpos\Api\Data\Cart\CheckoutInterface
//     */
//    public function getQuoteData();
//
//    /**
//     * Set quote data
//     *
//     * @api
//     * @param \Magestore\Webpos\Api\Data\Cart\CheckoutInterface $quoteData
//     * @return $this
//     */
//    public function setQuoteData($quoteData);
}
