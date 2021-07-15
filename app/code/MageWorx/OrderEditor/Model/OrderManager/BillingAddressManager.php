<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\OrderEditor\Model\OrderManager;

//use MageWorx\OrderEditor\Api\Data\OrderManager\BillingAddressDataInterface;
use Magento\Sales\Api\Data\OrderAddressInterface as BillingAddressDataInterface;
use Magento\Sales\Api\OrderAddressRepositoryInterface;
use MageWorx\OrderEditor\Api\OrderManager\BillingAddressManagerInterface;
use MageWorx\OrderEditor\Api\OrderRepositoryInterface;

/**
 * Class BillingAddressManager
 *
 * Manage billing address of the order
 *
 * @api
 */
class BillingAddressManager implements BillingAddressManagerInterface
{
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var OrderAddressRepositoryInterface
     */
    private $orderAddressRepository;

    /**
     * BillingAddressManager constructor.
     *
     * @param OrderRepositoryInterface $orderRepository
     * @param OrderAddressRepositoryInterface $orderAddressRepository
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        OrderAddressRepositoryInterface $orderAddressRepository
    ) {
        $this->orderRepository        = $orderRepository;
        $this->orderAddressRepository = $orderAddressRepository;
    }

    /**
     * @inheritDoc
     */
    public function getBillingAddressByOrderId(int $orderId): BillingAddressDataInterface
    {
        $order          = $this->orderRepository->getById($orderId);
        $billingAddress = $order->getBillingAddress();

        return $billingAddress;
    }

    /**
     * @inheritDoc
     */
    public function updateBillingAddressDataByOrderId(
        int $orderId,
        BillingAddressDataInterface $billingAddressData
    ): void {
        $order = $this->orderRepository->getById($orderId);

        /** Set default values */
        /** @var \Magento\Sales\Model\Order\Address $billingAddressData */
        $billingAddressData->setAddressType('billing')
                           ->setParentId($order->getId());

        /** Update data in original address entity */
        /** @var \Magento\Sales\Model\Order\Address $billingAddressOriginal */
        $billingAddressOriginal = $order->getBillingAddress();
        $billingAddressOriginal->addData($billingAddressData->getData());

        $this->orderAddressRepository->save($billingAddressOriginal);

        $order->setBillingAddress($billingAddressData);
        $this->orderRepository->save($order);
    }
}
