<?php
/**
 * Copyright © 2016 Magestore. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magestore\FulfilSuccess\Block\Adminhtml\AbstractRequest\Detail;

class OrderInfo extends \Magestore\FulfilSuccess\Block\Adminhtml\AbstractRequest\Detail\Common
{
    protected function _prepareLayout()
    {
        $this->setTemplate('Magestore_FulfilSuccess::abstractRequest/detail/order_info.phtml');
        parent::_prepareLayout();
    }
}