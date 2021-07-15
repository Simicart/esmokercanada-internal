<?php

/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
namespace Magestore\Webpos\Controller\Adminhtml\Pos;

/**
 * Class DenominationsGrid
 * @package Magestore\Webpos\Controller\Adminhtml\Pos
 */
class DenominationsGrid extends \Magestore\Webpos\Controller\Adminhtml\Pos\AbstractPos
{
    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}
