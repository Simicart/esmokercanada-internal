/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define(
    [
        'Magestore_Webpos/js/model/factory',
        'Magestore_Webpos/js/view/checkout/checkout/renderer/payment',
    ],
    function(Factory, ModelClass){
         "use strict";
        return {
            get: function(){
                var key = 'view/checkout/checkout/renderer/payment';
                return Factory.getSingleton(key, ModelClass);              
            },
            
            create: function(){
                return ModelClass();
            }
        }
    }
);