<?php

/**
 * Product:       Xtento_XtCore (2.0.9)
 * ID:            F0RIhapXqgQvfHUiSDvtff3tZxXjZ8OzKkh6+M6Rq88=
 * Packaged:      2017-08-19T02:11:08+00:00
 * Last Modified: 2017-07-20T19:39:10+00:00
 * File:          app/code/Xtento/XtCore/Block/System/Config/Form/Xtento/Servername.php
 * Copyright:     Copyright (c) 2017 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

namespace Xtento\XtCore\Block\System\Config\Form\Xtento;

use Magento\Framework\Data\Form\Element\AbstractElement;

class Servername extends \Magento\Config\Block\System\Config\Form\Field
{
    /**
     * @var \Xtento\XtCore\Helper\Server
     */
    protected $serverHelper;

    /**
     * Servername constructor.
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Xtento\XtCore\Helper\Server $serverHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Xtento\XtCore\Helper\Server $serverHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->serverHelper = $serverHelper;
    }

    /**
     * @param AbstractElement $element
     *
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $sName1 = $this->serverHelper->getFirstName();
        $sName2 = $this->serverHelper->getSecondName();
        if ($sName1 !== $sName2) {
            $element->setValue(sprintf('%s (Base: %s)', $sName1, $sName2));
        } else {
            $element->setValue(sprintf('%s', $sName1));
        }

        return parent::_getElementHtml($element);
    }
}
