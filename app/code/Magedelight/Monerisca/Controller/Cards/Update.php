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

class Update extends \Magedelight\Monerisca\Controller\Cards\Monerisca
{

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params         = $this->getRequest()->getPostValue();
        if ($this->_directoryHelper->isRegionRequired($params['country_id'])) {
            $params['md_monerisca']['address_info']['state'] = '';
        } else {
            $params['md_monerisca']['address_info']['region_id'] = 0;
        }

        $params['md_monerisca']['address_info']['country_id'] = $params['country_id'];

        if (!$params) {
            return $resultRedirect->setPath('*/*/listing');
        }

        $customer     = $this->getCustomer();
        $updateCardId = $params['md_monerisca']['card_id'];

        if (!empty($updateCardId)) {
            $cardModel = $this->cardsFactory->create();
            $cardModel->getResource()->load($cardModel, $updateCardId);
            if ($cardModel->getId()) {
                $dataKey = $cardModel->getData('data_key');
                $requestObject  = $this->requestObject;
                $requestObject->addData([
                    'customer_id' => $customer->getId(),
                    'customer_data_key' => $dataKey,
                ]);
                $requestObject->addData($params['md_monerisca']['address_info']);
                $requestObject->addData($params['md_monerisca']['payment_info']);
                $response       = $this->monerisApi
                    ->setInputData($requestObject)
                    ->updateCustomerProfile();

                $this->prepareResponse(
                    $response,
                    $cardModel,
                    $updateCardId,
                    $params,
                    $customer,
                    $resultRedirect
                );
            }
        }

        return $resultRedirect->setPath('*/*/listing');
    }

    private function prepareResponse(
        $response,
        $cardModel,
        $updateCardId,
        $params,
        $customer,
        $resultRedirect
    ) {
    
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
                $model->setData($params['md_monerisca']['address_info']);
                $cardUpdateCheck   = $params['md_monerisca']['payment_info'];
                $this->prepareSuccess(
                    $cardUpdateCheck,
                    $updateCardId,
                    $oldCardData,
                    $model,
                    $params,
                    $new_data_key,
                    $customer
                );
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __($e->getMessage())
                );
                return $resultRedirect->setPath('*/*/listing');
            }
            $this->messageManager->addSuccessMessage(__('Card updated successfully.'));
        } else {
            $this->prepareError(
                $code,
                $response
            );
        }
    }

    private function prepareSuccess(
        $cardUpdateCheck,
        $updateCardId,
        $oldCardData,
        $model,
        $params,
        $new_data_key,
        $customer
    ) {
    
        if ($cardUpdateCheck['cc_action'] == 'existing') {
            $model->setccType($oldCardData['cc_type'])
                ->setcc_exp_month($oldCardData['cc_exp_month'])
                ->setcc_exp_year($oldCardData['cc_exp_year']);
            if (isset($oldCardData['cc_last4'])) :
                $model->setcc_last4($oldCardData['cc_last4']);
            endif;
        } else {
            $model->setccType($params['md_monerisca']['payment_info']['cc_type'])
                ->setcc_exp_month($params['md_monerisca']['payment_info']['cc_exp_month'])
                ->setcc_exp_year($params['md_monerisca']['payment_info']['cc_exp_year'])
                ->setcc_last4(substr(
                    $params['md_monerisca']['payment_info']['cc_number'],
                    -4,
                    4
                ));
        }
        $model->setDataKey($new_data_key)
            ->setCustomerId($customer->getId())
            ->setUpdatedAt($this->localeDate->date())
            ->setCardId($updateCardId);
        $model->getResource()->save($model);
    }

    private function prepareError($code, $response)
    {
        $errorMessage = $this->monerisHelper->getErrorDescription($code);
        if (isset($errorMessage) && !empty($errorMessage)) {
            $this->messageManager->addErrorMessage('Error code: '.$code.' : '
                        .$errorMessage);
        } else {
            $this->messageManager->addErrorMessage($response->responseData["Message"]);
        }
    }
}
