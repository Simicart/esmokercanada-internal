/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'Magestore_Webpos/js/model/resource-model/indexed-db/abstract'
    ],
    function (Abstract) {
        "use strict";
        return Abstract.extend({
            mainTable: 'customer_rewards_point',
            keyPath: 'customer_id',
            indexes: {
                customer_id: {unique: true}
            }
        });
    }
);