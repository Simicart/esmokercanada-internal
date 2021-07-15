<?php
namespace Magenest\UltimateFollowupEmail\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Sales\Model\OrderFactory;
use Magento\Wishlist\Model\WishlistFactory;

class WishlistHelper extends AbstractHelper
{
    /**
     * @var WishlistFactory
     */
    protected $wishlistFactory;

    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    public function __construct(
        Context $context,
        WishlistFactory $wishlistFactory,
        OrderFactory $orderFactory
    ) {
        parent::__construct($context);
        $this->wishlistFactory = $wishlistFactory;
        $this->orderFactory = $orderFactory;
    }

    public function getCustomersWishlist()
    {
        $resource = $this->orderFactory->create()->getResource();
        $connection = $resource->getConnection();
        $select = $connection->select();
        $wishlistTable = $resource->getTable('wishlist');
        $wishlistItemTable = $resource->getTable('wishlist_item');
        $select->from(
            ['wishlist' => $wishlistTable],
            ['customer_id' ,'wishlist_id', 'updated_at']
        );
        $rows = $connection->fetchAll($select);
        return $rows;
    }

    public function getCustomersProductWishlist()
    {
        $resource = $this->orderFactory->create()->getResource();
        $connection = $resource->getConnection();
        $select = $connection->select();
        $wishlistTable = $resource->getTable('wishlist');
        $wishlistItemTable = $resource->getTable('wishlist_item');
        $select->from(
            ['wishlist' => $wishlistTable],
            ['customer_id' ,'wishlist_id', 'updated_at']
        )->join(
            ['wishlist_item' => $wishlistItemTable],
            'wishlist.wishlist_id = wishlist_item.wishlist_id',
            ['product_id', 'added_at', 'wishlist_item_id']
        );
        $rows = $connection->fetchAll($select);
        foreach ($rows as $key => $row) {
            if ($this->isBought($row['product_id'], $row['customer_id'])) {
                unset($rows[$key]);
            }
        }
        return $rows;
    }


    protected function isBought($productId, $customerId)
    {
        $resource = $this->orderFactory->create()->getResource();
        $connection = $resource->getConnection();
        $select = $connection->select();
        $orderTable = $resource->getTable('sales_order');
        $orderItemTable = $resource->getTable('sales_order_item');
        $select->from(
            ['sales_order_item' => $orderItemTable]
        )->join(
            ['sales_order' => $orderTable],
            'sales_order.entity_id = sales_order_item.order_id'
        )->where(
            'sales_order.customer_id = ?',
            $customerId
        )->where(
            'sales_order_item.product_id = ?',
            $productId
        );
        $rows = $connection->fetchAll($select);
        if (count($rows) > 0) {
            return true;
        }
        return false;
    }
}
