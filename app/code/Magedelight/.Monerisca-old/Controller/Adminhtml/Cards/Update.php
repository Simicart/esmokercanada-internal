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

class Update extends \Magedelight\Monerisca\Controller\Adminhtml\Cards\Monerisca
{
    
    private function getCustomer($customerId)
    {
        return $this->customerRepository->getById($customerId);
    }
    public function execute()
    {
       
        $params = $this->getRequest()->getParams();
        $customerId = $params['id'];
        if ($this->_directoryHelper->isRegionRequired($params['paymentParam']['country_id'])) {
            $params['paymentParam']['state'] = '';
        } else {
            $params['paymentParam']['region_id'] = 0;
        }
        if (!$params) {
            $message = '<div id="messages"><div class="messages"><div class="message message-error error">'
                . '<div data-ui-id="messages-message-error">'.__('Please try again.').'</div></div></div></div>';
            $result = ['error' => true, 'message' => $message];
            $resultJson = $this->resultJsonFactory->create();
            $resultJson->setData($result);

            return $resultJson;
        }
        $customer = $this->getCustomer($customerId);
        $updateCardId = $params['paymentParam']['card_id'];
        if (!empty($updateCardId)) {
            $cardModel = $this->cardsFactory->create();
            $cardModel->getResource()->load($cardModel, $updateCardId);
            if ($cardModel->getId()) {
                $dataKey = $cardModel->getData('data_key');
                $requestObject = $this->requestObject;
                $requestObject->addData([
                        'customer_id' => $customer->getId(),
                        'customer_data_key' => $dataKey,
                    ]);
                $requestObject->addData($params['paymentParam']);
                $response = $this->monerisApi
                    ->setInputData($requestObject)
                    ->updateCustomerProfile();
                 $result = $this->prepareResponse(
                     $response,
                     $cardModel,
                     $updateCardId,
                     $params,
                     $customer,
                     $customerId
                 );
            }
        }
        $resultJson = $this->resultJsonFactory->create();
        $resultJson->setData($result);

        return $resultJson;
    }
    /**
     *
     * @param type $response
     * @param type $cardModel
     * @param type $updateCardId
     * @param type $params
     * @param type $customer
     */
    private function prepareResponse(
        $response,
        $cardModel,
        $updateCardId,
        $params,
        $customer,
        $customerId
    ) {
        $append = '';
        $errorMessage = '';
        $code      = $response->responseData["ResponseCode"];
        $transFlag = $response->responseData["Complete"];
        if ($transFlag=="true") {
            $oldCardData = $cardModel->getData();
            unset($oldCardData['card_id']);
            try {
                $new_data_key = $response->responseData["DataKey"];
                $model = $this->cardsFactory->create();
                $model->getResource()->load($model, $updateCardId);
                $model->setData($oldCardData);
                $model->setData($params['paymentParam']);
                if ($params['paymentParam']['cc_action'] == 'existing') {
                    $model->setccType($oldCardData['cc_type'])
                        ->setcc_exp_month($oldCardData['cc_exp_month'])
                        ->setcc_exp_year($oldCardData['cc_exp_year']);
                    if (isset($oldCardData['cc_last4'])) :
                            $model->setcc_last4($oldCardData['cc_last4']);
                    endif;
                } else {
                    $model->setccType($params['paymentParam']['cc_type'])
                        ->setcc_exp_month($params['paymentParam']['cc_exp_month'])
                        ->setcc_exp_year($params['paymentParam']['cc_exp_year'])
                        ->setcc_last4(substr($params['paymentParam']['cc_number'], -4, 4));
                }
                $model->setDataKey($new_data_key)
                    ->setCustomerId($customer->getId())
                    ->setUpdatedAt($this->localeDate->date())
                    ->setCardId($updateCardId);
                $model->getResource()->save($model);
                $message = '<div id="messages"><div class="messages">'
                    . '<div class="message message-success success">'
                    . '<div data-ui-id="messages-message-success">Card updated successfully.</div>'
                    . '</div></div></div>';
                $monerisBlock = $this->_view->getLayout()->createBlock(
                    'Magedelight\Monerisca\Block\Adminhtml\CardTab'
                );
                $monerisBlock->setChild('monerisAddCards', $this->_view->getLayout()->createBlock(
                    'Magedelight\Monerisca\Block\Adminhtml\CardForm'
                ));
                $monerisBlock->setCustomerId($customerId);
                $append .= $monerisBlock->toHtml();
                $result = ['error' => false, 'message' => $message, 'append' => $append];
            } catch (\Exception $e) {
                $message = '<div id="messages"><div class="messages">'
                    . '<div class="message message-error error">'
                    . '<div data-ui-id="messages-message-error">'.$e->getMessage().'</div>'
                    . '</div></div></div>';
                $result = ['error' => true, 'message' => $message];
            }
        } else {
            $errorMessage = $this->monerisHelper->getErrorDescription($code);
            $message = '<div id="messages">'
            . '<div class="messages">'
            . '<div class="message message-error error">'
            . '<div data-ui-id="messages-message-error">'
            .'Error code: '.$code.' : '.$errorMessage.'</div>'
            . '</div></div></div>';
            $result = ['error' => true, 'message' => $message];
        }
        return $result;
    }
}
