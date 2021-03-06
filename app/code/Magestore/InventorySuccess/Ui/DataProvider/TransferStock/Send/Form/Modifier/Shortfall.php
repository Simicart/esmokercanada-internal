<?php

/**
 * Copyright © 2016 Magestore. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magestore\InventorySuccess\Ui\DataProvider\TransferStock\Send\Form\Modifier;

use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Form\Field;
use Magestore\InventorySuccess\Model\ResourceModel\TransferStock\CollectionFactory;
use Magestore\InventorySuccess\Model\TransferStockFactory;
use Magento\Framework\Phrase;
use Magento\Ui\Component\Form;
use Magento\Framework\Stdlib\ArrayManager;
use Magestore\InventorySuccess\Model\TransferStock;
use Magestore\InventorySuccess\Api\Data\TransferStock\TransferPermission;

//use Magestore\InventorySuccess\Model\TransferStock;
//use Magestore\InventorySuccess\Api\Data\TransferStock\TransferPermission;

use Magento\Ui\Component\DynamicRows;
use Magento\Ui\Component\Modal;


/**
 * Class Related
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Shortfall extends \Magestore\InventorySuccess\Ui\DataProvider\TransferStock\Request\Form\Modifier\RequestStock
{

    protected $_sortOrder = '6';

    protected $_dataLinks = 'shortfall_products';
    protected $_groupContainer = 'shortfall_history';


    protected $_groupLabel = 'Shortfall List';


    protected $_fieldsetContent = '';


    protected $_buttonTitle = 'Select Products';


    protected $_modalTitle = '';


    protected $_modalButtonTitle = 'Add Selected Products';

    protected $_modifierConfig = [
        'button_set' => 'product_stock_button_set',
        'modal' => 'add_return_modal',
        'listing' => 'os_transferstock_shortfall_send_product_selection',
        'form' => 'os_transferstock_send_form',
        'columns_ids' => 'os_transferstock_shortfall_send_product_selection_columns.ids',
        'history_listing' => 'transferstock_shortfall_send_history'
    ];

    protected $_mapFields = [
        'id' => 'product_id',
        'sku' => 'product_sku',
        'name' => 'product_name',
        'qty_returned' => 'qty_returned',
        'qty_requested' => 'qty',
        'qty_delivered' => 'qty_delivered',
        'qty_received' => 'qty_received',
        'image' => 'image_url',
        'qty_sent' => 'qty'
    ];

    protected $_modalDataId = 'transferstock_id';

    public function getVisible()
    {
        $transferStock = $this->getCurrentTransferStock();
        if ($transferStock->getId() &&
            $transferStock->getStatus() != TransferStock::STATUS_PENDING &&
            $transferStock->getStatus() != TransferStock::STATUS_CANCEL
        ) {
            return true;
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
            $receiving_products = $this->_coreRegistry->registry("shortfall_products");
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
        $children = [
            $this->_modifierConfig['button_set'] => $this->getCustomButtons(),
            $this->_modifierConfig['modal'] => $this->getCustomModal(),
            $this->_dataLinks => $this->getDynamicGrid(),
            $this->_modifierConfig['history_listing'] => $this->getShortfallListing(),
        ];
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

        if (!$this->_permissionManagement->checkPermission(TransferPermission::SEND_STOCK_ADD_RECEIVING)) {
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
        $receiving_products = $this->_coreRegistry->registry("shortfall_products");
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
    protected
    function getCustomButtons()
    {
        $buttons = [
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
//                'import_button' => [
//                    'arguments' => [
//                        'data' => [
//                            'config' => [
//                                'formElement' => 'container',
//                                'componentType' => 'container',
//                                'component' => 'Magestore_InventorySuccess/js/transferstock/import-receiving-button',
//                                'actions' => [],
//                                'title' => __('Import'),
//                                'provider' => null,
//                            ],
//                        ],
//                    ],
//                ],
            ],
        ];

        if ($this->canShowButtons()) {
            $buttons = $this->getAddProductButton($buttons);
            $buttons = $this->getSaveReturnButton($buttons);
            $buttons = $this->getSaveReceiveButton($buttons);
        }
        $buttons = $this->getDownloadShortfallButton($buttons);
        return $buttons;
    }


    public
    function getAddProductButton($buttons)
    {
        $buttons['children']['return_add_product_button'] = [
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
        ];
        return $buttons;
    }

    public
    function getSaveReturnButton($buttons)
    {
        $buttons['children']['return_save_button'] = [
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
                                        'action' => 'save_return'
                                    ],
                                ]
                            ]
                        ],
                        'title' => __('Save Return'),
                        'provider' => null,
                    ],
                ],
            ],
        ];
        return $buttons;
    }

    public
    function getSaveReceiveButton($buttons)
    {
        $buttons['children']['receiving_save_button'] = [
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
        ];
        return $buttons;
    }

    public
    function getDownloadShortfallButton($buttons)
    {

        $buttons['children']['download_shortfall_button'] = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'formElement' => 'container',
                        'componentType' => 'container',
                        'component' => 'Magestore_InventorySuccess/js/form/components/export-button',
                        'actions' => [
                            [
                                'targetName' =>
                                    $this->_modifierConfig['form'] . '.' . $this->_modifierConfig['form'],

                                'actionName' => 'save',
                                'params' => [
                                    true,
                                    [
                                        'id' => $this->request->getParam('id'),
                                        'action' => 'download_shortfall',
                                    ],
                                ]
                            ]
                        ],
                        'title' => __('Download Shortfall List'),
                        'provider' => null,
                    ],
                ],
            ],
        ];
        return $buttons;
    }


    protected
    function getShortfallListing()
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
    protected
    function fillModifierMeta()
    {
        return [
            'id' => $this->getTextColumn('id', true, __('ID'), 10),
            'sku' => $this->getTextColumn('sku', false, __('SKU'), 20),
            'name' => $this->getTextColumn('name', false, __('Name'), 30),
            'qty_requested' => $this->getTextColumn('qty_sent', false, __('Qty Sent'), 40),
            'qty_received' => $this->getTextColumn('qty_received', false, __('Qty Received'), 60),
            'qty_returned' => $this->getTextColumn('qty_returned', false, __('Qty Returned'), 70),
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
                            'sortOrder' => 80,
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
                            'sortOrder' => 85,
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
                            'sortOrder' => 90,
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
                            'sortOrder' => 100,
                            'visible' => false,
                        ],
                    ],
                ],
            ],

        ];
    }


}
