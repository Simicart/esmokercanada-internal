/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'jquery',
        'Magestore_Webpos/js/model/abstract',
        'Magestore_WebposCustomize/js/model/resource-model/magento-rest/rewards/spending-rate',
        'Magestore_WebposCustomize/js/model/resource-model/indexed-db/rewards/spending-rate',
        'Magestore_WebposCustomize/js/model/collection/rewards/spending-rate'
    ],
    function ($, modelAbstract, restResource, indexedDbResource, collection) {
        "use strict";
        return modelAbstract.extend({
            sync_id:'rewards_spend_rates',
            initialize: function () {
                this._super();
                this.setResource(restResource(), indexedDbResource());
                this.setResourceCollection(collection());
            },
        });
    }
);