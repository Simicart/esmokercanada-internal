<?php
/**
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

namespace Magestore\Webpos\Api\Directory\Country;

/**
 * Currency repository interface.
 *
 * An order is a document that a web store issues to a customer. Magento generates a sales order that lists the product
 * items, billing and shipping addresses, and shipping and payment methods. A corresponding external document, known as
 * a purchase order, is emailed to the customer.
 * @api
 */
interface CountryRepositoryInterface
{
    /**
     *
     * @param
     * @return \Magestore\Webpos\Api\Data\Directory\Country\CountryResultInterface
     */
    public function getList();

}
