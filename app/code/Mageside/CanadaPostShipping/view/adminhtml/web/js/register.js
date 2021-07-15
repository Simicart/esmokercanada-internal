/**
 * Copyright © 2018 Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
define([
    'jquery',
    'mage/translate',
    'mage/template',
    'Magento_Ui/js/modal/confirm'
], function ($, $t, mageTemplate, uiConfirm) {

    $.widget('mageside.register', {

        options: {
            ajax_url: null,
            registrationMessage: 'For complete settings you may complete registration or sign up on Canada Post service site. Continue?'
        },

        _create: function () {
            var self = this;
            this.element.on("click", function () {
                self.getToken();
            });
        },

        getToken: function () {
            var self = this;
            $.ajax({
                url: self.options.ajax_url,
                data: {'form_key': window.FORM_KEY},
                method: 'POST',
                dataType: 'json'
            }).success(function (response) {
                if (response.tokenId) {
                    var $form = $(mageTemplate(self.options.registration_form, {
                        tokenId: response.tokenId
                    }));
                    $form.appendTo('body').hide().submit();
                } else {
                    alert(
                        'token: ' + response.tokenId
                        + ', error: ' + response.error
                        + ', message-code: ' + response.messages[0].code
                        + ', message: ' + response.messages[0].message
                    );
                }

                // var validationMessage = $('#validation_result');
                // var text = '<ul style="list-style-type: none">';
                // response.each(function (value) {
                //     if (value.type == 'success') {
                //         text += '<li class="message message-success success">' + $t(value.message) + '</li>';
                //         validationMessage.removeClass('hidden message-error error');
                //     } else if (value.type == 'error') {
                //         text += '<li class="message message-error error">' + $t(value.message) + '</li>';
                //         validationMessage.removeClass('hidden message-success success');
                //     } else {
                //         return false;
                //     }
                // });
                // text += '</ul>';
                // validationMessage.html(text);
                // return false;
            }).error(function (xhr) {
                if (xhr.statusText === 'abort') {
                    return;
                }
                alert($t('Something went wrong.'));
            });
        }
    });
    return $.mageside.register;
});
