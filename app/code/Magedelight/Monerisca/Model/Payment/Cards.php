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

namespace Magedelight\Monerisca\Model\Payment;

use Magento\Framework\Exception\LocalizedException;

class Cards
{
    const CARDS_NAMESPACE           = 'md_monerisca_cards';
    const CARD_ID_KEY               = 'id';
    const CARD_PROCESSED_AMOUNT_KEY = 'processed_amount';
    const CARD_CAPTURED_AMOUNT_KEY  = 'captured_amount';
    const CARD_REFUNDED_AMOUNT_KEY  = 'refunded_amount';

    /**
     * Cards information.
     *
     * @var mixed
     */
    public $cards = [];

    /**
     * Payment instance.
     */
    public $payment = null;

     /**
      *
      * @var type
      */
    public $objectFactory;

    /**
     * @param \Magento\Framework\DataObjectFactory $objectFactory
     */
    public function __construct(
        \Magento\Framework\DataObjectFactory $objectFactory
    ) {
        
        $this->objectFactory     = $objectFactory;
    }
    /**
     * Set payment instance for storing credit card information and partial authorizations.
     */
    public function setPayment(\Magento\Sales\Model\Order\Payment $payment)
    {
        $this->payment = $payment;

       $paymentCardsInformation = $this->payment->getAdditionalInformation(self::CARDS_NAMESPACE);
        if ($paymentCardsInformation) {
            $this->cards = $paymentCardsInformation;
        } else {
           $additionalInformations = $this->payment->getAdditionalInformation();
            $additionalCardInfo = [];
            foreach ($additionalInformations as $key => $value) {
                $additionalInfo[$key] = $value;
            }
            if (isset($additionalInfo["id"])) {
                $additionalCardInfo[$additionalInfo["id"]] = $additionalInfo;
            }
            $paymentCardsInformation = $additionalCardInfo;
            if ($paymentCardsInformation) {
                $this->cards = $paymentCardsInformation;
            }
        }
        return $this;
    }

    /**
     * Add based on $cardInfo card to payment and return Id of new item.
     *
     * @param mixed $cardInfo
     *
     * @return string
     */
    public function registerCard($cardInfo = [])
    {
        $this->_isPaymentValid();
        $cardId                      = hash('sha256', microtime(1));
        $cardInfo[self::CARD_ID_KEY] = $cardId;
        $this->cards[$cardId]       = $cardInfo;
        $this->payment->setAdditionalInformation(
            self::CARDS_NAMESPACE,
            $this->cards
        );

        return $this->getCard($cardId);
    }

    /**
     * Save data from card object in cards storage.
     */
    public function updateCard($card)
    {
        $cardId = $card->getData(self::CARD_ID_KEY);
        if ($cardId && isset($this->cards[$cardId])) {
            $this->cards[$cardId] = $card->getData();
            $this->payment->setAdditionalInformation(
                self::CARDS_NAMESPACE,
                $this->cards
            );
        }

        return $this;
    }

    /**
     * Retrieve card by ID.
     *
     * @param string $cardId
     *
     * @return Varien_Object|bool
     */
    public function getCard($cardId)
    {
        if (isset($this->cards[$cardId])) {
            $card = $this->objectFactory->create()->setData($this->cards[$cardId]);

            return $card;
        }

        return false;
    }

    /**
     * Get all stored cards.
     *
     * @return array
     */
    public function getCards()
    {
        $this->_isPaymentValid();
        $cards = [];
        foreach (array_keys($this->cards) as $key) {
            $cards[$key] = $this->getCard($key);
        }

        return $cards;
    }

    /**
     * Return count of saved cards.
     *
     * @return int
     */
    public function getCardsCount()
    {
        $this->_isPaymentValid();

        return count($this->cards);
    }

    /**
     * Return processed amount for all cards.
     *
     * @return float
     */
    public function getProcessedAmount()
    {
        return $this->_getAmount(self::CARD_PROCESSED_AMOUNT_KEY);
    }

    /**
     * Return captured amount for all cards.
     *
     * @return float
     */
    public function getCapturedAmount()
    {
        return $this->_getAmount(self::CARD_CAPTURED_AMOUNT_KEY);
    }

    /**
     * Return refunded amount for all cards.
     *
     * @return float
     */
    public function getRefundedAmount()
    {
        return $this->_getAmount(self::CARD_REFUNDED_AMOUNT_KEY);
    }

    /**
     * Remove all cards from payment instance.
     */
    public function flushCards()
    {
        $this->cards = [];
        $this->payment->setAdditionalInformation(self::CARDS_NAMESPACE, null);

        return $this;
    }

    /**
     * Check for payment instace present.
     *
     * @throws Exception
     */
    // @codingStandardsIgnoreStart
    public function _isPaymentValid()
    {
        if (!$this->payment) {
            throw new LocalizedException(new \Magento\Framework\Phrase(__('Payment instance is not set')));
        }
    }
// @codingStandardsIgnoreEnd
    /**
     * Return total for cards data fields.
     *
     * $param string $key
     *
     * @return float
     */
    public function _getAmount($key)
    {
        $amount = 0;
        foreach ($this->cards as $card) {
            if (isset($card[$key])) {
                $amount += $card[$key];
            }
        }

        return $amount;
    }
}
