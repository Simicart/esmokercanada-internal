/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define([
    'ko',
    'jquery',
    'Magestore_Webpos/js/helper/general'
], function (ko, $, WebposHelper) {
    'use strict';
    var Helper = {
        initialize: function () {
            var self = this;
            return self;
        },
        isMirasvitRewardsEnable: function () {
            var plugin = WebposHelper.getBrowserConfig('plugins');
            var plugins_config = WebposHelper.getBrowserConfig('plugins_config');
            if (plugin && plugin.length > 0 && $.inArray('rewards', plugin) !== -1 && WebposHelper.isUseOnline('checkout')) {
                if (plugins_config && plugins_config['rewards']) {
                    return true;
                }
            }
            return false;
        }
    };
    return Helper.initialize();

});