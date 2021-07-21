<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Controller\Adminhtml\Pickup;

class Cancel extends \Magento\Backend\App\Action
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
     * @var \Mageside\CanadaPostShipping\Model\Service\Pickup
     */
    protected $pickupService;

    /**
     * Cancel constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Mageside\CanadaPostShipping\Model\PickupFactory $pickupFactory
     * @param \Mageside\CanadaPostShipping\Model\Service\Pickup $pickupService
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Mageside\CanadaPostShipping\Model\PickupFactory $pickupFactory,
        \Mageside\CanadaPostShipping\Model\Service\Pickup $pickupService
    ) {
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

        try {
            if ($id = $this->getRequest()->getParam('id')) {
                $pickup = $this->pickupFactory->create();
                $pickup->load($id);
                if ($pickup->getId()) {
                    $data = $this->pickupService->cancelPickup($pickup);
                    if ($data['error']) {
                        foreach ($data['messages'] as $message) {
                            $this->messageManager->addErrorMessage($message['message']);
                        }
                    } else {
                        $pickup->save();
                        $this->messageManager->addSuccessMessage(__('Pickup canceled successfully.'));
                        return $resultRedirect->setPath('*/*/index');
                    }
                } else {
                    $this->messageManager->addErrorMessage(__('Pickup %1 does not exist.', $id));
                }
            }
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Something went wrong while canceling pickup.'));
        }

        return $resultRedirect->setPath('*/*/index');
    }
}
