/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'jquery',
        'ko',
        'Magestore_Webpos/js/view/settings/general/abstract',
        'mage/url',
        'mage/storage',
        'Magestore_Webpos/js/action/notification/add-notification',
        'Magestore_Webpos/js/model/event-manager',
        'mage/translate',
        'Magestore_Webpos/js/helper/full-screen-loader'
    ],
    function ($, ko, Component, mageUrl, storage, addNotification, eventManager, Translate, fullScreenLoader) {
        "use strict";

        return Component.extend({
            defaults: {
                template: 'Magestore_Webpos/settings/general/location/change-location'
            },
            elementName: 'location',
            value: ko.observable(window.webposConfig.locationId),
            optionsArray: ko.observableArray(window.webposConfig.allLocationIds),
            initialize: function () {
                this._super();
                var self = this;
            },

            saveConfig: function (data) {
                var self = this;
                if (!checkNetWork) {
                    addNotification(Translate('Cannot connect to your server!'), true, 'danger', 'Error');
                    self.value(window.webposConfig.locationId);
                    return false;
                }
                var value = $('select[name="' + data.elementName + '"]').val();
                if (value) {
                    fullScreenLoader.startLoader();
                    storage.get(
                        'webpos/index/changeLocation?location_id=' + value,
                        {

                        }
                    ).done(
                        function (response) {
                            Cookies.set('check_login', 1, { expires: parseInt(window.webposConfig.timeoutSession) });
                            var deleteRequest = window.indexedDB.deleteDatabase('magestore_webpos');
                            fullScreenLoader.stopLoader();
                            window.location.reload();
                        }
                    );
                }
            }
        });
    }
);