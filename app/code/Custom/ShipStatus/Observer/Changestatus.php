<?php
namespace Custom\ShipStatus\Observer;
use Magento\Sales\Model\Order;

class Changestatus implements \Magento\Framework\Event\ObserverInterface
{
  public function execute(\Magento\Framework\Event\Observer $observer)
  {
  	//$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/templog.log');
	//$logger = new \Zend\Log\Logger();
	//$logger->addWriter($writer);
	  $shipment = $observer->getEvent()->getShipment();
	  $order = $shipment->getOrder();
	  //$orderId = $order->getIncrementId();
      $id = $order->getId();
      //$logger->info($id);
	  $orderState = 'complete';
	  $status = 'complete';
	  $order->setState($orderState)->setStatus($status);
	  $this->testUpdate($id);
	  $order->save();
  }
  public function testUpdate($orderId)
  {
  	  $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
      $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
      $connection = $resource->getConnection();
      $tableName = $resource->getTableName('sales_order');
      $sql = "UPDATE " . $tableName . " SET status = 'complete', state = 'complete' WHERE entity_id = " . $orderId;
      $connection->query($sql);
  }
}