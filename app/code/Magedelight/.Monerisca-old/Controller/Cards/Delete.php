<?php
/**
* Magedelight
* Copyright (C) 2017 Magedelight <info@magedelight.com>
*
* @category Magedelight
* @package Magedelight_Monerisca
* @copyright Copyright (c) 2017 Mage Delight (http://www.magedelight.com/)
* @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
* @author Magedelight <info@magedelight.com>
*/

namespace Magedelight\Monerisca\Controller\Cards;

class Delete extends \Magedelight\Monerisca\Controller\Cards\Monerisca
{

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $deleteCardId   = $this->getRequest()->getPostValue('card_id');
        if (!empty($deleteCardId)) {
            $cardModel = $this->cardsFactory->create();
            $cardModel->getResource()->load($cardModel, $deleteCardId);
            $data_key = $cardModel->getData('data_key');
            $customerId     = $this->customerSession->getCustomerId();
            if ($data_key && $customerId) {
                $requestObject    = $this->requestObject;
                $requestObject->addData([
                    'customer_data_key' => $data_key,
                ]);
                $response         = $this->monerisApi->setInputData($requestObject)
                    ->deleteCustomerPaymentProfile();
                $code      = $response->responseData["ResponseCode"];
                $transFlag = $response->responseData["Complete"];
                $this->prepareMessage($code, $cardModel, $transFlag);
            } else {
                $this->messageManager->addErrorMessage('Card does not exists.');
                return $resultRedirect->setPath('*/*/listing');
            }

            return $resultRedirect->setPath('*/*/listing');
        } else {
            $this->messageManager->addErrorMessage('Unable to find card to delete.');
            return $resultRedirect->setPath('*/*/listing');
        }
    }

    private function prepareMessage($code, $cardModel, $transFlag)
    {
        if ($transFlag=="true") {
            $cardModel->getResource()->delete($cardModel);
            $this->messageManager->addSuccessMessage(__('Card deleted successfully.'));
        } else {
            $this->messageManager->addErrorMessage($code.' : '.$this->monerisHelper->getErrorDescription($code));
        }
    }
}
