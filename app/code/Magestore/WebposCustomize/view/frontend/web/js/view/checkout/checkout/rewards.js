/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'jquery',
        'ko',
        'Magestore_WebposCustomize/js/view/checkout/checkout/abstract',
        // 'Magestore_Webpos/js/view/settings/general/rewardpoints/auto-sync-balance',
        'Magestore_Webpos/js/helper/general',
        'Magestore_WebposCustomize/js/helper/general',
        'Magestore_Webpos/js/model/checkout/cart',
        'Magestore_WebposCustomize/js/model/checkout/rewards',
    ],
    function ($,ko, Abstract,
              // AutoSyncBalance,
              WebposHelper,
              CustomizeHelper,
              CartModel, RewardPointFactory) {
        "use strict";
        return Abstract.extend({
            defaults: {
                template: 'Magestore_WebposCustomize/checkout/checkout/rewards'
            },
            initialize: function () {
                this._super();
                this.model = RewardPointFactory();
                if(!this.addedData){
                    this.initData();
                }
            },
            initData: function(){
                var self = this;
                self.addedData = true;
                self.balance = ko.pureComputed(function () {
                    return self.model.balanceAfterApply();
                });
                self.useMaxPoint = ko.observable(false);
                self.pointUnitName = self.model.pointUnitName;
                self.maxPoint = ko.pureComputed(function () {
                    return "Use maximum " + self.model.maxPoint() + " " + self.model.pointUnitName();
                });
                self.currentAmount = ko.observable(0);
                self.updatingBalance = self.model.updatingBalance;
                self.visible = self.model.visible;
                self.canApply = ko.pureComputed(function (){
                    return (self.model.balance() > 0)?true:false;
                });
                self.useMaxPoint.subscribe(function (value) {
                    if (value) {
                        self.model.useMaxPoint(true);
                        self.model.currentAmount(self.model.maxPoint());
                        self.currentAmount(self.model.maxPoint())
                    } else {
                        self.model.useMaxPoint(false);
                    }
                });
                self.observerEvent('go_to_checkout_page', $.proxy(function(){
                    if(CartModel.customerId() && CustomizeHelper.isMirasvitRewardsEnable()){
                        self.updateStorageBalance();
                    }
                }, self));
                WebposHelper.observerEvent('spent_point_apply', function (event, data) {
                    var pointData = data;
                    if(pointData && typeof pointData.spend_points != 'undefined') {
                        self.currentAmount(pointData.spend_points);
                        if (self.currentAmount() == self.model.maxPoint()) {
                            self.useMaxPoint(true);
                            self.model.useMaxPoint(true);
                        } else {
                            self.useMaxPoint(false);
                            self.model.useMaxPoint(false);
                        }
                    }
                });
                WebposHelper.observerEvent('go_to_checkout_page',function(event,data){
                    self.currentAmount(self.model.appliedAmount());
                });
            },
            pointUseChange: function(el, event){
                var self = this;
                var amount = this.getPriceHelper().toNumber(event.target.value);
                amount = (amount > 0)?amount:0;
                self.model.currentAmount(amount);
                if (self.model.currentAmount() >= self.model.maxPoint()) {
                    self.useMaxPoint(true);
                } else {
                    self.useMaxPoint(false);
                }
                self.currentAmount(self.model.currentAmount());
            },
            apply: function(){
                var self = this;
                if(WebposHelper.isUseOnline('checkout')){
                    if(self.model.canUseExtension()) {
                        self.model.spendPointOnline();
                    }
                }else{
                    self.model.apply();
                }
            },
            updateBalance: function(){
                if(this.updatingBalance() == false){
                    this.model.updateBalance();
                }
            },
            updateStorageBalance: function(){
                this.model.updateStorageBalance();
                // var autoSyncBalance = WebposHelper.getLocalConfig(AutoSyncBalance().configPath);
                // if(autoSyncBalance == true){
                //     this.model.updateBalance();
                // }
            }
        });
    }
);
