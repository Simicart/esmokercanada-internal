<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Model;

class QuoteRepository extends \Magento\Quote\Model\QuoteRepository
{
    /**
     * @inheritdoc
     */
    public function getActive($cartId, array $sharedStoreIds = [])
    {
        $quote = $this->get($cartId, $sharedStoreIds);
        $quote->getShippingAddress()->setCollectShippingRates(true);

        return $quote;
    }
}
