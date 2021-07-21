<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Cron;

/**
 * Class ProcessPickup
 * @package Mageside\CanadaPostShipping\Cron
 */
class ProcessPickup
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Mageside\CanadaPostShipping\Model\Service\Pickup
     */
    private $pickupService;

    /**
     * ProcessPickup constructor.
     * @param \Mageside\CanadaPostShipping\Model\Service\Pickup $pickupService
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Mageside\CanadaPostShipping\Model\Service\Pickup $pickupService,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->pickupService = $pickupService;
        $this->logger = $logger;
    }

    public function clearPickups()
    {
        try {
            // TODO: do something
            $data = $this->pickupService->getActivePickups();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
