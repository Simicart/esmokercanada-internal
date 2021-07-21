<?php

namespace Magedelight\Monerisca\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        
        $installer = $setup;
        $installer->startSetup();
        $tableName = $installer->getTable('md_monerisca');
        
        if (version_compare($context->getVersion(), '1.0.3', '<' )) {
            if ($setup->getConnection()->isTableExists($tableName) == true) {
                $installer->getConnection()->addColumn(
                    $tableName,
                    'website_id',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        'length' => 10,
                        'nullable' => true,
                        'afters' => 'card_id',
                        'comment' => 'Customer Website Id'
                    ]
                );
            }
        }

        $setup->endSetup();

    }
}