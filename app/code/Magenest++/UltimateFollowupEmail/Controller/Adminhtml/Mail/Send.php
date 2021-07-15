<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 13/11/2015
 * Time: 19:30
 */

namespace Magenest\UltimateFollowupEmail\Controller\Adminhtml\Mail;

use Magento\Framework\Controller\ResultFactory;

use Magento\Backend\App\Action;

class Send extends Action
{

    protected $_mailFactory;


    public function execute()
    {
        $ids = $this->getRequest()->getParam('id');

        if (is_numeric($ids)) {
            $Ids[] = $ids;
        } else {
            $Ids = $ids;
        }

        /*
            * @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect
        */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        if (!is_array($Ids)) {
            $this->messageManager->addWarning('Please select item(s)');
        } else {
            try {
                foreach ($Ids as $id) {
                    /*
                        * @var  $mailModel \Magenest\UltimateFollowupEmail\Model\Mail
                    */
                    $mailModel = $this->_objectManager->create('Magenest\UltimateFollowupEmail\Model\Mail')->load($id);
                    ;

                    $mailModel->send();
                }

                $this->messageManager->addSuccess(__('Total of %d record(s) were successfully send', count($Ids)));
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }//end if

        $resultRedirect->setPath('*/*/index');
        return $resultRedirect;
    }//end execute()

    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magenest_UltimateFollowupEmail::mail');
    }//end _isAllowed()
}//end class
