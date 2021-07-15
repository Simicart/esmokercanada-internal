<?php
/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

namespace Magestore\WebposCustomize\Model\Customer;

/**
 * Customer repository.
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class CustomerRepository extends \Magestore\Webpos\Model\Customer\CustomerRepository
{
	/**
     * Helper function that adds a FilterGroup to the collection.
     *
     * @param \Magento\Framework\Api\Search\FilterGroup $filterGroup
     * @param \Magento\Customer\Model\ResourceModel\Customer\Collection $collection
     * @return void
     * @throws \Magento\Framework\Exception\InputException
     */
    protected function addFilterGroupToCollection(
        \Magento\Framework\Api\Search\FilterGroup $filterGroup,
        \Magento\Customer\Model\ResourceModel\Customer\Collection $collection
    ) {
        $fields = [];
        $conditions = [];
        foreach ($filterGroup->getFilters() as $filter) {
            $webposCondition = $filter->getConditionType() ? $filter->getConditionType() : 'like';
            $fieldName = $filter->getField();
            if(in_array($fieldName, ['full_name','telephone','email'])) {
                switch ($webposCondition) {
                    case 'eq':
                        $webposCondition = '=';
                        break;
                    case 'neq':
                        $webposCondition = '!=';
                        break;
                }
            }
            if ($fieldName == 'full_name') {
                $fieldName = 'CONCAT(e.firstname, " ", e.lastname)';
                $collection->getSelect()->orWhere($fieldName.' '.$webposCondition.' "'. $filter->getValue().'"');
            } else if ($fieldName == 'telephone') {
                $fieldName = 'IFNULL(at_billing_telephone.telephone,"N/A")';
                $collection->getSelect()->orWhere($fieldName.' '.$webposCondition.' "'. $filter->getValue().'"');
            }else if ($fieldName == 'email') {
                $collection->getSelect()->orWhere($fieldName.' '.$webposCondition.' "'. $filter->getValue().'"');
            } else if ($fieldName == 'wk_telephone') {
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $attributeId = $objectManager->create('Magento\Eav\Model\ResourceModel\Entity\Attribute')->getIdByCode('customer', $fieldName);
                $fieldName = 'e_varchar.value';
                if($attributeId){
                    $collection->getSelect()->joinLeft(
                        ['e_varchar' => $collection->getTable('customer_entity_varchar')],
                        'e_varchar.entity_id=e.entity_id && e_varchar.attribute_id='.$attributeId,
                        array()
                    )->orwhere($fieldName . ' ' . $webposCondition . ' "' . $filter->getValue() . '"');
                }
            } else {
                $fields[] = ['attribute' => $fieldName, $webposCondition => $filter->getValue()];
            }
        }
        if ($fields) {
            $collection->addFieldToFilter($fields, $conditions);
        }
    }
}