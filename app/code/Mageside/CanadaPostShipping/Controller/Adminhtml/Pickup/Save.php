<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Controller\Adminhtml\Pickup;

use Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Mageside_CanadaPostShipping::mageside_canadapost_shipping';

    /**
     * @var \Mageside\CanadaPostShipping\Model\PickupFactory
     */
    protected $pickupFactory;

    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Mageside\CanadaPostShipping\Model\Service\Pickup
     */
    protected $pickupService;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param \Mageside\CanadaPostShipping\Model\PickupFactory $pickupFactory
     * @param \Mageside\CanadaPostShipping\Model\Service\Pickup $pickupService
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Mageside\CanadaPostShipping\Model\PickupFactory $pickupFactory,
        \Mageside\CanadaPostShipping\Model\Service\Pickup $pickupService
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->pickupFactory = $pickupFactory;
        $this->pickupService = $pickupService;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if (!$this->_formKeyValidator->validate($this->getRequest())) {
            $this->messageManager->addErrorMessage(__('Invalid form data.'));

            return $resultRedirect->setPath('*/*/index');
        }

        $requestData = $this->getRequest()->getPostValue();
        $pickup = $this->pickupFactory->create();

        try {
            if (!empty($requestData)) {
                $pickup->addData($requestData);
                if ($pickup->getRequestId()) {
                    $data = $this->pickupService->updatePickup($pickup);
                } else {
                    $data = $this->pickupService->createPickup($pickup);
                }
                if ($data['error']) {
                    foreach ($data['messages'] as $message) {
                        $this->messageManager->addErrorMessage($message['message']);
                    }
                } else {
                    $pickup->save();
                    $this->messageManager->addSuccessMessage(__('Pickup saved successfully.'));
                    $this->dataPersistor->clear('canada_pickup');
                    return $resultRedirect->setPath('*/*/index');
                }
            }
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Something went wrong while saving pickup.'));
        }

        $this->dataPersistor->set('canada_pickup', $requestData);

        return $resultRedirect->setPath('*/*/edit');
    }
}
