<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Block\Adminhtml\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class CancelPickupButton
 */
class CancelPickupButton implements ButtonProviderInterface
{
    /**
     * Url Builder
     *
     * @var \Magento\Framework\UrlInterface
     */
    private $urlBuilder;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    private $request;

    /**
     * @var \Mageside\CanadaPostShipping\Model\Manifest
     */
    private $pickup;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Mageside\CanadaPostShipping\Model\Pickup $pickup
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Mageside\CanadaPostShipping\Model\Pickup $pickup
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->request = $context->getRequest();
        $this->pickup = $pickup;
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($pickupId = $this->request->getParam('id')) {
            $pickup = $this->pickup->load($pickupId);
            if ($pickup->getId()) {
                $data = [
                    'label' => 'Cancel Pickup',
                    'class' => 'secondary',
                    'on_click' => sprintf(
                        "location.href = '%s';",
                        $this->urlBuilder->getUrl('*/*/cancel', ['id' => $pickupId])
                    ),
                    'sort_order' => 20,
                ];
            }
        }

        return $data;
    }
}
