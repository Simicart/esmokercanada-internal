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

namespace Magedelight\Monerisca\Controller\Adminhtml\Cards;

class Delete extends \Magedelight\Monerisca\Controller\Adminhtml\Cards\Monerisca
{
    public function execute()
    {
        $customerId = $this->getRequest()->getParam('id');
        $append = '';
        $deleteCardId = $this->getRequest()->getParam('customercardid');
        if (!empty($deleteCardId)) {
            $cardModel = $this->cardsFactory->create();
            $cardModel->getResource()->load($cardModel, $deleteCardId);
            $data_key = $cardModel->getData('data_key');
            if ($data_key && $customerId) {
                $requestObject = $this->requestObject;
                $requestObject->addData([
                     'customer_data_key' => $data_key,
                ]);
                try {
                    $response         = $this->monerisApi->setInputData($requestObject)
                    ->deleteCustomerPaymentProfile();
                    $code      = $response->responseData["ResponseCode"];
                    $transFlag = $response->responseData["Complete"];

                    if ($transFlag=="true") {
                         $cardModel->getResource()->delete($cardModel);
                        $append .= '<div id="messages"><div class="messages">'
                            . '<div class="message message-success success">'
                            . '<div data-ui-id="messages-message-success">'
                            .__('Card deleted successfully.').'</div></div></div></div>';
                        $result = ['error' => false, 'message' => $append];
                    } else {
                        $append .= '<div id="messages"><div class="messages"><div class="message '
                            . 'message-error error"><div '
                            . 'data-ui-id="messages-message-error">'
                            .$code.' : '.$this->monerisHelper->getErrorDescription($code).'</div>'
                            . '</div></div></div>';
                        $result = ['error' => true, 'message' => $append];
                    }
                } catch (\Exception $e) {
                    $append .= '<div id="messages"><div class="messages">'
                        . '<div class="message message-error error">'
                        . '<div data-ui-id="messages-message-error">'.$e->getMessage().'</div></div></div></div>';
                    $result = ['error' => true, 'message' => $append];
                }
            } else {
                $append .= '<div id="messages"><div class="messages">'
                    . '<div class="message message-error error">'
                    . '<div data-ui-id="messages-message-error">'.'Card does not exists.'.'</div></div></div></div>';
                $result = ['error' => true, 'message' => $append];
            }
        } else {
            $append .= '<div id="messages"><div class="messages">'
                . '<div class="message message-error error">'
                . '<div data-ui-id="messages-message-error">'.'Unable to find card to delete.'.'</div>'
                . '</div></div></div>';
            $result = ['error' => true, 'message' => $append];
        }
        $resultJson = $this->resultJsonFactory->create();
        $resultJson->setData($result);

        return $resultJson;
    }
}
