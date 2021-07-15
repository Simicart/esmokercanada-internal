<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 14/11/2015
 * Time: 16:33
 */

namespace Magenest\UltimateFollowupEmail\Controller\Adminhtml\Rule;

use Magenest\UltimateFollowupEmail\Model\Observer\Coupon\AddNewType;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;
use Magento\SalesRule\Model\Rule;

class CouponSearch extends Action
{


    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        // get the cart price rule whichs have auto generated coupon
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        /** @var  $saleRuleCollection \Magento\SalesRule\Model\ResourceModel\Rule\Collection */
        $saleRuleCollection = $this->_objectManager->create('Magento\SalesRule\Model\ResourceModel\Rule\Collection');
        $query = $this->getRequest()->getParam('q');
        $saleRuleCollection
            ->addFieldToFilter('coupon_type', ['IN'=>[AddNewType::COUPON_TYPE_FUE, Rule::COUPON_TYPE_SPECIFIC]])
            ->addFieldToFilter('use_auto_generation', 1)
            ->addFieldToFilter('name', ['like' => '%'.$query.'%']);

        $responseData = [];
        foreach ($saleRuleCollection as $resultItem) {
            $responseData[] = [
                               'value' => $resultItem->getName(),
                               'id'    => $resultItem->getId(),
                               'label' => $resultItem->getName(),
                              ];
        }

        $resultJson->setData($responseData);
        return $resultJson;
    }//end execute()

    /**
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magenest_UltimateFollowupEmail::rule');
    }//end _isAllowed()
}//end class
