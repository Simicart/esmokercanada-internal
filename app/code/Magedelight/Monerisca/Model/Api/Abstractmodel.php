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

namespace Magedelight\Monerisca\Model\Api;

class Abstractmodel extends \Magento\Framework\DataObject
{
    public $configModel;
    public $inputData = [];
    public $responseData = [];
    public $monerisStoreId;
    public $apiToken;
    public $orderToken;
    public $cvvEnabled;
    public $testMode;
    public $cardCode = [
        'VI' => '001',
        'MC' => '002',
        'AE' => '003',
        'DI' => '004',
    ];

    public function __construct(
        \Magedelight\Monerisca\Model\Config $configModel
    ) {
    
        $this->configModel      = $configModel;
        $this->monerisStoreId   = $this->configModel->getMoneriscaStoreId();
        $this->apiToken         = $this->configModel->getApiToken();
        $this->orderToken       = $this->configModel->getOrderToken();
        $this->cvvEnabled       = $this->configModel->isCardVerificationEnabled();
        $this->testMode         = $this->configModel->getIsTestMode();
    }

    public function setInputData($input = null)
    {
        $this->inputData = $input;

        return $this;
    }

    public function getInputData()
    {
        return $this->inputData;
    }

    public function setResponseData($response = [])
    {
        $this->responseData = $response;

        return $this;
    }

    public function getResponseData()
    {
        return $this->responseData;
    }

    public function getConfigModel()
    {
        return $this->configModel;
    }
}
