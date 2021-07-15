/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */
require([
    'Magestore_Webpos/js/model/checkout/integration/reward-points',
]);

define(
    [
        'jquery',
        'ko',
        'Magestore_Webpos/js/view/customer/integration/abstract',
        'Magestore_WebposCustomize/js/helper/general',
        'Magestore_WebposCustomize/js/model/checkout/rewards-factory',
    ],
    function ($,ko, Abstract, CustomizeHelper, RewardsFactory) {
        "use strict";
        return Abstract.extend({
            defaults: {
                template: 'Magestore_WebposCustomize/customer/rewards'
            },
            initialize: function () {
                this._super();
                this.model = RewardsFactory.get();
                if(!this.addedData && CustomizeHelper.isMirasvitRewardsEnable()){
                    this.initData();
                }
            }
        });
    }
);
