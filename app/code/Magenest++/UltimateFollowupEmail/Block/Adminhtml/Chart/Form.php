<?php
namespace Magenest\UltimateFollowupEmail\Block\Adminhtml\Chart;

use Magenest\UltimateFollowupEmail\Model\AbandonedCartFactory;
use Magenest\UltimateFollowupEmail\Model\GuestFactory;
use Magento\Quote\Model\QuoteFactory;
use Magento\Sales\Model\Order;

/**
 * Class Form
 * @package Magenest\Xero\Block\Adminhtml\Request
 */
class Form extends \Magento\Backend\Block\Widget
{
    protected $quoteFactory;

    protected $abandonedCartFactory;

    protected $guestFactory;

    protected $abandonedCarts;

    protected $carts;

    protected $nonAbandonedCarts;

    protected $guestAbandonedCarts;

    protected $customerAbandonedCarts;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        QuoteFactory $quoteFactory,
        AbandonedCartFactory $abandonedCartFactory,
        GuestFactory $guestFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->quoteFactory = $quoteFactory;
        $this->abandonedCartFactory = $abandonedCartFactory;
        $this->guestFactory = $guestFactory;
    }

    public function getAbandonedCartData()
    {
        return [
            'Abandoned'=> $this->getAbandonedCarts(),
            'Not Abandoned'=> $this->getNonAbadonedCarts()
        ];
    }

    public function getGuestAbandonedCartData()
    {
        return [
            'Guest'=> $this->getGuestAbandonedCarts(),
            'Customer'=> $this->getCustomerAbandonedCarts()
        ];
    }

    public function getAbandonedCartLineData()
    {
        $quote = $this->quoteFactory->create();
        $resource = $quote->getResource();
        $connection = $resource->getConnection();

        $mainTable = $resource->getTable('quote');
        $followUpAbandonedCartTable = $resource->getTable('magenest_ultimatefollowupemail_guest_abandoned_cart');

        $select = $connection->select()->from(
            ['m' => $mainTable],
            ['count'=>'COUNT(m.entity_id)', 'created_at']
        )->joinLeft(
            ['a' => $followUpAbandonedCartTable],
            'm.entity_id = a.quote_id'
        )->where(
            'a.quote_id is not null'
        )->group(
            'CAST(m.created_at AS DATE)'
        )->order(
            'm.created_at DESC'
        )->limit(30);
        $rows = $connection->fetchAll($select);
        foreach ($rows as &$row) {
            $row['created_at'] = date('Y-m-d', strtotime($row['created_at']));
        }
        $rows = array_reverse($rows);
        return $rows;
    }

    public function getAbandonedCarts()
    {
        if ($this->abandonedCarts) {
            return $this->abandonedCarts;
        }
        $abadonedCarts = $this->getCustomerAbandonedCarts() + $this->getGuestAbandonedCarts();
        $this->abandonedCarts = $abadonedCarts;
        return $this->abandonedCarts;
    }

    public function getCustomerAbandonedCarts()
    {
        if ($this->customerAbandonedCarts) {
            return $this->customerAbandonedCarts;
        }
        $this->customerAbandonedCarts = $this->abandonedCartFactory->create()
            ->getCollection()
            ->addFieldToFilter('type', 'customer')
            ->count();
        return $this->customerAbandonedCarts;
    }

    public function getGuestAbandonedCarts()
    {
        if ($this->guestAbandonedCarts) {
            return $this->guestAbandonedCarts;
        }
        $this->guestAbandonedCarts = $this->abandonedCartFactory->create()
            ->getCollection()
            ->addFieldToFilter('type', ['IN'=>['anonymous','guest']])
            ->count();
        return $this->guestAbandonedCarts;
    }

    public function getCarts()
    {
        if ($this->carts) {
            return $this->carts;
        }
        $carts = $this->quoteFactory->create()
            ->getCollection()
            ->count();
        $this->carts = $carts;
        return $this->carts;
    }

    public function getNonAbadonedCarts()
    {
        if ($this->nonAbandonedCarts) {
            return $this->nonAbandonedCarts;
        }
        $this->nonAbandonedCarts = $this->getCarts() - $this->getAbandonedCarts();
        return $this->nonAbandonedCarts;
    }
}
