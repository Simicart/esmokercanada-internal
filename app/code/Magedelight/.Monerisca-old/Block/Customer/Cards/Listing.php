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

namespace Magedelight\Monerisca\Block\Customer\Cards;

class Listing extends \Magedelight\Monerisca\Block\Customer\Monerisca
{
   
    /**
     * get customer saved cards
     * @return type
     */
    public function getCustomerCards()
    {
        $customerId = $this->customerSession->getId();
        
        $websiteId =  $this->monerisHelper->getWebsiteId();
        $customer_account_scope =  $this->monerisHelper->getCustomerAccountScope();
        
        
        $result = [];
        if (!empty($customerId)) {
            $result = $this->cardCollectionFactory->create()
            ->addFieldToFilter('customer_id', $customerId);
            
            if ($customer_account_scope) {
               $result->addFieldToFilter('website_id', $websiteId);
            }
            
            $result->getData();
        }

        return $result;
    }

    /**
     * get address html
     * @param type $_card
     * @return type
     */
    public function getAddressHtml($_card)
    {
        $typeObject = $this->dataObject;
        $typeObject->addData([
            'code' => 'html',
            'title' => 'HTML',
            'default_format' => $this->monerisConfig->getDefaultFormat(),
        ]);
        $this->addressRender->setType($typeObject);
        $data = [];
        $countryName = '';
        if (!empty($_card['country_id'])) {
            $countryModel = $this->countryFactory->create();
            $this->countryResource->loadByCode($countryModel, $_card['country_id']);
            $countryName = $countryModel->getName();
        }
        $data['firstname'] = $_card['firstname'];
        $data['lastname'] = $_card['lastname'];
        $data['street'] = $_card['street'];
        $data['city'] = $_card['city'];
        $data['country_id'] = $_card['country_id'];
        $data['country'] = $countryName;
        $data['region_id'] = $_card['region_id'];
        $data['postcode'] = $_card['postcode'];
        $data['telephone'] = $_card['telephone'];
        $format = $this->addressRender->getFormatArray($data);
        return $this->filterManager->template($format, ['variables' => $data]);
    }
    /**
     * get back url
     * @return type
     */
    public function getBackUrl()
    {
        return $this->_urlBuilder->getUrl('customer/account');
    }
    /**
     * get add cards url
     * @return type
     */
    public function getAddCardUrl()
    {
        return $this->_urlBuilder->getUrl('md_monerisca/cards/add');
    }
    /**
     * get edit cards url
     * @return type
     */
    public function getPostUrl()
    {
        return $this->_urlBuilder->getUrl('md_monerisca/cards/edit');
    }
    /**
     * get delete url
     * @return type
     */
    public function getDeleteAction()
    {
        return $this->_urlBuilder->getUrl('md_monerisca/cards/delete');
    }
}
