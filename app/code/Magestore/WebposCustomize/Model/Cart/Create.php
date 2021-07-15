<?php

/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

namespace Magestore\WebposCustomize\Model\Cart;

use Magestore\Webpos\Api\Data\Cart\QuoteDataInterface;

class Create extends \Magestore\Webpos\Model\Cart\Create implements \Magestore\WebposCustomize\Api\Cart\CheckoutInterface
{
    /**
     * @param $sections
     * @param $model
     * @return array
     */
    protected function getQuoteData($sections = null)
    {
        $quoteData = $this->_objectManager->create('Magestore\Webpos\Model\Cart\Data\Checkout');
        if (empty($sections) || $sections == \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::QUOTE_INIT ||
            (is_array($sections) && in_array(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::QUOTE_INIT, $sections))
        ) {
            $quoteData->setData(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::QUOTE_INIT,
                $this->getQuoteInitData());
        }
        if (empty($sections) || $sections == \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::ITEMS ||
            (is_array($sections) && in_array(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::ITEMS, $sections))
        ) {
            $quoteData->setData(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::ITEMS,
                $this->getQuoteItems());
        }
        if (empty($sections) || $sections == \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::TOTALS ||
            (is_array($sections) && in_array(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::TOTALS, $sections))
        ) {
            $quoteData->setData(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::TOTALS,
                $this->getCartTotals());
        }
        if (empty($sections) || $sections == \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::SHIPPING ||
            (is_array($sections) && in_array(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::SHIPPING, $sections))
        ) {
            $quoteData->setData(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::SHIPPING,
                $this->getShipping());
        }
        if (empty($sections) || $sections == \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::PAYMENT ||
            (is_array($sections) && in_array(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::PAYMENT, $sections))
        ) {
            $quoteData->setData(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::PAYMENT,
                $this->getPayment());
        }
        if ($this->_objectManager->get('\Magento\Framework\Module\Manager')->isEnabled('Magestore_Giftvoucher')) {
            if (empty($sections) || $sections == \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::GIFTCARD ||
                (is_array($sections) && in_array(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::GIFTCARD, $sections))
            ) {
                $quoteData->setData(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::GIFTCARD,
                    $this->getGiftCardDiscount());
            }
        }
        if ($this->_objectManager->get('\Magento\Framework\Module\Manager')->isEnabled('Magestore_Rewardpoints')) {
            if (empty($sections) || $sections == \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::REWARDPOINTS ||
                (is_array($sections) && in_array(\Magestore\Webpos\Api\Data\Cart\Check1outInterface::REWARDPOINTS, $sections))
            ) {
                $quoteData->setData(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::REWARDPOINTS,
                    $this->getPointsDiscount());
            }
        }
        if ($this->_objectManager->get('\Magento\Framework\Module\Manager')->isEnabled('Mirasvit_Rewards')) {
            if (empty($sections) || $sections == \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::REWARDS ||
                (is_array($sections) && in_array(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::REWARDS, $sections))
            ) {
                $quoteData->setData(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::REWARDS,
                    $this->getRewardPointsDiscount());
            }
        }
        if ($this->_objectManager->get('\Magento\Framework\Module\Manager')->isEnabled('Magestore_Customercredit')) {
            if (empty($sections) || $sections == \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::STORECREDIT ||
                (is_array($sections) && in_array(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::STORECREDIT, $sections))
            ) {
                $quoteData->setData(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::STORECREDIT,
                    $this->getStorecredit());
            }
        }
        $quote = $this->getQuote();
        $this->updateWebposSessionData($quote->getStoreId(), $quote->getTillId(), $quote->getId());
        return $quoteData;
    }

    /**
     * @return array
     */
    public function getCartTotals()
    {
        $totals = $this->getAllTotals($this->getQuote());
        $totalsResult = array();
        if ($this->_objectManager->get('\Magento\Framework\Module\Manager')
            ->isEnabled('Magestore_WebposCustomize')
        ) {
            $rewardsPurchase = $this->_objectManager->create('\Mirasvit\Rewards\Helper\Purchase');
            $rewardsData = $this->_objectManager->create('\Mirasvit\Rewards\Helper\Data');
            $purchase = $rewardsPurchase->getPurchase();
            if(!$purchase){
                $purchaseFactory = $this->_objectManager->create('Mirasvit\Rewards\Model\PurchaseFactory');
                $purchase = $purchaseFactory->create();
            }
            $quote = $this->getQuote();
            $purchase->setQuote($quote);
            foreach ($totals as $total) {
                $data = $total->getData();
                switch ($total->getData('code')) {
                    case 'rewards_label':
                        if ($purchase->getEarnPoints()) {
                            $data['value'] = $purchase->getEarnPoints();
                            $data['unit'] = $rewardsData->getConfig()->getGeneralPointUnitName($quote->getStoreId());
                            $data['title'] = __('You Earn');
                            $totalsResult[] = $data;
                        }
                        break;
                    case 'rewards_spend_label':
                        if ($purchase->getSpendPoints()) {
                            $data['value'] = $purchase->getSpendPoints();
                            $data['unit'] = $rewardsData->getConfig()->getGeneralPointUnitName($quote->getStoreId());
                            $data['title'] = __('You Spend');
                            $totalsResult[] = $data;
                        }
                        break;
                    default:
                        $totalsResult[] = $data;
                }
            }
        } else {
            foreach ($totals as $total) {
                $data = $total->getData();
                $totalsResult[] = $data;
            }
        }
        return $totalsResult;
    }

    /**
     * @return array
     */
    public function getRewardPointsDiscount()
    {
        $balance = 0;
        $earnedPoint = 0;
        $usedPoint = 0;
        $maxPoint = 0;
        $discountAmount = 0;
        $rewardPoint = $this->_objectManager->create('\Magestore\WebposCustomize\Model\Response\Rewards');
        $rewardsPurchase = $this->_objectManager->create('\Mirasvit\Rewards\Helper\Purchase');
        $purchase = $rewardsPurchase->getByQuote($this->getQuote()->getId());
        if ($purchase && $this->getQuote()->getCustomerId()) {
            if ($purchase->getEarnPoints()) {
                $earnedPoint = $purchase->getEarnPoints();
            }
            if ($purchase->getSpendPoints()) {
                $usedPoint = $purchase->getSpendPoints();
                $shippingAddress = $this->getQuote()->getShippingAddress();
                if(!$this->getQuote()->isVirtual()) {
                    $discountAmount = $shippingAddress->getDiscountAmount();
                } else {
                    $discountAmount = $this->getQuote()->getBillingAddress()->getDiscountAmount();
                }
            }
            $balance = $purchase->getCustomerBalancePoints($this->getQuote()->getCustomerId());
            $maxPoint = $purchase->getSpendMaxPoints();
        }
        $rewardPoint->setEarnedPoint($earnedPoint);
        $rewardPoint->setUsedPoint($usedPoint);
        $rewardPoint->setBalance($balance);
        $rewardPoint->setMaxPoints($maxPoint);
        $rewardPoint->setDiscountAmount($discountAmount);
        return $rewardPoint;
    }

    /**
     * save shipping method
     *
     * @param string $quoteId
     * @param string $shippingMethod
     * @return \Magestore\Webpos\Api\Data\Cart\CheckoutInterface
     * @throws \Exception
     */
    public function saveShippingMethod($quoteId, $shippingMethod)
    {
        $this->initQuote($quoteId);

        $billingAddress = $this->getQuote()->getBillingAddress();
        try {
            $this->_saveShippingMethod($shippingMethod);
            $this->setBillingAddress($billingAddress);

            $extensionAttributes = $this->getQuote()->getExtensionAttributes();
            if (!$this->getQuote()->isVirtual() && $extensionAttributes && $extensionAttributes->getShippingAssignments()) {
                $shippingAssignments = $extensionAttributes->getShippingAssignments();
                if (count($shippingAssignments) == 1) {
                    $shippingAssignment = $shippingAssignments[0];
                    $shipping = $shippingAssignment->getShipping();
                    if(!empty($shipping->getMethod()) && $this->getQuote()->getItemsCount() > 0){
                        $shipping->setMethod($shippingMethod);
                    }
                }
            }

            if (!$this->getQuote()->isVirtual()) {
                $this->setShippingAddress($this->getQuote()->getShippingAddress());
                $this->getShippingAddress()->setSameAsBilling(0);
                $this->getQuote()->getShippingAddress()->setCollectShippingRates(true)
                    ->collectShippingRates();
            }

            $rewardsPurchase = $this->_objectManager->create('\Mirasvit\Rewards\Helper\Purchase');
            $purchase = $rewardsPurchase->getPurchase();
            $purchase->setQuote($this->getQuote());
            $purchase->refreshPointsNumber(true)
                ->save();

            $this->saveQuote();
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\StateException(
                __('Unable to save shipping method')
            );
        }

        $data = array(
            \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::QUOTE_INIT,
            \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::ITEMS,
            \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::PAYMENT,
            \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::TOTALS,
            \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::GIFTCARD,
            \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::REWARDPOINTS,
            \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::REWARDS,
            \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::STORECREDIT
        );
        $result = $this->getQuoteData($data);
        return $result;
    }

    /**
     * @param int $pointsAmount
     * @param string $quoteId
     * @return \Magestore\Webpos\Api\Data\Cart\CheckoutInterface
     */
    public function spendPointRewards($pointsAmount, $quoteId)
    {
        $this->initQuote($quoteId);
        $quote = $this->getQuote();

        $result = $this->_objectManager->create('Magestore\WebposCustomize\Model\Response\SpendPoint');

        $success = false;
        $message = "";

        $rewardsPurchase = $this->_objectManager->create('\Mirasvit\Rewards\Helper\Purchase');
        $rewardsData = $this->_objectManager->create('\Mirasvit\Rewards\Helper\Data');
        $purchase = $rewardsPurchase->getPurchase();
        if(!$purchase){
            $purchaseFactory = $this->_objectManager->create('Mirasvit\Rewards\Model\PurchaseFactory');
            $purchase = $purchaseFactory->create();
        }
        $purchase->setQuote($quote);

        $pointsNumber = abs((int) $pointsAmount);
        $oldPointsNumber = $purchase->getSpendPoints();

        $purchase->setSpendPoints($pointsNumber)
            ->refreshPointsNumber(true)
            ->save();

        if($purchase && $quote->getCustomerId()) {
            if($purchase->getEarnPoints()) {
                $quote->setData("rewards_earn", $purchase->getEarnPoints());
            }
            if($purchase->getSpendPoints()) {
                $quote->setData("rewards_spent", $purchase->getSpendPoints());
                $quote->setData("rewards_amount", $purchase->getSpendAmount());

                $shippingAddress = $quote->getShippingAddress();

                if(!$this->getQuote()->isVirtual()) {
                    $quote->setData("rewards_discount", $shippingAddress->getDiscountAmount());
                    $quote->setData("rewards_base_discount", $shippingAddress->getBaseDiscountAmount());
                    $this->setShippingAddress($shippingAddress);
                } else {
                    $billingAddress = $quote->getBillingAddress();
                    $quote->setData("rewards_discount", $billingAddress->getDiscountAmount());
                    $quote->setData("rewards_base_discount", $billingAddress->getBaseDiscountAmount());
                }
                $quote->setData("rewards_base_amount", $rewardsData->formatCurrency($purchase->getSpendAmount()));
            }
        }

        try {
            if ($pointsNumber) {
                $success = true;
                $message = __(
                    '%1 was applied.', $rewardsData->formatPoints($purchase->getSpendPoints())
                );
                if ($pointsNumber != $purchase->getSpendPoints()) {
                    if ($pointsNumber < $purchase->getSpendMinPoints()) {
                        $success = false;
                        $message = __(
                            'Minimum number is %1.', $rewardsData->formatPoints($purchase->getSpendMinPoints())
                        );
                    } elseif ($pointsNumber > $purchase->getSpendMaxPoints()) {
                        $success = false;
                        $message = __(
                            'Maximum number is %1.', $rewardsData->formatPoints($purchase->getSpendMaxPoints())
                        );
                    }
                }
            } else {
                $success = true;
                $message = __('%1 was canceled.', $rewardsData->getPointsName());
            }
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $success = false;
            $message = $e->getMessage();
        } catch (\Exception $e) {
            $success = false;
            $message = __('Cannot apply %1.', $rewardsData->getPointsName());
            $this->_objectManager->create('\Magento\Framework\App\Helper\Context')->getLogger()->errorException($e);
        }
        $this->saveQuote();
        $result = $this->getQuoteData();
        return $result;
    }

    /**
     * @param string $quoteId
     * @return \Magestore\Webpos\Api\Data\Cart\CheckoutInterface
     */
    public function updateRewards($quoteId) {
        $this->initQuote($quoteId);
        $this->saveQuote();
        $result = $this->getQuoteData();
        return $result;
    }

    /**
     * @param string $quoteId
     * @param \Magestore\Webpos\Api\Data\Checkout\PaymentInterface $payment
     * @param string $shippingMethod
     * @param \Magestore\Webpos\Api\Data\Cart\QuoteDataInterface $quoteData
     * @param \Magestore\Webpos\Api\Data\Cart\ActionInterface $actions
     * @param \Magestore\Webpos\Api\Data\Checkout\Integration\ModuleInterface[] $integration
     * @param \Magestore\Webpos\Api\Data\Checkout\ExtensionDataInterface[] $extensionData
     * @return \Magestore\Webpos\Api\Data\Sales\OrderInterface
     * @throws \Exception
     */
    public function placeOrder($quoteId, $payment, $shippingMethod, $quoteData, $actions, $integration, $extensionData)
    {
        $data = array('order' => new \Magento\Framework\DataObject(array(
            'quote_id' => $quoteId,
            'payment' => $payment,
            'shipping_method' => $shippingMethod,
            'quote_data' => $quoteData,
            'can_process' => true
        ))
        );
        $this->_eventManager->dispatch(\Magestore\Webpos\Api\Data\Cart\CheckoutInterface::EVENT_WEBPOS_ORDER_PLACE_BEFORE, $data);
        $this->initQuote($quoteId);
        try {
            $billingAddress = $this->getQuote()->getBillingAddress();
            if ($shippingMethod) {
                $this->_saveShippingMethod($shippingMethod);
            }
            $this->setBillingAddress($billingAddress);

            $this->_savePaymentData($payment);
            $order = $this->createOrder();
            $this->_removeSessionData($this->getSession());
            $order = $this->processOrderData($order, $extensionData);
            $order = $this->_processIntegration($order, $integration);
            $this->processActionsAfterCreateOrder($order, $actions);
            $this->_saveOrderComment($order, $quoteData->getCustomerNote());
            $order = $this->processPaymentAfterCreateOrder($order, $payment);
            $this->_eventManager->dispatch('webpos_order_sync_after', ['order' => $order]);
            $isWebVersion = $quoteData->getIsWebVersion();
            $isWebVersion = ($isWebVersion && ($isWebVersion == QuoteDataInterface::YES))?true:false;
            $paymentModel = $this->getPaymentModelByCode($payment['method']);
            if ($paymentModel && ($isWebVersion || $payment['method'] == 'authorizenet_directpost')
                && !$this->isProcessPaymentBeforeOrder($payment['method'])
            ) {
                $result['order'] = $order->getData();
                $result['payment_model'] = $payment['method'];
                $result['payment_infomation'] = $paymentModel->getRequestInformation($order);
                $result = \Zend_Json::encode($result);
            } else {
                $orderRepository = $this->_objectManager->create("Magestore\Webpos\Api\Sales\OrderRepositoryInterface");
                $order = $orderRepository->get($order->getId());

                // Francy Add
                $order = $this->_processIntegration($order, $integration);

                $result = $order;
                $this->emailSender->send($order);
            }
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\StateException(
                __($e->getMessage())
            );
        }
        $orderData = array(
            'result' => $result
        );
        $this->_eventManager->dispatch(
            \Magestore\Webpos\Api\Data\Cart\CheckoutInterface::EVENT_WEBPOS_ORDER_PLACE_AFTER, $orderData);
        return $result;
    }
}