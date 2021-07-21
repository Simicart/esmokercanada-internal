/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */

define([
    'Magento_Checkout/js/view/shipping-information/address-renderer/default',
    'Mageside_CanadaPostShipping/js/view/shipping-address/address-renderer/default-additional',
    'underscore'
], function (Component, additional, _) {
    'use strict';

    return Component.extend(additional);
});
