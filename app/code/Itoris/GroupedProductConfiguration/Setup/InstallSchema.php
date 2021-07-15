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
namespace Itoris\GroupedProductConfiguration\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
class InstallSchema implements InstallSchemaInterface
{
    protected $magentoConfigTable = 'core_config_data';
    const XML_PATH_MODULE_ENABLED = 'itoris_groupedProductConfiguration/general/enabled';
    const XML_PATH_IMAGE_SUB_PRODUCT_ENABLED = 'itoris_groupedProductConfiguration/general/show_image';
    const XML_PATH_SUB_CLICKABLE_PRODUCT_ENABLED = 'itoris_groupedProductConfiguration/general/make_clickable';
    const XML_PATH_SHOW_QTY_ENABLED = 'itoris_groupedProductConfiguration/general/show_qty_as';
    protected  $_backendConfig;
    public function install(SchemaSetupInterface $setup,
                            ModuleContextInterface $context)
    {
        $obectManager= \Magento\Framework\App\ObjectManager::getInstance();
        $this->_backendConfig=$obectManager->create('Magento\Backend\App\ConfigInterface');
        $setup->startSetup();

        $configNote = $this->_backendConfig->getValue(self::XML_PATH_MODULE_ENABLED);
        if(!isset($configNote)){
            $insert="('".self::XML_PATH_MODULE_ENABLED."', '1')";
            $configNote = $this->_backendConfig->getValue(self::XML_PATH_IMAGE_SUB_PRODUCT_ENABLED);
           /*if(!isset($configNote))
                $insert=$insert.",('".self::XML_PATH_IMAGE_SUB_PRODUCT_ENABLED."', '1')";
            $configNote = $this->_backendConfig->getValue(self::XML_PATH_SUB_CLICKABLE_PRODUCT_ENABLED);
            if(!isset($configNote))
                $insert=$insert.",('".self::XML_PATH_SUB_CLICKABLE_PRODUCT_ENABLED."', '1')";
            $configNote = $this->_backendConfig->getValue(self::XML_PATH_SHOW_QTY_ENABLED);
            if(!isset($configNote))
                $insert=$insert.",('".self::XML_PATH_SHOW_QTY_ENABLED."', '0')";*/
            $setup->run("
            INSERT INTO {$setup->getTable($this->magentoConfigTable)}
            (path, value)
            VALUES {$insert}
            ");
        }
        $setup->run("CREATE TABLE IF NOT EXISTS {$setup->getTable('itoris_groupedproduct_rules_settings')} (
                    `setting_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    `product_id` int(10) UNSIGNED NULL,
                    `clickable` SMALLINT (1)  UNSIGNED DEFAULT 0,
                    `show_image` SMALLINT (1)  UNSIGNED DEFAULT 0,
                    `show_checkbox` SMALLINT (1)  UNSIGNED DEFAULT 0,
                    FOREIGN KEY (`product_id`) REFERENCES {$setup->getTable('catalog_product_entity')} (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE
                ) ENGINE = INNODB DEFAULT CHARSET = UTF8;");
        $setup->endSetup();
    }
}