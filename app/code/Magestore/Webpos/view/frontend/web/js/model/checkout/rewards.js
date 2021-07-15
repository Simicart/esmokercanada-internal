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
        'Magestore_WebposCustomize/js/model/resource-model/magento-rest/rewards/rewards',
        'Magestore_WebposCustomize/js/model/resource-model/indexed-db/rewards/rewards',
        'Magestore_WebposCustomize/js/model/collection/rewards',
        'Magestore_Webpos/js/model/checkout/cart',
        'Magestore_Webpos/js/view/checkout/cart',
        'Magestore_Webpos/js/model/checkout/cart/totals/total',
        'Magestore_Webpos/js/model/checkout/cart/totals',
        'Magestore_Webpos/js/model/checkout/cart/totals-factory',
        'Magestore_Webpos/js/model/checkout/cart/data/cart',
        // 'Magestore_Webpos/js/view/settings/general/rewardpoints/show-rewardpoints-balance',
        // 'Magestore_Webpos/js/view/settings/general/rewardpoints/auto-sync-balance',
        'Magestore_Webpos/js/model/event-manager',
        'Magestore_Webpos/js/helper/general',
        'Magestore_WebposCustomize/js/helper/general',
        // 'Magestore_WebposCustomize/js/model/checkout/rewards/earning-rate',
        'Magestore_WebposCustomize/js/model/resource-model/magento-rest/rewards/earning-rate',
        'Magestore_WebposCustomize/js/model/resource-model/magento-rest/rewards/spending-rate',
        'Magestore_Webpos/js/model/checkout/checkout'
    ],
    function ($, ko, modelAbstract, onlineResource, offlineResource, collection, CartModel, CartView,
              Total,
              Totals,
              TotalsFactory,
              CartData,
              // ShowPointBalance,
              // AutoSyncBalance,
              Event,
              WebposHelper,
              CustomizeHelper,
              // EarnRateModel,
              EarnRateOnlineResource,
              SpendRateOnlineResource,
              CheckoutModel) {
        "use strict";
        if (!window.hadObserver) {
            window.hadObserver = [];
        }
        return modelAbstract.extend({
            sync_id:'customer_rewards_points',
            TOTAL_CODE:'rewards',
            TOTAL_CODE_EARN_POINT:'rewards_label',
            TOTAL_CODE_SPEND_POINT:'rewards_spent_label',
            MODULE_CODE:'rewards',
            STATUS_INACTIVE: 0,
            STATUS_ACTIVE: 1,
            TYPE_POINT_TO_MONEY: '1',
            TYPE_MONEY_TO_POINT: '2',
            CUSTOMER_GROUP_ALL: '0',
            EARN_WHEN_INVOICE: '1',
            balance: ko.observable(0),
            currentAmount: ko.observable(0),

            applied: ko.observable(false),
            appliedAmount: ko.observable(0),
            applying: ko.observable(false),
            maxPoint: ko.observable(0),
            visible: ko.observable(false),
            useMaxPoint: ko.observable(true),
            updatingBalance: ko.observable(false),
            updatingEarningRate: ko.observable(false),
            updatingSpendingRate: ko.observable(false),
            loading: ko.observable(false),
            remaining: CheckoutModel.remainTotal,

            earningPoint: ko.observable(0),
            spendingPoint: ko.observable(0),
            earningRates: ko.observableArray([]),
            spendingRates: ko.observableArray([]),
            earningRateValue: ko.observable(0),
            spendingRateValue: ko.observable(0),
            earningRate: ko.observable(),
            spendingRate: ko.observable(),

            discountAmount: ko.observable(0),
            pointUnitName: ko.observable("Points"),
            initialize: function () {
                if(CustomizeHelper.isMirasvitRewardsEnable()) {
                    this._super();
                    this.setResource(onlineResource(), offlineResource());
                    this.setResourceCollection(collection());
                    this.TotalsModel = Totals();
                    this.initVariable();
                    if ($.inArray(this.MODULE_CODE, window.hadObserver) < 0) {
                        this.initObserver();
                        window.hadObserver.push(this.MODULE_CODE);
                    }
                }
            },
            getConfig: function(path){
                var allConfig = WebposHelper.getBrowserConfig('plugins_config');
                if(allConfig[this.MODULE_CODE]){
                    var configs = allConfig[this.MODULE_CODE];
                    if(configs[path]){
                        return configs[path];
                    }
                }
                return false;
            },
            formatPoints: function (points) {
                var self = this;
                var unit = self.getConfig('rewards/general/point_unit_name');
                if (points == 1) {
                    unit = unit.replace("/\([^)]+\)/", '');
                } else {
                    unit = unit.replace(['(', ')'], '');
                }

                return points + " " + unit;
            },
            getAmountForShipping: function(items){
                var amount = {
                    base:0,
                    amount:0
                };
                if(items && items.length > 0){
                    var totalBase = 0;
                    var totalAmount = 0;
                    ko.utils.arrayForEach(items, function(item) {
                        if(item.item_rewards_base_point_discount){
                            totalBase += item.item_rewards_base_point_discount;
                        }
                        if(item.item_rewards_point_discount){
                            totalAmount += item.item_rewards_base_point_discount;
                        }
                    });
                    amount.base = WebposHelper.toBasePrice(this.discountAmount()) - totalBase;
                    amount.amount = this.discountAmount() - totalAmount;
                }
                return amount;
            },
            initVariable: function () {
                var self = this;

                self.updateBalance();

                self.visible = ko.pureComputed(function(){
                    return self.canUseExtension();
                });

                self.applied(false);
                self.pointUnitName(self.getConfig('rewards/general/point_unit_name'));

                self.balanceAfterApply = ko.pureComputed(function () {
                    return (self.applied()) ? (self.balance() - self.appliedAmount()) : self.balance();
                });

                self.useMaxPoint.subscribe(function (value) {
                    if (value == true) {
                        if(WebposHelper.isUseOnline('checkout')){
                            if(self.maxPoint()){
                                self.currentAmount(self.maxPoint());
                            }else{
                                self.validate(self.balance(),self.convertMoneyToPoint(self.TotalsModel.positiveTotal()));
                            }
                            // if(self.canUseExtension()){
                                // self.spendPointOnline();
                            // }
                        }else{
                            self.validate(self.balance(),self.convertMoneyToPoint(self.TotalsModel.positiveTotal()));
                        }
                    }
                });

                self.applying.subscribe(function (value) {
                    if(self.applying() == true) {
                        var data = {
                            'spend_points': self.appliedAmount()
                        };
                        Event.dispatch('spent_point_apply', data);

                        if(!WebposHelper.isUseOnline('checkout')) {
                            self.apply();
                        }
                        self.updateBalance();
                        self.applying(false);
                    }
                });
            },
            initObserver: function(){
                var self = this;
                /**
                 * Reset data after cart empty
                 */
                WebposHelper.observerEvent('cart_empty_after', function (event, data) {
                    self.cartEmptyAfter(data);
                });

                /**
                 * Load customer balance when select customer to checkout
                 */
                WebposHelper.observerEvent('checkout_select_customer_after', function (event, data) {
                    self.selectCustomerToCheckoutAfter(data);
                });

                /**
                 * Show customer point balance on receipt
                 */
                WebposHelper.observerEvent('prepare_receipt_totals', function (event, data) {
                    self.prepareReceipt(data);
                });

                // /**
                //  * Update customer point balance on local after checkout
                //  */
                // WebposHelper.observerEvent('webpos_order_save_after', function (event, data) {
                //     self.orderSaveAfter(data);
                // });

                /**
                 * Add params to sync data when syncing order
                 */
                WebposHelper.observerEvent('webpos_place_order_before', function (event, data) {
                    if(!WebposHelper.isUseOnline('checkout')){
                        self.placeOrderBefore(data);
                    }
                });

                /**
                 * Call api to update customer credit balance after refund by credit
                 */
                WebposHelper.observerEvent('order_refund_after', function (event, data) {
                    // self.refundAfter(data);
                });

                /**
                 * Collect rates
                 */
                WebposHelper.observerEvent('go_to_checkout_page',function(event,data){
                    var useMaxPoint = self.getConfig('rewardpoints/spending/max_point_default');
                    if(self.appliedAmount() <= 0){
                        self.useMaxPoint(false);
                        self.currentAmount();
                        if(useMaxPoint == self.STATUS_ACTIVE){
                            self.useMaxPoint(true);
                        }
                    }
                });

                /**
                 * Process data after call api
                 */
                WebposHelper.observerEvent('checkout_call_api_after',function(event, data){
                    self.checkoutCallApiAfter(data);
                });

                /**
                 * Add params to sync rewards data when place order online
                 */
                WebposHelper.observerEvent('webpos_place_order_online_before', function (event, data) {
                    self.placeOrderOnlineBefore(data);
                });

                /**
                 * Update customer point balance on local after checkout
                 */
                WebposHelper.observerEvent('webpos_place_order_online_after', function (event, data) {
                    self.orderSaveAfter(data);
                });
            },
            /**
             * Event cart empty after - remove applied data
             * @param data
             */
            cartEmptyAfter: function(data){
                this.remove();
                this.resetAllData();
            },
            /**
             * Event after select customer - load balance and collect rates
             * @param data
             */
            selectCustomerToCheckoutAfter: function(data){
                var self = this;
                if (self.updatingBalance() == false && CartModel.customerId()) {
                    if (data.customer && data.customer.id) {
                        self.updateBalance();
                        self.loadBalanceByCustomerId(data.customer.id);
                    }
                }
            },
            /**
             * Event before show receipt - Add data to show on receipt
             * @param data
             */
            prepareReceipt: function(data){
                // data.totals.push({
                //     code: 'rewardpoints_discount',
                //     title: 'Points Discount',
                //     required: false,
                //     sortOrder: 37,
                //     isPrice: true
                // });
                data.totals.push({
                    code: 'rewards_spent',
                    title: 'You Spend',
                    required: false,
                    sortOrder: 6,
                    isPrice: false,
                    valueLabel: this.pointUnitName()
                });
                data.totals.push({
                    code: 'rewards_earn',
                    title: 'You Earn',
                    required: false,
                    sortOrder: 5,
                    isPrice: false,
                    valueLabel: this.pointUnitName()
                });
                if (data.customer_id) {
                    var self = this;
                    if (CartModel.customerId()) {
                        var balance = self.balance() - self.appliedAmount();
                        var earnWhenInvoice = self.getConfig('rewards/general/is_earn_after_invoice');
                        if (earnWhenInvoice == self.EARN_WHEN_INVOICE) {
                            if (CheckoutModel.createInvoice()) {
                                balance += self.earningPoint();
                            }
                        } else {
                            if (CheckoutModel.createInvoice() && CheckoutModel.createShipment()) {
                                balance += self.earningPoint();
                            }
                        }
                        data.accountInfo.push({
                            label: WebposHelper.__('Customer points balance'),
                            value: balance
                        });
                    }
                }
            },
            placeOrderOnlineBefore: function(params){
                var self = this;
                if (CartModel.customerId()) {
                    var order_data = [];
                    if(self.earningPoint() > 0) {
                        order_data.push({
                            key: "rewards_earn",
                            value: self.earningPoint()
                        });
                    }
                    if(self.applied() && self.appliedAmount() > 0) {
                        order_data.push({
                            key: "rewards_spent",
                            value: self.spendingPoint()
                        });
                        order_data.push({
                            key: "rewards_discount",
                            value: self.discountAmount()
                        });
                        order_data.push({
                            key: "rewards_base_discount",
                            value: WebposHelper.toBasePrice(self.discountAmount())
                        });
                    }
                    var extension_data = [];
                    params.integration.push({
                        'module': 'mirasvit_rewards',
                        'event_name': 'webpos_use_mirasvit_rewards',
                        'order_data': order_data,
                        'extension_data': extension_data
                    });
                }
            },
            /**
             * Event order save after - update balance on local
             * @param data
             */
            orderSaveAfter: function(data){
                var self = this;
                var balance = self.balance();
                if (data && data.customer_id && data.rewardpoints_spent > 0) {
                    balance -= data.rewardpoints_spent;
                }
                var earnWhenInvoice = self.getConfig('rewardpoints/earning/order_invoice');
                var holdDays = WebposHelper.toNumber(self.getConfig('rewardpoints/earning/holding_days'));
                if(holdDays <= 0) {
                    if (earnWhenInvoice == self.EARN_WHEN_INVOICE) {
                        if (CheckoutModel.createInvoice()) {
                            if (data && data.customer_id && data.rewardpoints_earn > 0) {
                                balance += data.rewardpoints_earn;
                            }
                        }
                    } else {
                        if (CheckoutModel.createInvoice() && CheckoutModel.createShipment()) {
                            if (data && data.customer_id && data.rewardpoints_earn > 0) {
                                balance += data.rewardpoints_earn;
                            }
                        }
                    }
                }
                if(balance != self.balance()){
                    self.saveBalance(data.customer_id, balance);
                }
            },
            /**
             * Event place order before - add data to order
             * @param data
             */
            placeOrderBefore: function(data){
                var self = this;
                if (data && data.increment_id && CartModel.customerId()) {
                    var order_data = [];
                    if(self.earningPoint() > 0){
                        data.rewardpoints_earn = self.earningPoint();
                        order_data.push({
                            key: "rewardpoints_earn",
                            value: self.earningPoint()
                        });
                    }
                    if(self.applied() && self.appliedAmount() > 0){
                        data.rewardpoints_spent = self.appliedAmount();
                        data.rewardpoints_discount = -self.discountAmount();
                        data.rewardpoints_base_discount = -WebposHelper.toBasePrice(self.discountAmount());

                        order_data.push({
                            key: "rewardpoints_spent",
                            value: self.appliedAmount()
                        });
                        order_data.push({
                            key: "rewardpoints_discount",
                            value: self.discountAmount()
                        });
                        order_data.push({
                            key: "rewardpoints_base_discount",
                            value: WebposHelper.toBasePrice(self.discountAmount())
                        });
                    }

                    var useForShipping = self.getConfig('rewardpoints/spending/spend_for_shipping');
                    if (useForShipping == '1') {
                        order_data.push({
                            key: "rewardpoints_amount",
                            value: self.getAmountForShipping(data.items).amount
                        });
                        order_data.push({
                            key: "rewardpoints_base_amount",
                            value: self.getAmountForShipping(data.items).base
                        });
                    }

                    data.sync_params.integration.push({
                        'module': 'os_reward_points',
                        'event_name': 'webpos_create_order_with_points_after',
                        'order_data': order_data,
                        'extension_data': []
                    });
                }
            },
            refundAfter: function(data){
                var self = this;
                if (data && data.response && data.response.customer_id) {
                    if(data.response.rewardpoints_earn > 0 || data.response.rewardpoints_spent > 0){
                        self.updateBalance(data.response.customer_id);
                    }
                }
            },
            /**
             * Reset all model data
             */
            resetAllData: function(){
                this.balance(0);
                this.currentAmount(0);
                this.discountAmount(0);
                this.applied(false);
                this.appliedAmount(0);
                this.useMaxPoint(false);
                this.maxPoint(0);
                this.earningRateValue(0);
                this.spendingRateValue(0);
                this.earningRate({});
                this.spendingRate({});
            },
            /**
             * Reset model data
             */
            resetData: function(){
                this.currentAmount(0);
                this.discountAmount(0);
                this.applied(false);
                this.appliedAmount(0);
                this.useMaxPoint(false);
            },
            /**
             * Update balance from server
             * @param customerId
             */
            updateBalance: function(customerId){
                customerId = (customerId)?customerId:CartModel.customerId();
                if(customerId){
                    var self = this;
                    var deferred = $.Deferred();
                    var params = {
                        customer_id: customerId
                    };
                    onlineResource().setPush(true).setLog(false).getBalance(params,deferred);
                    self.updatingBalance(true);
                    deferred.done(function (response) {
                        var data = (typeof response == 'string')?JSON.parse(response):response;
                        if(data && typeof data.balance != undefined){
                            self.balance(data.balance);
                            self.saveBalance(customerId, data.balance);
                        }
                    }).always(function (response) {
                        self.updatingBalance(false);
                    });
                }
            },
            /**
             * Apply discount to cart
             * @param apply
             */
            apply: function(apply){
                var amount = (apply === false)?0:this.currentAmount();
                var visible = (amount > 0)?true:false;
                this.applied(visible);
                this.currentAmount(amount);
                if(visible){
                    this.appliedAmount(amount);
                }else{
                    this.appliedAmount(0);
                }
                if(!WebposHelper.isUseOnline('checkout')) {
                    this.collectDiscountAmount();
                }
                this.TotalsModel.addTotal({
                    code: this.TOTAL_CODE,
                    cssClass: 'discount',
                    title: WebposHelper.__('Points Discount'),
                    value: -this.discountAmount(),
                    baseValue: -WebposHelper.toBasePrice(this.discountAmount()),
                    isVisible: visible,
                    removeAble: false,
                    actions:{
                        remove: $.proxy(this.remove, this),
                        collect: $.proxy(this.collect, this)
                    }
                });
                this.TotalsModel.updateTotal('rewards',{isVisible: visible});
                this.process(WebposHelper.toBasePrice(this.discountAmount()));
                WebposHelper.dispatchEvent('reset_payments_data', '');
            },
            /**
             * Remove data
             */
            remove: function(){
                this.resetData();
                this.apply(false);
            },
            /**
             * Validate can use module
             * @returns {boolean}
             */
            canUseExtension: function(){
                debugger;
                var self = this;
                var customerId = CartModel.customerId();
                var moduleEnable = CustomizeHelper.isMirasvitRewardsEnable();
                var canuse = (moduleEnable && customerId)?true:false;
                return canuse;
            },
            /**
             * Validate amount before apply
             * @param balance
             * @param max
             * @returns {boolean}
             */
            validate: function(balance, max){
                var self = this;
                if(!self.canUseExtension()){
                    if(self.visible() == true && self.applied() && self.applied() == true){
                        self.remove();
                    }
                    return false;
                }
                if(!balance && !max){
                    var useMaxPoint = self.useMaxPoint();
                    if (self.currentAmount() >= self.maxPoint()) {
                        useMaxPoint = true;
                    } else {
                        useMaxPoint = false;
                    }
                    self.useMaxPoint(useMaxPoint);
                    if (self.useMaxPoint() == useMaxPoint && useMaxPoint) {
                        self.currentAmount(self.maxPoint());
                    }
                }
                return true;
            },
            collectValidTotal: function(){
                var self = this;
                var grandTotal = (self.TotalsModel.grandTotal() > 0)?self.TotalsModel.grandTotal():0;
                var discountAmount = (self.discountAmount())?self.discountAmount():0;
                var applyAfterDiscount = (WebposHelper.getBrowserConfig('tax/calculation/apply_after_discount'))?'0':'1';
                var validTotal = (applyAfterDiscount == '1')?(grandTotal + discountAmount - self.TotalsModel.tax()):(grandTotal + discountAmount);
                var useForShipping = self.getConfig('rewards/general/is_spend_shipping');
                if(useForShipping == '0'){
                    validTotal -= self.TotalsModel.shippingFee();
                }
                if(WebposHelper.isUseOnline('checkout')){
                    validTotal -= parseFloat(self.TotalsModel.getOnlineValue(self.TOTAL_CODE));
                }
                return validTotal;
            },
            collectMaxTotalToDiscount: function(){
                var max = 0;
                if(CartData.totals().length > 0){
                    var self = this;
                    ko.utils.arrayForEach(CartData.totals(), function (total) {
                        if(total.code() != self.TOTAL_CODE && total.code() != self.TotalsModel.GRANDTOTAL_TOTAL_CODE && total.value()){
                            max += WebposHelper.toNumber(total.value());
                        }
                    });
                }
                var applyAfterDiscount = (WebposHelper.getBrowserConfig('tax/calculation/apply_after_discount'))?'0':'1';
                if(applyAfterDiscount == '1'){
                    max -= WebposHelper.toNumber(this.TotalsModel.tax());
                }
                var useForShipping = this.getConfig('rewards/general/is_spend_shipping');
                if(useForShipping == '0'){
                    max -= WebposHelper.toNumber(this.TotalsModel.shippingFee());
                }
                return max;
            },
            collectDiscountAmount: function(){
                //Function caculator points discount amount
            },
            /**
             * Load balance by customer from local
             * @param customerId
             */
            loadBalanceByCustomerId: function(customerId){
                var self = this;
                if(customerId) {
                    // self.getCollection().addFieldToFilter('customer_id', customerId, 'eq');
                    self.getCollection().load().done(function (response) {
                        if (response.items && response.items.length > 0) {
                            var balance = parseFloat(response.items[0].point_balance);
                            self.balance(balance);
                            if(balance <= 0){
                                self.remove();
                            }else{
                                if(self.applied()){
                                    self.collect();
                                }
                            }
                        }else{
                            self.balance(0);
                            self.remove();
                        }
                    });
                }else{
                    if(self.visible() == true && self.applied() && self.applied() == true){
                        self.balance(0);
                        self.remove();
                    }
                }
            },
            /**
             * Update balance from local
             */
            updateStorageBalance: function(){
                var self = this;
                if(CartModel.customerId()) {
                    self.getCollection().addFieldToFilter('customer_id', CartModel.customerId(), 'eq');
                    self.getCollection().load().done(function (response) {
                        if (response.items && response.items.length > 0) {
                            self.balance(parseFloat(response.items[0].point_balance));
                        }else{
                            self.balance(0);
                            self.remove();
                        }
                    });
                }else{
                    if(self.visible() == true && self.applied() && self.applied() == true){
                        self.balance(0);
                        self.remove();
                    }
                }
            },
            /**
             * Load point balance from local by customer id
             * @param customerId
             */
            loadStorageBalanceByCustomerId: function(customerId){
                var self = this;
                if(customerId){
                    self.getCollection().addFieldToFilter('customer_id', customerId, 'eq');
                    self.getCollection().load().done(function (response) {
                        if (response.items && response.items.length > 0) {
                            self.balance(parseFloat(response.items[0].point_balance));
                        }else{
                            self.balance(0);
                        }
                    });
                }else{
                    self.balance(0);
                }
            },
            /**
             * Save point balance to local
             * @param customerId
             * @param balance
             */
            saveBalance: function(customerId, balance){
                if(customerId) {
                    var self = this;
                    self.getCollection().addFieldToFilter('customer_id', customerId, 'eq');
                    self.getCollection().load().done(function (response) {
                        var data = {};
                        if (response.items && response.items.length > 0) {
                            data = response.items[0];
                            data.point_balance = balance;
                        }else{
                            data.customer_id = customerId;
                            data.point_balance = balance;
                        }
                        self.setData(data).save();
                    });
                }
            },
            /**
             * add point to balance on local
             * @param customerId
             * @param amount
             */
            addPoint: function(customerId, amount){
                if(customerId) {
                    var self = this;
                    self.getCollection().addFieldToFilter('customer_id', customerId, 'eq');
                    self.getCollection().load().done(function (response) {
                        var data = {};
                        if (response.items && response.items.length > 0) {
                            data = response.items[0];
                            data.point_balance += amount;
                            self.setData(data).save();
                        }
                    });
                }
            },
            /**
             * remove point from balance on local
             * @param customerId
             * @param amount
             */
            removePoint: function(customerId, amount){
                if(customerId) {
                    var self = this;
                    self.getCollection().addFieldToFilter('customer_id', customerId, 'eq');
                    self.getCollection().load().done(function (response) {
                        var data = {};
                        if (response.items && response.items.length > 0) {
                            data = response.items[0];
                            data.point_balance -= amount;
                            self.setData(data).save();
                        }
                    });
                }
            },
            /**
             * Reset discount per item
             */
            reset: function(){
                var self = this;
                ko.utils.arrayForEach(CartData.items(), function (item) {
                    item.item_rewards_point_discount(0);
                    item.item_rewards_base_point_discount(0);
                });
            },
            /**
             * Process discount per item
             * @param cartBaseTotalAmount
             */
            process: function(cartBaseTotalAmount){
                var self = this;
                if(cartBaseTotalAmount > 0){
                    var maxAmount = CartData.getMaxDiscountAmount();
                    var itemsAmountTotal = (cartBaseTotalAmount > maxAmount)?maxAmount:cartBaseTotalAmount;
                    var amountApplied = 0;
                    ko.utils.arrayForEach(CartData.items(), function (item, index) {
                        var maxAmountItem = CartData.getMaxItemDiscountAmount(item.item_id());
                        var discountPercent = maxAmountItem/maxAmount;
                        var item_base_amount = (index == CartData.items().length - 1)?(itemsAmountTotal - amountApplied):itemsAmountTotal*discountPercent;
                        amountApplied += item_base_amount;
                        var item_amount = WebposHelper.convertPrice(item_base_amount);
                        item.item_rewards_base_point_discount(item_base_amount);
                        item.item_rewards_base_point_discount(item_amount);
                        item.item_rewards_point_spent(self.convertMoneyToPoint(item_base_amount));
                        if(self.earningPoint() > 0){
                            var itemEarningPoint = parseFloat(item.row_total()) * parseFloat(self.earningRateValue());
                            item.item_rewards_point_earn(self.roundEarning(itemEarningPoint));
                        }
                    });
                }else{
                    self.reset();
                }
            },
            /**
             * Collect discount per item
             */
            collect: function(){
                var amount = (this.appliedAmount())?this.appliedAmount():0;
                this.currentAmount(amount);
                this.apply();
            },

            /**
             * Validate customer group allowed to use
             * @param rate
             * @param customerGroupId
             * @returns {boolean}
             */
            canApplyRate: function(rate, customerGroupId) {
                if(rate && rate.customer_group_ids){
                    var groups = rate.customer_group_ids;
                    groups = groups.split(',');
                    if(typeof customerGroupId == "undefined" || !customerGroupId) {
                        return false;
                    }
                    if(groups.indexOf(this.CUSTOMER_GROUP_ALL) > -1) {
                        return true;
                    }
                    if(groups.indexOf(String(customerGroupId)) > -1) {
                        return true;
                    }
                }
                return false;
            },
            /**
             * Round earning point
             * @param point
             * @returns {*}
             */
            roundEarning: function(point){
                var roundMethod = this.getConfig('rewardpoints/earning/rounding_method');
                switch(roundMethod){
                    case 'round':
                        point = Math.round(point);
                        break;
                    case 'ceil':
                        point = Math.ceil(point);
                        break;
                    case 'floor':
                        point = Math.floor(point);
                        break;
                }
                return point;
            },
            /**
             * Collect total can earn point
             * @param point
             * @returns {*}
             */
            collectTotalToEarn: function(){
                var earnByShipping = this.getConfig('rewards/general/is_earn_shipping');
                var earnByTax = this.getConfig('rewards/general/is_include_tax_earning');
                var earnByDiscount = this.getConfig('rewards/general/is_include_discount_earning');

                var earnInStatuses = this.getConfig('rewards/general/earn_in_statuses');
                var earnAfterInvoice = this.getConfig('rewards/general/is_earn_after_invoice');

                var cancelAfterRefund = this.getConfig('rewards/general/is_cancel_after_refund');

                var total = this.TotalsModel.getTotalValue('grand_total');

                if(earnByShipping == '0' && this.TotalsModel.shippingFee()){
                    total -= this.TotalsModel.shippingFee();
                }
                if(earnByTax == '0' && this.TotalsModel.tax()){
                    total -= this.TotalsModel.tax();
                }
                if(earnByDiscount == '0' && this.TotalsModel.getBaseTotalValue('discount')){
                    total -= this.TotalsModel.getBaseTotalValue('discount');
                }

                return total;
            },
            /**
             * Convert point to money
             * @param point
             * @returns {number}
             */
            convertPointToMoney: function(point){
                return parseFloat(point) * parseFloat(this.spendingRateValue())
            },
            /**
             * Convert money to point
             * @param discount
             * @returns {number}
             */
            convertMoneyToPoint: function(discount){

                return (this.spendingRateValue() > 0)?Math.ceil(parseFloat(discount) / parseFloat(this.spendingRateValue())):0;
            },
            /**
             * Function use to sort json array
             * @param prop
             * @returns {Function}
             */
            sortBy: function(prop){
                return function(a,b){
                    if( a[prop] > b[prop]){
                        return 1;
                    }else if( a[prop] < b[prop] ){
                        return -1;
                    }
                    return 0;
                }
            },
            /**
             * Spend reward points
             * @returns {*}
             */
            spendPointOnline: function(){
                var self = this;
                if(self.loading()){
                    return false;
                }
                self.loading(true);
                var deferred = $.Deferred();
                var initParams = CartModel.getQuoteInitParams();
                var params = {points_amount: self.currentAmount()};
                params.quote_id = initParams.quote_id;
                CheckoutModel.loading(true);
                onlineResource().setPush(true).setLog(false).spendPoint(params,deferred);
                deferred.done(function (response) {
                    var rewardsData = response.rewards;
                    if(rewardsData) {
                        self.earningPoint(parseInt(rewardsData.earned_point));
                        if(parseInt(rewardsData.used_point) > 0) {
                            self.applied(true);
                            self.appliedAmount(parseInt(rewardsData.used_point));
                            self.currentAmount(parseInt(rewardsData.used_point));
                            self.discountAmount(parseInt(rewardsData.discount_amount));
                        } else {
                            self.applied(0);
                            self.appliedAmount(0);
                            self.currentAmount(0);
                            self.discountAmount(0);
                        }
                    }
                }).always(function(){
                    CheckoutModel.loading(false);
                    self.loading(false);
                    self.applying(true);
                });
                return deferred;
            },
            /**
             * Process response data
             * @param responseData
             */
            checkoutCallApiAfter: function(responseData){
                var self = this;
                if(WebposHelper.isUseOnline('checkout') && responseData){
                    var data = responseData.data;
                    if(data && data.rewards){
                        if(typeof data.rewards.earned_point != 'undefined') {
                            self.earningPoint(parseFloat(data.rewards.earned_point));

                        }
                        if(typeof data.rewards.used_point != 'undefined' && data.rewards.used_point > 0) {
                            self.spendingPoint(parseFloat(data.rewards.used_point));
                            self.currentAmount(parseFloat(data.rewards.used_point));
                            self.appliedAmount(parseFloat(data.rewards.used_point));
                        }
                        if(typeof data.rewards.max_points != 'undefined') {
                            self.maxPoint(parseFloat(data.rewards.max_points));

                        }
                        if(typeof data.rewards.balance != 'undefined') {
                            self.balance(parseFloat(data.rewards.balance));

                        }
                        if(typeof data.rewards.discount_amount != 'undefined') {
                            self.discountAmount(parseFloat(data.rewards.discount_amount));
                        }
                    }
                }
            }
        });
    }
);