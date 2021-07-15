<?php
/**
* Magedelight
* Copyright (C) 2017 Magedelight <info@magedelight.com>
*
* @category Magedelight
* @package Magedelight_Monerisca
* @copyright Copyright (c) 2017 Mage Delight (http://www.magedelight.com/)
* @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
* @author Magedelight <info@magedelight.com>
*/

namespace Magedelight\Monerisca\Block;

class Form extends \Magento\Payment\Block\Form\Cc
{
    public $paymentConfig;
    public $monerisPaymentConfig;
    public $checkoutsession;
    // @codingStandardsIgnoreStart
    public $_template = 'Magedelight_Monerisca::form.phtml';
    // @codingStandardsIgnoreEnd
    public $confiprovider;
    public $config;
    public $items     = [];
   // @codingStandardsIgnoreStart
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magedelight\Monerisca\Model\ConfigProvider $configprovider,
        \Magento\Checkout\Model\Session\Proxy $checkoutsession,
        \Magento\Payment\Model\Config $paymentConfig,
        \Magedelight\Monerisca\Model\Config $monerisConfig,
        array $data = []
    ) {
    
        parent::__construct($context, $paymentConfig, $data);
        $this->paymentConfig            = $paymentConfig;
        $this->confiprovider            = $configprovider;
        $this->checkoutsession          = $checkoutsession;
        $this->monerisPaymentConfig     = $monerisConfig;
    }
 // @codingStandardsIgnoreEnd
    public function getCcAvailableTypes()
    {
        $types  = $this->paymentConfig->getCcTypes();
        $method = $this->getMethod();
        if ($method) {
            $availableTypes = $this->monerisPaymentConfig->getCcTypes();
            if ($availableTypes) {
                $availableTypes = explode(',', $availableTypes);
                foreach ($types as $code => $name) {
                    if (!in_array($code, $availableTypes)) {
                        unset($types[$code]);
                    }
                }
            }
        }

        return $types;
    }

    public function getQuoteItems()
    {
        $quote = $this->checkoutsession->getQuote();
        if ($quote && $quote->getId()) {
            $this->items = $quote->getAllItems();
        }

        return $this->items;
    }

    public function getCcMonths()
    {
        $months = $this->getData('cc_months');

        if ($months===null) {
            $months[""] = __('Month');
            $raw_data    = array_merge($months, $this->paymentConfig->getMonths());
            foreach ($raw_data as $key => $value) {
                $key++;
                $monthNum = ($key < 10) ? '0' . $key : $key;
                $months[$monthNum] = $value;
            }

            $this->setData('cc_months', $months);
        }

        return $months;
    }

    public function getSaveCardOptional()
    {
        return $this->monerisPaymentConfig->getSaveCardOptional();
    }

    public function getCcYears()
    {
        $years = $this->getData('cc_years');
        if ($years === null) {
            $years = $this->paymentConfig->getYears();
            $years = [0 => __('Year')] + $years;
            $this->setData('cc_years', $years);
        }

        return $years;
    }

    public function hasVerification()
    {
        if ($this->getMethod()) {
            $configData = $this->monerisPaymentConfig->isCardVerificationEnabled();
            if ($configData === null) {
                return true;
            }

            return $configData;
        }

        return true;
    }

    public function hasSsCardType()
    {
        $availableTypes = explode(
            ',',
            $this->monerisPaymentConfig->getCcTypes()
        );
        $ssPresenations = array_intersect(['SS', 'SM', 'SO'], $availableTypes);
        if ($availableTypes && !empty($ssPresenations)) {
            return true;
        }

        return false;
    }

    /**
     * Render block HTML.
     * @return string
     */
    public function _toHtml()
    {
        $this->_eventManager->dispatch(
            'payment_form_block_to_html_before',
            ['block' => $this]
        );

        return parent::_toHtml();
    }

    public function getCustomerSavedCards()
    {
        return $this->confiprovider->getStoredCards();
    }
}
