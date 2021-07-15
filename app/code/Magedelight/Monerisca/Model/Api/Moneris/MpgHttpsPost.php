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

class MpgHttpsPost
{

    public $api_token;
    public $store_id;
    public $app_version;
    public $mpgRequest;
    public $mpgResponse;
    public $xmlString;
    public $txnType;
    public $isMPI;

    public function __construct($storeid, $apitoken, $mpgRequestOBJ, $httppostfactory, $mpgresponsefactory)
    {

        $this->store_id=$storeid;
        $this->api_token= $apitoken;
        $this->app_version = null;
        $this->mpgRequest=$mpgRequestOBJ;
        $this->isMPI=$mpgRequestOBJ->getIsMPI();
        $dataToSend=$this->toXML();

        $url = $this->mpgRequest->getURL();
        $this->httppostfactory = $httppostfactory;
        $this->mpgresponsefactory = $mpgresponsefactory;

        $httpsPost = $this->httppostfactory->create(['url' => $url,
                                            'dataToSend' => $dataToSend
                                        ]);
        $response = $httpsPost->getHttpsResponse();

        if (!$response) {
                $response="<?xml version=\"1.0\"?><response><receipt>".
                    "<ReceiptId>Global Error Receipt</ReceiptId>".
                    "<ReferenceNum>null</ReferenceNum><ResponseCode>null</ResponseCode>".
                    "<AuthCode>null</AuthCode><TransTime>null</TransTime>".
                    "<TransDate>null</TransDate><TransType>null</TransType><Complete>false</Complete>".
                    "<Message>Global Error Receipt</Message><TransAmount>null</TransAmount>".
                    "<CardType>null</CardType>".
                    "<TransID>null</TransID><TimedOut>null</TimedOut>".
                    "<CorporateCard>false</CorporateCard><MessageId>null</MessageId>".
                    "</receipt></response>";
        }

        $this->mpgResponse = $this->mpgresponsefactory->create(['xmlString' => $response
                                        ]);
    }

    public function setAppVersion($app_version)
    {
        $this->app_version = $app_version;
    }

    public function getMpgResponse()
    {
        return $this->mpgResponse;
    }

    public function toXML()
    {

        $req=$this->mpgRequest;
        $reqXMLString=$req->toXML();

        if ($this->isMPI === true) {
            $this->xmlString .="<?xml version=\"1.0\"?>".
                                "<MpiRequest>".
                                    "<store_id>$this->store_id</store_id>".
                                    "<api_token>$this->api_token</api_token>";

            if ($this->app_version != null) {
                $this->xmlString .= "<app_version>$this->app_version</app_version>";
            }

            $this->xmlString .=     $reqXMLString.
                                "</MpiRequest>";
        } else {
            $this->xmlString .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>".
                                "<request>".
                                    "<store_id>$this->store_id</store_id>".
                                    "<api_token>$this->api_token</api_token>";

            if ($this->app_version != null) {
                $this->xmlString .= "<app_version>$this->app_version</app_version>";
            }

            $this->xmlString .=     $reqXMLString.
                                "</request>";
        }

        return ($this->xmlString);
    }
}
