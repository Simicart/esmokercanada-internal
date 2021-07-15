<?php

namespace Magenest\UltimateFollowupEmail\Controller\Adminhtml\Birthday;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;

class Index extends \Magento\Backend\App\Action
{


    public function execute()
    {
        /*
            * @var \Magento\Backend\Model\View\Result\Page $resultPage
        */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Magenest_UltimateFollowupEmail::ultimatefollowupemail');
        $resultPage->getConfig()->getTitle()->prepend(__('Birthday Search'));
        return $resultPage;
    }//end execute()

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magenest_UltimateFollowupEmail::birthday');
    }//end _isAllowed()
}//end class
