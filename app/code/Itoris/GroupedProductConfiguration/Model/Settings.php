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

namespace Itoris\GroupedProductConfiguration\Model;
use Magento\Framework\DataObject\IdentityInterface;
class Settings extends \Magento\Catalog\Model\AbstractModel implements IdentityInterface{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const SETTING_ID = 'setting_id';
    const PRODUCT_ID = 'product_id';
    const SHOW_IMAGE = 'show_image';
    const SHOW_CHECKBOX = 'show_checkbox';
    const CLICKABLE = 'clickable';
    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'grouped_product_configuration';
    /**
     * @var string
     */
    protected $_cacheTag = 'grouped_product_configuration';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'grouped_product_configuration';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Itoris\GroupedProductConfiguration\Model\ResourceModel\Settings');
        parent::_construct(); // TODO: Change the autogenerated stub
    }
    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::SETTING_ID);
    }

    public function setId($id)
    {
        return $this->setData(self::SETTING_ID, $id);
    }
    /**
     * Get Product Id
     *
     * @return int|null
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    public function setProductId($id)
    {
        return $this->setData(self::PRODUCT_ID, $id);
    }
    /**
     * Get Show image
     *
     * @return int|null
     */
    public function getshowImage()
    {
        return $this->getData(self::SHOW_IMAGE);
    }

    public function setShowImage($show)
    {
        return $this->setData(self::SHOW_IMAGE, $show);
    }
    /**
     * Get Show image
     *
     * @return int|null
     */
    public function getShowCheckBox()
    {
        return $this->getData(self::SHOW_CHECKBOX);
    }

    public function setShowCheckBox($show)
    {
        return $this->setData(self::SHOW_CHECKBOX, $show);
    }
    public function getClicable()
    {
        return $this->getData(self::CLICKABLE);
    }

    public function setClicable($clickable)
    {
        return $this->setData(self::CLICKABLE, $clickable);
    }




}