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
            mainTable: 'rewards_spending_rate',
            keyPath: 'spending_rule_id',
            indexes: {
                spending_rule_id: {unique: true},
            },
        });
    }
);