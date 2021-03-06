/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'jquery',
        'Magestore_Webpos/js/model/abstract',
        'Magestore_Webpos/js/model/resource-model/magento-rest/directory/currency',
        'Magestore_Webpos/js/model/resource-model/indexed-db/directory/currency',
        'Magestore_Webpos/js/model/collection/directory/currency'
    ],
    function ($, modelAbstract, customerRest, customerIndexedDb, customerCollection) {
        "use strict";
        return modelAbstract.extend({
            sync_id:'currency',
            initialize: function () {
                this._super();
                this.setResource(customerRest(), customerIndexedDb());
                this.setResourceCollection(customerCollection());
            }
        });
    }
);