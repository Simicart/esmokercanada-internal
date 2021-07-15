/**
 * Copyright © 2016 ITORIS INC. All rights reserved.
 * See license agreement for details
 */
define([
    'jquery',
    'priceUtils',
    'priceOptionsCustom',
    'jquery/ui',
    'priceOptionDate'
], function ($, utils) {
    'use strict';

    var globalOptions = {
        fromSelector: 'form',
        dropdownsSelector: '[data-role=calendar-dropdown]'
    };

    $.widget('itoris.priceOptionDateCustom', $.mage.priceOptionDate, {
        options: globalOptions,
        dropdown:[],
        /**
         * Function-initializer of priceOptionDate widget
         * @private
         */
        _create: function initOptionDate() {
            var field = this.element,
                form = field.closest(this.options.fromSelector),
                dropdowns = $(this.options.dropdownsSelector, field),
                optionHandler = {},
                dateOptionId;
               var productId=($(dropdowns).closest('fieldset').attr('data_product_id'));
                if(typeof this.dropdown[productId]=='undefined')
               this.dropdown[productId]=$(this.options.dropdownsSelector, field)

            if (dropdowns.length) {
                dateOptionId = this.options.dropdownsSelector + dropdowns.attr('name');

                optionHandler.optionHandlers = {};
                optionHandlers[dateOptionId]= onCalendarDropdownChange(dropdowns);
                optionHandler.optionHandlers[dateOptionId] = onCalendarDropdownChange(dropdowns);

                form.priceOptionsCustom(optionHandler);
                dropdowns.data('role', dateOptionId);
                dropdowns.on('change', onDateChange.bind(this,  this.dropdown[productId]));
            }
        }
    });

    return $.itoris.priceOptionDateCustom;

    /**
     * Custom handler for Date-with-Dropdowns option type.
     * @param  {jQuery} siblings
     * @return {Function} function that return object { optionHash : optionAdditionalPrice }
     */
    function onCalendarDropdownChange(siblings) {
        return function (element, optionConfig, form) {
            var changes = {},
                optionId = utils.findOptionId(element),
                overhead = optionConfig[optionId].prices,
                isNeedToUpdate = true,
                optionHash = 'price-option-calendar-' + optionId;

            siblings.each(function (index, el) {
                isNeedToUpdate = isNeedToUpdate && !!$(el).val();
            });

            overhead = isNeedToUpdate ? overhead : {};
            changes[optionHash] = overhead;

            return changes;
        };
    }

    /**
     * Adjusts the number of days in the day option element based on which month or year
     * is selected (changed). Adjusts the days to 28, 29, 30, or 31 typically.
     * @param {jQuery} dropdowns
     */
    function onDateChange(dropdowns) {
        var daysNodes,
            curMonth, curYear, expectedDays,
            options, needed,
            month = dropdowns.filter('[data-calendar-role=month]'),
            year = dropdowns.filter('[data-calendar-role=year]');

        if (month.length && year.length) {
            daysNodes = dropdowns.filter('[data-calendar-role=day]').find('option');

            curMonth = month.val() || '01';
            curYear = year.val() || '2000';
            expectedDays = getDaysInMonth(curMonth, curYear);

            if (daysNodes.length - 1 > expectedDays) { // remove unnecessary option nodes
                daysNodes.each(function (i, e) {
                    if (e.value > expectedDays) {
                        $(e).remove();
                    }
                });
            } else if (daysNodes.length - 1 < expectedDays) { // add missing option nodes
                options = [];
                needed = expectedDays - daysNodes.length + 1;

                while (needed--) {
                    options.push('<option value="' + (expectedDays - needed) + '">' + (expectedDays - needed) + '</option>');
                }
                $(options.join('')).insertAfter(daysNodes.last());
            }
        }
    }

    /**
     * Returns number of days for special month and year
     * @param  {Number} month
     * @param  {Number} year
     * @return {Number}
     */
    function getDaysInMonth(month, year) {
        return new Date(year, month, 0).getDate();
    }
});
