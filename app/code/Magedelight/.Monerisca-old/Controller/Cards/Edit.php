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

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magedelight\Monerisca\Controller\Cards\Monerisca
{
   
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultRedirect = $this->resultRedirectFactory->create();
        $editId = $this->getRequest()->getPostValue('card_id');
        $customerId = $this->customerSession->getCustomerId();

        if ($editId && $customerId) {
             $navigationBlock = $resultPage->getLayout()->getBlock('customer_account_navigation');
            if ($navigationBlock) {
                $navigationBlock->setActive('md_monerisca/cards/listing/');
            }
            return $resultPage;
        } else {
            $this->messageManager->addErrorMessage(__('Card information missing.'));
            return $resultRedirect->setPath('*/*/listing');
        }
        return $resultPage;
    }
}
