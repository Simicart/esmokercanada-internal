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
namespace Itoris\GroupedProductConfiguration\Ui\DataProvider\Product\Form\Modifier;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Ui\Component\Form;
use Magento\Ui\Component\Container;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Locale\CurrencyInterface;
class GroupedProductSettings extends \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier
{

    /**
     * @var LocatorInterface
     */
    protected $locator;
    protected $em;
    /**
     * @var ArrayManager
     */
    protected $arrayManager;
    protected $meta = [];
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    const GROUP_CUSTOM_OPTIONS_SCOPE = 'data.product';
    const GROUP_CUSTOM_OPTIONS_NAME = 'itoris_grouped_conf_product';
    const GROUP_CUSTOM_OPTIONS_PREVIOUS_NAME = 'search-engine-optimization';
    const GROUP_CUSTOM_OPTIONS_DEFAULT_SORT_ORDER = 32;
    const IMPORT_OPTIONS_MODAL = 'import_options_modal';
    const CUSTOM_OPTIONS_LISTING = 'product_custom_options_listing';
    const CONTAINER_OPTION = 'container_option';
    /**
     * @var CurrencyInterface
     */
    private $localeCurrency;

    public function __construct(
        LocatorInterface $locator,
        ArrayManager $arrayManager
    ) {
        $this->locator = $locator;
        $this->arrayManager = $arrayManager;
    }
    protected function getNextGroupSortOrder(array $meta, $groupCodes, $defaultSortOrder, $iteration = 1)
    {
        $groupCodes = (array)$groupCodes;

        foreach ($groupCodes as $groupCode) {
            if (isset($meta[$groupCode]['arguments']['data']['config']['sortOrder'])) {
                return $meta[$groupCode]['arguments']['data']['config']['sortOrder'] + $iteration;
            }
        }

        return $defaultSortOrder;
    }
    /**
     * {@inheritdoc}
     */
    public function modifyMeta(array $meta)
    {
        $this->em=\Magento\Framework\App\ObjectManager::getInstance();
        /** @var  $layout \Magento\Framework\View\LayoutInterface */
         $layout = $this->em->create('Magento\Framework\View\LayoutInterface');
        $this->meta = $meta;
        $this->createCustomOptionsPanel();

        return $this->meta;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {

        return array_replace_recursive($data, [

        ]);
    }
    /**
     * Create "Customizable Options" panel
     *
     * @return $this
     */
    protected function createCustomOptionsPanel()
    {
        $this->em=\Magento\Framework\App\ObjectManager::getInstance();
       // $layout = $em->create('Magento\Framework\View\LayoutInterface');
       // $block = $layout->createBlock('Itoris\Producttabsslider\Block\Adminhtml\Grid\ProductTabGrid','itoris.product.tabs');
        $form = $this->em->create('Itoris\GroupedProductConfiguration\Block\Adminhtml\Settings\Edit\Form');
        $handles = $form->getLayout()->getUpdate()->getHandles();
       if(in_array('catalog_product_grouped',$handles)) {
           $product = $this->em->get('Magento\Framework\Registry')->registry('product');
           $this->meta = array_replace_recursive(
               $this->meta,
               [
                   static::GROUP_CUSTOM_OPTIONS_NAME => [
                       'arguments' => [
                           'data' => [
                               'config' => [
                                   'label' => __('Grouped Product Options'),
                                   'componentType' => Fieldset::NAME,
                                   'dataScope' => static::GROUP_CUSTOM_OPTIONS_SCOPE,
                                   'collapsible' => true,
                                   'sortOrder' => $this->getNextGroupSortOrder(
                                       $this->meta,
                                       static::GROUP_CUSTOM_OPTIONS_PREVIOUS_NAME,
                                       static::GROUP_CUSTOM_OPTIONS_DEFAULT_SORT_ORDER
                                   ),
                               ],
                           ],
                       ],
                       'children' => [
                           'itoris_grouped_product' => [
                               'arguments' => [
                                   'data' => [
                                       'config' => [
                                           'label' => null,
                                           'formElement' => Container::NAME,
                                           'componentType' => Container::NAME,
                                           'template' => 'ui/form/components/complex',
                                           'sortOrder' => 10,
                                           'content' => $form->toHtml(),
                                       ],
                                   ],
                               ],
                           ]
                       ]

                   ]
               ]
           );
       }
        return $this;
    }

}