<?php
/**
 * Copyright © 2018 Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */

namespace Mageside\CanadaPostShipping\Block\Adminhtml\System\Config\Field;

class RegisterButton extends \Magento\Config\Block\System\Config\Form\Field
{
    const BUTTON_TEMPLATE = 'system/config/button/button.phtml';

    /**
     * @var \Mageside\CanadaPostShipping\Helper\Carrier
     */
    protected $_configHelper;

    /**
     * RegisterButton constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Mageside\CanadaPostShipping\Helper\Carrier $configHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Mageside\CanadaPostShipping\Helper\Carrier $configHelper,
        array $data = []
    ) {
        $this->_configHelper = $configHelper;
        parent::__construct($context, $data);
    }

    /**
     * Set template to itself
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (!$this->getTemplate()) {
            $this->setTemplate(static::BUTTON_TEMPLATE);
        }
        return $this;
    }
    /**
     * Render button
     *
     * @param  \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        // Remove scope label
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }
    /**
     * Get the button and scripts contents
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        //TODO ajax_url
        $this->addData(
            [
                'id'            => 'validation_result',
                'button_label'  => __('Sign up to Canada Post'),
                'ajax_url'      => $this->getUrl('canadapost/registration/token')
                // 'ajax_url'      => $this->getUrl(
                //     'canadapost/registration/returnAction',
                //     ['token-id' => '428bd39e39ce3ecf0e6543', 'registration-status' => 'SUCCESS']
                // )
            ]
        );

        return $this->_toHtml();
    }

    /**
     * @return bool|mixed
     */
    public function getRegistrationMerchantUrl()
    {
        return ((bool) $this->_configHelper->getConfigCarrier('sandbox_mode')) ?
            $this->_configHelper->getConfigCarrier('registration_merchant_url') :
            $this->_configHelper->getConfigCarrier('registration_merchant_url');
    }

    /**
     * @return string
     */
    public function getReturnUrl()
    {
        //TODO storeId
        return $this->getUrl('canadapost/registration/returnAction');
    }

    /**
     * @return bool|mixed
     */
    public function getPlatformId()
    {
        return $this->_configHelper->getConfigCarrier('platform_id');
    }
}
