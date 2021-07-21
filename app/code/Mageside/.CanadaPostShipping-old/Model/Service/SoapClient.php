<?php
/**
 * Copyright © 2018 Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Model\Service;

use Magento\Framework\Module\Dir;

class SoapClient extends \SoapClient
{
    /**
     * @var \Mageside\CanadaPostShipping\Helper\Carrier
     */
    private $_carrierHelper;

    /**
     * Paths array to wsdl files
     *
     * @var array
     */
    private $_serviceWsdl = [
        'shipment'      => '/wsdl/shipment.wsdl',
        'ncshipment'    => '/wsdl/ncshipment.wsdl',
        'rating'        => '/wsdl/rating.wsdl',
        'artifact'      => '/wsdl/artifact.wsdl',
        'track'         => '/wsdl/track.wsdl',
        'transmit'      => '/wsdl/manifest.wsdl',
        'manifest'      => '/wsdl/manifest.wsdl',
        'registration'  => '/wsdl/merchantregistration.wsdl',
        'postoffice'    => '/wsdl/postoffice.wsdl',
    ];

    /**
     * Path to certificate file
     *
     * @var string
     */
    private $_certificate = '/cert/cacert.pem';

    /**
     * SoapClient constructor.
     *
     * @param \Mageside\CanadaPostShipping\Helper\Carrier $carrierHelper
     * @param string $service
     */
    public function __construct(
        \Mageside\CanadaPostShipping\Helper\Carrier $carrierHelper,
        $service
    ) {
        $this->_carrierHelper = $carrierHelper;
        if (!$this->_carrierHelper->isContractShipment() && $service == 'shipment') {
            $service = 'ncshipment';
        }
        parent::__construct($this->getWsdl($service), $this->getOptions($service));
        $this->setHeader($service);
    }

    /**
     * Need to override SoapClient because the abstract element 'groupIdOrTransmitShipment'
     * is expected to be in the request in order for validation to pass.
     * So, we give it what it expects, but in __doRequest we modify the request by removing the abstract element
     * and add the correct element.
     *
     * @param string $request
     * @param string $location
     * @param string $action
     * @param int $version
     * @param null $one_way
     * @return string
     */
    public function __doRequest($request, $location, $action, $version, $one_way = null) {
        $dom = new \DOMDocument('1.0');
        $dom->loadXML($request);

        //get element name and values of group-id or transmit-shipment.
        $groupIdOrTransmitShipment =  $dom->getElementsByTagName("groupIdOrTransmitShipment")->item(0);
        if ($groupIdOrTransmitShipment) {
            $element = $groupIdOrTransmitShipment->firstChild->firstChild->nodeValue;
            $value = $groupIdOrTransmitShipment->firstChild->firstChild->nextSibling->firstChild->nodeValue;

            //remove bad element
            $newDom = $groupIdOrTransmitShipment->parentNode->removeChild($groupIdOrTransmitShipment);

            //append correct element with namespace
            $body =  $dom->getElementsByTagName("shipment")->item(0);
            $newElement = $dom->createElement($element, $value);
            $body->appendChild($newElement);

            //save $dom to string
            $request = $dom->saveXML();
        }

        //doRequest
        return parent::__doRequest($request, $location, $action, $version);
    }

    /**
     * Get path to wsdl file
     *
     * @param string $service
     * @return string
     */
    private function getWsdl($service)
    {
        return $this->_carrierHelper->getModuleDir(Dir::MODULE_ETC_DIR) . $this->_serviceWsdl[$service];
    }

    /**
     * Get path to certificate file
     *
     * @return string
     */
    private function getCertificate()
    {
        $certificate = trim($this->_carrierHelper->getConfigCarrier('certificate_path'));
        if (!$certificate) {
            $certificate = $this->_carrierHelper->getModuleDir(Dir::MODULE_ETC_DIR) . $this->_certificate;
        }

        return $certificate;
    }

    /**
     * Get SoapClient options
     *
     * @param string $service
     * @return array
     */
    private function getOptions($service)
    {
        // Notice: for tracking always using production environment
        $location = ($this->_carrierHelper->getConfigCarrier('sandbox_mode') && $service != 'track') ?
            $this->_carrierHelper->getConfigCarrier($service . '_development_endpoint_url') :
            $this->_carrierHelper->getConfigCarrier($service . '_production_endpoint_url');
        $hostName = explode('/', $location)[2];

        $opts = [
            'ssl' => [
                'verify_peer'   => true,
                'cafile'        => $this->getCertificate(),
                'peer_name'     => $hostName
            ],
            'http' => ['protocol_version' => 1.0]
        ];

        $ctx = stream_context_create($opts);

        return [
            'location'          => $location,
            'features'          => SOAP_SINGLE_ELEMENT_ARRAYS,
            'stream_context'    => $ctx,
            'trace'             => true
        ];
    }

    /**
     * Create soap client with selected wsdl
     *
     * @param $service
     * @return $this
     */
    private function setHeader($service)
    {
        // Notice: for tracking always using production environment
        if ($service == 'registration') {
            $username = $this->_carrierHelper->getConfigCarrier('platform_username');
            $password = $this->_carrierHelper->getConfigCarrier('platform_password');
        } elseif ($this->_carrierHelper->getConfigCarrier('sandbox_mode') && $service != 'track') {
            $username = $this->_carrierHelper->getConfigCarrier('username_development');
            $password = $this->_carrierHelper->getConfigCarrier('password_development');
        } else {
            $username = $this->_carrierHelper->getConfigCarrier('username');
            $password = $this->_carrierHelper->getConfigCarrier('password');
        }

        $WSSENS = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';
        $usernameToken = new \stdClass();
        $usernameToken->Username = new \SoapVar(
            $username,
            XSD_STRING,
            null,
            null,
            null,
            $WSSENS
        );
        $usernameToken->Password = new \SoapVar(
            $password,
            XSD_STRING,
            null,
            null,
            null,
            $WSSENS
        );
        $content = new \stdClass();
        $content->UsernameToken = new \SoapVar(
            $usernameToken,
            SOAP_ENC_OBJECT,
            null,
            null,
            null,
            $WSSENS
        );
        $header = new \SOAPHeader($WSSENS, 'Security', $content);
        $this->__setSoapHeaders($header);

        return $this;
    }
}
