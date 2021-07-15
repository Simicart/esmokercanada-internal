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
namespace Itoris\GroupedProductConfiguration\Block\Frontend\Option;

/**
 * Bundle option checkbox type renderer
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Checkbox extends \Itoris\GroupedProductConfiguration\Block\Frontend\Option
{
    /**
     * @var string
     */
    protected $_template = 'Itoris_GroupedProductConfiguration::bundle/option/checkbox.phtml';
    public function getProductBundle()
    {
        $id_product= $this->_coreRegistry->registry('itoris_id_product_custom');
        $product = $this->_coreRegistry->registry('productBundle-custom_'.$id_product);
        return $product;
    }
    public function setProductBundle($product)
    {
        if($this->_coreRegistry->registry('itoris_id_product_custom')!=$product->getId() || $this->_coreRegistry->registry('itoris_id_product_custom')==NULL ) {
            $this->_coreRegistry->register('productBundle-custom_' . $product->getId(), $product);
            $this->_coreRegistry->register('itoris_id_product_custom', $product->getId());
        }
    }

}
