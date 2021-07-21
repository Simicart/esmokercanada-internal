/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */

define([
    'underscore'
], function (_) {
    'use strict';

    return {
        defaults: {
            ignoredAttributes: ['canada_dpo_id', 'canada_dpo_address']
        },

        getPostOfficeAddress: function () {
            var attributes = this.address().customAttributes;
            if (attributes && attributes.length) {
                var dpoAddress = _.findWhere(attributes, {attribute_code: 'canada_dpo_address'});
                if (dpoAddress) {
                    return dpoAddress.value;
                }
            }
            return '';
        },

        getPostOfficeId: function () {
            var attributes = this.address().customAttributes;
            if (attributes && attributes.length) {
                var dpoId = _.findWhere(attributes, {attribute_code: 'canada_dpo_id'});
                if (dpoId) {
                    return dpoId.value;
                }
            }
            return '';
        },

        canShowAttribute: function (attribute) {
            return !_.contains(this.ignoredAttributes, attribute.attribute_code);
        }
    };
});
