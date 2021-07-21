/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
define([
    'jquery',
    'mage/utils/wrapper'
], function ($, wrapper) {
    'use strict';

    var mixin = {

        /**
         * Convert custom_attributes (for magento 2.2)
         * @param {Object} formData
         * @returns {Object}
         */
        formAddressDataToQuoteAddress: function (originFn, formData) {
            var address = originFn(formData);

            if (address['customAttributes']) {
                address['customAttributes'] = Object.entries(address['customAttributes'])
                    .map(function (customAttribute) {
                        if (typeof customAttribute[1] === 'object') {
                            return customAttribute[1];
                        } else {
                            return {
                                'attribute_code': customAttribute[0],
                                'value': customAttribute[1]
                            };
                        }
                    });
            }

            return address;
        }
    };

    /**
     * Override default address-converter.formAddressDataToQuoteAddress().
     */
    return function (target) {
        return wrapper.extend(target, mixin);
    };
});
