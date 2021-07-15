<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 09/12/2016
 * Time: 15:29
 */

namespace Magenest\UltimateFollowupEmail\Model\Processor;

class Downloadable extends UltimateFollowupEmail
{

    protected $order;

    protected $linkBean;
    protected $type = 'order_updated_item';

    /**
     * build email target and
     *
     * @return mixed
     */
    public function run()
    {
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();

        /** @var  \Magenest\UltimateFollowupEmail\Model\Aggregator\DownloadableLink  $aggregator */
        $aggregator = $objectManager->create('Magenest\UltimateFollowupEmail\Model\Aggregator\DownloadableLink');

        $orderRows = $aggregator->collect();

        $linkModel = $objectManager->create('Magenest\UltimateFollowupEmail\Model\Link');


        foreach ($orderRows as $orderRow) {
            $order = $objectManager->create('Magento\Sales\Model\Order')->load($orderRow['entity_id']);

            $this->order = $order;

            $this->_emailTarget = $order;

            $customerEmail = $order->getCustomerEmail();
            $firstName     = $order->getCustomerFirstname();
            $lastName      = $order->getCustomerLastname();
            $this->_emailTarget->setData('customer_email', $customerEmail);

            $this->_emailTarget->setData('customer_firstname', $firstName);
            $this->_emailTarget->setData('customer_lastname', $lastName);
            $linkId = $orderRow['link_id'];
            $this->linkBean = $linkModel->load($linkId);
            $this->createFollowUpEmail();
            $this->linkBean->addData(['state' =>'complete'])->save();
        }
    }

    public function isValidate($rule)
    {
        return true;
    }
    public function getDuplicatedKey()
    {
        return $this->_emailTarget->getId(). $this->linkBean->getId();
    }

    public function prepareMail()
    {
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();
        $orderHelper = $objectManager->create('Magenest\UltimateFollowupEmail\Helper\Order');

        $downloadLink = $orderHelper->getDownloadableLink($this->linkBean);
        $this->_vars = [
            'order'            => $this->order,
            'downloadLink'     => $downloadLink,
            'customerFistName' => $this->order->getCustomerFirstname(),
            'customerLastName' => $this->order->getCustomerLastname(),
            'customerName'     => $this->order->getCustomerFirstname() .' '.$this->order->getCustomerLastname()
        ];
    }

    public function postCreateMail()
    {
        // TODO: Implement postCreateMail() method.
    }
}
