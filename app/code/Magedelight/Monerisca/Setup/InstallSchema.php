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

namespace Magedelight\Monerisca\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{

    /**
     * @param SchemaSetupInterface $setup
     */
    // @codingStandardsIgnoreStart
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
    
        $installer = $setup;
        $installer->startSetup();
        $table     = $installer->getConnection()->newTable(
            $installer->getTable('md_monerisca')
        )->addColumn(
            'card_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Card Id'
        )->addColumn(
            'customer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            '10',
            ['unsigned' => true, 'nullable' => true],
            'Customer ID'
        )->addColumn(
            'website_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            '10',
            ['unsigned' => true, 'nullable' => true],
            'Customer Website Id'
        )->addColumn(
            'data_key',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'Customer Data Key'
        )->addColumn(
            'firstname',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            150,
            [],
            'Card Customer First Name'
        )
                ->addColumn(
                    'lastname',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    150,
                    [],
                    'Card Customer Last Name'
                )
                ->addColumn(
                    'postcode',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    50,
                    [],
                    'PostCode'
                )
                ->addColumn(
                    'country_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    10,
                    [],
                    'Country ID'
                )
                ->addColumn(
                    'region_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '150',
                    [],
                    'Region ID'
                )
                ->addColumn(
                    'state',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '150',
                    [],
                    'State'
                )
                ->addColumn(
                    'city',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '150',
                    [],
                    'CustomerCity'
                )
                ->addColumn(
                    'company',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '150',
                    [],
                    'Customer Company'
                )
                ->addColumn(
                    'street',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [],
                    'Customer Street'
                )
                ->addColumn(
                    'telephone',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '50',
                    [],
                    'Customer Telephone'
                )
                ->addColumn(
                    'cc_exp_month',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '12',
                    [],
                    'Card Exp Month'
                )
                ->addColumn(
                    'cc_last_4',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '100',
                    [],
                    'Card Last Four Digit'
                )
                ->addColumn(
                    'cc_type',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '32',
                    [],
                    'Card Type'
                )
                ->addColumn(
                    'cc_exp_year',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '4',
                    [],
                    'Card Exp Year'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Card Creation Time'
                )->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                    'Card Modification Time'
                )
                ->addForeignKey(// pri col name         //ref tabname     //ref cou name
                    'Monerisca_CUSTOMER_ID',
                    'customer_id', // table column name
                    $installer->getTable('customer_entity'), // ref table name
                    'entity_id', // ref column name
                    \Magento\Framework\DB\Ddl\Table::ACTION_SET_NULL  // on delete
                )->addIndex(
                    $setup->getIdxName(
                        $installer->getTable('md_monerisca'),
                        ['data_key', 'firstname'],
                        AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['data_key', 'firstname'],
                    ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
                );
        $installer->getConnection()->createTable($table);

        $this->createMoneriscaQuotePayment($setup);
        $this->createMoneriscaOrderPayment($setup);
        $installer->endSetup();
    }
// @codingStandardsIgnoreEnd
    /**
     * create quote payment table
     * @param type $setup
     */
    public function createMoneriscaQuotePayment($setup)
    {
        $installer = $setup;
        $table     = $installer->getConnection()->newTable(
            $installer->getTable('md_monerisca_quote_payment')
        )->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Id'
        )->addColumn(
            'quote_payment_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            '10',
            ['unsigned' => true, 'nullable' => true],
            'Quote ID'
        )->addColumn(
            'md_monerisca_data_key',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '30',
            [],
            'Customer Data Key'
        )->addColumn(
            'txn_number',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '64k',
            [],
            'Monerisca TXN Number'
        )->addIndex(
            $setup->getIdxName(
                $installer->getTable('md_monerisca_quote_payment'),
                ['md_monerisca_data_key'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            ['md_monerisca_data_key'],
            ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
        );
        $installer->getConnection()->createTable($table);
    }

    /**
     * crate oreder payment table
     * @param type $setup
     */
    public function createMoneriscaOrderPayment($setup)
    {

        $installer = $setup;
        $table     = $installer->getConnection()->newTable(
            $installer->getTable('md_monerisca_sales_order_payment')
        )->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true],
            'Id'
        )->addColumn(
            'order_payment_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            '10',
            ['unsigned' => true, 'nullable' => true],
            'Order Payment Id'
        )->addColumn(
            'md_monerisca_data_key',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            '30',
            [],
            'Customer Monerisca Data Key'
        )->addColumn(
            'txn_number',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            150,
            [],
            'Txn Number'
        )->addIndex(
            $setup->getIdxName(
                $installer->getTable('md_monerisca_sales_order_payment'),
                ['md_monerisca_data_key'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            ['md_monerisca_data_key'],
            ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
        );
        $installer->getConnection()->createTable($table);
    }
}
