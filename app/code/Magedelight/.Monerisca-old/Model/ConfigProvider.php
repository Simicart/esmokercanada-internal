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

namespace Magedelight\Monerisca\Model;

use Magento\Payment\Model\CcGenericConfigProvider;
use Magento\Payment\Helper\Data as PaymentHelper;
use Magento\Payment\Model\CcConfig;

class ConfigProvider extends CcGenericConfigProvider
{
    public $methodCodes = [
        Payment::CODE,
    ];
    public $cards;
    public $encryptor;
    public $config;
    public $checkoutSession;
    public $customerSession;
    public $dataHelper;
    public $urlBuilder;
    public $cardfactory;
    public $sessionquote;
    public $paymentConfig;
    // @codingStandardsIgnoreStart
    public function __construct(
        CcConfig $ccConfig,
        PaymentHelper $paymentHelper,
        \Magedelight\Monerisca\Model\Config $config,
        \Magento\Checkout\Model\Session\Proxy $checkoutSession,
        \Magento\Customer\Model\Session\Proxy $customerSession,
        \Magento\Framework\Url $urlBuilder,
        \Magento\Payment\Model\Config $paymentConfig,
        \Magento\Backend\Model\Session\Quote $sessionquote,
        \Magedelight\Monerisca\Helper\Data $dataHelper,
        \Magento\Framework\Encryption\Encryptor $encryptor,
        CardsFactory $cardFactory,
        array $methodCodes = []
    ) {

        parent::__construct($ccConfig, $paymentHelper, $methodCodes);
        $this->config          = $config;
        $this->checkoutSession = $checkoutSession;
        $this->customerSession = $customerSession;
        $this->urlBuilder      = $urlBuilder;
        $this->paymentConfig  = $paymentConfig;
        $this->dataHelper      = $dataHelper;
        $this->encryptor       = $encryptor;
        $this->cardfactory     = $cardFactory;
        $this->sessionquote    = $sessionquote;
    }
     // @codingStandardsIgnoreEnd
    /**
     * Returns applicable stored cards.
     *
     * @return array
     */
    public function getStoredCards()
    {
        $result   = [];
        $cardData = [];
        $websiteId =  $this->dataHelper->getWebsiteId();
        $customer_account_scope =  $this->dataHelper->getCustomerAccountScope();
        
        if ($this->dataHelper->checkAdmin()) {
            $customerId = $this->sessionquote->getQuote()->getCustomerId();
        } else {
            $customer   = $this->customerSession->getCustomer();
            $customerId = $customer->getId();
        }
        if (!empty($customerId)) {
            $cardModel = $this->cardfactory->create();
            $cardData  = $cardModel->getCollection()
                ->addFieldToFilter('customer_id', $customerId);
            
            if ($customer_account_scope) {
               $cardData->addFieldToFilter('website_id', $websiteId);
            }
            $cardData->getData();
        }

        foreach ($cardData as $key => $_card) {
            $cardReplaced  = 'XXXX-'.$_card['cc_last_4'];
            $result[$this->encryptor->encrypt($_card['data_key'])] = sprintf(
                '%s, %s %s',
                $cardReplaced,
                $_card['firstname'],
                $_card['lastname']
            );
        }
        $result['new'] = 'Use other card';

        return $result;
    }

    public function getCcAvailableCcTypes()
    {
        return $this->dataHelper->getCcAvailableCardTypes();
    }

    public function canSaveCard()
    {
        if (!$this->config->getSaveCardOptional()) {
            return true;
        }
        return false;
    }

    public function getCcMonths()
    {
        return $this->paymentConfig->getMonths();
    }

    public function show3dSecure()
    {
        return false;
    }

    public function getConfig()
    {
   
        if (!$this->config->getIsActive()) {
            return [];
        }
        
        $config       = array_merge_recursive(
            [
            'payment' => [
                \Magedelight\Monerisca\Model\Payment::CODE => [
                    'canSaveCard' => $this->canSaveCard(),
                    'storedCards' => $this->getStoredCards(),
                    'ccMonths' => $this->getCcMonths(),
                    'ccYears' => $this->getCcYears(),
                    'hasVerification' => $this->config->isCardVerificationEnabled(),
                    'creditCardExpMonth' => (int) $this->dataHelper->getTodayMonth(),
                    'creditCardExpYear' => (int) $this->dataHelper->getTodayYear(),
                    'availableCardTypes' => $this->getCcAvailableCcTypes(),
                ],
            ],
            ]
        );
        return $config;
    }
}
