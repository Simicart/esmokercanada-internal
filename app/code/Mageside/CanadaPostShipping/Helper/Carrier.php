<?php
/**
 * Copyright © 2018 Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Sales\Model\Order\Shipment;

class Carrier extends \Magento\Shipping\Helper\Carrier
{
    /**
     * Code of the carrier
     *
     * @var string
     */
    private $_code = \Mageside\CanadaPostShipping\Model\Carrier::CODE;

    /**
     * @var \Magento\Framework\Module\Dir\Reader
     */
    private $_configReader;

    /**
     * @var \Magento\Directory\Model\RegionFactory
     */
    private $_regionFactory;

    /**
     * Config constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\Module\Dir\Reader $configReader
     * @param \Magento\Directory\Model\RegionFactory $regionFactory
     * @param \Magento\Framework\Locale\ResolverInterface $localeResolver
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Module\Dir\Reader $configReader,
        \Magento\Directory\Model\RegionFactory $regionFactory,
        \Magento\Framework\Locale\ResolverInterface $localeResolver
    ) {
        $this->_configReader = $configReader;
        $this->_regionFactory = $regionFactory;
        return parent::__construct($context, $localeResolver);
    }

    /**
     * Get module settings
     *
     * @param $key
     * @return mixed
     */
    public function getConfigModule($key)
    {
        return $this->scopeConfig->getValue(
            'mageside_canada_post_shipping/general/' . $key,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    public function isModuleEnabled()
    {
        if ($this->getConfigCarrier('active')
            && $this->isModuleOutputEnabled("Mageside_CanadaPostShipping")
        ) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isContractShipment()
    {
        $contractId = $this->getConfigCarrier('contract_id');
        if (!empty($contractId)) {
            return true;
        }

        return false;
    }

    /**
     * Retrieve information from carrier configuration
     *
     * @param $field
     * @return bool|mixed
     */
    public function getConfigCarrier($field)
    {
        return $this->scopeConfig->getValue(
            'carriers/' . $this->_code . '/' . $field,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @param $notify
     * @return bool
     */
    public function getNotificationConfig($notify)
    {
        if (strpos($this->getConfigCarrier('shipment_options'), 'D2PO') !== false) {
            return true;
        }

        if (strpos($this->getConfigCarrier('notification'), $notify) !== false) {
            return true;
        }

        return false;
    }

    /**
     * Get path to module etc directory
     *
     * @param $directory
     * @return string
     */
    public function getModuleDir($directory)
    {
        return $this->_configReader->getModuleDir($directory, 'Mageside_CanadaPostShipping');
    }

    /**
     * @param null $storeId
     * @return \Magento\Framework\DataObject
     */
    public function getStoreConfig($storeId = null)
    {
        $storeConfig = new \Magento\Framework\DataObject();

        $store = new \Magento\Framework\DataObject(
            (array)$this->scopeConfig->getValue(
                'general/store_information',
                ScopeInterface::SCOPE_STORE,
                $storeId
            )
        );

        $shipperRegionCode = $this->scopeConfig->getValue(
            Shipment::XML_PATH_STORE_REGION_ID,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
        if (is_numeric($shipperRegionCode)) {
            $shipperRegionCode = $this->_regionFactory->create()->load($shipperRegionCode)->getCode();
        }
        $originStreet1 = $this->scopeConfig->getValue(
            Shipment::XML_PATH_STORE_ADDRESS1,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
        $originStreet2 = $this->scopeConfig->getValue(
            Shipment::XML_PATH_STORE_ADDRESS2,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );

        $storeConfig->setShipperContactCompanyName($store->getName());
        $storeConfig->setShipperContactPhoneNumber($store->getPhone());
        $storeConfig->setShipperAddressStreet(trim($originStreet1 . ' ' . $originStreet2));
        $storeConfig->setShipperAddressStreet1($originStreet1);
        $storeConfig->setShipperAddressCity(
            $this->scopeConfig->getValue(
                Shipment::XML_PATH_STORE_CITY,
                ScopeInterface::SCOPE_STORE,
                $storeId
            )
        );
        $storeConfig->setShipperAddressStateOrProvinceCode($shipperRegionCode);
        $storeConfig->setShipperAddressPostalCode(
            $this->scopeConfig->getValue(
                Shipment::XML_PATH_STORE_ZIP,
                ScopeInterface::SCOPE_STORE,
                $storeId
            )
        );

        return $storeConfig;
    }

    /**
     * Get store weight unit setting
     *
     * @param $storeId
     * @return string
     */
    public function getStoreWeightUnit($storeId)
    {
        return $this->scopeConfig->getValue(
            'general/locale/weight_unit',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        ) == 'lbs' ? 'LBS' : 'KILOGRAM';
    }
}
