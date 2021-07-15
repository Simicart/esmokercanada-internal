<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 09/12/2016
 * Time: 10:14
 */

namespace Magenest\UltimateFollowupEmail\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Catalog\Model\ResourceModel\Product\Gallery;
use Magento\Framework\Setup\SetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    const DOWNLOADABLE_LINK_TABLE = "magenest_ultimatefollowupemail_downloadable_link";
    const CAPTURED_GUEST_TABLE = "magenest_ultimatefollowupemail_guest_capture";
    const ABANDONED_CART_TABLE = "magenest_ultimatefollowupemail_guest_abandoned_cart";
    const MAIL_LOG_TABLE = "magenest_ultimatefollowupemail_mail_log";

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '2.1.0', '<')) {
            $this->addDownloadableLinkTable($setup);
        }
        if (version_compare($context->getVersion(), '100.2.2', '<')) {
            $this->addCapturedGuestTable($setup);
            $this->addIsProcessedColumn($setup);
        }
        if (version_compare($context->getVersion(), '100.2.3', '<')) {
            $this->addCouponTimeColumn($setup);
            $this->addFueColumnToCouponTable($setup);
            $this->addFueColumnToSalesruleTable($setup);
            $this->addLogColumnToMailLogTable($setup);
        }
        $setup->endSetup();
    }

    /**
     * @param $setup
     */
    public function addDownloadableLinkTable(SetupInterface $setup)
    {
        $tableName = $setup->getTable(self::DOWNLOADABLE_LINK_TABLE);
        if (!$setup->tableExists($tableName)) {
            $table = $setup->getConnection()->newTable(
                $setup->getTable($tableName)
            )->addColumn(
                'entity_id',
                Table::TYPE_INTEGER,
                null,
                [
                    'identity' => true,
                    'unsigned' => true,
                    'nullable' => false,
                    'primary' => true
                ],
                'Entity ID'
            )->addColumn(
                'link_file',
                Table::TYPE_TEXT,
                255,
                ['nullable' => true],
                'Link File'
            )->addColumn(
                'state',
                Table::TYPE_TEXT,
                100,
                ['nullable' => true],
                'State of the Link'
            )->addColumn(
                'product_name',
                Table::TYPE_TEXT,
                255,
                ['nullable' => true],
                'Product Name'
            )->addColumn(
                'product_id',
                Table::TYPE_INTEGER,
                11,
                ['nullable' => true],
                'Product Id'
            )->setComment('Downloadable Link');

            $setup->getConnection()->createTable($table);
        }
    }
    /**
     * @param $setup
     */
    public function addCapturedGuestTable(SetupInterface $setup)
    {
        /**
         * Table to capture the email of guest customer immediately
         */
        $table = $setup->getConnection()
            ->newTable($setup->getTable(self::CAPTURED_GUEST_TABLE))
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Field Mapping id'
            )
            ->addColumn(
                'quote_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false,'unsigned' => true],
                'Quote id'
            )
            ->addColumn(
                'email',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Billing email guest enters in checkout'
            )
            ->addColumn(
                'type',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Type is guest or customer'
            )
            ->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false , 'default'=>0],
                'Status Id'
            )
            ->setComment('Guest email');
        $setup->getConnection()->createTable($table);
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function addIsProcessedColumn($setup)
    {
        if (!$setup->tableExists(self::ABANDONED_CART_TABLE)) {
            return;
        };

        $setup->getConnection()->addColumn(
            $setup->getTable(self::ABANDONED_CART_TABLE),
            'is_processed',
            [
                'type' => Table::TYPE_INTEGER,
                null,
                ['nullable' => false , 'default'=>0],
                'comment' =>'Is processed'
            ]
        );
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function addCouponTimeColumn($setup)
    {
        if (!$setup->tableExists('magenest_ultimatefollowupemail_rule')) {
            return;
        };

        $setup->getConnection()->addColumn(
            $setup->getTable('magenest_ultimatefollowupemail_rule'),
            'coupon_time',
            [
                'type' => Table::TYPE_TEXT,
                null,
                ['nullable' => true],
                'comment' =>'Coupon Available Time'
            ]
        );
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function addFueColumnToCouponTable($setup)
    {
        $setup->getConnection()->addColumn(
            $setup->getTable('salesrule_coupon'),
            'mail_id',
            [
                'type' => Table::TYPE_TEXT,
                null,
                ['nullable' => true],
                'comment' =>'Followup Email Id'
            ]
        );
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function addFueColumnToSalesruleTable($setup)
    {
        $setup->getConnection()->addColumn(
            $setup->getTable('salesrule'),
            'is_fue',
            [
                'type' => Table::TYPE_TEXT,
                null,
                ['nullable' => true],
                'comment' =>'Is followup email coupon'
            ]
        );
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function addLogColumnToMailLogTable($setup)
    {
        $columnName = 'log';
        $columnExisted = $setup->getConnection()->tableColumnExists(self::MAIL_LOG_TABLE, $columnName);
        if (!$columnExisted) {
            $setup->getConnection()->addColumn(
                $setup->getTable(self::MAIL_LOG_TABLE),
                $columnName,
                [
                    'type' => Table::TYPE_TEXT,
                    null,
                    ['nullable' => true],
                    'comment' => 'Mail Status Log'
                ]
            );
        }
    }
}
