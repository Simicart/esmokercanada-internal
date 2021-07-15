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

namespace Itoris\GroupedProductConfiguration\Helper;


class HelperSettings extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $data=[];
    protected $_objectManager;
    protected $_isExistSettings;
    /**
     * @return string
     */
    public function settingsInit($id){
            $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $resource = $this->_objectManager->create('Magento\Framework\App\ResourceConnection');
            $conn = $resource->getConnection();
            /* @var \Magento\Framework\App\ProductMetadata $productMetadata */
            $conn= $resource->getConnection();
            $sql = "SELECT * FROM `{$resource->getTableName('itoris_groupedproduct_rules_settings')}`
                WHERE   product_id = ".$id;
            $result = $conn->fetchAll($sql);
            $this->_isExistSettings=$result;
         if($result){
             $this->_isExistSettings=true;
             $this->data=$result;
         }else{
             $this->_isExistSettings=$result;
         }



    }
    public function isExistSettings(){
        return $this->_isExistSettings;
    }
    public function getSettings($key=''){
        if($this->_isExistSettings) {
            if (empty($key)) {
                return $this->data[0];
            }
            return $this->data[0][$key];
        }
        return NULL;
    }
}