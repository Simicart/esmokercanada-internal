<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\OrderEditor\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Sales\Api\Data\OrderInterface;
use MageWorx\OrderEditor\Api\OrderRepositoryInterface;

class OrderManager implements \MageWorx\OrderEditor\Api\OrderManagerInterface
{
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var \MageWorx\OrderEditor\Api\RestoreQuoteInterface
     */
    private $restoreQuoteModel;

    /**
     * @var Order\Sales
     */
    private $editOrderModel;

    /**
     * OrderManager constructor.
     *
     * @param OrderRepositoryInterface $orderRepository
     * @param \MageWorx\OrderEditor\Api\RestoreQuoteInterface $restoreQuoteModel
     * @param Order\Sales $editOrderModel
     */
    public function __construct(
        \MageWorx\OrderEditor\Api\OrderRepositoryInterface $orderRepository,
        \MageWorx\OrderEditor\Api\RestoreQuoteInterface $restoreQuoteModel,
        \MageWorx\OrderEditor\Model\Order\Sales $editOrderModel
    ) {
        $this->orderRepository   = $orderRepository;
        $this->restoreQuoteModel = $restoreQuoteModel;
        $this->editOrderModel    = $editOrderModel;
    }

    /**
     * @inheritDoc
     */
    public function backupOrdersQuoteByOrderId(int $orderId): void
    {
        $order = $this->orderRepository->getById($orderId);
        $quote = $order->getQuote();
        $quote->setOrigOrderId($orderId);
        $this->restoreQuoteModel->backupInitialQuoteState($quote);
    }

    /**
     * @inheritDoc
     */
    public function restoreOrdersQuoteByOrderId(int $orderId): void
    {
        $order = $this->orderRepository->getById($orderId);
        $quote = $order->getQuote();
        $quote->setOrigOrderId($orderId);
        $this->restoreQuoteModel->restore($quote);
    }
}
