<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Ui\DataProvider\Form;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Mageside\CanadaPostShipping\Model\ResourceModel\Pickup\Collection;
use Mageside\CanadaPostShipping\Helper\Carrier as CarrierHelper;
use Magento\Framework\App\Request\DataPersistorInterface;

class Pickup extends AbstractDataProvider
{
    /**
     * @var \Mageside\CanadaPostShipping\Model\ResourceModel\Pickup\Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var CarrierHelper
     */
    protected $carrierHelper;

    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * Pickup constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param Collection $collection
     * @param CarrierHelper $carrierHelper
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Collection $collection,
        CarrierHelper $carrierHelper,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collection;
        $this->carrierHelper = $carrierHelper;
        $this->dataPersistor = $dataPersistor;
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    /**
     * @inheritdoc
     */
    public function getMeta()
    {
        $meta = parent::getMeta();
        $meta['payment_details']['children']['contract_id']['arguments']['data']['config']['default'] =
            $this->carrierHelper->getConfigCarrier('contract_id');
        $meta['payment_details']['children']['method_of_payment']['arguments']['data']['config']['default'] =
            $this->carrierHelper->getConfigCarrier('has_default_credit_card') ? 'CreditCard' : 'Account';

        return $meta;
    }

    /**
     * @inheritdoc
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $record) {
            $this->loadedData[$record->getId()] = $record->getData();
        }

        $data = $this->dataPersistor->get('canada_pickup');
        if (!empty($data)) {
            $pickup = $this->collection->getNewEmptyItem();
            $pickup->setData($data);
            $this->loadedData[$pickup->getId()] = $pickup->getData();
            $this->dataPersistor->clear('canada_pickup');
        }

        return $this->loadedData;
    }
}
