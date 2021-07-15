<?php

/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

namespace Magestore\WebposCustomize\Model\Rewards;

use \Magento\Framework\ObjectManagerInterface as ObjectManagerInterface;


use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;

class RateRepository implements \Magestore\WebposCustomize\Api\Rewards\RateRepositoryInterface
{
    /**
     * @var \Magento\Framework\App\ObjectManager
     */
    protected $_objectManager;

    /**
     * @var \Mirasvit\Rewards\Model\ResourceModel\Earning\Rule\CollectionFactory
     */
    protected $earningRuleCollectionFactory;

    /**
     * @var \Mirasvit\Rewards\Model\ResourceModel\Spending\Rule\CollectionFactory
     */
    protected $spendingRuleCollectionFactory;

    /**
     * RateRepository constructor.
     * @param \Mirasvit\Rewards\Model\ResourceModel\Earning\Rule\CollectionFactory $earningRuleCollectionFactory
     * @param \Mirasvit\Rewards\Model\ResourceModel\Spending\Rule\CollectionFactory $spendingRuleCollectionFactory
     */
    public function __construct(
        \Mirasvit\Rewards\Model\ResourceModel\Earning\Rule\CollectionFactory $earningRuleCollectionFactory,
        \Mirasvit\Rewards\Model\ResourceModel\Spending\Rule\CollectionFactory $spendingRuleCollectionFactory
    )
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->earningRuleCollectionFactory = $earningRuleCollectionFactory;
        $this->spendingRuleCollectionFactory = $spendingRuleCollectionFactory;
    }

    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function getEarningPointRates($websiteId, $customerGroupId) {
        $rules = $this->earningRuleCollectionFactory->create()
            ->addWebsiteFilter($websiteId)
            ->addCustomerGroupFilter($customerGroupId)
            ->addCurrentFilter()
            ->setOrder('sort_order');
        $result = $this->_objectManager->get('Magento\Framework\Api\Search\SearchResultFactory')->create();
        $result->setItems($rules->getItems());
        $result->setTotalCount($rules->getSize());
        return $result;
    }

    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public function getSpendingPointRates($websiteId, $customerGroupId) {
        $rules = $this->spendingRuleCollectionFactory->create()
            ->addWebsiteFilter($websiteId)
            ->addCustomerGroupFilter($customerGroupId)
            ->addCurrentFilter()
            ->setOrder('sort_order');
        $result = $this->_objectManager->get('Magento\Framework\Api\Search\SearchResultFactory')->create();
        $result->setItems($rules->getItems());
        $result->setTotalCount($rules->getSize());
        return $result;
    }
}