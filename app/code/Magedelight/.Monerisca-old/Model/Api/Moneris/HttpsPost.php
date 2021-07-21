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

namespace Magedelight\Monerisca\Model\Api\Moneris;

class HttpsPost
{
    public $url;
    public $dataToSend;
    public $clientTimeOut;
    public $apiVersion;
    public $response;
    public $debug = false; //default is false for production release

    public function __construct($url, $dataToSend)
    {
        $this->url=$url;
        $this->dataToSend=$dataToSend;
        $g = new \Magedelight\Monerisca\Model\Api\Moneris\MpgGlobals();
        $gArray=$g->getGlobals();
        $clientTimeOut = $gArray['CLIENT_TIMEOUT'];
        $apiVersion = $gArray['API_VERSION'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->dataToSend);
        curl_setopt($ch, CURLOPT_TIMEOUT, $clientTimeOut);
        curl_setopt($ch, CURLOPT_USERAGENT, $apiVersion);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        //curl_setopt($ch, CURLOPT_CAINFO, "PATH_TO_CA_BUNDLE");

        $this->response = curl_exec($ch);

        curl_close($ch);
    }

    public function getHttpsResponse()
    {
        return $this->response;
    }
}
