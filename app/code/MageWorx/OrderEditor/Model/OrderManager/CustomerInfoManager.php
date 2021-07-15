<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\OrderEditor\Model\OrderManager;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\AttributeInterfaceFactory;
use MageWorx\OrderEditor\Api\Data\OrderManager\CustomerInfoInterface;
use MageWorx\OrderEditor\Api\Data\OrderManager\CustomerInfoInterfaceFactory;
use MageWorx\OrderEditor\Api\OrderManager\CustomerInfoManagerInterface;
use MageWorx\OrderEditor\Api\CustomerInterface as OrderEditorCustomerModel;
use MageWorx\OrderEditor\Api\OrderRepositoryInterface;

/**
 * Class CustomerInfoManager
 *
 * Manage customer information of the order
 *
 * @api
 */
class CustomerInfoManager implements CustomerInfoManagerInterface
{
    /**
     * @var CustomerInfoInterfaceFactory
     */
    private $customerInfoFactory;

    /**
     * @var AttributeInterfaceFactory
     */
    private $customAttributesFactory;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var OrderEditorCustomerModel
     */
    private $customer;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * CustomerInfoManager constructor.
     *
     * @param CustomerInfoInterfaceFactory $customerInfoFactory
     * @param AttributeInterfaceFactory $customAttributesFactory
     * @param OrderRepositoryInterface $orderRepository
     * @param OrderEditorCustomerModel $customer
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        CustomerInfoInterfaceFactory $customerInfoFactory,
        AttributeInterfaceFactory $customAttributesFactory,
        OrderRepositoryInterface $orderRepository,
        OrderEditorCustomerModel $customer,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerInfoFactory     = $customerInfoFactory;
        $this->customAttributesFactory = $customAttributesFactory;
        $this->orderRepository         = $orderRepository;
        $this->customer                = $customer;
        $this->customerRepository      = $customerRepository;
    }

    /**
     * @inheritDoc
     */
    public function getCustomerInfoByOrderId(int $orderId): CustomerInfoInterface
    {
        /** @var CustomerInfoInterface $customerInfo */
        $customerInfo = $this->customerInfoFactory->create();
        $order        = $this->orderRepository->getById($orderId);

        $customerInfo->setCustomerId($order->getCustomerId() ?? 0);
        $customerInfo->setCustomerGroup($order->getCustomerGroupId());
        $customerInfo->setCustomerLastname($order->getCustomerLastname());
        $customerInfo->setCustomerFirstname($order->getCustomerFirstname());
        $customerInfo->setCustomerEmail($order->getCustomerEmail());

        return $customerInfo;
    }

    /**
     * Update information about customer
     *
     * @param int $orderId
     * @param CustomerInfoInterface $customerInfo
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function updateCustomerInfoByOrderId(
        int $orderId,
        CustomerInfoInterface $customerInfo
    ): void {
        $order      = $this->orderRepository->getById($orderId);
        $customerId = $customerInfo->getCustomerId();

        $this->customer
            ->setOrderId($order->getId());

        if ($customerId) {
            $this->customer->setCustomerId($customerId);
            if ($order->getCustomerId() !== $customerId) {
                $origCustomer = $this->customerRepository->getById($customerId);
                $customerInfo->setCustomerEmail($origCustomer->getEmail())
                    ->setCustomerFirstname($origCustomer->getFirstname())
                    ->setCustomerLastname($origCustomer->getLastname())
                    ->setCustomerGroup($origCustomer->getGroupId())
                    ->setCustomAttributes($origCustomer->getCustomAttributes());
            }
        }

        $customerData = $this->extractCustomerData($customerInfo);
        $this->customer->setCustomerData($customerData)
                       ->update();
    }

    /**
     * @param CustomerInfoInterface $customerInfo
     * @return array
     */
    protected function extractCustomerData(CustomerInfoInterface $customerInfo): array
    {
        $data = [
            'customer_firstname' => $customerInfo->getCustomerFirstname(),
            'customer_lastname'  => $customerInfo->getCustomerLastname(),
            'group_id'           => $customerInfo->getCustomerGroup(),
            'email'              => $customerInfo->getCustomerEmail(),
            'customer_id'        => $customerInfo->getCustomerId()
        ];

        $customAttributes = $customerInfo->getCustomAttributes();
        if (!empty($customAttributes)) {
            foreach ($customAttributes as $attribute) {
                $data[$attribute->getAttributeCode()] = $attribute->getValue();
            }
        }

        return $data;
    }
}
