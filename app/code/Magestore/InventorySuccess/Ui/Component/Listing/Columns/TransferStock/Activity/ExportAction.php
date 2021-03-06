<?php

/**
 * Copyright © 2016 Magestore. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magestore\InventorySuccess\Ui\Component\Listing\Columns\TransferStock\Activity;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

/**
 * Class Actions.
 *
 * @category Magestore
 * @package  Magestore_InventorySuccess
 * @module   Inventorysuccess
 * @author   Magestore Developer
 */
class ExportAction extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var \Magestore\InventorySuccess\Model\TransferStock\TransferActivityFactory
     */
    protected $_transferActivityFactory;


    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    //protected $_editUrl = 'inventorysuccess/transferstock_activity/view';
    protected $_editUrl = 'inventorysuccess/transferstock_activity/export';
    //protected $_editUrl = 'inventorysuccess/transferstock_request/downloadshortfall';

    /**
     * Constructor.
     *
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        \Magestore\InventorySuccess\Model\TransferStock\TransferActivityFactory $transferActivityFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
        $this->_transferActivityFactory = $transferActivityFactory;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $indexField = $this->getData('config/indexField');
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item[$indexField])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl($this->_editUrl, ['id' => $item[$indexField]]),
                        'label' => __('Export')
                    ];
                }
            }
        }

        return $dataSource;
    }
}
