/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'jquery',
        'ko',
        'Magestore_Webpos/js/model/checkout/cart/items',
        'Magestore_Webpos/js/model/checkout/cart',
        'Magestore_Webpos/js/helper/alert',
        'Magestore_Webpos/js/model/checkout/checkout',
        'Magestore_Webpos/js/model/sales/order-factory',
        'Magestore_Webpos/js/view/layout',
        'mage/translate',
        'Magestore_Webpos/js/view/base/list/collection-list',
        'Magestore_Webpos/js/model/event-manager',
        'Magestore_Webpos/js/helper/price',
        'Magestore_Webpos/js/helper/datetime',
        'Magestore_Webpos/js/model/checkout/multiorder',
        'Magestore_Webpos/js/action/cart/hold',
        'Magestore_Webpos/js/action/cart/switch-order',
        'Magestore_Webpos/js/action/cart/cancel-onhold'

    ],
    function ($, ko, Items, CartModel, Alert, CheckoutModel, OrderFactory, ViewManager, $t, listAbstract, Event, priceHelper, datetimeHelper, multiOrder, Hold, Checkout, CancelOnhold) {
        "use strict";
        return listAbstract.extend({
            items: ko.observableArray([]),
            collection: '',
            isShowHeader: false,
            isSearchable: true,
            pageSize: 100,
            curPage: 1,
            showDateTime: ko.computed(function () {
                return multiOrder.showDateTime();
            }),
            selectedOrder: ko.observable(null),
            searchKey: '',
            groupDays: [],
            statusObject: ko.observableArray([
                {statusClass: 'pending', statusTitle: 'Pending', statusLabel: 'Pe'},
                {statusClass: 'processing', statusTitle: 'Processing', statusLabel: 'Pr'},
                {statusClass: 'complete', statusTitle: 'Complete', statusLabel: 'Co'},
                {statusClass: 'canceled', statusTitle: 'Canceled', statusLabel: 'Ca'},
                {statusClass: 'closed', statusTitle: 'Closed', statusLabel: 'Cl'},
                {statusClass: 'notsync', statusTitle: 'Not sync', statusLabel: 'Ns'},
                {statusClass: 'onhold', statusTitle: 'Not sync', statusLabel: 'Ho'}
            ]),
            statusBtn: '.wrap-status-orders ul li',
            statusArray: ['onhold', 'holded'],
            isMultipleOrder: ko.observable(false),

            defaults: {
                template: 'Magestore_Webpos/checkout/cart/multiorder',
            },

            initialize: function () {
                this._super();
                this.listenOnHoldAfterEvent();
                this.render();
            },


            HideMultipleOrder: function () {
                this.isMultipleOrder(false);
            },

            currentId: ko.pureComputed(function () {
                return multiOrder.currentId();
            }),

            _processResponse: function(response){
                return response.items;
            },

            _prepareItems: function () {
                var self = this;
                this.resetData();
                this.groupDays = [];

                this.collection = OrderFactory.get().setMode('offline').getCollection();
                this.collection.addFieldToFilter('status', this.statusArray, 'in');
                this.collection.setOrder('entity_id', 'ASC');
                var deferred = $.Deferred();
                this.collection.load(deferred);
                $('#multiorder-overlay').show();
                deferred.done(function(response){
                    var items = self._processResponse(response);
                    if (!multiOrder.currentId()) {
                        if (typeof items[0] !== 'undefined') {
                            var firstItem = items[0];
                            self.selectCurrentOrder(firstItem);
                        } else {
                            multiOrder.currentId(0);
                            multiOrder.currentOrderData({});
                            CartModel.emptyCart();
                        }
                    }
                    self.setItems(items);
                    $('#multiorder-overlay').hide();
                });
            },

            afterRender: function () {
                var length = 9999;

                $('.multiorder-item').each(function () {
                    if ($(this).width() <= length) {
                        length = $(this).width();
                    }
                });
                if (length < 65) {
                    multiOrder.showDateTime(true);
                }
            },

            beforeRender: function() {
                multiOrder.showDateTime(true);
            },

            /**
             * return a date time with format: 15:26 PM
             * @param dateString
             * @returns {string}
             */
            getTime: function(dateString) {
                var currentTime = datetimeHelper.stringToCurrentTime(dateString);
                return datetimeHelper.getTime(currentTime);
            },

            render: function() {
                this._render();
            },

            listenOnHoldAfterEvent: function () {
                var self = this;
                Event.observer('order_hold_after', function (event, eventData) {
                    self.render();
                });
            },

            processItem: function (data) {
                var self = this;
                if (data.entity_id !== multiOrder.currentId() && multiOrder.currentId()) {
                    var holdData = CheckoutModel.getHoldOrderData();
                    var oldOrder = multiOrder.currentOrderData();

                    holdData.entity_id = oldOrder.entity_id;
                    holdData.increment_id = oldOrder.increment_id;
                    $('#multiorder-overlay').show();
                    var holdDeferred = OrderFactory.get().setMode('offline').setData(holdData).save();
                    holdDeferred.done(function (newData) {
                        self.selectCurrentOrder(data);
                        Event.dispatch('order_hold_after', {});
                    });
                } else {
                    self.selectCurrentOrder(data);
                }
            },

            addNewSession: function () {
                var self = this;
                var holdData = CheckoutModel.getHoldOrderData();
                var oldOrder = multiOrder.currentOrderData();
                if (typeof oldOrder.entity_id !== 'undefined' && oldOrder.entity_id) {
                    holdData.entity_id = oldOrder.entity_id;
                    holdData.increment_id = oldOrder.increment_id;
                    $('#multiorder-overlay').show();
                    var holdDeferred = OrderFactory.get().setMode('offline').setData(holdData).save();
                    holdDeferred.done(function (newData) {
                        self.createNewEmptyOrder();
                    });
                } else {
                    $('#multiorder-overlay').show();
                    OrderFactory.get().setMode('offline').setData(holdData).save().done(function (response) {
                        Event.dispatch('order_hold_after', response.entity_id);
                    });
                }

            },

            createNewEmptyOrder: function () {
                var self = this;
                CartModel.emptyCart();
                var data = CheckoutModel.getHoldOrderData();
                $('#multiorder-overlay').show();
                OrderFactory.get().setMode('offline').setData(data).save().done(function (response) {
                    self.selectCurrentOrder(response);
                    Event.dispatch('order_hold_after', response.entity_id);
                });
            },


            removeSession: function (data) {
                /* Remove session data*/
                $('#multiorder-overlay').show();
                CancelOnhold(data);
                if (data.entity_id === this.currentId()) {
                    multiOrder.currentId(0);
                    multiOrder.currentOrderData({});
                }
            },

            selectCurrentOrder: function (data) {
                multiOrder.currentId(data.entity_id);
                multiOrder.currentOrderData(data);
                Checkout(data);
            }


        });
    }
);
