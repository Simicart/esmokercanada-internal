<?php

/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
namespace Magestore\Webpos\Model\Sales\Order;

use Magento\Sales\Model\ResourceModel\Metadata as Metadata;;
use Magento\Sales\Api\Data\CreditmemoSearchResultInterfaceFactory as SearchResultFactory;

/**
 * Repository class for @see \Magento\Sales\Api\Data\CreditmemoInterface
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class CreditmemoRepository extends \Magento\Sales\Model\Order\CreditmemoRepository
    implements \Magestore\Webpos\Api\Sales\CreditmemoRepositoryInterface
{
    /**
     * @var Metadata
     */
    protected $metadata;

    /**
     * @var SearchResultFactory
     */
    protected $searchResultFactory = null;

    /**
     * @var \Magento\Sales\Controller\Adminhtml\Order\CreditmemoLoader
     */
    protected $creditmemoLoader;

    /**
     * @var \Magento\Sales\Api\CreditmemoManagementInterface
     */
    protected $creditmemoManagement;

    /**
     * @var \Magento\Sales\Model\Order\Email\Sender\CreditmemoSender
     */
    protected $creditmemoSender;

    /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    protected $orderRepository;

    /**
     * @var \Magestore\Webpos\Helper\Currency
     */
    protected $currencyHelper;

    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $productFactory;

    /**
     * CreditmemoRepository constructor.
     * @param Metadata $metadata
     * @param SearchResultFactory $searchResultFactory
     * @param \Magento\Sales\Controller\Adminhtml\Order\CreditmemoLoader $creditmemoLoader
     * @param \Magento\Sales\Api\CreditmemoManagementInterface $creditmemoManagement
     * @param \Magento\Sales\Model\Order\Email\Sender\CreditmemoSender $creditmemoSender
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        Metadata $metadata,
        SearchResultFactory $searchResultFactory,
        \Magento\Sales\Controller\Adminhtml\Order\CreditmemoLoader $creditmemoLoader,
        \Magento\Sales\Api\CreditmemoManagementInterface $creditmemoManagement,
        \Magento\Sales\Model\Order\Email\Sender\CreditmemoSender $creditmemoSender,
        \Magestore\Webpos\Api\Sales\OrderRepositoryInterface $orderRepository,
        \Magestore\Webpos\Helper\Currency $currencyHelper,
        \Magento\Catalog\Model\ProductFactory $productFactory
    ) {
        $this->metadata = $metadata;
        $this->searchResultFactory = $searchResultFactory;
        $this->creditmemoLoader = $creditmemoLoader;
        $this->creditmemoManagement = $creditmemoManagement;
        $this->creditmemoSender = $creditmemoSender;
        $this->orderRepository = $orderRepository;
        $this->currencyHelper = $currencyHelper;
        $this->productFactory = $productFactory;
    }

    /**
     * Performs persist operations for a specified credit memo.
     *
     * @param \Magento\Sales\Api\Data\CreditmemoInterface $entity The credit memo.
     * @return \Magestore\Webpos\Api\Data\Sales\OrderInterface Order interface.
     */
    public function saveCreditmemo(\Magento\Sales\Api\Data\CreditmemoInterface $entity){
        $data = $this->prepareCreditmemo($entity);
        $this->creditmemoLoader->setOrderId($data['order_id']);
        $this->creditmemoLoader->setCreditmemo($data['creditmemo']);
        $creditmemo = $this->creditmemoLoader->load();
        if ($creditmemo) {
            if (!$creditmemo->isValidGrandTotal()) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('The credit memo\'s total must be positive.')
                );
            }
            if (!empty($data['creditmemo']['comment_text'])) {
                $creditmemo->addComment(
                    $data['creditmemo']['comment_text'],
                    isset($data['creditmemo']['comment_customer_notify']),
                    true
                );
                if(isset($data['creditmemo']['comment_text']))
                    $creditmemo->setCustomerNote($data['creditmemo']['comment_text']);
                if(isset($data['creditmemo']['comment_customer_notify']))
                    $creditmemo->setCustomerNoteNotify(isset($data['comment_customer_notify']));
            }
            $this->creditmemoManagement->refund($creditmemo, true, !empty($data['creditmemo']['send_email']));

            if (!empty($data['creditmemo']['send_email'])) {
                $this->creditmemoSender->send($creditmemo);
            }
        }
        return $this->orderRepository->get($data['order_id']);
    }

    /**
     * @param \Magento\Sales\Api\Data\CreditmemoInterface $entity
     * @return array
     */
    protected function prepareCreditmemo(\Magento\Sales\Api\Data\CreditmemoInterface $entity){
        $data = [];
        $items = $entity->getItems();
        $orderId = $entity->getOrderId();
        if(count($items>0) && $orderId){
            $data['order_id'] = $orderId;
            $creditmemo = [];
            foreach ($items as $item){
                $creditmemo['items'][$item->getOrderItemId()]['qty'] = $item->getQty();
                if($item->getAdditionalData() == 'back_to_stock') {
                    $creditmemo['items'][$item->getOrderItemId()]['back_to_stock'] = 1;
                }
                
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
                $resource = $objectManager->create('Magento\Sales\Model\Order')->load($entity->getOrderId());           
                $allItem = $resource->getAllItems();
                $bundle = false;
                foreach($allItem as $itemx){
                    if($itemx->getItemId() == $item->getOrderItemId() ){
                        if($itemx->getProductType() == "bundle"){
                            $bundle = true;
                        }
                    }
                    if(($bundle == true) && ($itemx->getParentItemId() == $item->getOrderItemId())){
                                        
                        $creditmemo['items'][$itemx->getItemId()]['qty'] = $itemx->getQtyOrdered()/$item->getQty();
                        if($item->getAdditionalData() == 'back_to_stock') {
                            $creditmemo['items'][$itemx->getItemId()]['back_to_stock'] = 1;
                        }
                    }
                }
                if($bundle == true){
                    //unset($creditmemo['items'][$item->getOrderItemId()]);
                }
            }
 
            $creditmemo['send_email'] = $entity->getEmailSent();
            $comments = $entity->getComments();
            if(count($comments) && $comment = $comments[0]){
                $creditmemo['comment_text'] = $comment->getComment();
                if($creditmemo['send_email'])
                    $creditmemo['comment_customer_notify'] = 1;
            }
            $baseCurrencyCode = $entity->getBaseCurrencyCode();
            $storeCurrencyCode = $entity->getStoreCurrencyCode();
            $creditmemo['shipping_amount'] = $this->currencyHelper->currencyConvert($entity->getShippingAmount(), $storeCurrencyCode, $baseCurrencyCode);
            $creditmemo['adjustment_positive'] = $this->currencyHelper->currencyConvert($entity->getAdjustmentPositive(), $storeCurrencyCode, $baseCurrencyCode);
            $creditmemo['adjustment_negative'] = $this->currencyHelper->currencyConvert($entity->getAdjustmentNegative(), $storeCurrencyCode, $baseCurrencyCode);
            $data['creditmemo'] = $creditmemo;
            return $data;
        }
    }
}
