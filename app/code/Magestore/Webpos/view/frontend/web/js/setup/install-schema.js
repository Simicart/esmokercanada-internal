/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'Magestore_Webpos/js/model/resource-model/indexed-db/db'
    ],
    function (db) {
        "use strict";
        if (typeof installRunning == 'undefined') {
            var installRunning = false;
        }
        return {
            installSchema: function () {
                if (!installRunning) {
                    installRunning = true;
                    var self = this;
                    new db.open({
                        server: dbName,
                        version: version,
                        schema: {
                            core_config_data: {
                                key: {keyPath: 'path'},
                                indexes: {
                                    path: {unique: true}
                                }
                            },
                            synchronization: {
                                key: {keyPath: 'id'},
                                indexes: {
                                    id: {unique: true}
                                }
                            },
                            customer: {
                                key: {keyPath: 'id'},
                                indexes: {
                                    id: {unique: true},
                                    full_name: {unique: false}
                                }
                            },
                            customer_index: {
                                key: {keyPath: 'id'},
                                indexes: {
                                    id: {unique: true}
                                }
                            },
                            customer_complain: {
                                key: {keyPath: 'complain_id'},
                                indexes: {
                                    complain_id: {unique: true}
                                }
                            },
                            category: {
                                key: {keyPath: 'id'},
                                indexes: {
                                    id: {unique: true}
                                }
                            },
                            product: {
                                key: {keyPath: 'id'},
                                indexes: {
                                    id: {unique: true},
                                    sku: {unique: true}
                                }
                            },
                            product_index: {
                                key: {keyPath: 'id'},
                                indexes: {
                                    id: {unique: true}
                                }
                            },
                            order: {
                                key: {keyPath: 'entity_id'},
                                indexes: {
                                    entity_id: {unique: true},
                                    increment_id: {unique: true}
                                }
                            },
                            customer_group: {
                                key: {keyPath: 'id'},
                                indexes: {
                                    id: {unique: true}
                                }
                            },
                            stock_item: {
                                key: {keyPath: 'item_id'},
                                indexes: {
                                    item_id: {unique: true},
                                    product_id: {unique: false}
                                }
                            },
                            stock_item_index: {
                                key: {keyPath: 'id'},
                                indexes: {
                                    id: {unique: true}
                                }
                            },
                            shipping: {
                                key: {keyPath: 'code'},
                                indexes: {
                                    code: {unique: true}
                                }
                            },
                            payment: {
                                key: {keyPath: 'code'},
                                indexes: {
                                    code: {unique: true}
                                }
                            },
                            country: {
                                key: {keyPath: 'country_id'},
                                indexes: {
                                    country_id: {unique: true}
                                }
                            },
                            currency: {
                                key: {keyPath: 'code'},
                                indexes: {
                                    code: {unique: true}
                                }
                            },
                            taxrate: {
                                key: {keyPath: 'id'},
                                indexes: {
                                    id: {unique: true}
                                }
                            },
                            taxclass: {
                                key: {keyPath: 'class_id'},
                                indexes: {
                                    class_id: {unique: true}
                                }
                            },
                            taxrule: {
                                key: {keyPath: 'id'},
                                indexes: {
                                    id: {unique: true}
                                }
                            },
                            action_logs: {
                                key: {keyPath: 'action_id'},
                                indexes: {
                                    action_id: {unique: true}
                                }
                            },

                            session: {
                                key: {keyPath: 'shift_id'},
                                indexes: {
                                    shift_id: {unique: true}
                                }
                            },
                            cash_transaction: {
                                key: {keyPath: 'transaction_id'},
                                indexes: {
                                    transaction_id: {unique: true}
                                }
                            },
                            rewardpoint_rate: {
                                key: {keyPath: 'rate_id'},
                                indexes: {
                                    rate_id: {unique: true}
                                }
                            },
                            swatch: {
                                key: {keyPath: 'attribute_id'},
                                indexes: {
                                    attribute_id: {unique: true}
                                }
                            },
                            customer_credit: {
                                key: {keyPath: 'credit_id'},
                                indexes: {
                                    credit_id: {unique: true}
                                }
                            },
                            customer_point: {
                                key: {keyPath: 'reward_id'},
                                indexes: {
                                    reward_id: {unique: true}
                                }
                            },
                            //Francy Add
                            customer_rewards_point: {
                                key: {keyPath: 'customer_id'},
                                indexes: {
                                    customer_id: {unique: true}
                                }
                            },
                            rewards_spending_rate: {
                                key: {keyPath: 'spending_rule_id'},
                                indexes: {
                                    spending_rule_id: {unique: true}
                                }
                            },
                            rewards_earning_rate: {
                                key: {keyPath: 'earning_rule_id'},
                                indexes: {
                                    earning_rule_id: {unique: true}
                                }
                            }
                            //End Code
                        }
                    }).catch(function (err) {
                        console.log(err);
                        limit = limit - 1;
                        if (limit > 0) {
                            self.installSchema();
                        } else {
                            return false;
                        }
                    }).then(function (s) {
                        server = s;
                        installRunning = false;
                        return true;
                    });
                }
            }
        }
    }
);
