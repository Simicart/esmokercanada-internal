/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'jquery',
        'Magestore_Webpos/js/model/collection/abstract',
        'Magestore_WebposCustomize/js/model/resource-model/magento-rest/rewards/earning-rate',
        'Magestore_WebposCustomize/js/model/resource-model/indexed-db/rewards/earning-rate'
    ],
    function ($, collectionAbstract, restResource, indexedDbResource) {
        "use strict";

        return collectionAbstract.extend({
            /* Query Params*/
            queryParams: {
                filterParams: [],
                orderParams: [],
                pageSize: '',
                currentPage: '',
                paramToFilter: [],
                paramOrFilter: []
            },
            initialize: function () {
                this._super();
                this.setResource(restResource(), indexedDbResource());
            },
        });
    }
);