<?php
/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

namespace Magestore\Webpos\Model\Sales\Order;

use Magento\Sales\Api\Data\ShippingAssignmentInterface;
use Magento\Sales\Api\Data\ShippingAssignmentInterfaceFactory;
use Magento\Sales\Model\OrderFactory;

/**
 * Class ShippingAssignmentBuilder
 * @package Magento\Sales\Model\Order
 */
class ShippingAssignmentBuilder
{
    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * @var ShippingAssignmentInterfaceFactory
     */
    protected $shippingAssignmentFactory;

    /**
     * @var ShippingBuilderFactory
     */
    protected $shippingBuilderFactory;

    /**
     * @var int|null
     */
    protected $orderId = null;

    /**
     * ShippingAssignment constructor.
     *
     * @param OrderFactory $orderFactory
     * @param ShippingAssignmentInterfaceFactory $shippingAssignmentFactory
     * @param ShippingBuilderFactory $shippingBuilderFactory
     */
    public function __construct(
        OrderFactory $orderFactory,
        ShippingAssignmentInterfaceFactory $shippingAssignmentFactory,
        \Magento\Sales\Model\Order\ShippingBuilderFactory $shippingBuilderFactory
    ) {
        $this->orderFactory = $orderFactory;
        $this->shippingAssignmentFactory = $shippingAssignmentFactory;
        $this->shippingBuilderFactory = $shippingBuilderFactory;
    }

    /**
     * @param int $orderId
     * @return void
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return int|null
     */
    protected function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return ShippingAssignmentInterface[]|null
     */
    public function create()
    {
        $shippingAssignments = null;
        if ($this->getOrderId()) {
            $order = $this->orderFactory->create()->load($this->getOrderId());
            /** @var ShippingAssignmentInterface $shippingAssignment */
            $shippingAssignment =  $this->shippingAssignmentFactory->create();

            $shipping = $this->shippingBuilderFactory->create();
            $shipping->setOrderId($this->getOrderId());
            $shippingAssignment->setShipping($shipping->create());
            $shippingAssignment->setStockId($order->getStockId());
            //for now order has only one shipping assignment
            $shippingAssignments = [$shippingAssignment];
        }
        return $shippingAssignments;
    }
}
