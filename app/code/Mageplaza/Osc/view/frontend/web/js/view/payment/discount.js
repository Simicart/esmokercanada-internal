/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_Osc
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

/*jshint browser:true jquery:true*/
/*global alert*/
define(
    [
        'ko',
        'Magento_SalesRule/js/view/payment/discount',
        'Mageplaza_Osc/js/model/osc-loader/discount',
        'Magento_Checkout/js/model/shipping-rate-service',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/shipping-rate-registry'
    ],
    function (ko, Component, discountLoader, shippingRateService, quote, rateRegistry) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Mageplaza_Osc/container/review/discount'
            },
            isBlockLoading: discountLoader.isLoading,

            initialize: function () {
                this._super();
                this.isApplied(window.checkoutConfig.quoteData.coupon_code);
                this.isApplied.subscribe(function () {
                    let shippingAddress = quote.shippingAddress();
                    rateRegistry.set(shippingAddress.getCacheKey(), null);
                    if (quote.shippingAddress() && quote.shippingAddress().countryId) {
                        shippingRateService.estimateShippingMethod();
                    }
                });
            }
        });
    }
);
