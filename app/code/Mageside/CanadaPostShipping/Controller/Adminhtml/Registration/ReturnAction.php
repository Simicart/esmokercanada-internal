<?php
/**
 * Copyright © 2018 Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Controller\Adminhtml\Registration;

use Magento\Framework\Controller\ResultFactory;
use Mageside\CanadaPostShipping\Model\Carrier;

class ReturnAction extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Mageside_CanadaPostShipping::mageside_canadapost_shipping';

    /**
     * @var \Mageside\CanadaPostShipping\Model\Service\Registration
     */
    protected $_registration;

    /**
     * GetToken constructor.
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Mageside\CanadaPostShipping\Model\Service\Registration $registration
    ) {
        $this->_registration = $registration;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $tokenId = $this->getRequest()->getParam('token-id');
        $status = $this->getRequest()->getParam('registration-status');

        if ($tokenId && $status == 'SUCCESS') {
            $result = $this->_registration->getMerchantInfo($tokenId);
            if ($result['error']) {
                foreach ($result['messages'] as $message) {
                    $this->messageManager->addErrorMessage($message['message']);
                }
            } elseif ($result['merchant']) {
                $this->_registration->saveMerchantInfo($result['merchant']);
                $this->messageManager->addSuccessMessage(__('Canada Post Account settings successfully saved.'));
            } else {
                $this->messageManager->addErrorMessage(__('Something went wrong.'));
            }
        } elseif ($status == 'CANCELLED') {
            $this->messageManager->addErrorMessage(
                __('Registration status: %1. Unable to submit requests on your behalf '
                    .'until you accept the terms and conditions, '
                    .'but your relationship with Canada Post remains in effect.',
                    $status
                )
            );
        } else {
            $this->messageManager->addErrorMessage(
                __('Registration status: %1. Please try again later.', $status)
            );
        }

        return $resultRedirect->setPath('adminhtml/system_config/edit', ['section'=>'carriers']);
    }
}
