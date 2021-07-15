<?php
/**
 * Copyright © 2018 Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Model\Currency;

class Webservicex extends \Magento\Directory\Model\Currency\Import\Webservicex
{
    /**
     * @param $currencyFrom
     * @param $currencyTo
     * @return float|int|null
     */
    public function getCurrencyRate($currencyFrom, $currencyTo)
    {
        $rateExchange = null;
        try {
            $rateExchange = $this->_convert($currencyFrom, $currencyTo);
        } catch (\Exception $e) {
            $rateExchange = null;
        }

        return $rateExchange;
    }
}
