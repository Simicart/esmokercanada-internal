/**
 * Copyright © 2016 ITORIS INC. All rights reserved.
 * See license agreement for details
 */
define([
    'jquery',
    'Magento_Catalog/js/price-utils',
    'underscore',
    'mage/template',
    'jquery/ui'
], function ($, utils, _, mageTemplate) {
    'use strict';

    var globalOptions = {
        productId: null,
        priceConfig: null,
        prices: {},
        priceTemplate: '<span class="price"><%- data.formatted %></span>'
    };
    $.widget('mage.priceBox', {
        options: globalOptions,
        cache: {},

        /**
         * Widget initialisation.
         * Every time when option changed prices also can be changed. So
         * changed options.prices -> changed cached prices -> recalculation -> redraw price box
         */
        _init: function initPriceBox() {
            var box = this.element;
            box.trigger('updatePrice');
            this.cache.displayPrices = utils.deepClone(this.options.prices);
        },

        /**
         * Widget creating.
         */
        _create: function createPriceBox() {
            var box = this.element;

            this._setDefaultsFromPriceConfig();
            this._setDefaultsFromDataSet();

            box.on('reloadPrice', this.reloadPrice.bind(this));
            box.on('updatePrice', this.onUpdatePrice.bind(this));
            box.on('reloadPriceCustom', this.reloadPriceCustom.bind(this));
            box.on('reloadPriceConfigurable', this.reloadPriceConfigurable.bind(this));
            box.on('updatePriceBundle', this.onUpdatePriceBundle.bind(this));
            box.on('updatePriceConfigurable', this.onUpdatePriceConfigurable.bind(this));
        },

        /**
         * Call on event updatePrice. Proxy to updatePrice method.
         * @param {Event} event
         * @param {Object} prices
         */
        onUpdatePrice: function onUpdatePrice(event, prices) {
            return this.updatePrice(prices);
        },
        onUpdatePriceBundle: function onUpdatePrice(event, prices) {
            return this.updatePriceBundle(prices);
        },
        onUpdatePriceConfigurable: function onUpdatePrice(event, prices) {
            return this.updatePriceConfigurable(prices);
        },

        /**
         * Updates price via new (or additional values).
         * It expects object like this:
         * -----
         *   "option-hash":
         *      "price-code":
         *         "amount": 999.99999,
         *         ...
         * -----
         * Empty option-hash object or empty price-code object treats as zero amount.
         * @param {Object} newPrices
         */
        updatePrice: function updatePrice(newPrices) {
            if(typeof(itorisHandleGrouped)!='undefined' &&  itorisHandleGrouped=='grouped_handle_product') {
                var prices = this.cache.displayPrices,
                    additionalPrice = {},
                    pricesCode = [];
                if(newPrices &&  typeof(newPrices.productId) != 'undefined' && newPrices.productId && typeof(priceBundle)!= 'undefined' && typeof(priceBundle[newPrices.productId])!= 'undefined')
                {
                    this.updatePriceBundle(newPrices);
                    return;
                }
                if(newPrices &&  typeof(newPrices.productId) != 'undefined' && newPrices.productId && typeof(configurableProduct)!= 'undefined'
                    && typeof(configurableProduct[newPrices.productId])!= 'undefined')
                {
                    if(typeof (newPrices.configPriceFalse)!='undefined') {
                        this.updatePriceConfigurable(undefined);
                    }
                    this.updatePriceConfigurable(newPrices);
                    return;
                }
                if(typeof (newPrices)!='undefined' && typeof(newPrices.productId) != 'undefined'){
                    this.cache.additionalPriceObjectCustom = this.cache.additionalPriceObjectCustom || {};
                    this.cache.additionalPriceObjectCustom[newPrices.productId] = this.cache.additionalPriceObjectCustom[newPrices.productId] || {};
                }else {
                    this.cache.additionalPriceObject = this.cache.additionalPriceObject || {};
                }
                if (newPrices) {

                    if (typeof(newPrices.productId) != 'undefined') {
                        $.extend(this.cache.additionalPriceObjectCustom[newPrices.productId], newPrices);
                    } else {
                        $.extend(this.cache.additionalPriceObject, newPrices);
                    }

                }

                if (!_.isEmpty(additionalPrice)) {
                    pricesCode = _.keys(additionalPrice);
                } else if (!_.isEmpty(prices)) {
                    pricesCode = _.keys(prices);
                }
                if (newPrices && newPrices.productId != undefined) {
                    _.each(this.cache.additionalPriceObjectCustom[newPrices.productId], function (additional) {
                        if (additional && !_.isEmpty(additional)) {
                            pricesCode = _.keys(additional);
                        }
                        _.each(pricesCode, function (priceCode) {
                            var priceValue = additional[priceCode] || {};
                            priceValue.amount = +priceValue.amount || 0;
                            priceValue.adjustments = priceValue.adjustments || {};

                            additionalPrice[priceCode] = additionalPrice[priceCode] || {
                                    'amount': 0,
                                    'adjustments': {}
                                };
                            additionalPrice[priceCode].amount = 0 + (additionalPrice[priceCode].amount || 0)
                                + priceValue.amount;
                            _.each(priceValue.adjustments, function (adValue, adCode) {
                                additionalPrice[priceCode].adjustments[adCode] = 0
                                    + (additionalPrice[priceCode].adjustments[adCode] || 0) + adValue;
                            });
                        });
                    });
                } else {
                    _.each(this.cache.additionalPriceObject, function (additional) {
                        if (additional && !_.isEmpty(additional)) {
                            pricesCode = _.keys(additional);
                        }
                        _.each(pricesCode, function (priceCode) {
                            var priceValue = additional[priceCode] || {};
                            priceValue.amount = +priceValue.amount || 0;
                            priceValue.adjustments = priceValue.adjustments || {};

                            additionalPrice[priceCode] = additionalPrice[priceCode] || {
                                    'amount': 0,
                                    'adjustments': {}
                                };
                            additionalPrice[priceCode].amount = 0 + (additionalPrice[priceCode].amount || 0)
                                + priceValue.amount;
                            _.each(priceValue.adjustments, function (adValue, adCode) {
                                additionalPrice[priceCode].adjustments[adCode] = 0
                                    + (additionalPrice[priceCode].adjustments[adCode] || 0) + adValue;
                            });
                        });
                    });
                }


                if (_.isEmpty(additionalPrice)) {
                    this.cache.displayPrices = utils.deepClone(this.options.prices);
                } else {
                    _.each(additionalPrice, function (option, priceCode) {
                        var origin = this.options.prices[priceCode] || {},
                            final = prices[priceCode] || {};
                        option.amount = option.amount || 0;
                        origin.amount = origin.amount || 0;
                        origin.adjustments = origin.adjustments || {};
                        final.adjustments = final.adjustments || {};

                        final.amount = 0 + origin.amount + option.amount;
                        _.each(option.adjustments, function (pa, paCode) {
                            final.adjustments[paCode] = 0 + (origin.adjustments[paCode] || 0) + pa;
                        });
                    }, this);
                }
                this.element.trigger('reloadPrice');
            }else {

                var prices = this.cache.displayPrices,
                    additionalPrice = {},
                    pricesCode = [];

                this.cache.additionalPriceObject = this.cache.additionalPriceObject || {};
                if (newPrices) {
                    $.extend(this.cache.additionalPriceObject, newPrices);
                }

                if (!_.isEmpty(additionalPrice)) {
                    pricesCode = _.keys(additionalPrice);
                } else if (!_.isEmpty(prices)) {
                    pricesCode = _.keys(prices);
                }

                _.each(this.cache.additionalPriceObject, function (additional) {
                    if (additional && !_.isEmpty(additional)) {
                        pricesCode = _.keys(additional);
                    }
                    _.each(pricesCode, function (priceCode) {
                        var priceValue = additional[priceCode] || {};
                        priceValue.amount = +priceValue.amount || 0;
                        priceValue.adjustments = priceValue.adjustments || {};

                        additionalPrice[priceCode] = additionalPrice[priceCode] || {
                                'amount': 0,
                                'adjustments': {}
                            };
                        additionalPrice[priceCode].amount =  0 + (additionalPrice[priceCode].amount || 0)
                            + priceValue.amount;
                        _.each(priceValue.adjustments, function (adValue, adCode) {
                            additionalPrice[priceCode].adjustments[adCode] = 0
                                + (additionalPrice[priceCode].adjustments[adCode] || 0) + adValue;
                        });
                    });
                });

                if (_.isEmpty(additionalPrice)) {
                    this.cache.displayPrices = utils.deepClone(this.options.prices);
                } else {
                    _.each(additionalPrice, function (option, priceCode) {
                        var origin = this.options.prices[priceCode] || {},
                            final = prices[priceCode] || {};
                        option.amount = option.amount || 0;
                        origin.amount = origin.amount || 0;
                        origin.adjustments = origin.adjustments || {};
                        final.adjustments = final.adjustments || {};

                        final.amount = 0 + origin.amount + option.amount;
                        _.each(option.adjustments, function (pa, paCode) {
                            final.adjustments[paCode] = 0 + (origin.adjustments[paCode] || 0) + pa;
                        });
                    }, this);
                }

                this.element.trigger('reloadPrice');
            }

        },
        updatePriceBundle: function updatePrice(newPrices) {
            if(typeof(itorisHandleGrouped)!='undefined' &&  itorisHandleGrouped=='grouped_handle_product') {
                var prices = this.cache.displayBundlePrices,
                    additionalPrice = {},
                    pricesCode = [];
                       if (typeof (newPrices) != 'undefined' && typeof(newPrices.productId) != 'undefined') {
                           this.cache.additionalPriceBundleObjectCustom = this.cache.additionalPriceBundleObjectCustom || {};
                          // this.cache.additionalPriceBundleObjectCustom[i] = this.cache.additionalPriceBundleObjectCustom[i] || {};
                           this.cache.additionalPriceBundleObjectCustom[newPrices.productId] = this.cache.additionalPriceBundleObjectCustom[newPrices.productId] || {};
                       }
                       if (newPrices) {
                           if (typeof(newPrices.productId) != 'undefined') {
                               $.extend(this.cache.additionalPriceBundleObjectCustom[newPrices.productId], newPrices);
                           } else {
                               $.extend(this.cache.additionalPriceBundleObjectCustom, newPrices);
                           }

                       }

                       if (!_.isEmpty(additionalPrice)) {
                           pricesCode = _.keys(additionalPrice);
                       } else if (!_.isEmpty(prices)) {
                           pricesCode = _.keys(prices);
                       }
                       if (newPrices && newPrices.productId != undefined) {
                           _.each(this.cache.additionalPriceBundleObjectCustom[newPrices.productId], function (additional) {
                               if (additional && !_.isEmpty(additional)) {
                                   pricesCode = _.keys(additional);
                               }

                               _.each(pricesCode, function (priceCode) {
                                   var priceValue = additional[priceCode] || {};
                                   priceValue.amount = +priceValue.amount || 0;
                                   priceValue.adjustments = priceValue.adjustments || {};

                                   additionalPrice[priceCode] = additionalPrice[priceCode] || {
                                           'amount': 0,
                                           'adjustments': {}
                                       };

                                   additionalPrice[priceCode].amount = 0 + (additionalPrice[priceCode].amount || 0)
                                       + priceValue.amount;
                                   _.each(priceValue.adjustments, function (adValue, adCode) {
                                       additionalPrice[priceCode].adjustments[adCode] = 0
                                           + (additionalPrice[priceCode].adjustments[adCode] || 0) + adValue;
                                   });
                               });
                           });
                       }


                if (_.isEmpty(additionalPrice)) {
                    this.cache.displayBundlePrices = utils.deepClone(this.options.prices);
                } else {
                    _.each(additionalPrice, function (option, priceCode) {
                        var origin = this.options.prices[priceCode] || {},
                            final = prices[priceCode] || {};
                        option.amount = option.amount || 0;
                        origin.amount = origin.amount || 0;
                        origin.adjustments = origin.adjustments || {};
                        final.adjustments = final.adjustments || {};
                        final.amount = 0 + origin.amount + option.amount;
                        _.each(option.adjustments, function (pa, paCode) {
                            final.adjustments[paCode] = 0 + (origin.adjustments[paCode] || 0) + pa;
                        });
                    }, this);
                }
                this.element.trigger('reloadPriceCustom');
            }
        },
        updatePriceConfigurable: function updatePrice(newPrices) {
            if(typeof(itorisHandleGrouped)!='undefined' &&  itorisHandleGrouped=='grouped_handle_product') {
                var prices = this.cache.displayConfigurablePrices,
                    additionalPrice = {},
                    pricesCode = [];

                if (typeof (newPrices) != 'undefined' && typeof(newPrices.productId) != 'undefined') {
                    this.cache.additionalPriceConfigurableObjectCustom = this.cache.additionalPriceConfigurableObjectCustom || {};
                    // this.cache.additionalPriceBundleObjectCustom[i] = this.cache.additionalPriceBundleObjectCustom[i] || {};
                    this.cache.additionalPriceConfigurableObjectCustom[newPrices.productId] = this.cache.additionalPriceConfigurableObjectCustom[newPrices.productId] || {};
                }
                if (newPrices) {
                    if (typeof(newPrices.productId) != 'undefined') {
                        $.extend(this.cache.additionalPriceConfigurableObjectCustom[newPrices.productId], newPrices);
                    } else {
                        $.extend(this.cache.additionalPriceConfigurableObjectCustom, newPrices);
                    }

                }

                if (!_.isEmpty(additionalPrice)) {
                    pricesCode = _.keys(additionalPrice);
                } else if (!_.isEmpty(prices)) {
                    pricesCode = _.keys(prices);
                }
               ;
                if (newPrices && newPrices.productId != undefined) {
                    _.each(this.cache.additionalPriceConfigurableObjectCustom[newPrices.productId], function (additional) {
                        if (additional && !_.isEmpty(additional)) {
                            pricesCode = _.keys(additional);
                        }

                        _.each(pricesCode, function (priceCode) {
                            var priceValue = additional[priceCode] || {};
                            priceValue.amount = +priceValue.amount || 0;
                            priceValue.adjustments = priceValue.adjustments || {};

                            additionalPrice[priceCode] = additionalPrice[priceCode] || {
                                    'amount': 0,
                                    'adjustments': {}
                                };

                            additionalPrice[priceCode].amount = 0 + (additionalPrice[priceCode].amount || 0)
                                + priceValue.amount;
                            _.each(priceValue.adjustments, function (adValue, adCode) {
                                additionalPrice[priceCode].adjustments[adCode] = 0
                                    + (additionalPrice[priceCode].adjustments[adCode] || 0) + adValue;
                            });
                        });
                    });
                }


                if (_.isEmpty(additionalPrice)) {
                    this.cache.displayConfigurablePrices = utils.deepClone(this.options.prices);
                } else {
                    _.each(additionalPrice, function (option, priceCode) {
                        var origin = this.options.prices[priceCode] || {},
                            final = prices[priceCode] || {};
                        option.amount = option.amount || 0;
                        origin.amount = origin.amount || 0;
                        origin.adjustments = origin.adjustments || {};
                        final.adjustments = final.adjustments || {};

                        final.amount = 0 + origin.amount + option.amount;
                        _.each(option.adjustments, function (pa, paCode) {
                            final.adjustments[paCode] = 0 + (origin.adjustments[paCode] || 0) + pa;
                        });
                    }, this);
                }
                this.element.trigger('reloadPriceConfigurable');
            }
        },
        /**
         * Render price unit block.
         */
        reloadPrice: function reDrawPrices() {
            var priceFormat = (this.options.priceConfig && this.options.priceConfig.priceFormat) || {},
                priceTemplate = mageTemplate(this.options.priceTemplate);
            _.each(this.cache.displayPrices, function (price, priceCode) {
                price.final = _.reduce(price.adjustments, function(memo, amount) {
                    return memo + amount;
                }, price.amount);

                price.formatted = utils.formatPrice(price.final, priceFormat);
                $('[data-price-type="' + priceCode + '"]', this.element).html(priceTemplate({data: price}));
            }, this);
        },
        reloadPriceCustom: function reDrawPrices() {
            var priceFormat = (this.options.priceConfig && this.options.priceConfig.priceFormat) || {},
                priceTemplate = mageTemplate(this.options.priceTemplate);
            _.each(this.cache.displayBundlePrices, function (price, priceCode) {
                price.final = _.reduce(price.adjustments, function(memo, amount) {
                    return memo + amount;
                }, price.amount);

                price.formatted = utils.formatPrice(price.final, priceFormat);
                $('[data-price-type="' + priceCode + '"]', this.element).html(priceTemplate({data: price}));
            }, this);
        },
        reloadPriceConfigurable: function reDrawPrices() {
            var priceFormat = (this.options.priceConfig && this.options.priceConfig.priceFormat) || {},
                priceTemplate = mageTemplate(this.options.priceTemplate);
            _.each(this.cache.displayConfigurablePrices, function (price, priceCode) {
                price.final = _.reduce(price.adjustments, function(memo, amount) {
                    return memo + amount;
                }, price.amount);

                price.formatted = utils.formatPrice(price.final, priceFormat);
                $('[data-price-type="' + priceCode + '"]', this.element).html(priceTemplate({data: price}));
            }, this);
        },


        /**
         * Overwrites initial (default) prices object.
         * @param {Object} prices
         */
        setDefault: function setDefaultPrices(prices) {
            this.cache.displayPrices = utils.deepClone(prices);
            this.options.prices = utils.deepClone(prices);
        },
        setDefaultCustom: function setDefaultPrices(prices,productId) {
            this.cache.displayBundlePrices = utils.deepClone(prices);
            this.options.bundleprices = utils.deepClone(prices);
        },

        /**
         * Custom behavior on getting options:
         * now widget able to deep merge of accepted configuration.
         * @param  {Object} options
         * @return {mage.priceBox}
         */
        _setOptions: function setOptions(options) {
            $.extend(true, this.options, options);

            if ('disabled' in options) {
                this._setOption('disabled', options.disabled);
            }

            return this;
        },

        /**
         * setDefaultsFromDataSet
         */
        _setDefaultsFromDataSet: function _setDefaultsFromDataSet() {
            var box = this.element,
                priceHolders = $('[data-price-type]', box),
                prices = this.options.prices;
            this.options.productId = box.data('productId');

            if (_.isEmpty(prices)) {
                priceHolders.each(function (index, element) {
                    var type = $(element).data('priceType'),
                        amount = parseFloat($(element).data('priceAmount'));

                    if (type && amount) {
                        prices[type] = {
                            amount: amount
                        };
                    }
                });
            }
        },

        /**
         * setDefaultsFromPriceConfig
         */
        _setDefaultsFromPriceConfig: function _setDefaultsFromPriceConfig() {
            var config = this.options.priceConfig;

            if (config) {
                if (+config.productId !== +this.options.productId) {
                    return;
                }
                this.options.prices = config.prices;
            }
        }
    });

    return $.mage.priceBox;
});
