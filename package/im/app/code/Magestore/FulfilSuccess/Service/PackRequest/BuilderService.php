<?php

/**
 * Copyright © 2016 Magestore. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magestore\FulfilSuccess\Service\PackRequest;

use Magento\Sales\Api\OrderItemRepositoryInterface;
use Magestore\FulfilSuccess\Api\Data\PickRequestInterface;
use Magestore\FulfilSuccess\Api\Data\PackRequestInterface;
use Magestore\FulfilSuccess\Api\Data\PackRequestInterfaceFactory;
use Magestore\FulfilSuccess\Api\PackRequestRepositoryInterface;
use Magestore\FulfilSuccess\Api\PickRequestRepositoryInterface;
use Magestore\FulfilSuccess\Api\PickRequestItemRepositoryInterface;
use Magestore\FulfilSuccess\Service\PackRequest\PackRequestService;

class BuilderService
{
    /**
     * @var OrderItemRepositoryInterface
     */
    protected $orderItemRepository;

    /**
     * @var PackRequestInterfaceFactory 
     */
    protected $packRequestFactory;
    
    /**
     * @var PickRequestItemRepositoryInterface 
     */
    protected $pickRequestItemRepository;
    
    /**
     * @var PackRequestRepositoryInterface
     */
    protected $packRequestRepository;
    
    /**
     * @var PackRequestService 
     */
    protected $packRequestService;
    
    /**
     * @var PickRequestRepositoryInterface 
     */
    protected $pickRequestRepository;


    /**
     * BuilderService constructor.
     * @param OrderItemRepositoryInterface $orderItemRepository
     * @param PackRequestInterfaceFactory $packRequestFactory
     * @param PickRequestItemRepositoryInterface $pickRequestItemRepository
     * @param PackRequestRepositoryInterface $packRequestRepository
     * @param \Magestore\FulfilSuccess\Service\PackRequest\PackRequestService $packRequestService
     */
    public function __construct(
        OrderItemRepositoryInterface $orderItemRepository,
        PackRequestInterfaceFactory $packRequestFactory,
        PickRequestRepositoryInterface $pickRequestRepository,
        PickRequestItemRepositoryInterface $pickRequestItemRepository,
        PackRequestRepositoryInterface $packRequestRepository,
        PackRequestService $packRequestService
    )
    {
        $this->orderItemRepository = $orderItemRepository;
        $this->packRequestFactory = $packRequestFactory;
        $this->pickRequestItemRepository = $pickRequestItemRepository;
        $this->packRequestRepository = $packRequestRepository;
        $this->pickRequestRepository = $pickRequestRepository;
        $this->packRequestService = $packRequestService;
    }
    
    /**
     * 
     * @param PickRequestInterface $pickRequest
     * @return PackRequestInterface
     */
    public function createFromPickRequest(PickRequestInterface $pickRequest)
    {
        /** @var PackRequestInterface $packRequest */
        $packRequest = null;
        $isNew = false;
        /* check existed Pack Request */
        $packRequests = $this->packRequestRepository->getByOrderId($pickRequest->getOrderId());
        if(count($packRequests)) {
            foreach($packRequests as $existedPackRequest) {
                if($existedPackRequest->getStatus() == PickRequestInterface::STATUS_PICKING
                        && $existedPackRequest->getWarehouseId() == $pickRequest->getWarehouseId()) {
                    $packRequest = $existedPackRequest;
                    break;
                }
            }
        }
        if(!$packRequest) {
            $packRequest = $this->packRequestFactory->create();
            $packRequest->setPickRequestId($pickRequest->getId());
            $packRequest->setOrderId($pickRequest->getOrderId());
            $packRequest->setWarehouseId($pickRequest->getWarehouseId());
            $packRequest->setOrderIncrementId($pickRequest->getOrderIncrementId());      
            $packRequest->setStatus(PackRequestInterface::STATUS_PACKING);    
            $this->packRequestRepository->save($packRequest);
            $isNew = true;
        }

        $pickItems = $this->pickRequestItemRepository->getListByRequestId($pickRequest->getId());
        $totalPickedQty = 0;
        if(count($pickItems)) {
            foreach($pickItems as $pickItem) {
                if(!$pickItem->getPickedQty()) {
                    continue;
                }
                $this->packRequestService->addPickItemToPackRequest($packRequest, $pickItem);
                if ($this->orderItemRepository->get($pickItem->getItemId())->getProductType() == \Magento\Bundle\Model\Product\Type::TYPE_CODE) {
                    continue;
                }
                $totalPickedQty += $pickItem->getPickedQty();
                $packRequest->setTotalItems($totalPickedQty);
                $this->packRequestRepository->save($packRequest);
            }
        }
        /* check total picked qty */
        if($isNew && !$totalPickedQty) {
            $this->packRequestRepository->delete($packRequest);
            throw new \Exception(__('There is no items picked to move to packing step.'));
        }
        /* update pack_id to Pick Request */
        $pickRequest->setPackRequestId($packRequest->getPackRequestId());
        $this->pickRequestRepository->save($pickRequest);
        
        return $packRequest;
    }
}