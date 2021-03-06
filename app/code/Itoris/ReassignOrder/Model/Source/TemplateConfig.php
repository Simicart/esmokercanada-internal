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
 * @package    ITORIS_M2_REASSIGN_ORDER
 * @copyright  Copyright (c) 2016 ITORIS INC. (http://www.itoris.com)
 * @license    http://www.itoris.com/magento-extensions-license.html  Commercial License
 */
namespace Itoris\ReassignOrder\Model\Source;

class TemplateConfig implements \Magento\Framework\Option\ArrayInterface
{
    const EMAIL_TEMPLATE_ID='itoris_email_reassignorder';
    protected $_objectManager;
    public function getObjectManager(){
        if($this->_objectManager)
            return $this->_objectManager;
        return $this->_objectManager= \Magento\Framework\App\ObjectManager::getInstance();
    }
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        /** @var  $colection \Magento\Email\Model\ResourceModel\Template\Collection */
        $colection = $this->getObjectManager()->create('Magento\Email\Model\ResourceModel\Template\Collection');
        $colection->getSelect()->reset(\Zend_Db_Select::COLUMNS)->columns(['template_id','template_code']);
        $colection->getSelect()->where("orig_template_code='".self::EMAIL_TEMPLATE_ID."'");
        $data = $colection->getData();
        $templ[]=['value' => self::EMAIL_TEMPLATE_ID, 'label' => __('Order reassigned (Default Template from Locale)')];
        if($data){
            foreach($data as $template){
                $templ[]=['value'=>$template['template_id'],'label'=>$template['template_code']];
            }
        }
        return $templ;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [0 => __('No'), 1 => __('Yes')];
    }
}
