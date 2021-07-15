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

class Save extends \Magedelight\Monerisca\Controller\Cards\Monerisca
{
    public function execute()
    {
       
        $resultRedirect = $this->resultRedirectFactory->create();
        $websiteId =  $this->monerisHelper->getWebsiteId();
        $errorMessage = '';
        $params = $this->getRequest()->getPostValue();
        if (!$params) {
            return $resultRedirect->setPath('*/*/listing');
        }
       
        $params['md_monerisca']['address_info']['country_id'] = $params['country_id'];
        $customer = $this->getCustomer();
        try {
            $requestObject = $this->requestObject;

            $requestObject->addData([
                'customer_id' => $customer->getId(),
                'email' => $customer->getEmail(),
            ]);
            $requestObject->addData($params['md_monerisca']['address_info']);
            $requestObject->addData($params['md_monerisca']['payment_info']);

            $response = $this->monerisApi
            ->setInputData($requestObject)
            ->createCustomerProfile();

            $transFlag = $response->responseData["Complete"];
            $code      = $response->responseData["ResponseCode"];
            if ($transFlag=="true") {
                $data_key = $response->responseData["DataKey"];
                if (!empty($data_key)) {
                    $cardModelObject = $this->cardsFactory->create();
                    $cardModelObject->setData($params['md_monerisca']['address_info'])
                    ->setCustomerId($customer->getId())
                    ->setDataKey($data_key)
                    ->setCcType($params['md_monerisca']['payment_info']['cc_type'])
                    ->setCcExpMonth($params['md_monerisca']['payment_info']['cc_exp_month'])
                    ->setCcExpYear($params['md_monerisca']['payment_info']['cc_exp_year'])
                    ->setCcLast4(substr($params['md_monerisca']['payment_info']['cc_number'], -4, 4))
                    ->setWebsiteId($websiteId)        
                    ->setCreatedAt($this->localeDate->date())
                    ->setUpdatedAt($this->localeDate->date());
                    $cardModelObject->getResource()->save($cardModelObject);
                    $this->messageManager->addSuccessMessage(__('Credit card saved successfully.'));
                }
            } else {
                $errorMessage = $this->monerisHelper->getErrorDescription($code);
                if (isset($errorMessage) && !empty($errorMessage)) {
                    $this->messageManager->addErrorMessage('Error code: '.$code.' : '
                        .$errorMessage);
                } else {
                    $this->messageManager->addErrorMessage($response->responseData["Message"]);
                }
            }

            return $resultRedirect->setPath('*/*/listing');
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __($e->getMessage()));

            return $resultRedirect->setPath('*/*/listing');
        }

          return $resultRedirect->setPath('*/*/listing');
    }
}
