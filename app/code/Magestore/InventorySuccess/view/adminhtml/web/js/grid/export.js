/*
 * Copyright © 2016 Magestore. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'ko',
    'Magento_Ui/js/grid/export'
], function ($, ko, exports) {
    'use strict';

    return exports.extend({
        applyOption: function () {
            var option = this.getActiveOption(),
                url = this.buildOptionUrl(option);
            var product_id = this.getProductParam();
            if(product_id){
                var str = '/gridToCsv/';
                if(url.indexOf(str) > 0){
                    var flag = url.indexOf(str);
                    var exportUrl = url.substr(0,flag);
                    exportUrl = exportUrl+str+'product_id/'+product_id+url.substr(flag+str.length,url.length);
                    location.href = exportUrl;
                }
            }else {
                location.href = url;
            }
        },
        getProductParam : function (){
            var currentUrl =  window.location.href;
            var str = 'product/edit/id/';
            if(currentUrl.indexOf(str) > 0){
                var start = currentUrl.indexOf(str);
                currentUrl = currentUrl.slice(start+str.length);
                var end = currentUrl.indexOf('/');
                var product_id = currentUrl.substr(0,end);
                return product_id;
            }
        }
    });
});
