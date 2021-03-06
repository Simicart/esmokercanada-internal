<?php

/**
 * *
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

namespace Magestore\WebposStripe\Block\Adminhtml\Config;


class Setupguide extends \Magento\Backend\Block\Template
{
    /**
     * @var string
     */
    protected $_template = 'Magestore_WebposStripe::config/setupguide.phtml';

    /**
     * Get api test url
     * @return string
     */
    public function getTestApiUrl(){
        return $this->getUrl('webposstripe/api/test');
    }

}