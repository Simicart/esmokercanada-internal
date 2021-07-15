<?php

/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
namespace Magestore\WebposCustomize\Api\Cart;

interface CheckoutInterface extends \Magestore\Webpos\Api\Cart\CheckoutInterface
{
    /**
     *
     * @param int $pointsAmount
     * @param string $quoteId
     * @return \Magestore\Webpos\Api\Data\Cart\CheckoutInterface
     */
    public function spendPointRewards($pointsAmount, $quoteId);

    /**
     * @param string $quoteId
     * @return \Magestore\Webpos\Api\Data\Cart\CheckoutInterface
     */
    public function updateRewards($quoteId);
}