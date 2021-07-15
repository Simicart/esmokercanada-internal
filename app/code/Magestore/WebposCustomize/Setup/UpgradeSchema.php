<?php
/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

namespace Magestore\WebposCustomize\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Setup\EavSetup;

class UpgradeSchema implements  UpgradeSchemaInterface
{
    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * UpgradeSchema constructor.
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('quote'),
                'rewards_earn',
                array(
                    'type'      => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'nullable'  => true,
                    'length'    => '11',
                    'comment'   => 'Reward Points Earn'
                )
            );
            $setup->getConnection()->addColumn(
                $setup->getTable('quote'),
                'rewards_spent',
                array(
                    'type'      => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'nullable'  => true,
                    'length'    => '11',
                    'comment'   => 'Reward Points Spent'
                )
            );
            $setup->getConnection()->addColumn(
                $setup->getTable('quote'),
                'rewards_base_amount',
                array(
                    'type'      => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'nullable'  => false,
                    'default'   => 0,
                    'length'    => '12,4',
                    'comment'   => 'Reward Points Base Amount'
                )
            );
            $setup->getConnection()->addColumn(
                $setup->getTable('quote'),
                'rewards_amount',
                array(
                    'type'      => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                    'nullable'  => false,
                    'default'   => 0,
                    'length'    => '12,4',
                    'comment'   => 'Reward Points Amount'
                )
            );
        }
        $setup->endSetup();

    }
}