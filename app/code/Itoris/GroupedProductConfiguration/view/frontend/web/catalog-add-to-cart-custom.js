/**
 * Copyright © 2016 ITORIS INC. All rights reserved.
 * See license agreement for details
 */
define([
    'jquery',
    'mage/translate',
    'jquery/ui',
    'catalogAddToCart',
], function($, $t) {
    "use strict";

    $.widget('itoris.catalogAddToCartCustom',$.mage.catalogAddToCart, {

        submitForm: function (form) {
            var addToCartButton, self = this;
            if(typeof(itorisHandleGrouped)!='undefined' &&  itorisHandleGrouped =='grouped_handle_product') {
                if (form.has('input[type="file"]:not(:hidden)').length!=undefined && form.has('input[type="file"]:not(:hidden)').length && form.find('input[type="file"]:not(:hidden)').val()!='' && form.find('input[type="file"]:not(:hidden)').val()!=undefined) {
                    self.element.off('submit');
                    // disable 'Add to Cart' button
                    addToCartButton = $(form).find(this.options.addToCartButtonSelector);
                    addToCartButton.prop('disabled', true);
                    addToCartButton.addClass(this.options.addToCartButtonDisabledClass);
                    form.submit();
                } else {
                    self.ajaxSubmit(form);
                }
            }else{
                if (form.has('input[type="file"]').length  && form.find('input[type="file"]').val() !== '') {
                    self.element.off('submit');
                    // disable 'Add to Cart' button
                    addToCartButton = $(form).find(this.options.addToCartButtonSelector);
                    addToCartButton.prop('disabled', true);
                    addToCartButton.addClass(this.options.addToCartButtonDisabledClass);
                    form.submit();
                } else {
                    self.ajaxSubmit(form);
                }
            }
        },



    });

    return $.itoris.catalogAddToCartCustom;
});
