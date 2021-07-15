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

namespace Itoris\GroupedProductConfiguration\Model\Product\Indexer\Stock;

use Magento\Catalog\Model\Product\Attribute\Source\Status as ProductStatus;

class Grouped extends \Magento\GroupedProduct\Model\ResourceModel\Indexer\Stock\Grouped {
    
    protected $_objectManager;
    
    protected $_helperExt;

    protected function _getStockStatusSelect($entityIds = null, $usePrimaryTable = false)
    {
        $this->_objectManager= \Magento\Framework\App\ObjectManager::getInstance();
        $this->_helperExt= $this->_objectManager->create('Itoris\GroupedProductConfiguration\Helper\ExtensionConfig');

        if (!$this->_helperExt->isEnabled()) return parent::_getStockStatusSelect($entityIds, $usePrimaryTable);
        
        $version=$this->_objectManager->create('Itoris\GroupedProductConfiguration\Helper\MagentoVersion');
        if($version->getMagentoVersion()<2.08){
            $select = $this->verSionIndexerOld($entityIds, $usePrimaryTable);
        }else{
            $select = $this->newVersionIndexer($entityIds, $usePrimaryTable);
        }

        return $select;
    }
    
    public function verSionIndexerOld($entityIds = null, $usePrimaryTable = false){
        $objectManager =$this->_objectManager= \Magento\Framework\App\ObjectManager::getInstance();
        /** @var  $resource \Magento\Framework\App\ResourceConnection */
        $resource = $this->_objectManager->create('Magento\Framework\App\ResourceConnection');

        $adapter  = $this->getConnection();
        $idxTable = $usePrimaryTable ? $this->getMainTable() : $this->getIdxTable();
        $select   = $adapter->select()
            ->from(['e' => $this->getTable('catalog_product_entity')], ['entity_id']);
        $this->_addWebsiteJoinToSelect($select, true);
        $this->_addProductWebsiteJoinToSelect($select, 'cw.website_id', 'e.entity_id');
        $select->columns('cw.website_id')
            ->join(
                ['cis' => $this->getTable('cataloginventory_stock')],
                '',
                ['stock_id'])
            ->joinLeft(
                ['cisi' => $this->getTable('cataloginventory_stock_item')],
                'cisi.stock_id = cis.stock_id AND cisi.product_id = e.entity_id',
                [])
            ->joinLeft(
                ['l' => $this->getTable('catalog_product_link')],
                'e.entity_id = l.product_id AND l.link_type_id=' .\Magento\GroupedProduct\Model\ResourceModel\Product\Link::LINK_TYPE_GROUPED,
                [])
            ->joinLeft(
                ['le' => $this->getTable('catalog_product_entity')],
                'le.entity_id = l.linked_product_id',
                [])
            ->joinLeft(
                ['i' => $idxTable],
                'i.product_id = l.linked_product_id AND cw.website_id = i.website_id AND cis.stock_id = i.stock_id',
                [])
            ->columns(['qty' => new \Zend_Db_Expr('0')])
            ->where('cw.website_id != 0')
            ->where('e.type_id = ?', $this->getTypeId())
            ->group(['e.entity_id', 'cw.website_id', 'cis.stock_id']);

        // add limitation of status
        $psExpr = $this->_addAttributeToSelect($select, 'status', 'e.entity_id', 'cs.store_id');
        $psCond = $adapter->quoteInto($psExpr . '=?', 1);

        if ($this->_isManageStock()) {
            $statusExpr = $adapter->getCheckSql('cisi.use_config_manage_stock = 0 AND cisi.manage_stock = 0',
                1, 'cisi.is_in_stock');
        } else {
            $statusExpr = $adapter->getCheckSql('cisi.use_config_manage_stock = 0 AND cisi.manage_stock = 1',
                'cisi.is_in_stock', 1);
        }

        $optExpr = $adapter->getCheckSql("{$psCond}", 'i.stock_status', 0);
        $stockStatusExpr = $adapter->getLeastSql(["MAX({$optExpr})", "MIN({$statusExpr})"]);

        $select->columns([
            'status' => $statusExpr
        ]);

        if (!is_null($entityIds)) {
            $select->where('e.entity_id IN(?)', $entityIds);
        }

        return $select;
    }
    
    public function newVersionIndexer($entityIds = null, $usePrimaryTable = false){
        $connection = $this->getConnection();
        $idxTable = $usePrimaryTable ? $this->getMainTable() : $this->getIdxTable();
        $metadata = $this->getMetadataPool()->getMetadata(\Magento\Catalog\Api\Data\ProductInterface::class);
        $select = \Magento\CatalogInventory\Model\ResourceModel\Indexer\Stock\DefaultStock::_getStockStatusSelect($entityIds, $usePrimaryTable); 
        $select->reset(
            \Magento\Framework\DB\Select::COLUMNS
        )->columns(
            ['e.entity_id', 'cis.website_id', 'cis.stock_id']
        )->joinLeft(
            ['l' => $this->getTable('catalog_product_link')],
            'e.' . $metadata->getLinkField() . ' = l.product_id AND l.link_type_id=' .
            \Magento\GroupedProduct\Model\ResourceModel\Product\Link::LINK_TYPE_GROUPED,
            []
        )->joinLeft(
            ['le' => $this->getTable('catalog_product_entity')],
            'le.entity_id = l.linked_product_id',
            []
        )->joinLeft(
            ['i' => $idxTable],
            'i.product_id = l.linked_product_id AND cis.website_id = i.website_id AND cis.stock_id = i.stock_id',
            []
        )->columns(
            ['qty' => new \Zend_Db_Expr('0')]
        );

        $statusExpression = $this->getStatusExpression($connection);

        //$optExpr = $connection->getCheckSql("le.required_options = 0", 'i.stock_status', 0);
        $stockStatusExpr = $connection->getLeastSql(["MAX(i.stock_status)", "MIN({$statusExpression})"]);

        $select->columns(['status' => $stockStatusExpr]);

        if ($entityIds !== null) {
            $select->where('e.entity_id IN(?)', $entityIds);
        }

        return $select;
    }
}
