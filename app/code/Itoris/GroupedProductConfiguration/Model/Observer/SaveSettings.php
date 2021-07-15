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

namespace Itoris\GroupedProductConfiguration\Model\Observer;

use Magento\Framework\Event\ObserverInterface;
class SaveSettings implements ObserverInterface
{
    protected $_scopeConfig;
    protected $tabs = false;
    protected $_objectManager;
    protected $_request;
    protected $_layout;

    public function __construct(
        \Magento\Framework\View\Layout $layout,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->_layout = $layout;
        $this->_objectManager = $objectManager;
        $this->_request = $request;
        $this->_scopeConfig = $scopeConfig;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $dataParamsItoris = $this->_request->getParam('itoris_groped_data_form');
        if (isset($dataParamsItoris)) {
            $resource = $this->_objectManager->create('Magento\Framework\App\ResourceConnection');
            $conn = $resource->getConnection();
            $product = $observer->getEvent()->getProduct();
            if ($this->_request->getActionName() == 'duplicate' && (int)$this->_request->getParam('id') && (int)$product->getId()) {
                $this->duplicateProduct((int)$this->_request->getParam('id'), (int)$product->getId());
                return;
            }
            $sql = "SELECT * FROM `{$resource->getTableName('itoris_groupedproduct_rules_settings')}`
                WHERE   product_id = " . $product->getId();
            $result = $conn->fetchOne($sql);
            if (!$result) {
                $settings = $this->_objectManager->create('Itoris\GroupedProductConfiguration\Model\Settings');
                $settings->setProductId($product->getId());
                $settings->setShowCheckbox($this->_request->getParam('show_checkbox'));
                $settings->setShowImage($this->_request->getParam('show_image'));
                $settings->setShowDescription($this->_request->getParam('show_description'));
                $settings->setClickable($this->_request->getParam('clickable'));
                $settings->save();
            } else {
                $sql = "UPDATE `{$resource->getTableName('itoris_groupedproduct_rules_settings')}` SET
                        product_id={$this->_request->getParam('id')},show_checkbox={$this->_request->getParam('show_checkbox')},
                        show_image={$this->_request->getParam('show_image')},show_description={$this->_request->getParam('show_description')},clickable = {$this->_request->getParam('clickable')}
                         WHERE product_id={$product->getId()}";

                $conn->query($sql);
            }




        }

    }
    const BLOCK_HTML_CACHE_TAG = 'BLOCK_HTML';
    protected function cleanCashe(){

        $cacheFrontendPool = $this->_objectManager->get('Magento\Framework\App\Cache\Frontend\Pool');
        foreach($cacheFrontendPool as $cacheFrontend){
            $cacheFrontend->getBackend()->clean(\Zend_Cache::CLEANING_MODE_ALL, self::BLOCK_HTML_CACHE_TAG);
        }

    }
}