/**
 * Copyright © 2016 ITORIS INC. All rights reserved.
 * See license agreement for details
 */
define([
    'jquery',
    'underscore',
    'mage/template',
    'priceUtils',
    'jquery/ui',
    'priceBox',
    'priceOptions' // usually widget can be found in /lib/web/mage dir
], function($,_,mageTemplate,utils){
    var globalOptions = {
        productId: null,
        priceHolderSelector: '.price-box', //data-role="priceBox"
        optionsSelector: '.product-custom-option',
        optionConfig: {},
        optionHandlers: {},
        optionTemplate: '<%- data.label %>' +
        '<% if (data.finalPrice.value) { %>' +
        ' +<%- data.finalPrice.formatted %>' +
        '<% } %>',
        controlContainer: 'dd'
    };
    $.widget('itoris.priceOptionsCustom', $.mage.priceOptions, {
        options: globalOptions,
        prodArr:globalOptionsProd,
        /**
         * Widget creating method.
         * Triggered once.
         * @private
         */
        _create: function createPriceOptions() {
                var prefixPlaceholder = this.prodArr;
                    var form = this.element,
                        options = $(this.options.optionsSelector, form),
                        priceBox = $(this.options.priceHolderSelector, $(this.options.optionsSelector).element);
                    if (priceBox.data('magePriceBox') && priceBox.priceBox('option') && priceBox.priceBox('option').priceConfig) {
                        if (priceBox.priceBox('option').priceConfig.optionTemplate) {
                            this._setOption('optionTemplate', priceBox.priceBox('option').priceConfig.optionTemplate);
                        }
                        this._setOption('priceFormat', priceBox.priceBox('option').priceConfig.priceFormat);
                    }
                    this._applyOptionNodeFix(options);

                    options.on('change', this._onOptionChanged.bind(this));

        },

        /**
         * Custom option change-event handler
         * @param {Event} event
         * @private
         */
        _onOptionChanged: function onOptionChanged(event) {
          var productId = $(event.target).closest('.itoris_slider_group').attr('data_product_id');
            var changes,
                option = $(event.target),
                handler = this.options.optionHandlers[option.data('role')];
                var handlerData=optionHandlers[option.data('role')];
            this.options.priceHolderSelector = "[data-role=priceBox][data-product-id=" + productId + "]";
            option.data('optionContainer', option.closest(this.options.controlContainer));
            this.options.optionConfig = globalOptionsProd[productId];
            if(handler) {

                if (handler && handler instanceof Function) {
                    changes = handler(option, this.options.optionConfig, this);
                }
            }else if(handlerData && handlerData instanceof Function) {
                changes=changes = handlerData(option, this.options.optionConfig, this);
                changes.productId = productId;
            }else {
                if(this.options.optionConfig){
                    changes = defaultGetOptionValue(option, this.options.optionConfig);
                }else{
                    return;
                }

            }
            changes.productId = productId;
            $(this.options.priceHolderSelector).trigger('updatePrice', changes);
        },


        /**
         * Helper to fix issue with option nodes:
         *  - you can't place any html in option ->
         *    so you can't style it via CSS
         * @param {jQuery} options
         * @private
         */
        _applyOptionNodeFix: function applyOptionNodeFix(options) {
            var config = this.options,
                format = config.priceFormat,
                template = config.optionTemplate;
            template = mageTemplate(template);
            options.filter('select').each(function (index, element) {
                var $element = $(element),
                    optionId = utils.findOptionId($element),
                    optionName = $element.prop('name'),
                    optionType = $element.prop('type');
                var  optionConfig = config.optionConfig && config.optionConfig[optionId];

                $element.find('option').each(function (idx, option) {
                    var $option,
                        optionValue,
                        toTemplate,
                        prices;

                    $option = $(option);
                    optionValue = $option.val();
                    if (!optionValue && optionValue !== 0) {
                        return;
                    }
                    if(typeof(optionConfig)=='undefined' || typeof (optionConfig[optionValue])=='undefined'){
                        return;
                    }
                    toTemplate = {
                        data: {
                            label: optionConfig[optionValue] && optionConfig[optionValue].name
                        }
                    };
                    prices = optionConfig[optionValue] ? optionConfig[optionValue].prices : null;

                    if (prices) {
                        _.each(prices, function (price, type) {
                            var value = +(price.amount);
                            value += _.reduce(price.adjustments, function (sum, x) {
                                return sum + x;
                            }, 0);
                            toTemplate.data[type] = {
                                value: value,
                                formatted: utils.formatPrice(value, format)
                            };
                        });

                        $option.text(template(toTemplate));
                    }
                });
            });
        },

        /**
         * Custom behavior on getting options:
         * now widget able to deep merge accepted configuration with instance options.
         * @param  {Object}  options
         * @return {$.Widget}
         * @private
         */
        _setOptions: function setOptions(options) {
            $.extend(true, this.options, options);
            this._super(options);

            return this;
        }
    });
    return $.itoris.priceOptionsCustom;
    /**
     * Custom option preprocessor
     * @param  {jQuery} element
     * @param  {Object} optionsConfig - part of config
     * @return {Object}
     */
    function defaultGetOptionValue(element, optionsConfig) {
        var changes = {},
            optionValue = element.val(),
            optionId = utils.findOptionId(element[0]),
            optionName = element.prop('name'),
            optionType = element.prop('type'),
            optionConfig = optionsConfig[optionId],
            optionHash = optionName;
        switch (optionType) {
            case 'text':

            case 'textarea':
                changes[optionHash] = optionValue ? optionConfig.prices : {};
                break;

            case 'radio':
                if (element.is(':checked')) {
                    changes[optionHash] = optionConfig[optionValue] && optionConfig[optionValue].prices || {};
                }
                break;
            case 'select-one':
                changes[optionHash] = optionConfig[optionValue] && optionConfig[optionValue].prices || {};
                break;

            case 'select-multiple':
                _.each(optionConfig, function (row, optionValueCode) {
                    optionHash = optionName + '##' + optionValueCode;
                    changes[optionHash] = _.contains(optionValue, optionValueCode) ? row.prices : {};
                });
                break;

            case 'checkbox':
                optionHash = optionName + '##' + optionValue;
                changes[optionHash] = element.is(':checked') ? optionConfig[optionValue].prices : {};
                break;

            case 'file':
                // Checking for 'disable' property equal to checking DOMNode with id*="change-"
                changes[optionHash] = optionValue || element.prop('disabled') ? optionConfig.prices : {};
                break;
        }
        return changes;
    }
});