<?php
/**
 * Copyright © 2016 Magestore. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magestore\BarcodeSuccess\Observer\Webpos\Catalog\Product;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magestore\BarcodeSuccess\Model\ResourceModel\Barcode\CollectionFactory;

class WebposProductSearchOnline implements ObserverInterface
{
    /**
     * @var MappingManagementInterface
     */
    protected $_barcodeCollectionFactory;

    /**
     * WebposLocationSaveAfter constructor.
     * @param MappingManagementInterface $mappingManagement
     */
    public function __construct(
        CollectionFactory $_barcodeCollectionFactory
    )
    {
        $this->_barcodeCollectionFactory = $_barcodeCollectionFactory;
    }

    /**
     * @param EventObserver $observer
     * @return $this
     */
    public function execute(EventObserver $observer)
    {
        $barcodeString = $observer->getSearchString();
        $result = $observer->getResult();
        if ($barcodeString && $barcodeString!= '') {
            $barcodes = $this->_barcodeCollectionFactory->create()
                ->addFieldToFilter('barcode',  array('like' => $barcodeString));
            $list_sku = $barcodes->getColumnValues('product_sku');
            $result->setData($list_sku);
        }
    }
}