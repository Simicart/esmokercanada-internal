<?php
/**
 * Copyright © 2018 Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Controller\Adminhtml\Registration;

use Magento\Framework\Controller\ResultFactory;
use Mageside\CanadaPostShipping\Model\Carrier;

class Token extends \Magento\Backend\App\Action
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
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $result = $this->_registration->getToken();
        if (!$result['error']) {
            $this->_registration->saveConfigValue(
                'carriers/' . Carrier::CODE . '/registration_token_id',
                $result['tokenId']
            );
        }

        return $resultJson->setData($result);
    }
}
