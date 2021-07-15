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
                this.keyPath = 'earning_rule_id';
                this.interfaceName = 'earn_rate';
                this.interfaceNames = 'earn_rates';
                this._super();
                this.setSearchApiUrl('');
                this.apiGetEarningPointRate = "/webposcustomize/getEarningPointRates/";
            },
            getCallBackEvent: function(key){
                switch(key){

                }
            },
            setApiUrl: function(key,value){
                switch(key){
                    case "apiGetEarningPointRate":
                        this.apiGetEarningPointRate = value;
                        break;
                }
            },
            getApiUrl: function(key){
                switch(key){
                    case "apiGetEarningPointRate":
                        return this.apiGetEarningPointRate;
                }
            },
            getEarningPointRate: function(params,deferred){
                var apiUrl = this.getApiUrl("apiGetEarningPointRate");
                this.callApi(apiUrl, params, deferred);
            },
        });
    }
);