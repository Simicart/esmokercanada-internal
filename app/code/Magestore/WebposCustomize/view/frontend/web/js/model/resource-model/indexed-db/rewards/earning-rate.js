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
            mainTable: 'rewards_earning_rate',
            keyPath: 'earning_rule_id',
            indexes: {
                earning_rule_id: {unique: true},
            },
        });
    }
);