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
namespace Itoris\GroupedProductConfiguration\Controller\Adminhtml\Settings;


class Settings extends \Magento\Backend\App\Action
{
    const BLOCK_HTML_CACHE_TAG = 'BLOCK_HTML';
    protected function cleanCashe(){

        $cacheFrontendPool = $this->_objectManager->get('Magento\Framework\App\Cache\Frontend\Pool');
        foreach($cacheFrontendPool as $cacheFrontend){
            $cacheFrontend->getBackend()->clean(\Zend_Cache::CLEANING_MODE_ALL, self::BLOCK_HTML_CACHE_TAG);
        }

    }
    public function execute()
    {

        $jsonFactory = $this->_objectManager->create('\Magento\Framework\Controller\Result\JsonFactory');
        /** @var  $resource \Magento\Framework\App\ResourceConnection */
        $resource = $this->_objectManager->create('Magento\Framework\App\ResourceConnection');
        $conn = $resource->getConnection();
        if($this->getRequest()->getParam('product_id')){
            $sql = "SELECT * FROM `{$resource->getTableName('itoris_groupedproduct_rules_settings')}`
                WHERE   product_id = ".$this->getRequest()->getParam('product_id');
            $result = $conn->fetchOne($sql);
            if(!$result){

                $sql = "INSERT INTO  `{$resource->getTableName('itoris_groupedproduct_rules_settings')}` (product_id,show_checkbox,show_image,clickable)
                 VALUES ({$this->getRequest()->getParam('product_id')},{$this->getRequest()->getParam('show_checkbox')},{$this->getRequest()->getParam('show_image')},{$this->getRequest()->getParam('clickable')})";
                $conn->query($sql);
            }else{
                $sql = "UPDATE `{$resource->getTableName('itoris_groupedproduct_rules_settings')}` SET
                        product_id={$this->getRequest()->getParam('product_id')},show_checkbox={$this->getRequest()->getParam('show_checkbox')},
                        show_image={$this->getRequest()->getParam('show_image')},clickable = {$this->getRequest()->getParam('clickable')}
                         WHERE product_id={$this->getRequest()->getParam('product_id')}";

                $conn->query($sql);
            }
        }else{
            $result = $jsonFactory->create();
            return $result->setData(['failed' => true]);
        }
        $this->cleanCashe();
        $result = $jsonFactory->create();
        return $result->setData(['success' => true]);
    }

}