<?php

/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
namespace Magestore\WebposCustomize\Model\Rewards;

/**
 * Class PointRepository
 * @package Magestore\WebposCustomize\Model\Rewards
 */
class PointRepository implements \Magestore\WebposCustomize\Api\Rewards\PointRepositoryInterface
{
    /**
     * @var \Mirasvit\Rewards\Helper\Balance
     */
    protected $rewardsBalance;

    /**
     * @var \Magento\Framework\App\ObjectManager
     */
    protected $_objectManager;

    /**
     * @var \Magestore\WebposCustomize\Api\Data\Rewards\SearchResultsInterfaceFactory
     */
    protected $searchResultsInterface;

    /**
     * PointRepository constructor.
     * @param \Mirasvit\Rewards\Helper\Balance $rewardsBalance
     * @param \Magestore\WebposCustomize\Api\Data\Rewards\SearchResultsInterfaceFactory $searchResultsInterface
     */
    public function __construct(
        \Mirasvit\Rewards\Helper\Balance $rewardsBalance,
        \Magestore\WebposCustomize\Api\Data\Rewards\SearchResultsInterfaceFactory $searchResultsInterface
    ) {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->rewardsBalance = $rewardsBalance;
        $this->searchResultsInterface = $searchResultsInterface;
    }

    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function getBalance($customerId){
        $data = [];
        if($customerId){
            $model = $this->_objectManager->create('Magento\Customer\Model\Customer')->load($customerId);
            if($model->getId() > 0){
                $data['balance'] = floatval($this->rewardsBalance->getBalancePoints($model));
            }else{
                $data['balance'] = floatval(0);
            }
            $data['success'] = true;
        }else{
            $data['message'] = __('Please choose customer account');
            $data['error'] = true;
        }
        return \Zend_Json::encode($data);
    }

    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function getList(){
        $items = [];
        $collection = $this->_objectManager->create('Magento\Customer\Model\ResourceModel\Customer\Collection');
        $collection->load();
        if ($collection->getSize() > 0) {
            foreach ($collection as $customer) {
                $items[] = [
                    'customer_id' => $customer->getData('entity_id'),
                    'point_balance' => $this->rewardsBalance->getBalancePoints($customer)
                ];
            }
        }
        $result = $this->searchResultsInterface->create();
        $result->setItems($items);
        $result->setTotalCount(count($items));
        return $result;
    }
}