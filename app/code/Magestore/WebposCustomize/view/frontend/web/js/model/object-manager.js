/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'require',
        'Magestore_WebposCustomize/js/model/checkout/rewards',
        'Magestore_WebposCustomize/js/model/checkout/rewards/earning-rate',
        'Magestore_WebposCustomize/js/model/checkout/rewards/spending-rate',
    ],
    function (  require,
                model_checkout_rewards,
                model_checkout_rewards_earning_rate,
                model_checkout_rewards_spending_rate
        ) {
        "use strict";

        return {
            
            /**
             * get object singleton
             * 
             * @param string modelName
             * @returns {object}
             */            
            get: function(modelName) {
                var model = this._convertModelPath(modelName);
                
                if(!window.webposObjects) {
                    window.webposObjects = {};
                } 
                if(!window.webposObjects[model]) {
                     var modelClass = require('Magestore_WebposCustomize/js/'+modelName);
                     window.webposObjects[model] = modelClass();
                }

                return window.webposObjects[model];
            },
            
            /**
             * create new object
             * 
             * @param string modelName
             * @returns {object}
             */
            create: function(modelName) {
                var modelClass = require('Magestore_WebposCustomize/js/'+modelName);
                return modelClass();
            },
            
            /**
             * convert model name to key
             * 
             * @param string modelName
             * @returns string
             */
            _convertModelPath: function(modelName) {
                for(var i=0; i<5; i++) {
                    modelName = modelName.replace('/', '_');
                    modelName = modelName.replace('-', '');
                }      
                return modelName;
            }
        };
    }
);