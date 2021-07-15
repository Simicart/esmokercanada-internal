/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'Magestore_WebposCustomize/js/model/factory',
        'Magestore_WebposCustomize/js/model/checkout/rewards',
    ],
    function(Factory, ModelClass){
        "use strict";
        return {
            get: function(){
                var key = 'model/checkout/rewards';
                return Factory.getSingleton(key, ModelClass);
            },

            create: function(){
                return ModelClass();
            }
        }
    }
);