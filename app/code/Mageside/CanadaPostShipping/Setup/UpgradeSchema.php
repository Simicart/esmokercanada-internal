<?php
/**
 * Copyright © 2018 Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;


class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.3.0', '<')) {
            $connection = $setup->getConnection();
            $connection->addColumn(
                $setup->getTable('mageside_canadapost_shipment'),
                'cost',
                [
                    'type'      => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'nullable'  => true,
                    'length'    => '5,2',
                    'comment'   => 'Cost',
                    'after'     => 'status'
                ]
            );
        }

        $setup->endSetup();
    }
}
