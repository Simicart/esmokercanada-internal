<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\OrderEditor\Controller\Adminhtml\Edit;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\View\Result\PageFactory;
use MageWorx\OrderEditor\Api\OrderRepositoryInterface;
use MageWorx\OrderEditor\Api\QuoteRepositoryInterface;
use MageWorx\OrderEditor\Controller\Adminhtml\AbstractAction;
use MageWorx\OrderEditor\Helper\Data;
use MageWorx\OrderEditor\Model\InventoryDetectionStatusManager;
use MageWorx\OrderEditor\Model\MsiStatusManager;
use MageWorx\OrderEditor\Model\Payment as PaymentModel;
use MageWorx\OrderEditor\Model\Shipping as ShippingModel;
use Magento\Framework\Serialize\Serializer\Json as SerializerJson;

/**
 * Class Info
 */
class Info extends AbstractAction
{
    const ADMIN_RESOURCE = 'MageWorx_OrderEditor::edit_info';

    /**
     * @var TimezoneInterface
     */
    protected $localeDate;

    /**
     * Info constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param RawFactory $resultRawFactory
     * @param Data $helper
     * @param ScopeConfigInterface $scopeConfig
     * @param QuoteRepositoryInterface $quoteRepository
     * @param ShippingModel $shipping
     * @param PaymentModel $payment
     * @param OrderRepositoryInterface $orderRepository
     * @param MsiStatusManager $msiStatusManager
     * @param InventoryDetectionStatusManager $inventoryDetectionStatusManager
     * @param SerializerJson $serializer
     * @param TimezoneInterface $timezone
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        RawFactory $resultRawFactory,
        Data $helper,
        ScopeConfigInterface $scopeConfig,
        QuoteRepositoryInterface $quoteRepository,
        ShippingModel $shipping,
        PaymentModel $payment,
        OrderRepositoryInterface $orderRepository,
        MsiStatusManager $msiStatusManager,
        InventoryDetectionStatusManager $inventoryDetectionStatusManager,
        SerializerJson $serializer,
        TimezoneInterface $timezone
    ) {
        parent::__construct(
            $context,
            $resultPageFactory,
            $resultRawFactory,
            $helper,
            $scopeConfig,
            $quoteRepository,
            $shipping,
            $payment,
            $orderRepository,
            $msiStatusManager,
            $inventoryDetectionStatusManager,
            $serializer
        );
        $this->localeDate = $timezone;
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     * @throws \Exception
     */
    protected function update()
    {
        $order    = $this->loadOrder();
        $params   = $this->getRequest()->getParams();
        $infoData = !empty($params['order']['info']) ? $params['order']['info'] : [];
        if (isset($infoData['created_at'])) {
            $createdAt = $this->localeDate->date(
                $infoData['created_at'],
                null,
                false
            );
            $newCreatedAt = $this->localeDate->scopeDate($order->getStoreId());
            $newCreatedAt->setDate(
                $createdAt->format('Y'),
                $createdAt->format('m'),
                $createdAt->format('d')
            );
            $newCreatedAt->setTime(
                $createdAt->format('H'),
                $createdAt->format('i'),
                $createdAt->format('s')
            );
            $newCreatedAt = $newCreatedAt->setTimezone(new \DateTimeZone('UTC'));
            $infoData['created_at'] = $newCreatedAt->format('U');
        }
        $order->addData($infoData);
        $order->setCreatedAt($newCreatedAt);
        try {
            $this->orderRepository->save($order);
        } catch (\Exception $e) {
            $this->getMessageManager()->addErrorMessage($e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    protected function prepareResponse(): string
    {
        return static::ACTION_RELOAD_PAGE;
    }
}
