/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'Magestore_Webpos/js/model/resource-model/magento-rest/checkout/abstract'
    ],
    function (onlineAbstract) {
        "use strict";

        return onlineAbstract.extend({
            initialize: function () {
                this._super();
                this.setSearchApiUrl('/webpos/integration/getCustomerPoints');
                this.apiGetPointBalanceUrl = "/webpos/integration/getPointBalance";
                this.apiSpendPointUrl = "/webpos/integration/spendPoint";
            },
            getCallBackEvent: function(key){
                switch(key){

                }
            },
            setApiUrl: function(key,value){
                switch(key){
                    case "apiGetPointBalanceUrl":
                        this.apiGetPointBalanceUrl = value;
                        break;
                    case "apiSpendPointUrl":
                        this.apiSpendPointUrl = value;
                        break;
                }
            },
            getApiUrl: function(key){
                switch(key){
                    case "apiGetPointBalanceUrl":
                        return this.apiGetPointBalanceUrl;
                    case "apiSpendPointUrl":
                        return this.apiSpendPointUrl;
                }
            },
            getBalance: function(params,deferred){
                var apiUrl = this.getApiUrl("apiGetPointBalanceUrl");
                this.callApi(apiUrl, params, deferred);
            },
            spendPoint: function(params,deferred){
                var apiUrl = this.getApiUrl("apiSpendPointUrl");
                this.callApi(apiUrl, params, deferred);
            }
        });
    }
);