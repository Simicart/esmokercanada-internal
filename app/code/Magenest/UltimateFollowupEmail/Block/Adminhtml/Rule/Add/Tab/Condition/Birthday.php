<?php
/**
 * Created by Magenest
 * User: Eric Quach
 * Date: 03/12/2015
 * Time: 13:44
 */
namespace Magenest\UltimateFollowupEmail\Block\Adminhtml\Rule\Add\Tab\Condition;

class Birthday extends \Magento\Backend\Block\Widget\Form\Generic implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{


    /**
     * Return Tab label
     *
     * @return string
     * @api
     */
    public function getTabLabel()
    {
        return __('Condition');
    }


    /**
     * Return Tab title
     *
     * @return string
     * @api
     */
    public function getTabTitle()
    {
        return __('Condition');
    }


    /**
     * Can show tab in tabs
     *
     * @return boolean
     * @api
     */
    public function canShowTab()
    {
        return true;
    }


    /**
     * Tab is hidden
     *
     * @return boolean
     * @api
     */
    public function isHidden()
    {
        return false;
    }


    protected function _prepareForm()
    {

        /*
            * @var \Magento\Framework\Data\Form $form
        */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('rule_');

        $followupEmailRule = $this->_coreRegistry->registry('current_fue_rule');

        if ($this->getRequest()->getParam('id')) {
            $editData = $followupEmailRule->getData();

            if ($editData['website_id']) {
                $editData['website_id'] = unserialize($editData['website_id']);
            }

            if ($editData['customer_group_id']) {
                $editData['customer_group_id'] = unserialize($editData['customer_group_id']);
            }

            $gender = '';
            if ($editData['conditions_serialized']) {
                $editData['condition'] = unserialize($editData['conditions_serialized']);
            }

            if (isset($editData['condition']['gender'])) {
                $gender = $editData['condition']['gender'];
            }

            $editData['id'] = $this->getRequest()->getParam('id');
        } else {
            $gender = '';
        }
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Condition')]);

        $fieldset->addField(
            'condition_gender',
            'select',
            [
             'label'       => __('Gender'),
             'required'    => false,
             'name'        => 'condition[gender]',
             'data-role'   => 'attach-value',
             'data-action' => $gender,

             'values'      => [
                               [
                                'label' => __('Any'),
                                'value' => '',

                               ],                               [
                                                                 'label' => __('Male'),
                                                                 'value' => '1',

                                                                ],                               [
                                                                                                  'label' => __('Female'),
                                                                                                  'value' => '2',
                                                                                                 ],
                              ],
            ]
        );

        // $form->setUseContainer(true);
        $this->setForm($form);

        if ($this->getRequest()->getParam('id')) {
            $form->setValues($editData);
        }

        return parent::_prepareForm();
    }
}
