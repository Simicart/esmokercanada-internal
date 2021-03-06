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
namespace Itoris\GroupedProductConfiguration\Block\Adminhtml\Configuration\Product\Edit;

/**
 * Adminhtml cms page edit form block
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getUrl('*/*/newtab'), 'method' => 'post']]
        );
        $form->setUseContainer(true);
        $this->setForm($form);
        $fieldset=$form->addFieldset(
            'base_fieldset',
            ['legend' => __('Grouped Product Configuration'), 'class' => 'fieldset-wide']);
        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' => __('Show QTY for Associated Products as'),
                'title' => __('Show QTY for Associated Products as'),
                'name' => 'is_active',
                'options' => [0 => __('Disabled'), 1 => __('Enabled')]
            ]
        );
        return parent::_prepareForm();

    }
}