<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Controller\Adminhtml\Pickup;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Mageside_CanadaPostShipping::mageside_canadapost_shipping';

    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Mageside_CanadaPostShipping::pickup');
        if ($id = $this->getRequest()->getParam('id')) {
            $resultPage->getConfig()->getTitle()->prepend(__('Edit Pickup: %1', $id));
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('New Pickup'));
        }

        return $resultPage;
    }
}