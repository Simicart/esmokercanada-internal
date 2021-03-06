/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

/*global define*/
define(
    [
        'jquery',
        'ko',
        'mage/translate',
        'Magestore_Webpos/js/model/sales/order/payment',
        'Magestore_Webpos/js/model/event-manager',
        'Magestore_Webpos/js/helper/alert',
        'Magestore_Webpos/js/helper/price',
        'Magestore_Webpos/js/action/notification/add-notification'
    ],
    function($, ko, $t, Payment, eventmanager, alertHelper, PriceHelper, notification) {
        'use strict';
        return {
            isValid: false,
            orderData: {},
            submitData: {
                "payment":{
                    "method_data":[]
                }
            },

            execute: function(datas, orderData, deferred, parent){
                var self = this;
                this.orderData = orderData;
                this.isValid = false;
                if(datas.length>0)
                    this.isValid = true;
                if(!this.isValid){
                    alertHelper({title:'Error', content: $t('Please select a payment method!')});
                    return;
                }
                var paymentsData = [];
                $.each(datas,function(){
                    var data = {};
                    data.code = this.code;
                    data.title = this.title;
                    data.base_amount = PriceHelper.correctPrice(this.base_cart_total);
                    data.amount = this.cart_total;
                    if(orderData.base_grand_total > this.base_paid_amount) {
                        data.base_real_amount = PriceHelper.correctPrice(this.base_paid_amount);
                        data.real_amount = this.paid_amount;
                    }else{
                        data.real_amount = orderData.grand_total;
                        data.base_real_amount = orderData.base_grand_total;
                    }
                    data.reference_number = this.reference_number;
                    data.is_pay_later = this.is_pay_later;
                    data.shift_id = window.webposConfig.shiftId?window.webposConfig.shiftId:'';
                    paymentsData.push(data);
                });
                this.submitData = {
                    "payment":{
                        "method_data": paymentsData
                    },
                    "order_increment_id": orderData.increment_id
                };
                if(this.submitData.payment.method_data.length>0){
                    parent.display(false);
                    notification($t('Create payment successfully!'), true, 'success', $t('Success'));
                    this.saveOrderOffline(this.submitData);
                    Payment().setData(this.orderData).setPostData(this.submitData).setMode('online').save();
                }                
            },

            saveOrderOffline: function(submitData){
                var self = this;
                if(this.submitData.payment.method_data.length>0){
                    if(!this.orderData.webpos_order_payments)
                        this.orderData.webpos_order_payments = [];
                    $.each(this.submitData.payment.method_data, function(index, value){
                        self.orderData.webpos_order_payments.push({
                            base_payment_amount: value.base_amount,
                            method: value.code,
                            method_title: value.title,
                            payment_amount: value.amount,
                            base_display_amount: value.base_real_amount,
                            display_amount: value.real_amount,
                        });
                        self.orderData.base_total_paid+=value.base_amount;
                        var amount = PriceHelper.currencyConvert(
                            value.base_amount,
                            self.orderData.base_currency_code,
                            self.orderData.order_currency_code
                        );
                        self.orderData.total_paid+=amount;
                        
                        self.orderData.base_total_due-=value.base_amount;
                        self.orderData.total_due-=amount;
                    });
                    if(self.orderData.base_total_paid-self.orderData.base_grand_total>0.01){
                        self.orderData.webpos_base_change=self.orderData.base_total_paid-self.orderData.base_grand_total;
                        self.orderData.webpos_change=self.orderData.total_paid-self.orderData.grand_total;
                    }
                }
                eventmanager.dispatch('sales_order_take_payment_beforeSave', {'response': this.submitData});
                eventmanager.dispatch('sales_order_afterSave', {'response': this.orderData});
            },
        }
    }
);
