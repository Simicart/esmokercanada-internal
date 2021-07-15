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

class Save extends \Magedelight\Monerisca\Controller\Adminhtml\Cards\Monerisca
{
    private function getCustomer($customerId)
    {
        return $this->customerRepository->getById($customerId);
    }
    public function execute()
    {
        $append = '';
        $errorMessage = '';
        $websiteId =  $this->monerisHelper->getWebsiteId();
        $params = $this->getRequest()->getParams();
        $customerId = $params['id'];
        if (!$params) {
            $message = '<div id="messages"><div class="messages"><div class="message message-error error">'
                . '<div data-ui-id="messages-message-error">'.__('Please try again.').'</div></div></div></div>';
            $result = ['error' => true, 'message' => $message];
            $resultJson = $this->resultJsonFactory->create();
            $resultJson->setData($result);
            return $resultJson;
        }
        $customer = $this->getCustomer($customerId);
        try {
            $requestObject = $this->requestObject;
            $requestObject->addData([
                'customer_id' => $customer->getId(),
                'email' => $customer->getEmail(),
            ]);
            $requestObject->addData($params['paymentParam']);
            $response = $this->monerisApi
            ->setInputData($requestObject)
            ->createCustomerProfile();
            $transFlag = $response->responseData["Complete"];
            $code      = $response->responseData["ResponseCode"];
            
            if ($transFlag=="true") {
                $data_key = $response->responseData["DataKey"];
                if (!empty($data_key)) {
                    $cardModelObject = $this->cardsFactory->create();
                    $cardModelObject
                    ->setData($params['paymentParam'])
                    ->setCustomerId($customer->getId())
                    ->setDataKey($data_key)
                    ->setCcLast4(substr($params['paymentParam']['cc_number'], -4, 4))
                    ->setWebsiteId($websiteId)        
                    ->setCreatedAt($this->localeDate->date())
                    ->setUpdatedAt($this->localeDate->date());
                    $cardModelObject->getResource()->save($cardModelObject);
                    $message = '<div id="messages"><div class="messages"><div class="message '
                        . 'message-success success">'
                        . '<div data-ui-id="messages-message-success">Credit card saved successfully.</div>'
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
                }
            } else {
                $errorMessage = $this->monerisHelper->getErrorDescription($code);
                if (isset($errorMessage) && !empty($errorMessage)) {
                     $message = '<div id="messages"><div class="messages">'
                        . '<div class="message message-error error">'
                        . '<div data-ui-id="messages-message-error">'
                        . ''.'Error code: '.$code.' : '.$errorMessage.'</div>'
                        . '</div></div></div>';
                    $result = ['error' => true, 'message' => $message];
                } else {
                    $message = '<div id="messages"><div class="messages">'
                      . '<div class="message message-error error">'
                      . '<div data-ui-id="messages-message-error">'.'Error code: '
                      .$response->responseData["Message"].'</div>'
                      . '</div></div></div>';
                    $result = ['error' => true, 'message' => $message];
                }
            }
        } catch (\Exception $e) {
            $message = '<div id="messages"><div class="messages">'
                . '<div class="message message-error error">'
                . '<div data-ui-id="messages-message-error">'.$e->getMessage().'</div></div></div></div>';
            $result = ['error' => true, 'message' => $message];
        }
        $resultJson = $this->resultJsonFactory->create();
        $resultJson->setData($result);
        return $resultJson;
    }
}
