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

class Info extends \Magento\Payment\Block\Info\Cc
{
    /**
     * Payment config model.
     * @var \Magento\Payment\Model\Config
     */
    public $isCheckoutProgressBlockFlag = true;
    public $monerisHelper;
    public $paymentConfig;
    public $paymentModel;
    public $monerisConfig;
    // @codingStandardsIgnoreStart
    public $_template                    = 'Magedelight_Monerisca::info.phtml';
     // @codingStandardsIgnoreEnd
    public $cardpayment;
    public $storeManager;
    public $currencyHelper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Payment\Model\Config $paymentConfig
     * @param \Magedelight\Monerisca\Model\Config $monerisConfig
     * @param \Magento\Store\Model\StoreManager $storeManager
     * @param \Magedelight\Monerisca\Model\Payment\Cards $cardpayment
     * @param \Magento\Sales\Model\Order\Payment\Transaction $payment
     * @param \Magedelight\Monerisca\Helper\Data $monerisHelper
     * @param \Magento\Framework\Pricing\Helper\Data $currencyHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Payment\Model\Config $paymentConfig,
        \Magedelight\Monerisca\Model\Config $monerisConfig,
        \Magento\Store\Model\StoreManager $storeManager,
        \Magedelight\Monerisca\Model\Payment\Cards $cardpayment,
        \Magento\Sales\Model\Order\Payment\Transaction $payment,
        \Magedelight\Monerisca\Helper\Data $monerisHelper,
        \Magento\Framework\Pricing\Helper\Data $currencyHelper,
        array $data = []
    ) {
    
        $this->storeManager       = $storeManager;
        $this->paymentConfig     = $paymentConfig;
        $this->monerisConfig = $monerisConfig;
        $this->paymentModel       = $payment;
        $this->cardpayment        = $cardpayment;
        $this->currencyHelper     = $currencyHelper;
        $this->monerisHelper  = $monerisHelper;
        parent::__construct($context, $paymentConfig, $data);
    }

    public function setCheckoutProgressBlock($flag)
    {
        $this->isCheckoutProgressBlockFlag = $flag;

        return $this;
    }

    public function getSpecificInformation()
    {
        return $this->_prepareSpecificInformation()->getData();
    }

    public function getCards()
    {
      
        $this->cardpayment->setPayment($this->getInfo());
        $cardsData = $this->cardpayment->getCards();
        $cards     = [];
        if (is_array($cardsData)) {
            foreach ($cardsData as $cardInfo) {
                $lastTransactionId = $this->getData('info')->getData('cc_trans_id');
                $cardTransactionId = $cardInfo->getTransactionId();
                if ($lastTransactionId == $cardTransactionId) {
                    $cards = $this->prepareData($cardInfo);
                }
            }
        }
        if ($this->getInfo()->getCcType() && $this->isCheckoutProgressBlockFlag
            && empty($cards)) {
            $cards[] = $this->getSpecificInformation();
        }

        return $cards;
    }

    public function prepareData($cardInfo)
    {
       
        $data = [];
        if ($cardInfo->getProcessedAmount()) {
            $amount                   = $this->currencyHelper->currency(
                $cardInfo->getProcessedAmount(),
                true,
                false
            );
            $data['Processed Amount'] = $amount;
        }

        if ($cardInfo->getBalanceOnCard() && is_numeric($cardInfo->getBalanceOnCard())) {
            $balance                   = $this->currencyHelper->currency(
                $cardInfo->getBalanceOnCard(),
                true,
                false
            );
            $data['Remaining Balance'] = $balance;
        }
        if ($this->monerisHelper->checkAdmin()) {
            $data = $this->getDataOutput($data, $cardInfo);
        }

        $this->setCardInfoObject($cardInfo);

        $cards[]                           = array_merge(
            $this->getSpecificInformation(),
            $data
        );
        $this->unsCardInfoObject();
        $this->_paymentSpecificInformation = null;
        return $cards;
    }

    public function getDataOutput($data, $cardInfo)
    {
        if ($cardInfo->getApprovalCode() && is_string($cardInfo->getApprovalCode())) {
              $data['Approval Code'] = $cardInfo->getApprovalCode();
        }

        if ($cardInfo->getMethod() && is_numeric($cardInfo->getMethod())) {
            $data['Method'] = ($cardInfo->getMethod() == 'CC') ? __('Credit Card')
                : __('eCheck');
        }

        if ($cardInfo->getLastTransId() && $cardInfo->getLastTransId()) {
            $data['Transaction Id'] = str_replace(['-capture',
            '-void', '-refund'], '', $cardInfo->getLastTransId());
        }

        if ($cardInfo->getAvsResultCode() && is_string($cardInfo->getAvsResultCode())) {
            $data['AVS Response'] = $cardInfo->getAvsResultCode();
        }

        if ($cardInfo->getCVNResultCode() && is_string($cardInfo->getCVNResultCode())) {
            $data['CVN Response'] = $cardInfo->getCVNResultCode();
        }

        if ($cardInfo->getCardCodeResponseCode() && is_string($cardInfo->getreconciliationID())) {
            $data['CCV Response'] = $cardInfo->getCardCodeResponseCode();
        }

        if ($cardInfo->getMerchantReferenceCode() && is_string($cardInfo->getMerchantReferenceCode())) {
            $data['Merchant Reference Code'] = $cardInfo->getMerchantReferenceCode();
        }
            return $data;
    }
}
