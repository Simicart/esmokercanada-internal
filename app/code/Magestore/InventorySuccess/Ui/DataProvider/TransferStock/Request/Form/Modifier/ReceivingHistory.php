<?php

/**
 * Copyright © 2016 Magestore. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magestore\InventorySuccess\Ui\DataProvider\TransferStock\Request\Form\Modifier;

use Magento\Ui\Component\Form;
use Magestore\InventorySuccess\Model\TransferStock;
use Magento\Ui\Component\DynamicRows;
use Magento\Ui\Component\Modal;
use Magestore\InventorySuccess\Api\Data\TransferStock\TransferPermission;

/**
 * Class Related
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ReceivingHistory extends \Magestore\InventorySuccess\Ui\DataProvider\TransferStock\Request\Form\Modifier\RequestStock
{
    protected $_sortOrder = '3';

    protected $_dataLinks = 'receiving_products';
    protected $_groupContainer = 'receiving_history';


    protected $_groupLabel = 'Receiving History';


    protected $_fieldsetContent = 'Please add or import products to create Receive';


    protected $_buttonTitle = 'Select Products';


    protected $_modalTitle = 'Add Products to create receive';


    protected $_modalButtonTitle = 'Add Selected Products';

    protected $_modifierConfig = [
        'button_set' => 'product_stock_button_set',
        'modal' => 'add_receiving_modal',
        'listing' => 'os_transferstock_receiving_product_selection',
        'form' => 'transferstock_request_form',
        'columns_ids' => 'os_transferstock_receiving_product_selection_columns.ids',
        'history_listing' => 'transferstock_receiving_history'
    ];

    protected $_mapFields = [
        'id' => 'product_id',
        'sku' => 'product_sku',
        'name' => 'product_name',
        'qty_requested' => 'qty_requested',
        'qty_delivered' => 'qty_delivered',
        'qty_received' => 'qty_received',
        'qty_returned' => 'qty_returned',
        'image' => 'image_url',
    ];

    public function getVisible()
    {
        $transferstock_id = $this->request->getParam('id');
        if ($transferstock_id) {
            $transferStock = $this->_transferStockFactory->create()->load($transferstock_id);
            if ($transferStock->getStatus() != TransferStock::STATUS_PENDING && $transferStock->getStatus() != TransferStock::STATUS_CANCEL) {
                return true;
            }
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        if (!$this->getVisible()) {
            return $data;
        }
        $transferstock_id = $this->request->getParam('id');
        if ($transferstock_id) {
            $data[$transferstock_id]['links'][$this->_dataLinks] = [];
            $receiving_products = $this->_coreRegistry->registry("receiving_products");
            $data[$transferstock_id]['links'][$this->_dataLinks] = $receiving_products;
        }
        return $data;
    }


    /**
     * {@inheritdoc}
     */
    public function modifyMeta(array $meta)
    {
        if (!$this->getVisible()) {
            return $meta;
        }

        return parent::modifyMeta($meta);
    }

    /**
     * Retrieve child meta configuration
     *
     * @return array
     */
    protected function getModifierChildren()
    {
        if ($this->canShowButtons()) {
            $children = [
                $this->_modifierConfig['button_set'] => $this->getCustomButtons(),
                $this->_modifierConfig['modal'] => $this->getCustomModal(),
                $this->_dataLinks => $this->getDynamicGrid(),
                $this->_modifierConfig['history_listing'] => $this->getReceivingHistoryListing(),
            ];
        } else {
            $children = [
                $this->_modifierConfig['modal'] => $this->getCustomModal(),
                $this->_dataLinks => $this->getDynamicGrid(),
                $this->_modifierConfig['history_listing'] => $this->getReceivingHistoryListing(),
            ];
        }

        return $children;
    }

    /**
     * hide all buttons: import, select product, save delivery when the current transfer is completed
     * @return bool
     */
    public function canShowButtons()
    {
        $transferStock = $this->getCurrentTransferStock();
        if ($transferStock->getStatus() == TransferStock::STATUS_COMPLETED) {
            return false;
        }

        if (!$this->_permissionManagement->checkPermission(TransferPermission::REQUEST_STOCK_ADD_RECEIVING)) {
            return false;
        }
        return true;
    }

    /**
     * Returns dynamic rows configuration
     *
     * @return array
     */
    protected function getDynamicGrid()
    {
        $receiving_products = $this->_coreRegistry->registry("receiving_products");

        $ShowColumnHeader = false;
        if (count($receiving_products)) {
            $ShowColumnHeader = true;
        }
        $grid = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'additionalClasses' => 'admin__field-wide',
                        'componentType' => DynamicRows::NAME,
                        'label' => null,
                        'renderDefaultRecord' => false,
                        'template' => 'ui/dynamic-rows/templates/grid',
                        'component' => 'Magento_Ui/js/dynamic-rows/dynamic-rows-grid',
                        'addButton' => false,
                        'itemTemplate' => 'record',
                        'dataScope' => 'data.links',
                        'deleteButtonLabel' => __('Remove'),
                        'dataProvider' => $this->_modifierConfig['listing'],
                        'map' => $this->_mapFields,
                        'links' => ['insertData' => '${ $.provider }:${ $.dataProvider }'],
                        'sortOrder' => 20,
                        'columnsHeader' => $ShowColumnHeader,
                        'columnsHeaderAfterRender' => true,
                    ],
                ],
            ],
            'children' => $this->getRows(),
        ];
        return $grid;
    }

    /**
     * Returns Buttons Set configuration
     *
     * @return array
     */
    protected function getCustomButtons()
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'formElement' => 'container',
                        'componentType' => 'container',
                        'label' => false,
                        'content' => __($this->_fieldsetContent),
                        'template' => 'Magestore_InventorySuccess/form/components/button-list',
                    ],
                ],
            ],
            'children' => [
                'import_button' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'formElement' => 'container',
                                'componentType' => 'container',
                                'component' => 'Magestore_InventorySuccess/js/transferstock/import-receiving-button',
                                'actions' => [],
                                'title' => __('Import'),
                                'provider' => null,
                            ],
                        ],
                    ],
                ],
                'delivery_add_product_button' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'formElement' => 'container',
                                'componentType' => 'container',
                                'component' => 'Magento_Ui/js/form/components/button',
                                'actions' => [
                                    [
                                        'targetName' =>
                                            $this->_modifierConfig['form'] . '.' . $this->_modifierConfig['form']
                                            . '.'
                                            . $this->_groupContainer
                                            . '.'
                                            . $this->_modifierConfig['modal'],
                                        'actionName' => 'openModal',
                                    ],
                                    [
                                        'targetName' =>
                                            $this->_modifierConfig['form'] . '.' . $this->_modifierConfig['form']
                                            . '.'
                                            . $this->_groupContainer
                                            . '.'
                                            . $this->_modifierConfig['modal']
                                            . '.'
                                            . $this->_modifierConfig['listing'],
                                        'actionName' => 'render',
                                    ],
                                ],
                                'title' => __($this->_buttonTitle),
                                'provider' => null,
                            ],
                        ],
                    ],
                ],

                'receiving_save_button' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'formElement' => 'container',
                                'componentType' => 'container',
                                'component' => 'Magento_Ui/js/form/components/button',
                                'actions' => [
                                    [
                                        'targetName' =>
                                            $this->_modifierConfig['form'] . '.' . $this->_modifierConfig['form'],

                                        'actionName' => 'save',
                                        'params' => [
                                            true,
                                            [
                                                'id' => $this->request->getParam('id'),
                                                'action' => 'save_receiving'
                                            ],
                                        ]
                                    ]
                                ],
                                'title' => __('Save Receive'),
                                'provider' => null,
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    protected function getReceivingHistoryListing()
    {
        $grid = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'autoRender' => true,
                        'componentType' => 'insertListing',
                        'dataScope' => $this->_modifierConfig['history_listing'],
                        'externalProvider' =>
                            $this->_modifierConfig['history_listing']
                            . '.'
                            . $this->_modifierConfig['history_listing']
                            . '_data_source',
                        'ns' => $this->_modifierConfig['history_listing'],
                        'render_url' => $this->urlBuilder->getUrl('mui/index/render'),
                        'realTimeLink' => true,
                        'dataLinks' => [
                            'imports' => false,
                            'exports' => true
                        ],
                        'behaviourType' => 'simple',
                        'externalFilterMode' => true,
                        'imports' => [
                            'transferstock_id' => '${ $.provider }:data.transferstock_id',
                        ],
                        'exports' => [
                            'transferstock_id' => '${ $.externalProvider }:params.transferstock_id',
                        ],
                    ],
                ],
            ],
        ];
        return $grid;
    }

    /**
     * Fill meta columns
     *
     * @return array
     */
    protected function fillModifierMeta()
    {
        return [
            'id' => $this->getTextColumn('id', true, __('ID'), 10),
            'sku' => $this->getTextColumn('sku', false, __('SKU'), 20),
            'name' => $this->getTextColumn('name', false, __('Name'), 30),
            'qty_requested' => $this->getTextColumn('qty_requested', false, __('Qty Requested'), 40),
            'qty_delivered' => $this->getTextColumn('qty_delivered', false, __('Qty Delivered'), 50),
            'qty_received' => $this->getTextColumn('qty_received', false, __('Qty Received'), 60),
            'qty' => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'dataType' => Form\Element\DataType\Number::NAME,
                            'formElement' => Form\Element\Input::NAME,
                            'componentType' => Form\Field::NAME,
                            'dataScope' => 'qty',
                            'label' => __('Qty'),
                            'fit' => true,
                            'additionalClasses' => 'admin__field-small',
                            'sortOrder' => 70,
                            'validation' => [
                                'validate-number' => true,
                                'validate-greater-than-zero' => true,
                                'required-entry' => true,
                            ],
                        ],
                    ],
                ],
            ],
            'image' => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'componentType' => Form\Field::NAME,
                            'formElement' => Form\Element\Input::NAME,
//                            'elementTmpl' => 'ui/dynamic-rows/cells/thumbnail',
                            'elementTmpl' => 'Magestore_InventorySuccess/dynamic-rows/cells/thumbnail',
                            'dataType' => Form\Element\DataType\Media::NAME,
                            'dataScope' => 'image',
                            'fit' => __('Thumbnail'),
                            'label' => __('Thumbnail'),
                            'sortOrder' => 75,
                            'visible' => $this->getVisibleImage()
                        ],
                    ],
                ],
            ],

            'actionDelete' => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'additionalClasses' => 'data-grid-actions-cell',
                            'componentType' => 'actionDelete',
                            'dataType' => Form\Element\DataType\Text::NAME,
                            'label' => __('Actions'),
                            'sortOrder' => 80,
                            'fit' => true,
                        ],
                    ],
                ],
            ],
            'position' => [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'dataType' => Form\Element\DataType\Number::NAME,
                            'formElement' => Form\Element\Input::NAME,
                            'componentType' => Form\Field::NAME,
                            'dataScope' => 'position',
                            'sortOrder' => 90,
                            'visible' => false,
                        ],
                    ],
                ],
            ],
        ];
    }
}
