/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'jquery',
        'ko',
        'Magestore_Webpos/js/model/abstract',
        'Magestore_Webpos/js/model/resource-model/magento-rest/pos/pos',
        'Magestore_Webpos/js/model/resource-model/indexed-db/pos/pos',
        'Magestore_Webpos/js/model/collection/pos/pos'
    ],
    function ($,ko, modelAbstract, restResource, indexedDbResource, collection) {
        "use strict";
        return modelAbstract.extend({
            initialize: function () {
                this._super();
                this.setResource(restResource(), indexedDbResource());
                this.setResourceCollection(collection());
            }
        });
    }
);