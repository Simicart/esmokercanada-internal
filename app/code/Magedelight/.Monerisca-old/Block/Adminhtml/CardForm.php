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

namespace Magedelight\Monerisca\Block\Adminhtml;

class CardForm extends \Magento\Directory\Block\Data
{
    // @codingStandardsIgnoreStart
    public $_template = 'cards/form.phtml';
    // @codingStandardsIgnoreEnd
    public $address = null;

    public $customerFactory = null;
    public $addressRepository;

    public $addressDataFactory;

    public $currentCustomer;

    public $dataObjectHelper;

    public $monerisConfig;

    public $paymentConfig;
    public $card;
    public $jsonHelper;
    public $customerRepository;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Directory\Helper\Data $directoryHelper,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Framework\App\Cache\Type\Config $configCacheType,
        \Magento\Directory\Model\ResourceModel\Region\CollectionFactory $regionCollectionFactory,
        \Magento\Directory\Model\ResourceModel\Country\CollectionFactory $countryCollectionFactory,
        \Magento\Customer\Api\AddressRepositoryInterface $addressRepository,
        \Magento\Customer\Api\Data\AddressInterfaceFactory $addressDataFactory,
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper,
        \Magedelight\Monerisca\Model\Config $monerisConfig,
        \Magento\Payment\Model\Config $paymentConfig,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        array $data = []
    ) {
        $this->addressRepository = $addressRepository;
        $this->addressDataFactory = $addressDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->monerisConfig = $monerisConfig;
        $this->customerFactory = $customerFactory;
        $this->paymentConfig = $paymentConfig;
        $this->jsonHelper = $jsonHelper;
        $this->customerRepository = $customerRepository;
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

    public function getCcAvailableTypes()
    {
        $types = $this->_getConfig()->getCcTypes();
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
    public function getCustomer()
    {
        $id = $this->getRequest()->getParam('id');
        return $this->customerRepository->getById($id);
    }
    public function _getConfig()
    {
        return $this->paymentConfig;
    }

    public function getCcMonths()
    {
        $raw_data    = $this->_getConfig()->getMonths();
        foreach ($raw_data as $key => $value) {
            $monthNum = ($key < 10) ? '0' . $key : $key;
            $months[$monthNum] = $value;
        }
        $this->setData('cc_months', $months);
        return $months;
    }

    public function getCcYears()
    {
        return $this->_getConfig()->getYears();
    }

    public function hasVerification()
    {
        return $this->monerisConfig->isCardVerificationEnabled();
    }

    public function setCard($card)
    {
        $this->card = $card;
        return $this;
    }

    public function getCard()
    {
        if (empty($this->card)) {
            return;
        }
        return $this->jsonHelper->jsonDecode($this->card);
    }
    public function getAddAction()
    {
        return $this->getUrl('md_monerisca/cards/add', ['id' => $this->getCustomer()->getId()]);
    }
}
