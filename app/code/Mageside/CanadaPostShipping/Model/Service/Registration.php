<?php
/**
 * Copyright © 2018 Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Model\Service;

use Mageside\CanadaPostShipping\Model\Carrier;

/**
 * Class Registration
 * @package Mageside\CanadaPostShipping\Model\Service
 * @documentation https://www.canadapost.ca/cpo/mc/business/productsservices/developers/services/ecomplatforms/soap/registrationtoken.jsf
 * @documentation https://www.canadapost.ca/cpo/mc/business/productsservices/developers/services/ecomplatforms/soap/registrationinfo.jsf
 */
class Registration extends \Mageside\CanadaPostShipping\Model\Service\AbstractService
{
    /**
     * @var \Magento\Framework\App\Config\ValueFactory
     */
    protected $_configValueFactory;

    /**
     * TODO check availability data list
     * @var array
     */
    protected $_configsToSave = [
        'customer_number'       => 'customer_number',
        'contract_id'           => 'contract_id',
        'username'              => 'username',
        'password'              => 'password',
        'username_development'  => 'username',
        'password_development'  => 'password'
    ];

    /**
     * Registration constructor.
     * @param \Mageside\CanadaPostShipping\Helper\Carrier $carrierHelper
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeData
     * @param \Magento\Framework\Stdlib\DateTime\DateTimeFormatterInterface $dateTimeFormatter
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param ArtifactFactory $artifact
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Shipping\Model\Tracking\Result\ErrorFactory $trackErrorFactory
     * @param \Magento\Shipping\Model\Tracking\Result\StatusFactory $trackStatusFactory
     * @param RatingFactory $ratingClientFactory
     * @param \Mageside\CanadaPostShipping\Model\Currency\CurrencyFactory $currencyFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\App\Config\ValueFactory $configValueFactory
     */
    public function __construct(
        \Mageside\CanadaPostShipping\Helper\Carrier $carrierHelper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeData,
        \Magento\Framework\Stdlib\DateTime\DateTimeFormatterInterface $dateTimeFormatter,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Mageside\CanadaPostShipping\Model\Service\ArtifactFactory $artifact,
        \Magento\Framework\Registry $registry,
        \Magento\Shipping\Model\Tracking\Result\ErrorFactory $trackErrorFactory,
        \Magento\Shipping\Model\Tracking\Result\StatusFactory $trackStatusFactory,
        \Mageside\CanadaPostShipping\Model\Service\RatingFactory $ratingClientFactory,
        \Mageside\CanadaPostShipping\Model\Currency\CurrencyFactory $currencyFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\Config\ValueFactory $configValueFactory
    ) {
        $this->_configValueFactory = $configValueFactory;
        parent::__construct(
            $carrierHelper,
            $scopeConfig,
            $localeData,
            $dateTimeFormatter,
            $productCollectionFactory,
            $artifact,
            $registry,
            $trackErrorFactory,
            $trackStatusFactory,
            $ratingClientFactory,
            $currencyFactory,
            $logger
        );
    }

    /**
     * @return array
     */
    public function getToken()
    {
        $tokenId = '';
        $error = false;
        $messages = [];
        try {
            // Execute Request
            $client = $this->createSoapClient('registration');
            $result = $client->__soapCall('GetMerchantRegistrationToken', [
                'get-merchant-registration-token-request' => [
                    'locale' => $this->_carrierHelper->getConfigCarrier('locale')
                ]
            ], null, null);

            // Parse Response
            if (isset($result->{'token'})) {
                $tokenId = $result->{'token'}->{'token-id'};
            } else {
                $error = true;
                foreach ($result->{'messages'}->{'message'} as $message) {
                    $messages[] = [
                        'code'      => $message->code,
                        'message'   => $message->description
                    ];
                }
            }
        } catch (\SoapFault $exception) {
            $error = true;
            $messages[] = [
                'code'      => trim($exception->faultcode),
                'message'   => trim($exception->getMessage())
            ];
        }

        return ['tokenId' => $tokenId, 'error' => $error, 'messages' => $messages];
    }

    /**
     * @param $tokenId
     * @return array
     */
    public function getMerchantInfo($tokenId)
    {
        $merchant = [];
        $error = false;
        $messages = [];

        //TODO fix cache (need retrieve data directly from database)
        //TODO maybe add 30min time limit validity of token
        if ($this->_carrierHelper->getConfigCarrier('registration_token_id') != $tokenId) {
            return [
                'error'     => true,
                'messages'  => ['message' => __('Token id is not valid.')]
            ];
        }

        try {
            // Execute Request
            $client = $this->createSoapClient('registration');
            $result = $client->__soapCall('GetMerchantRegistrationInfo', array(
                'get-merchant-registration-info-request' => array(
                    'locale'	=> $this->_carrierHelper->getConfigCarrier('locale'),
                    'token-id'	=> $tokenId
                )
            ), NULL, NULL);

            // Parse Response
            if (isset($result->{'merchant-info'})) {
                if (isset($result->{'merchant-info'}->{'customer-number'})) {
                    $merchant['customer_number'] = $result->{'merchant-info'}->{'customer-number'};
                }
                if (isset($result->{'merchant-info'}->{'contract-number'})) {
                    $merchant['contract_id'] = $result->{'merchant-info'}->{'contract-number'};
                }
                if (isset($result->{'merchant-info'}->{'merchant-username'})) {
                    $merchant['username'] = $result->{'merchant-info'}->{'merchant-username'};
                }
                if (isset($result->{'merchant-info'}->{'merchant-password'})) {
                    $merchant['password'] = $result->{'merchant-info'}->{'merchant-password'};
                }
                $merchant['hasDefaultCC'] = $result->{'merchant-info'}->{'has-default-credit-card'};
            } else {
                $error = true;
                foreach ($result->{'messages'}->{'message'} as $message) {
                    $messages[] = [
                        'code'      => $message->code,
                        'message'   => $message->description
                    ];
                }
            }
        } catch (\SoapFault $exception) {
            $error = true;
            $messages[] = [
                'code'      => trim($exception->faultcode),
                'message'   => trim($exception->getMessage())
            ];
        }

        return ['merchant' => $merchant, 'error' => $error, 'messages' => $messages];
    }

    /**
     * @param $merchant
     * @return $this
     */
    public function saveMerchantInfo($merchant)
    {
        foreach ($this->_configsToSave as $path => $source) {
            if (isset($merchant[$source])) {
                $this->saveConfigValue(
                    'carriers/' . Carrier::CODE . '/' . $path,
                    $merchant[$source]
                );
            }
        }

        return $this;
    }

    /**
     * @param $path
     * @param $value
     * @return $this
     */
    public function saveConfigValue($path, $value)
    {
        $this->_configValueFactory->create()
            ->load($path, 'path')
            ->setValue($value)
            ->setPath($path)
            ->save();

        return $this;
    }
}
