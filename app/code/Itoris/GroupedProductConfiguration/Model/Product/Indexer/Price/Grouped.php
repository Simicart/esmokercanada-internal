<?php
/**
 * ITORIS
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the ITORIS's Magento Extensions License Agreement
 * which is available through the world-wide-web at this URL:
 * http://www.itoris.com/magento-extensions-license.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to sales@itoris.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the extensions to newer
 * versions in the future. If you wish to customize the extension for your
 * needs please refer to the license agreement or contact sales@itoris.com for more information.
 *
 * @category   ITORIS
 * @package    ITORIS_M2_Itoris_GroupedProductConfiguration
 * @copyright  Copyright (c) 2016 ITORIS INC. (http://www.itoris.com)
 * @license    http://www.itoris.com/magento-extensions-license.html  Commercial License
 */
namespace Itoris\GroupedProductConfiguration\Model\Product\Indexer\Price;

use Magento\Catalog\Api\Data\ProductInterface;

class Grouped extends \Magento\GroupedProduct\Model\ResourceModel\Product\Indexer\Price\Grouped {

    protected function _prepareGroupedProductPriceData($entityIds = null)
    {
        if (!$this->hasEntity() && empty($entityIds)) {
            return $this;
        }
        $connection = $this->getConnection();
        $table = $this->getIdxTable();
        if(method_exists($this,'getMetadataPool') && method_exists($this->getMetadataPool(),'getMetadata') && method_exists($this->getMetadataPool()->getMetadata(ProductInterface::class),'getLinkField'))
            $linkField = $this->getMetadataPool()->getMetadata(ProductInterface::class)->getLinkField();
        else{
            $linkField = 'entity_id';
        }
        $select = $connection->select()->from(
            ['e' => $this->getTable('catalog_product_entity')],
            'entity_id'
        )->joinLeft(
            ['l' => $this->getTable('catalog_product_link')],
            'e.' . $linkField . ' = l.product_id AND l.link_type_id=' .
            \Magento\GroupedProduct\Model\ResourceModel\Product\Link::LINK_TYPE_GROUPED,
            []
        )->join(
            ['cg' => $this->getTable('customer_group')],
            '',
            ['customer_group_id']
        );
        $this->_addWebsiteJoinToSelect($select, true);
        $this->_addProductWebsiteJoinToSelect($select, 'cw.website_id', 'e.entity_id');
        $minCheckSql = $connection->getCheckSql('le.required_options = 0', 'i.min_price', 0);
        $maxCheckSql = $connection->getCheckSql('le.required_options = 0', 'i.max_price', 0);
        $select->columns(
            'website_id',
            'cw'
        )->joinLeft(
            ['le' => $this->getTable('catalog_product_entity')],
            'le.entity_id = l.linked_product_id',
            []
        )->joinLeft(
            ['i' => $table],
            'i.entity_id = l.linked_product_id AND i.website_id = cw.website_id' .
            ' AND i.customer_group_id = cg.customer_group_id',
            [
                'tax_class_id' => $this->getConnection()->getCheckSql(
                    'MIN(i.tax_class_id) IS NULL',
                    '0',
                    'MIN(i.tax_class_id)'
                ),
                'price' => new \Zend_Db_Expr('NULL'),
                'final_price' => new \Zend_Db_Expr('NULL'),
                'min_price' => new \Zend_Db_Expr('MIN(' . /*$minCheckSql*/ 'i.min_price' . ')'),
                'max_price' => new \Zend_Db_Expr('MAX(' . $maxCheckSql . ')'),
                'tier_price' => new \Zend_Db_Expr('NULL'),
            ]
        )->group(
            ['e.entity_id', 'cg.customer_group_id', 'cw.website_id']
        )->where(
            'e.type_id=?',
            $this->getTypeId()
        );

        if ($entityIds !== null) {
            $select->where('e.entity_id IN(?)', $entityIds);
        }

        /**
         * Add additional external limitation
         */
        $this->_eventManager->dispatch(
            'catalog_product_prepare_index_select',
            [
                'select' => $select,
                'entity_field' => new \Zend_Db_Expr('e.entity_id'),
                'website_field' => new \Zend_Db_Expr('cw.website_id'),
                'store_field' => new \Zend_Db_Expr('cs.store_id')
            ]
        );

        $query = $select->insertFromSelect($table);
        $connection->query($query);

        return $this;
    }

}

