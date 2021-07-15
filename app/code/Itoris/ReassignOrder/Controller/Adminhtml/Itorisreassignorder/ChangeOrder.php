<?php
/**
 * ITORIS
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the ITORIS's Magento Extensions License Agreement
 * which is available through the world-wide-web at this URL:
 * http://www.itoris.com/magento-extensions-license.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to sales@itoris.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the extensions to newer
 * versions in the future. If you wish to customize the extension for your
 * needs please refer to the license agreement or contact sales@itoris.com for more information.
 *
 * @category   ITORIS
 * @package    ITORIS_M2_REASSIGN_ORDER
 * @copyright  Copyright (c) 2016 ITORIS INC. (http://www.itoris.com)
 * @license    http://www.itoris.com/magento-extensions-license.html  Commercial License
 */

namespace Itoris\ReassignOrder\Controller\Adminhtml\Itorisreassignorder;


class ChangeOrder extends \Magento\Backend\App\Action
{
    protected $_helperItorisData;
    public function execute()
    {
        $post = $this->getRequest()->getPost();
        $order = $this->_objectManager->create('Magento\Sales\Model\Order')->load($post['order_ids']);
        $quote = $this->_objectManager->create('Magento\Quote\Model\Quote')->load($order->getQuoteId());
        /** @var  $customer \Magento\Customer\Model\Customer */
        $customer =$this->_objectManager->get('Magento\Customer\Model\Customer');
        $customer->setWebsiteId($order->getStore()->getWebsiteId());

        $customer->loadByEmail($post['to_email']);
        if (!$customer->getId()) {
            $resource = $this->_objectManager->create('Magento\Framework\App\ResourceConnection');
            $connection = $resource->getConnection();
            $table = $resource->getTableName('customer_entity');
            $id = (int) $connection->fetchOne("select `entity_id` from {$table} where `email`='{$post['to_email']}'");
            if ($id > 0) $customer->load($id);
        }
        if(isset($post['settings']['overwrite_customer_name'])) {
            $quote->setCustomerFirstname($customer->getFirstname())
                ->setCustomerLastname($customer->getLastname())
                ->setCustomerIsGuest(false);
            $order->setCustomerFirstname($customer->getFirstname())
                ->setCustomerLastname($customer->getLastname())
                ->setCustomerIsGuest(false)
                ->addStatusHistoryComment(__('
                Order was manually reassigned to existing customer, from %1 to %2.
                Name changed from %3 to %4',$order->getBillingAddress()->getEmail(), $customer->getEmail(), $order->getBillingAddress()->getName(),$customer->getName())
                );
        }else {
            $order->addStatusHistoryComment(__('
                Order was manually reassigned to existing customer, from %1 to %2. No name changed on order.', $order->getBillingAddress()->getEmail(), $customer->getEmail())
            );
        }

        if(isset($post['settings']['notify_customer'])) {
            $store = $order->getStore();
            $this->getHelper()->startEnvironmentEmulation($store->getId());
            $websiteId = $order->getStore()->getWebsiteId();
            $template = $this->getHelper()->getEmailTemplate($store->getId());

            $templateParams = $this->getHelper()->getTemplateParams($order, $customer,$store);
            $this->getHelper()->setEmailTo($post['to_email']);
            $this->getHelper()->setName($customer->getFirstname());
            $this->getHelper()->sendEmail($customer, $template,$templateParams,$store);
            $this->getHelper()->stopEnvironmentEmulation();
        }

        $quote->setCustomerEmail($post['to_email'])
            ->setCustomerId($customer->getId())
            ->setCustomerGroupId((int)$customer->getGroupId())
            ->save();
        $order->setCustomerEmail($post['to_email'])
            ->setCustomerId($customer->getId())
            ->setCustomerGroupId((int)$customer->getGroupId())
            ->save();
        $this->getHelper()->getMessageManager()->addSuccessMessage(__('Order has been reassigned'));
        return $this->_redirect('sales/order/view',['order_id' => $post['order_ids']]);
    }
    public function getHelper() {
        if($this->_helperItorisData){
            return $this->_helperItorisData;
        }
        return $this->_helperItorisData=$this->_objectManager->create('Itoris\ReassignOrder\Helper\Data');
    }

}