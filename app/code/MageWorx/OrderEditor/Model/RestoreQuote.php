<?php
/**
 * Copyright © MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\OrderEditor\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Serialize\Serializer\Json as SerializerJson;
use MageWorx\OrderEditor\Api\QuoteDataBackupRepositoryInterface;
use MageWorx\OrderEditor\Api\QuoteRepositoryInterface;
use MageWorx\OrderEditor\Api\RestoreQuoteInterface;

class RestoreQuote implements RestoreQuoteInterface
{
    /**
     * @var QuoteDataBackupRepositoryInterface
     */
    private $quoteDataBackupRepository;

    /**
     * @var QuoteRepositoryInterface
     */
    private $quoteRepository;

    /**
     * @var SerializerJson
     */
    protected $serializer;

    /**
     * RestoreQuote constructor.
     *
     * @param QuoteDataBackupRepositoryInterface $quoteDataBackupRepository
     * @param QuoteRepositoryInterface $quoteRepository
     * @param SerializerJson $serializer
     */
    public function __construct(
        QuoteDataBackupRepositoryInterface $quoteDataBackupRepository,
        QuoteRepositoryInterface $quoteRepository,
        SerializerJson $serializer
    ) {
        $this->quoteDataBackupRepository = $quoteDataBackupRepository;
        $this->quoteRepository           = $quoteRepository;
        $this->serializer                = $serializer;
    }

    /**
     * Restores the quote to a previous state
     *
     * @param \Magento\Quote\Api\Data\CartInterface|\Magento\Quote\Model\Quote $quote
     * @throws LocalizedException
     */
    public function restore(\Magento\Quote\Api\Data\CartInterface $quote): void
    {
        $quoteId = $quote->getId();
        if (!$quoteId) {
            throw new LocalizedException(__('Unable to restore quote: empty quote id'));
        }

        /** @var \MageWorx\OrderEditor\Model\Quote $quote */
        $quote = $this->quoteRepository->getById($quoteId);
        /** @var \MageWorx\OrderEditor\Api\Data\QuoteDataBackupInterface $backupInstance */
        $backupInstance      = $this->quoteDataBackupRepository->getByQuoteId($quoteId);
        $quoteDataSerialized = $backupInstance->getDataSerialized();
        $quoteBackupData     = $this->serializer->unserialize($quoteDataSerialized);
        if (empty($quoteBackupData)) {
            throw new LocalizedException(__('Quote data is empty for quote %1', $quoteId));
        }

        $quoteData = $quoteBackupData['quote'];
        $quote->setData($quoteData);
        $this->quoteRepository->save($quote);
        $this->quoteDataBackupRepository->delete($backupInstance);
    }

    /**
     * Start order editing from this method:
     * - backup initial quote state in additional table
     * - set up the "edit" flags in original tables
     *
     * When used before editing allow to restore the quote and corresponding entities from backup on any stage.
     *
     * @param \Magento\Quote\Api\Data\CartInterface $quote
     * @throws LocalizedException
     */
    public function backupInitialQuoteState(\Magento\Quote\Api\Data\CartInterface $quote): void
    {
        $quoteId = $quote->getId();
        $orderId = $quote->getOrigOrderId();
        if (!$quoteId) {
            throw new LocalizedException(__('Unable to backup quote: empty quote id'));
        }

        /** @var \Magento\Quote\Model\Quote $quote */
        $data['quote'] = $quote->getData();
        $jsonData      = $this->serializer->serialize($data);

        /** @var \MageWorx\OrderEditor\Api\Data\QuoteDataBackupInterface $backupInstance */
        try {
            $backupInstance = $this->quoteDataBackupRepository->getByQuoteId($quoteId);
        } catch (NoSuchEntityException $exception) {
            $backupInstance = $this->quoteDataBackupRepository->getEmptyEntity();
        }

        $backupInstance->setQuoteId($quoteId);
        $backupInstance->setOrderId($orderId);
        $backupInstance->setDataSerialized($jsonData);

        $this->quoteDataBackupRepository->save($backupInstance);
    }
}
