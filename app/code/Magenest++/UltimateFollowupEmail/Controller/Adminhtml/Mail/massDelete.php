<?php
namespace Magenest\UltimateFollowupEmail\Controller\Adminhtml\Mail;

use Magento\Backend\App\Action;

/**
 * Class MassDelete
 */
class MassDelete extends \Magento\Backend\App\Action
{


    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $blogpostIds = $this->getRequest()->getParam('mail');
        if (!is_array($blogpostIds) || empty($blogpostIds)) {
            $this->messageManager->addError(__('Please select mail(s).'));
        } else {
            try {
                foreach ($blogpostIds as $postId) {
                    $post = $this->_objectManager->get('Magenest\UltimateFollowupEmail\Model\Mail')->load($postId);
                    $post->delete();
                }

                $this->messageManager->addSuccess(
                    __('A total of %d record(s) have been deleted.', count($blogpostIds))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }

        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }//end execute()

    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magenest_UltimateFollowupEmail::mail');
    }//end _isAllowed()
}//end class
