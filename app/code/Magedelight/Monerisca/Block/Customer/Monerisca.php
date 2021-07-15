<?php
/**
* Magedelight
* Copyright (C) 2017 Magedelight <info@magedelight.com>
*
* @category Magedelight
* @package Magedelight_Monerisca
* @copyright Copyright (c) 2017 Mage Delight (http://www.magedelight.com/)
* @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
* @author Magedelight <info@magedelight.com>
*/

namespace Magedelight\Monerisca\Block\Customer;

class Monerisca extends \Magento\Directory\Block\Data
{
    /**
     * Magedelight\Monerisca\Api\CardRepositoryInterface
     * @var type
     */
    public $cardRepository;

    /**
     * Scope config
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    public $scopeConfig;

    /**
     * Payment config model
     *
     * @var \Magento\Payment\Model\Config
     */
    public $paymentConfig;

    /**
     * @var \Magento\Customer\Model\Session
     */
    public $customerSession;

    /**
     * @var \Magedelight\Monerisca\Model\ResourceModel\Cards\CollectionFactory
     */
    public $cardCollectionFactory;

    /**
     * @var \Magento\Customer\Block\Address\Renderer\DefaultRenderer
     */
    public $addressRender;

    /**
     * @var \Magento\Directory\Model\CountryFactory
     */
    public $countryFactory;

    /**
     * @var \Magedelight\Monerisca\Model\CardsFactory
     */
    public $cardFactory;

    /**
     * @var Magento\Framework\DataObject
     */
    public $dataObject;

    /**
     * @var Magedelight\Monerisca\Model\Config
     */
    public $monerisConfig;
    
    public $monerisHelper;

    /**
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Directory\Helper\Data $directoryHelper
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Framework\App\Cache\Type\Config $configCacheType
     * @param \Magento\Directory\Model\ResourceModel\Region\CollectionFactory $regionCollectionFactory
     * @param \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory
     * @param \Magento\Payment\Model\Config $paymentConfig
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Customer\Block\Address\Renderer\DefaultRenderer $addressRender
     * @param \Magento\Directory\Model\CountryFactory $countryFactory
     * @param \Magento\Framework\DataObject $dataObject
     * @param \Magento\Directory\Model\ResourceModel\Country $countryResource
     * @param \Magedelight\Monerisca\Model\Config $monerisConfig
     * @param \Magedelight\Monerisca\Model\ResourceModel\Cards\CollectionFactory $cardCollectionFactory
     * @param \Magedelight\Monerisca\Model\CardsFactory $cardsFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Directory\Helper\Data $directoryHelper,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\App\Cache\Type\Config $configCacheType,
        \Magento\Directory\Model\ResourceModel\Region\CollectionFactory $regionCollectionFactory,
        \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory,
        \Magento\Payment\Model\Config $paymentConfig,
        \Magento\Customer\Model\Session\Proxy $customerSession,
        \Magento\Customer\Block\Address\Renderer\DefaultRenderer $addressRender,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        \Magento\Framework\DataObject $dataObject,
        \Magento\Directory\Model\ResourceModel\Country $countryResource,
        \Magedelight\Monerisca\Model\Config $monerisConfig,
        \Magedelight\Monerisca\Model\ResourceModel\Cards\CollectionFactory $cardCollectionFactory,
        \Magedelight\Monerisca\Model\CardsFactory $cardsFactory,
        \Magedelight\Monerisca\Helper\Data $monerisHelper,       
        array $data = []
    ) {
        $this->monerisConfig            = $monerisConfig;
        $this->scopeConfig              = $context->getScopeConfig();
        $this->paymentConfig            = $paymentConfig;
        $this->customerSession          = $customerSession;
        $this->addressRender            = $addressRender;
        $this->countryFactory           = $countryFactory;
        $this->dataObject               = $dataObject;
        $this->countryResource          = $countryResource;
        $this->cardCollectionFactory    = $cardCollectionFactory;
        $this->cardsFactory             = $cardsFactory;
        $this->monerisHelper            = $monerisHelper;
        parent::__construct(
            $context,
            $directoryHelper,
            $jsonEncoder,
            $configCacheType,
            $regionCollectionFactory,
            $countryCollectionFactory,
            $data
        );
    }
 
    public function getCustomer()
    {
        return $this->_customer;
    }

    /**
     * get cc types
     * @return type
     */
    public function getCcAvailableTypes()
    {
        $types          = $this->paymentConfig->getCcTypes();
        $availableTypes = explode(',', $this->monerisConfig->getCcTypes());
        $typesCode      = array_keys($types);
        if ($availableTypes) {
            foreach ($typesCode as $code) {
                if (!in_array($code, $availableTypes)) {
                    unset($types[$code]);
                }
            }
        }

        return $types;
    }

    /**
     * get cc months
     * @return type
     */
    public function getCcMonths()
    {
        $months = $this->getData('cc_months');

        if ($months===null) {
            $months[""] = __('Month');
            $raw_data    = array_merge($months, $this->paymentConfig->getMonths());
            foreach ($raw_data as $key => $value) {
                $key++;
                $monthNum = ($key < 10) ? '0' . $key : $key;
                $months[$monthNum] = $value;
            }
            unset($months[0]);
            $this->setData('cc_months', $months);
        }

        return $months;
    }

    /**
     * get cc years
     * @return type
     */
    public function getCcYears()
    {
        $years = $this->getData('cc_years');
        if (!($years)) {
            $yearsConfig = $this->paymentConfig->getYears();
            $years       = [0 => __('Year')] + $yearsConfig;
            $this->setData('cc_years', $years);
        }

        return $years;
    }

    /**
     * get config value
     * @param type $path
     * @return type
     */
    public function getConfig($path)
    {
        return $this->scopeConfig->getValue(
            $path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * check varification is enable
     * @return type
     */
    public function hasVerification()
    {
        return $this->monerisConfig->isCardVerificationEnabled();
    }

    /**
     * get back url
     * @return string
     */
    public function getBackUrl()
    {
        return $this->_urlBuilder->getUrl('md_monerisca/cards/listing');
    }
}
