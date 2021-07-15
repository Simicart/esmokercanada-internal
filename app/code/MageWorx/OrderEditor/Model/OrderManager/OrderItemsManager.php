<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\OrderEditor\Model\OrderManager;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\Data\CartItemInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderItemInterface;
use Magento\Sales\Model\Order\Item as OrderItemModel;
use MageWorx\OrderEditor\Api\Data\OrderManager\EditOrderItemDataInterface;
use MageWorx\OrderEditor\Api\OrderManager\OrderItemsManagerInterface;

class OrderItemsManager implements OrderItemsManagerInterface
{
    /**
     * @var \MageWorx\OrderEditor\Api\OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var \MageWorx\OrderEditor\Api\OrderItemRepositoryInterface
     */
    private $orderItemRepository;

    /**
     * @var \MageWorx\OrderEditor\Api\QuoteRepositoryInterface
     */
    private $quoteRepository;

    /**
     * @var \MageWorx\OrderEditor\Api\QuoteItemRepositoryInterface
     */
    private $quoteItemRepository;

    /**
     * @var \MageWorx\OrderEditor\Model\Edit\Quote
     */
    private $quoteEditor;

    /**
     * @var \MageWorx\OrderEditor\Model\Order\Sales
     */
    private $editOrderModel;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * OrderItemsManager constructor.
     *
     * @param \MageWorx\OrderEditor\Api\OrderRepositoryInterface $orderRepository
     * @param \MageWorx\OrderEditor\Api\OrderItemRepositoryInterface $orderItemRepository
     * @param \MageWorx\OrderEditor\Api\QuoteRepositoryInterface $quoteRepository
     * @param \MageWorx\OrderEditor\Api\QuoteItemRepositoryInterface $quoteItemRepository
     * @param \MageWorx\OrderEditor\Model\Edit\Quote $quoteEditor
     * @param \MageWorx\OrderEditor\Model\Order\Sales $editOrderModel
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     */
    public function __construct(
        \MageWorx\OrderEditor\Api\OrderRepositoryInterface $orderRepository,
        \MageWorx\OrderEditor\Api\OrderItemRepositoryInterface $orderItemRepository,
        \MageWorx\OrderEditor\Api\QuoteRepositoryInterface $quoteRepository,
        \MageWorx\OrderEditor\Api\QuoteItemRepositoryInterface $quoteItemRepository,
        \MageWorx\OrderEditor\Model\Edit\Quote $quoteEditor,
        \MageWorx\OrderEditor\Model\Order\Sales $editOrderModel,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    ) {
        $this->orderRepository     = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->quoteRepository     = $quoteRepository;
        $this->quoteItemRepository = $quoteItemRepository;
        $this->quoteEditor         = $quoteEditor;
        $this->editOrderModel      = $editOrderModel;
        $this->productRepository   = $productRepository;
    }

    /**
     * @param int $orderId
     * @return OrderItemInterface[]
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getOrderItemsByOrderId(int $orderId): array
    {
        $order      = $this->orderRepository->getById($orderId);
        $orderItems = $order->getAllItems();

        return $orderItems;
    }

    /**
     * @param int $orderId
     * @return CartItemInterface[]
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getQuoteItemsByOrderId(int $orderId): array
    {
        $order     = $this->orderRepository->getById($orderId);
        $quote     = $order->getQuote();
        $quotItems = $quote->getAllItems();

        return $quotItems;
    }

    /**
     * @inheritDoc
     */
    public function addItemToOrderById(int $orderId, CartItemInterface $item): array
    {
        $order = $this->orderRepository->getById($orderId);
        $quote = $order->getQuote();

        $sku     = $item->getSku();
        $product = $this->productRepository->get($sku);
        $options = $item->getProductOption()
            ? $this->prepareProductOptions($product, $item->getProductOption())
            : [];
        $params  = [
            $product->getId() => [
                    'qty'          => $item->getQty(),
                    'custom_price' => $item->getPrice()
                ] + $options
        ];
        $this->quoteEditor->createNewOrderItems($params, $order);

        return $quote->getAllItems();
    }

    /**
     * @inheritDoc
     */
    public function addItemsToOrderById(int $orderId, array $items): array
    {
        $order  = $this->orderRepository->getById($orderId);
        $quote  = $order->getQuote();
        $params = [];

        foreach ($items as $item) {
            $sku                       = $item->getSku();
            $product                   = $this->productRepository->get($sku);
            $options                   = $item->getProductOption()
                ? $this->prepareProductOptions($product, $item->getProductOption())
                : [];
            $params[$product->getId()] = [
                    'qty'          => $item->getQty(),
                    'custom_price' => $item->getPrice()
                ] + $options;
        }

        if (!empty($params)) {
            $this->quoteEditor->createNewOrderItems($params, $order);
        }

        return $quote->getAllItems();
    }

    /**
     * @param int $orderId
     * @param EditOrderItemDataInterface $item
     * @return OrderItemInterface[]
     * @throws \ReflectionException
     */
    public function editItem(int $orderId, EditOrderItemDataInterface $item): array
    {
        $order     = $this->orderRepository->getById($orderId);
        $orderItem = $this->orderItemRepository->getById($item->getItemId());
        $product   = $orderItem->getProduct();
        $options   = $item->getProductOption()
            ? $this->prepareProductOptions($product, $item->getProductOption())
            : [];

        $itemData = $item->asArray() + $options;

        $params['item'] = [
            $item->getItemId() => $itemData
        ];

        $params['order_id'] = $orderId;
        $order->editItems($params);

        return $order->getAllItems();
    }

    /**
     * @inheritDoc
     */
    public function removeItemFromOrderById(int $orderId, int $itemId): array
    {
        $order     = $this->orderRepository->getById($orderId);
        $orderItem = $this->orderItemRepository->getById($itemId);
        $orderItem->removeOrderItem();
        $order->collectItemsChanges($orderItem);
        $order->collectOrderTotals();
        $order->updatePayment();

        return $order->getAllItems();
    }

    /**
     * @inheritDoc
     */
    public function removeItemsFromOrderById(int $orderId, string $itemIds): array
    {
        $order        = $this->orderRepository->getById($orderId);
        $itemIdsArray = explode(',', $itemIds);
        foreach ($itemIdsArray as $itemId) {
            try {
                $orderItem = $this->orderItemRepository->getById($itemId);
                $orderItem->removeOrderItem();
                $order->collectItemsChanges($orderItem);
            } catch (NoSuchEntityException $noSuchEntityException) {
                // Do nothing for items that does not exist
            }
        }
        $order->collectOrderTotals();
        $order->updatePayment();

        return $order->getAllItems();
    }

    /**
     * Apply changes from corresponding quote to the order
     *
     * @param int $orderId
     * @return OrderInterface
     * @throws NoSuchEntityException
     * @throws LocalizedException
     * @throws \Exception
     */
    public function commit(int $orderId): OrderInterface
    {
        $order  = $this->orderRepository->getById($orderId);
        $params = $this->collectParams($order);
        $order->editItems($params);
        $updatedOrder = $this->orderRepository->getById($orderId);

        return $updatedOrder;
    }

    /**
     * @param ProductInterface $product
     * @param \Magento\Quote\Api\Data\ProductOptionInterface $productOption
     * @return array
     */
    protected function prepareProductOptions(
        \Magento\Catalog\Api\Data\ProductInterface $product,
        \Magento\Quote\Api\Data\ProductOptionInterface $productOption
    ): array {
        $options = [];
        if ($product->getTypeId() === 'configurable') {
            $configurableItemOptions = $productOption->getExtensionAttributes()
                                                     ->getConfigurableItemOptions();
            $superConfig             = [];
            foreach ($configurableItemOptions as $configurableItemOption) {
                $optionId               = $configurableItemOption->getOptionId();
                $optionValue            = $configurableItemOption->getOptionValue();
                $superConfig[$optionId] = $optionValue;
            }

            $options['super_attribute']               = $superConfig;
            $simpleProduct                            = $product->getTypeInstance()->getProductByAttributes(
                $superConfig,
                $product
            );
            $options['product_options']               = $configurableItemOptions;
            $options['product_options']['simple_sku'] = $simpleProduct->getSku();
        }

        if ($product->getTypeId() === 'bundle') {
            $bundleOptions   = $productOption->getExtensionAttributes()
                                             ->getBundleOptions();
            $bundleOption    = [];
            $bundleOptionQty = [];
            foreach ($bundleOptions as $option) {
                $bundleOption[$option->getOptionId()]    = $option->getOptionSelections();
                $bundleOptionQty[$option->getOptionId()] = $option->getOptionQty();
            }

            $options['bundle_option']     = $bundleOption;
            $options['bundle_option_qty'] = $bundleOptionQty;
            $options['product_options']   = $bundleOptions;
        }

        if ($product->hasOptions()) {
            $customOptions = $productOption->getExtensionAttributes()
                                           ->getCustomOptions();

            foreach ($customOptions as $customOption) {
                $optionValue = $customOption->getOptionValue();
                if (stripos($optionValue, ',') !== false) {
                    $optionValue = explode(',', $optionValue);
                }
                $options['options'][$customOption->getOptionId()] = $optionValue;
                $options['product_options'] = $options['options'];
            }
        }

        return $options;
    }

    /**
     * @param \MageWorx\OrderEditor\Model\Order $order
     * @return array
     */
    private function collectParams(\MageWorx\OrderEditor\Model\Order $order): array
    {
        $quote      = $order->getQuote();
        $quoteItems = $quote->getAllItems();
        $orderItems = $order->getAllItems();

        $items                    = [];
        $quoteItemsWithOrderItems = [];

        foreach ($orderItems as $orderItem) {
            $items[$orderItem->getId()] = [
                'item_type' => 'order'
            ];
            $quoteItemId                = $orderItem->getQuoteItemId();
            /** @var \MageWorx\OrderEditor\Model\Quote\Item|bool $quoteItem */
            $quoteItem = $quote->getItemById($quoteItemId);
            if ($quoteItem) {
                $quoteItemsWithOrderItems[] = $quoteItemId;
            } else {
                // Deleted order item without quote item
                $items[$orderItem->getId()]['action'] = 'remove';
            }
            $items[$orderItem->getId()]['fact_qty'] = $quoteItem ? $quoteItem->getQty() : $orderItem->getQtyOrdered();
            $items[$orderItem->getId()]['item_id']  = $orderItem->getId();
        }

        /** @var \MageWorx\OrderEditor\Model\Quote\Item $quoteItem */
        foreach ($quoteItems as $quoteItem) {
            if (in_array($quoteItem->getId(), $quoteItemsWithOrderItems)) {
                // Item already processed as order item
                continue;
            }

            $id         = 'q' . $quoteItem->getId();
            $items[$id] = [
                'item_type' => 'quote',
                'item_id'   => $quoteItem->getId(),
                'fact_qty'  => $quoteItem->getQty(),
                'sku'       => $quoteItem->getSku()
            ];

            if ($quoteItem->getParentItemId()) {
                $items[$id]['parent'] = $quoteItem->getParentItemId();
            }
        }

        return [
            'order_id' => $order->getId(),
            'item'     => $items
        ];
    }
}
