<?php

namespace Mageside\CanadaPostShipping\Model\Plugin\Shipping\Controller\Adminhtml\Order;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Sales\Model\Order\Shipment;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Mageside\CanadaPostShipping\Helper\Carrier;
use Mageside\CanadaPostShipping\Model\Service\RatingFactory;

/**
 * Class ShipmentLoader
 * @package Mageside\CanadaPostShipping\Model\Plugin\Shipping\Controller\Adminhtml\Order
 */
class ShipmentLoader
{
    /**
     * @var RatingFactory
     */
    protected $ratingClientFactory;
    /**
     * @var Carrier
     */
    protected $carrierHelper;

    /**
     * @var CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * @var StoreManagerInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Quote\Api\ShippingMethodManagementInterface
     */
    protected $shippingMethodManagement;

    /**
     * ShipmentLoader constructor.
     * @param RatingFactory $ratingClientFactory
     * @param Carrier $carrierHelper
     * @param CartRepositoryInterface $quoteRepository
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        RatingFactory $ratingClientFactory,
        Carrier $carrierHelper,
        CartRepositoryInterface $quoteRepository,
        ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Api\ShippingMethodManagementInterface $shippingMethodManagement
    ) {
        $this->ratingClientFactory = $ratingClientFactory;
        $this->carrierHelper = $carrierHelper;
        $this->quoteRepository = $quoteRepository;
        $this->scopeConfig = $scopeConfig;
        $this->shippingMethodManagement = $shippingMethodManagement;
    }

    /**
     * If shipping method offline get shipping methods from canada post response
     *
     * @param \Magento\Shipping\Controller\Adminhtml\Order\ShipmentLoader $subject
     * @param $result
     * @return mixed
     * @throws NoSuchEntityException
     * @throws \Magento\Framework\Exception\StateException
     */
    public function afterLoad(\Magento\Shipping\Controller\Adminhtml\Order\ShipmentLoader $subject, $result)
    {
        $order = $result->getOrder();
        if ($this->carrierHelper->canShipByCanadaPost($order)) {
            $shipment = $subject->getShipment();
            $carrierCode = \Mageside\CanadaPostShipping\Model\Carrier::CODE;
            if (empty($shipment['canadapost_shipping_method'])) {
                $methods = $this->carrierHelper->getCanadaPostShippingMethods($order);
                $method = $carrierCode . "_" . $methods[0]['code'];
            } else {
                $method = $carrierCode . "_" . $shipment['canadapost_shipping_method'];
            }
            $order->setShippingMethod($method);
        }

        return $result;
    }
}
