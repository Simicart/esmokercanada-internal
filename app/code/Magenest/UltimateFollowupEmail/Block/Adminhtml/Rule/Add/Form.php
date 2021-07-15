<?php
/**
 * Created by Magenest
 * User: Eric Quach
 * Date: 29/09/2015
 * Time: 23:29
 */
namespace Magenest\UltimateFollowupEmail\Block\Adminhtml\Rule\Add;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    /**
     * Core system store model
     *
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;


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


    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('rule_');
        $form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('edit_form');
        $form->setAction($this->getUrl('ultimatefollowupemail/rule/post'));

        $type = $this->_coreRegistry->registry('type');
        $followupEmailRule = $this->_coreRegistry->registry('current_fue_rule');

        if (!$type) {
            $abandonedCartUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'abandoned_cart']);
            $orderStatusUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'order_status_change']);

            // customer related rule
            $birthDayUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'customer_birthday', 'group' => 'customer']);
            $customerRegistrationUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'customer_registration', 'group' => 'customer']);
            $customerRegistrationNoPurchaseDayUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'customer_registration_no_purchase', 'group' => 'customer']);

            // order related rule
            $orderPlaceUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'order_is_placed', 'group' => 'order']);
            $orderStatusPendingPaymentUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'order_status_pending_payment', 'group' => 'order']);
            $orderStatusProcessingUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'order_status_processing', 'group' => 'order']);
            $orderStatusClosedUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'order_status_closed', 'group' => 'order']);

            $orderStatusCompleteUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'order_status_complete', 'group' => 'order']);
            $orderStatusCanceledUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'order_status_canceled', 'group' => 'order']);

            $orderStatusHoldedUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'order_status_holded', 'group' => 'order']);
            $orderStatusPaymentReviewUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'order_status_payment_review', 'group' => 'order']);
            $productReviewUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'order_product_review', 'group' => 'order']);

            //send updated downloadable item
            $orderUpdateDownloadableUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'order_updated_item', 'group' => 'order']);

            // newsletter related rule
            $newsletterSubscribeUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'newsletter_subscribe', 'group' => 'newsletter']);
            $newsletterUnsubscribeUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'newsletter_unsubscribe', 'group' => 'newsletter']);

            // wishlist
            $wishlistSharedUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'wishlist_shared', 'group' => 'wishlist']);
            $wishlistReminderUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'wishlist_reminder', 'group' => 'wishlist']);
            $wishlistIsAbandonedUrl = $this->getUrl('ultimatefollowupemail/rule/new', ['_current' => false, 'type' => 'wishlist_is_abandoned', 'group' => 'wishlist']);



            $fieldSet = $form->addFieldset('type_fieldset', ['legend' => __('General Information')]);
            $fieldSet->addField(
                'type',
                'Magenest\UltimateFollowupEmail\Block\Form\Element\Select',
                [
                    'label' => __('Event'),
                    'required' => true,
                    'name' => 'type',
                    'data-action' => 'followup-email-trigger',
                    'values' => [
                        [
                            'label' => __('Select Option'),
                            'value' => '',

                        ],
                        [
                            'label' => __('Abandoned Cart'),
                            'optgroup-name' => __('Shopping Cart'),
                            'value' => [
                                [
                                    'value' => 'abandoned_cart',
                                    'params' => ['data-redirect-url' => $abandonedCartUrl],
                                    'label' => __('Abandoned Cart'),
                                ],
                            ],

                        ],

                        [
                            'label' => __('Customer'),
                            'optgroup-name' => __('Customer'),
                            'value' => [
                                [
                                    'value' => 'customer_registration',
                                    'params' => ['data-redirect-url' => $customerRegistrationUrl],
                                    'label' => __('Customer Registration'),
                                    'title' => 'ustom registration',
                                ],
                                [
                                    'value' => 'customer_birthday',
                                    'params' => ['data-redirect-url' => $birthDayUrl],
                                    'label' => __('Customer Birthday'),
                                ],
                            ],

                        ],
                        [
                            'label' => __('Order'),
                            'optgroup-name' => __('Order'),
                            'value' => [
                                [
                                    'value' => 'order_is_placed',
                                    'params' => ['data-redirect-url' => $orderPlaceUrl],
                                    'label' => __('Order is placed'),
                                ],
                                [
                                    'value' => 'order_status_pending_payment',
                                    'params' => ['data-redirect-url' => $orderStatusPendingPaymentUrl],
                                    'label' => __('Order obtained status pending payment'),
                                ],
                                [
                                    'value' => 'order_status_processing',
                                    'params' => ['data-redirect-url' => $orderStatusProcessingUrl],
                                    'label' => __('Order obtained status processing'),
                                ],
                                [
                                    'value' => 'order_status_closed',
                                    'params' => ['data-redirect-url' => $orderStatusClosedUrl],
                                    'label' => __('Order obtained status closed'),
                                ],
                                [
                                    'value' => 'order_status_complete',
                                    'params' => ['data-redirect-url' => $orderStatusCompleteUrl],
                                    'label' => __('Order obtained status complete'),
                                ],
                                [
                                    'value' => 'order_status_canceled',
                                    'params' => ['data-redirect-url' => $orderStatusCanceledUrl],
                                    'label' => __('Order obtained status canceled'),
                                ],
                                [
                                    'value' => 'order_status_holded',
                                    'params' => ['data-redirect-url' => $orderStatusHoldedUrl],
                                    'label' => __('Order obtained status holded'),
                                ],
                                [
                                    'value' => 'order_status_payment_review',
                                    'params' => ['data-redirect-url' => $orderStatusPaymentReviewUrl],
                                    'label' => __('Order obtained status payment review'),
                                ],
                                [
                                    'value' => 'order_updated_item',
                                    'params' => ['data-redirect-url' => $orderUpdateDownloadableUrl],
                                    'label' => __('Send Updated Item'),
                                ],
                                [
                                    'value' => 'order_product_review',
                                    'params' => ['data-redirect-url' => $productReviewUrl],
                                    'label' => __('Ask Customer for Product Review'),
                                ],
                            ],

                        ],
                        [
                            'label' => __('Newsletter subscribe'),
                            'optgroup-name' => __('Newsletter'),
                            'value' => [
                                [
                                    'value' => 'newsletter_subscribe',
                                    'params' => ['data-redirect-url' => $newsletterSubscribeUrl],
                                    'label' => __('Customer subscribe'),
                                ],
                                [
                                    'value' => 'newsletter_unsubscribe',
                                    'params' => ['data-redirect-url' => $newsletterUnsubscribeUrl],
                                    'label' => __('Customer unsubscribe'),
                                ],
                            ],

                        ],
                        [
                            'label' => __('WishList'),
                            'optgroup-name' => __('Wishlist'),
                            'value' => [
                                [
                                    'value' => 'wishlist_shared',
                                    'params' => ['data-redirect-url' => $wishlistSharedUrl],
                                    'label' => __('Wishlist is shared'),
                                ],
                //                                [
                //                                    'value' => 'wishlist_is_abandoned',
                //                                    'params' => ['data-redirect-url' => $wishlistIsAbandonedUrl],
                //                                    'label' => __('Wishlist is abd'),
                //                                ],
                                [
                                    'value' => 'wishlist_reminder',
                                    'params' => ['data-redirect-url' => $wishlistReminderUrl],
                                    'label' => __('Wishlist Reminder'),
                                ],
                            ],

                        ],
                    ],
                ]
            );
        } else {
            $fieldSet = $form->addFieldset('type_fieldset', ['legend' => __('General Information')]);

            $fieldSet->addField(
                'type',
                'hidden',
                [
                    'name' => 'type'
                ]
            );
            $fieldSet->addField(
                'visible_type',
                'text',
                [
                    'name' => 'visible_type',
                    'readonly' => 'readonly'
                ]
            );
        }

        //add a next button if the param type does not exist in the request

        $type = $this->getRequest()->getParam('type');
        if (!$type) {
            $form->addField(
                'next',
                'button',
                [
                    //  'label'       => __('Next'),
                    'value' => __('Next'),
                    'required' => true,
                    'name' => 'next',
                    'class' => 'action-default scalable next-button',
                    'data-action' => 'followup-email-next',
                ]
            );
        }


        if ($this->getRequest()->getParam('id')) {
            $editData = $followupEmailRule->getData();

            if ($editData['website_id']) {
                $editData['website_id'] = unserialize($editData['website_id']);
            }

            if ($editData['customer_group_id']) {
                $editData['customer_group_id'] = unserialize($editData['customer_group_id']);
            }

            $editData['type'] = $type;
            $editData['visible_type'] = $type;
            $editData['id'] = $this->getRequest()->getParam('id');
        } else {
            $editData = [];
            $editData['type'] = $type;
            $editData['visible_type'] = $type;
        }

        $editData['next'] = __("Next");

        $form->setValues($editData);

        $this->setForm($form);

        return parent::_prepareForm();
    }
}
