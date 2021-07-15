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

namespace Magedelight\Monerisca\Observer;

use Magento\Framework\Event\ObserverInterface;

class Savemonerisrelation implements ObserverInterface
{
    /**
     * @var Magedelight\Monerisca\Model\MdquotepaymentFactory
     */
    public $mdquotePaymentFactory;
    
    /**
     * @var Magedelight\Monerisca\Model\MdsalespaymentFactory
     */
    public $mdsalesPaymentFactory;

    public function __construct(
        \Magedelight\Monerisca\Model\MdquotepaymentFactory $mdquotePaymentFactory,
        \Magedelight\Monerisca\Model\MdsalesorderpaymentFactory $mdsalesPaymentFactory
    ) {
        $this->mdquotePaymentFactory = $mdquotePaymentFactory;
        $this->mdsalesPaymentFactory = $mdsalesPaymentFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $event = $observer->getEvent();
        $order = $event->getOrder();
        $payment = $order->getPayment();
        if ($payment->getMethod()==\Magedelight\Monerisca\Model\Payment::CODE) {
            $mdSalesPaymentModel = $this->mdsalesPaymentFactory->create();
            $mdSalesPaymentModel->setOrderPaymentId($payment->getId());
            $mdSalesPaymentModel->setMdMoneriscaDataKey($payment->getMdMoneriscaDataKey());
            $mdSalesPaymentModel->setTxnNumber($payment->getMoneriscaToken());
            $mdSalesPaymentModel->getResource()->save($mdSalesPaymentModel);

            $mdquotePaymentModel = $this->mdquotePaymentFactory->create();
            $quote = $event->getQuote();
            $quotePayment = $quote->getPayment();
            $mdquotePaymentModel->setQuotePaymentId($quotePayment->getId());
            $mdquotePaymentModel->setMdMoneriscaDataKey($payment->getMdMoneriscaDataKey());
            $mdquotePaymentModel->setTxnNumber($payment->getMoneriscaToken());
            $mdquotePaymentModel->getResource()->save($mdquotePaymentModel);
        }
        return $this;
    }
}
