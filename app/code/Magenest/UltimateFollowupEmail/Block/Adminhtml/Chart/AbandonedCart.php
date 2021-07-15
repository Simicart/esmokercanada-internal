<?php
namespace Magenest\UltimateFollowupEmail\Block\Adminhtml\Chart;

use Magenest\UltimateFollowupEmail\Model\AbandonedCartFactory;
use Magenest\UltimateFollowupEmail\Model\GuestFactory;
use Magenest\UltimateFollowupEmail\Setup\UpgradeSchema;
use Magento\Framework\DB\Select;
use Magento\Framework\Stdlib\DateTime;
use Magento\Quote\Model\QuoteFactory;
use Magento\Sales\Model\Order;

/**
 * Class Form
 * @package Magenest\Xero\Block\Adminhtml\Request
 */
class AbandonedCart extends \Magento\Backend\Block\Widget
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
    )
    {
        parent::__construct($context, $data);
        $this->quoteFactory = $quoteFactory;
        $this->abandonedCartFactory = $abandonedCartFactory;
        $this->guestFactory = $guestFactory;
    }

    public function getAbandonedCartData()
    {
        return [
            'Abandoned' => $this->getAbandonedCarts(),
            'Not Abandoned' => $this->getNonAbadonedCarts()
        ];
    }

    public function getGuestAbandonedCartData()
    {
        return [
            'Guest' => $this->getGuestAbandonedCarts(),
            'Customer' => $this->getCustomerAbandonedCarts()
        ];
    }

    public function getAbandonedCartLineData()
    {
        $quote = $this->quoteFactory->create();
        $quoteCollection = $quote->getCollection();
        $followUpAbandonedCartTable = $quoteCollection->getTable('magenest_ultimatefollowupemail_guest_abandoned_cart');
        $this->applyPeriodToCollection($quoteCollection, ['created_at', 'updated_at']);
        $select = $quoteCollection->getSelect()->reset(Select::COLUMNS)
            ->joinLeft(
                ['a' => $followUpAbandonedCartTable],
                'main_table.entity_id = a.quote_id',
                []
            )->where(
                'a.quote_id is not null'
            )->group(
                'main_table.created_at'
            )->order(
                'main_table.created_at ASC'
            )->columns([
                'COUNT(main_table.entity_id) as count',
                'created_at' => new \Zend_Db_Expr('CAST(main_table.created_at AS DATE)'),
                'updated_at' => new \Zend_Db_Expr('CAST(main_table.created_at AS DATE)')
            ]);
        $rows = $quote->getResource()->getConnection()->fetchAll($select);
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
        $cartModel = $this->abandonedCartFactory->create();
        $collection = $cartModel->getCollection();
        $collection
            ->getSelect()
            ->joinLeft(
                ['q' => $collection->getTable('quote')],
                'main_table.quote_id = q.entity_id',
                ['created_at', 'updated_at']
            )->joinLeft(
                ['g' => $cartModel->getResource()->getTable(UpgradeSchema::CAPTURED_GUEST_TABLE)],
                'main_table.quote_id = g.quote_id',
                []
            )->where('g.email is null');
        $this->applyPeriodToCollection($collection, ['created_at', 'updated_at']);
        $this->customerAbandonedCarts = $collection->getSize();
        return $this->customerAbandonedCarts;
    }

    public function getGuestAbandonedCarts()
    {
        if ($this->guestAbandonedCarts) {
            return $this->guestAbandonedCarts;
        }
        $cartModel = $this->abandonedCartFactory->create();
        $collection = $cartModel->getCollection();
        $collection
            ->getSelect()
            ->joinLeft(
                ['q' => $collection->getTable('quote')],
                'main_table.quote_id = q.entity_id',
                ['created_at', 'updated_at']
            )->join(
                ['g' => $cartModel->getResource()->getTable(UpgradeSchema::CAPTURED_GUEST_TABLE)],
                'main_table.quote_id = g.quote_id',
                []
            );
        $this->applyPeriodToCollection($collection, ['created_at', 'updated_at']);
        $this->guestAbandonedCarts = $collection->getSize();
        return $this->guestAbandonedCarts;
    }

    public function getCarts()
    {
        if ($this->carts) {
            return $this->carts;
        }
        $carts = $this->quoteFactory->create()
            ->getCollection();
        $this->applyPeriodToCollection($carts, ['created_at', 'updated_at']);
        $this->carts = $carts->getSize();
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

    /**
     * @param \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection $collection
     * @param string|array $dateFields
     * @return \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection mixed
     */
    protected function applyPeriodToCollection($collection, $dateFields)
    {
        if (!is_array($dateFields)) {
            $dateFields = [$dateFields];
        }
        if ($from = $this->getPeriodFromParam()) {
            $fromFields = [];
            foreach ($dateFields as $field) {
                $fromFields[] = $field . " >= '" . $this->getPhpFormatDate($from) . "'";
            }
            $collection->getSelect()
                ->where(implode(' OR ', $fromFields));
        }
        if ($to = $this->getPeriodToParam()) {
            $toFields = [];
            foreach ($dateFields as $field) {
                $toFields[] = $field . " <= '" . $this->getPhpFormatDate($to) . "'";
            }
            $collection->getSelect()
                ->where(implode(' OR ', $toFields));
        }
        return $collection;
    }

    public function getPeriodFromParam()
    {
        return $this->getRequest()->getParam('from');
    }

    public function getPeriodToParam()
    {
        return $this->getRequest()->getParam('to');
    }

    public function getPhpFormatDate($date)
    {
        return date(DateTime::DATE_PHP_FORMAT, strtotime($date));
    }
}
