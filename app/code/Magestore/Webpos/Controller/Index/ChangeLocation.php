<?php

/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
namespace Magestore\Webpos\Controller\Index;
/**
 * Class Index
 * @package Magestore\Webpos\Controller\ChangeStore
 */
class ChangeLocation extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Checkout\Model\Session $checkoutSession
    ){
        $this->checkoutSession = $checkoutSession;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $locationId = $this->getRequest()->getParam('location_id');
        $this->checkoutSession->setData('location_id', $locationId);
    }
}
