/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'jquery',
        'ko',
        'uiComponent',
        'Magestore_Webpos/js/model/config/config',
        'Magestore_Webpos/js/view/settings/synchronization/sync-map',
        'Magestore_Webpos/js/model/synchronization',
        'Magestore_Webpos/js/lib/cookie'
    ],
    function ($, ko, Component, config, syncmap, synchronization, Cookies) {
        "use strict";
        return Component.extend({

            isInstall: ko.observable(true),

            message: ko.observable(''),
            loading: ko.observable('.'),

            number: syncmap().length,

            model: syncmap(),

            modelListInstall: ko.observableArray([]),

            percent: ko.observable('0'),

            initialize: function () {
                this._super();
                var element = $('#install_container');
                if (Cookies.get('check_login') && element) {
                    element.addClass('active');
                    $('#c-button--push-left').hide();
                    $('#webpos-notification').hide();
                } else {
                    if (element.hasClass('active'))
                        element.removeClass('active');
                    $('#c-button--push-left').show();
                    $('#webpos-notification').show();
                }
                var self = this;
                self.model.sort(function (a, b) {
                    var x = a.sort_order;
                    var y = b.sort_order;
                    return ((x < y) ? -1 : ((x > y) ? 1 : 0));
                });
                if (Cookies.get('check_login')) {
                    reloading = true;
                    self.isInstall(true);
                    self.installData();
                    self.loadingProccess();
                }
            },

            installData: function () {
                var self = this;
                var model = this.model.shift();
                if (typeof model == 'undefined') {
                    Cookies.remove('check_login');
                    location.reload();
                    return this;
                }
                var update = new synchronization(model);
                var endDeferred = $.Deferred();
                update.initialize(endDeferred);
                update.install();
                self.message(model.label);
                self.modelListInstall.push(update);
                endDeferred.done(function () {
                    self.percent(parseInt(self.modelListInstall().length * 100 / self.number));
                    if (self.isInstall() && self.percent() >= 100) {
                        Cookies.remove('check_login');
                        location.reload();
                    }
                    self.installData();
                });
                endDeferred.fail(function () {
                    self.installData();
                });
            },
            loadingProccess: function () {
                var self = this;
                var temp = ['.', '..', '...'];
                var i = 0;
                setInterval(function () {
                    self.loading(temp[i]);
                    i = (i + 1) % 3;
                }, 1000);
            }
        });
    }
);