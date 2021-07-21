<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Model\Service;

class Pickup extends \Mageside\CanadaPostShipping\Model\Service\AbstractService
{
    /**
     * @param $pickup
     * @param string $type
     * @return array
     */
    protected function getCreatePickupRequestData($pickup, $type = 'new')
    {
        $mainBlock = $type == 'new' ? 'pickup-request-details' : 'pickup-request-update';
        $requestData = [
            'customer-number' => $this->_carrierHelper->getConfigCarrier('customer_number'),
            $mainBlock => [
                'pickup-type' => $pickup->getPickupType(),
                'pickup-location' => [
                    'business-address-flag' => !!$pickup->getBusinessAddressFlag()
                ],
                'contact-info' => [
                    'contact-name'  => substr($pickup->getContactName(), 0, 45),
                    'email'         => substr($pickup->getEmail(), 0, 60),
                    'contact-phone' => substr($pickup->getContactPhone(), 0, 16),
                    'receive-email-updates-flag' => !!$pickup->getReceiveEmailUpdatesFlag()
                ],
                'location-details' => [
                    'five-ton-flag'         => !!$pickup->getFiveTonFlag(),
                    'loading-dock-flag'     => !!$pickup->getLoadingDockFlag(),
                    'pickup-instructions'   => substr($pickup->getPickupInstructions(), 0, 40)
                ],
                'items-characteristics' => [
                    'pww-flag'          => !!$pickup->getPwwFlag(),
                    'priority-flag'     => !!$pickup->getPriorityFlag(),
                    'returns-flag'      => !!$pickup->getReturnsFlag(),
                    'heavy-item-flag'   => !!$pickup->getHeavyItemFlag(),
                ],
                'pickup-volume' => substr($pickup->getPickupVolume(), 0, 40),
                'pickup-times' => [
                    'on-demand-pickup-time' => [
                        'date'              => date('Y-m-d', strtotime($pickup->getDate())),
                        'preferred-time'    => $pickup->getPreferredTime(),
                        'closing-time'      => $pickup->getClosingTime()
                    ]
                ],
                'payment-info' => [
                    'method-of-payment' => $pickup->getMethodOfPayment()
                ]
            ]
        ];

        if (!$pickup->getBusinessAddressFlag()) {
            $requestData[$mainBlock]['pickup-location']['alternate-address'] = [
                'company'           => substr($pickup->getCompany(), 0, 35),
                'address-line-1'    => substr($pickup->getAddressLine1(), 0, 35),
                'city'              => substr($pickup->getCity(), 0, 35),
                'province'          => substr($pickup->getProvince(), 0, 2),
                'postal-code'       => substr($this->formatPostCode($pickup->getPostalCode()), 0, 6),
            ];
        }

        if (!empty($pickup->getTelephoneExt())) {
            $requestData[$mainBlock]['contact-info']['telephone-ext'] = substr($pickup->getTelephoneExt(), 0, 6);
        }

        if (!empty($pickup->getContractId())) {
            $requestData[$mainBlock]['payment-info']['contract-id'] = substr($pickup->getContractId(), 0, 10);
        }

        return $requestData;
    }

    /**
     * Create pickup request
     *
     * @see https://www.canadapost.ca/cpo/mc/business/productsservices/developers/services/parcelpickup/soap/createpickup.jsf#
     * @param $pickup
     * @return array
     */
    public function createPickup($pickup)
    {
        $error = false;
        $messages = [];
        try {
            // Execute Request
            $client = $this->createSoapClient('pickup');
            $requestData = $this->getCreatePickupRequestData($pickup);
            $result = $client->__soapCall('CreatePickupRequest', [
                'create-pickup-request-request' => $requestData
            ], null, null);

            // Parse Response
            if (isset($result->{'pickup-request-info'})) {
                $header = $result->{'pickup-request-info'}->{'pickup-request-header'};
                $pickup->setRequestId($header->{'request-id'});
                $pickup->setStatus($header->{'request-status'});
                if (isset($result->{'pickup-request-info'}->{'pickup-request-price'})) {
                    $pickup->setAmount($result->{'pickup-request-info'}->{'pickup-request-price'}->{'due-amount'});
                }
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

        return ['pickup' => $pickup, 'error' => $error, 'messages' => $messages];
    }

    /**
     * Update pickup request
     *
     * @param $pickup
     * @return array
     */
    public function updatePickup($pickup)
    {
        $error = false;
        $messages = [];
        try {
            // Execute Request
            $client = $this->createSoapClient('pickup');

            $requestData = $this->getCreatePickupRequestData($pickup, 'update');
            $requestData['request-id'] = $pickup->getRequestId();

            $result = $client->__soapCall('UpdatePickupRequest', [
                'update-pickup-request-request' => $requestData
            ], null, null);

            // Parse Response
            if (isset($result->{'update-pickup-request-success'})) {
                if ($result->{'update-pickup-request-success'} !== true) {
                    $error = true;
                    $messages[] = [
                        'code'      => 'error',
                        'message'   => __('Can\'t update pickup.')
                    ];
                }
            }

            if (isset($result->{'messages'})) {
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

        return ['pickup' => $pickup, 'error' => $error, 'messages' => $messages];
    }

    /**
     * Get active pickups list request
     *
     * @return array
     */
    public function getActivePickups()
    {
        $error = false;
        $pickups = [];
        $messages = [];
        try {
            // Execute Request
            $client = $this->createSoapClient('pickup');
            $result = $client->__soapCall('GetPickupRequests', [
                'get-pickup-requests' => [
                    'customer-number' => $this->_carrierHelper->getConfigCarrier('customer_number')
                ]
            ], null, null);

            // Parse Response
            if (isset($result->{'pickup-requests'})) {
                if (isset($result->{'pickup-requests'}[0])) {
                    foreach ($result->{'pickup-requests'}[0]->{'pickup-request'} as $pickupRequest) {
                        $header = $pickupRequest->{'pickup-request-header'};
                        $pickups[] = [
                            'request_id'    => $header->{'request-id'},
                            'status'        => $header->{'request-status'},
                            'pickup_type'   => $header->{'pickup-type'},
                            'date'          => $header->{'request-date'},
                        ];
                    }
                } else {
                    $error = true;
                    $messages[] = [
                        'code'      => 'empty list',
                        'message'   => __('No pickup requests returned.')
                    ];
                }
            }

            if (isset($result->{'messages'})) {
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

        return ['pickups' => $pickups, 'error' => $error, 'messages' => $messages];
    }

    /**
     * Cancel pickup request
     *
     * @param $pickup
     * @return array
     */
    public function cancelPickup($pickup)
    {
        $error = false;
        $messages = [];
        try {
            // Execute Request
            $client = $this->createSoapClient('pickup');
            $result = $client->__soapCall('CancelPickupRequest', [
                'cancel-pickup-request-request' => [
                    'customer-number'   => $this->_carrierHelper->getConfigCarrier('customer_number'),
                    'request-id'        => $pickup->getRequestId()
                ]
            ], null, null);

            // Parse Response
            if (isset($result->{'cancel-pickup-success'})) {
                if ($result->{'cancel-pickup-success'} === true) {
                    $pickup->setStatus('Cancelled');
                } else {
                    $error = true;
                    $messages[] = [
                        'code'      => 'error',
                        'message'   => __('Can\'t cancel pickup.')
                    ];
                }
            }

            if (isset($result->{'messages'})) {
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

        return ['pickup' => $pickup, 'error' => $error, 'messages' => $messages];
    }
}
