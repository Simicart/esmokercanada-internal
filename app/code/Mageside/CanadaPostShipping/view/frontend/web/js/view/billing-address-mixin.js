/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */

define([
    'underscore'
], function (_) {
    'use strict';

    return function (Component) {
        return Component.extend({
            defaults: {
                ignoredAttributes: ['canada_dpo_id', 'canada_dpo_address']
            },

            initConfig: function (config) {
                config.detailsTemplate = 'Mageside_CanadaPostShipping/billing-address/details';
                this._super(config);
                return this;
            },

            canShowAttribute: function (attribute) {
                return !_.contains(this.ignoredAttributes, attribute.attribute_code);
            }
        });
    };
});
