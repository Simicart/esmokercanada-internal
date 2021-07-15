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
namespace Itoris\GroupedProductConfiguration\Block\Adminhtml\Settings\Edit;

use \Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{
    protected $_template = 'Itoris_GroupedProductConfiguration::form.phtml';
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('department_form');
        $this->setTitle(__('Department Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $em=\Magento\Framework\App\ObjectManager::getInstance();
        if($this->getRequest()->getParam('id')!=NULL) {
            /** @var \Itoris\GroupedProductConfiguration\Model\ResourceModel\Settings\Collection $collection */
            $collection = $em->create('Itoris\GroupedProductConfiguration\Model\ResourceModel\Settings\Collection');
            $collection ->getSelect()->reset(\Zend_Db_Select::COLUMNS)->columns('show_checkbox');
            $collection ->getSelect()->columns('show_image');
            $collection ->getSelect()->columns('show_description');
            $collection ->getSelect()->columns('clickable');

            $collection->getSelect()->where('main_table.product_id=' . $this->getRequest()->getParam('id'));
            $helper = $em->create('Itoris\GroupedProductConfiguration\Helper\ExtensionConfig');

            $data = $collection->getData();
        }
        else
            $data=[];
        if(isset($data[0]))
        $data=$data[0];
        if(count($data)==0){
            $data['show_checkbox']=0;
            $data['show_image']=1;
            $data['clickable']=1;
        }
        $data['itoris_groped_data_form']=1;
        $data['clickable_button']=__('Save settings');
        $data['product_id']=$this->getRequest()->getParam('id');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'class'=>'itoris-groped-product-configuration-settings-form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('itoris_grouped_congiguration');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' =>'', 'class' => 'fieldset-wide']
        );
            $fieldset->addField(
                'show_checkbox',
                'select',
                [
                    'label' => __('Show QTY for Associated Products as'),
                    'class' => 'required-entry',
                    'title' => __('Show QTY for Associated Products as'),
                    'name' => 'show_checkbox',
                    'data-form-part'=>"product_form",
                    'options' => [0 => __('Input Box'), 1 => __('Check Box')]
                ]
            );
            $fieldset->addField(
                'show_image',
                'select',
                [
                    'label' => __('Show Images for sub-products'),
                    'class' => 'required-entry',
                    'title' => __('Show Images for sub-products'),
                    'data-form-part'=>"product_form",
                    'name' => 'show_image',
                    'options' => [0 => __('No'), 1 => __('Yes')]
                ]
            );
            $fieldset->addField(
                'show_description',
                'select',
                [
                    'label' => __('Show Short Description for sub-products'),
                    'class' => 'required-entry',
                    'title' => __('Show Short Description for sub-products'),
                    'data-form-part'=>"product_form",
                    'name' => 'show_description',
                    'options' => [0 => __('No'), 1 => __('Yes')]
                ]
            );
            $fieldset->addField(
                'clickable',
                'select',
                [
                    'label' => __('Make sub-products clickable'),
                    'class' => 'required-entry',
                    'title' => __('Make sub-products clickable'),
                    'data-form-part'=>"product_form",
                    'name' => 'clickable',
                    'options' => [0 => __('No'), 1 => __('Yes')]
                ]
            );
        $fieldset->addField(
            'product_id',
            'hidden',
            [
                'name' => 'product_id',
            ]
        );
        $fieldset->addField(
            'itoris_groped_data_form',
            'hidden',
            [
                'data-form-part'=>"product_form",
                'name' => 'itoris_groped_data_form',
            ]
        );

        $form->setValues($data);
        $form->setUseContainer(false);
        $this->setForm($form);

        return parent::_prepareForm();
    }
    public function getUrlSettings(){
        return $this->getUrl('itorisgrouped/settings/settings',['form_key'=>$this->getFormKey()]);
    }
}