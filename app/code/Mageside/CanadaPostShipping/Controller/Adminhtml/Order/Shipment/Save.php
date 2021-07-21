<?php
namespace Mageside\CanadaPostShipping\Controller\Adminhtml\Order\Shipment;

use Magento\Framework\Controller\ResultFactory;
use Magento\Sales\Model\Order\Shipment\Validation\QuantityValidator;

class Save extends \Magento\Shipping\Controller\Adminhtml\Order\Shipment\Save
{

    /**
     * Save shipment and order in one transaction
     *
     * @param \Magento\Sales\Model\Order\Shipment $shipment
     * @return \Magento\Shipping\Controller\Adminhtml\Order\Shipment\Save
     */
    protected function _saveShipment($shipment)
    {
        /**
         * Return origin shipping method
         */
        $originalShipmentMethod = $shipment->getOrder()->getOrigData('shipping_method');
        $shipment->getOrder()->setShippingMethod($originalShipmentMethod);

        $shipment->getOrder()->setIsInProcess(true);
        $transaction = $this->_objectManager->create(
            \Magento\Framework\DB\Transaction::class
        );
        $transaction->addObject(
            $shipment
        )->addObject(
            $shipment->getOrder()
        )->save();

        return $this;
    }
}
