/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'jquery',
        'Magestore_Webpos/js/model/resource-model/magento-rest/checkout/abstract'
    ],
    function ($, onlineAbstract) {
        "use strict";

        return onlineAbstract.extend({
            initialize: function () {
                this.keyPath = 'spending_rule_id';
                this.interfaceName = 'earn_rate';
                this.interfaceNames = 'earn_rates';
                this._super();
                this.setSearchApiUrl('');
                this.apiGetSpendingPointRate = "/webposcustomize/getSpendingPointRates/";
            },
            setApiUrl: function(key,value){
                switch(key){
                    case "apiGetSpendingPointRate":
                        this.apiGetSpendingPointRate = value;
                        break;
                }
            },
            getApiUrl: function(key){
                switch(key){
                    case "apiGetSpendingPointRate":
                        return this.apiGetSpendingPointRate;
                }
            },
            getSpendingPointRate: function(params,deferred){
                var apiUrl = this.getApiUrl("apiGetSpendingPointRate");
                this.callApi(apiUrl, params, deferred);
            }
        });
    }
);