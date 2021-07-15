<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\OrderEditor\Model\OrderManager;

use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use MageWorx\OrderEditor\Api\Data\OrderManager\OrderInfoInterface;
use Magento\Framework\Api\AttributeInterfaceFactory;
use MageWorx\OrderEditor\Api\Data\OrderManager\OrderInfoInterfaceFactory;
use MageWorx\OrderEditor\Api\OrderManager\OrderInfoManagerInterface;
use MageWorx\OrderEditor\Api\OrderRepositoryInterface;

/**
 * Class OrderInfoManager
 *
 * Manage order info: created at date, status, state
 *
 * @api
 */
class OrderInfoManager implements OrderInfoManagerInterface
{
    /**
     * @var OrderInfoInterfaceFactory
     */
    private $orderInfoFactory;

    /**
     * @var AttributeInterfaceFactory
     */
    private $customAttributesFactory;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var TimezoneInterface
     */
    private $timezone;

    /**
     * CustomerInfoManager constructor.
     *
     * @param OrderInfoInterfaceFactory $orderInfoFactory
     * @param AttributeInterfaceFactory $customAttributesFactory
     * @param OrderRepositoryInterface $orderRepository
     * @param TimezoneInterface $timezone
     */
    public function __construct(
        OrderInfoInterfaceFactory $orderInfoFactory,
        AttributeInterfaceFactory $customAttributesFactory,
        OrderRepositoryInterface $orderRepository,
        TimezoneInterface $timezone
    ) {
        $this->orderInfoFactory        = $orderInfoFactory;
        $this->customAttributesFactory = $customAttributesFactory;
        $this->orderRepository         = $orderRepository;
        $this->timezone                = $timezone;
    }

    /**
     * @inheritDoc
     */
    public function getOrderInfoByOrderId(int $orderId): OrderInfoInterface
    {
        /** @var OrderInfoInterface $orderInfo */
        $orderInfo      = $this->orderInfoFactory->create();
        $order          = $this->orderRepository->getById($orderId);

        $orderInfo->setCreatedAt($order->getCreatedAt());
        $orderInfo->setStatus($order->getStatus());
        $orderInfo->setState($order->getState());

        return $orderInfo;
    }

    /**
     * @inheritDoc
     */
    public function updateOrderInfoByOrderId(int $orderId, OrderInfoInterface $orderInfo): void
    {
        $order         = $this->orderRepository->getById($orderId);
        $orderInfoData = $this->extractOrderInfoData($orderInfo);
        $order->addData($orderInfoData);
        $this->orderRepository->save($order);
    }

    /**
     * @param OrderInfoInterface $orderInfo
     * @return array
     */
    private function extractOrderInfoData(OrderInfoInterface $orderInfo): array
    {
        $data = [
            'created_at' => $orderInfo->getCreatedAt(),
            'status'     => $orderInfo->getStatus(),
            'state'      => $orderInfo->getState()
        ];

        $customAttributes = $orderInfo->getCustomAttributes();
        if (!empty($customAttributes)) {
            foreach ($customAttributes as $attribute) {
                $data[$attribute->getAttributeCode()] = $attribute->getValue();
            }
        }

        $data = array_filter($data);

        return $data;
    }
}
