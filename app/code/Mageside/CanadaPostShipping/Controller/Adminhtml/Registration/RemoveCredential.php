<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Controller\Adminhtml\Registration;

use Magento\Framework\Controller\ResultFactory;
use Mageside\CanadaPostShipping\Model\Service\Registration;
use Magento\Backend\App\Action\Context;

class RemoveCredential extends \Magento\Backend\App\Action
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
    protected $registration;

    /**
     * RemoveCredential constructor.
     * @param Context $context
     * @param Registration $registration
     */
    public function __construct(
        Context $context,
        Registration $registration
    ) {
        $this->registration = $registration;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $website = $this->getRequest()->getParam('website', 0);

        try {
            $this->registration->saveMerchantInfo([], $website);
            $this->messageManager->addSuccessMessage(__('Canada Post account settings successfully cleared.'));
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Something went wrong.'));
        }

        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('adminhtml/system_config/edit', ['section'=>'carriers', 'website'=>$website]);
    }
}
