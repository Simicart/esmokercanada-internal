define([
    'Magestore_Webpos/js/view/sales/order/list',
    'Magestore_Webpos/js/model/sales/order-factory',
    'Magestore_Webpos/js/helper/staff',
    'Magestore_Webpos/js/helper/general',
    'jquery'
], function (OrderList, OrderFactory, staffHelper, Helper, $) {
    "use strict";

    return OrderList.extend({
        _prepareItems: function () {
                var self = this;
                this.startLoading();
                if(self.isSearching()){
                    return false;
                }
                self.isSearching(true);
                this.groupDays = [];
                var mode = (Helper.isUseOnline('orders'))?'online':'offline';
                this.collection = OrderFactory.get().setMode(mode).getCollection().reset();
                if (this.viewPermission.length == 0) {
                    this.setItems([]);
                    self.isSearching(false);
                    return;
                }
                if (this.searchKey)
                    this.collection.addFieldToFilter(
                        [
                            ['increment_id', '%'+this.searchKey.toLowerCase()+'%', 'like'],
                            ['customer_email', '%'+this.searchKey.toLowerCase()+'%', 'like'],
                            ['customer_firstname', '%'+this.searchKey.toLowerCase()+'%', 'like'],
                            ['customer_lastname', '%'+this.searchKey.toLowerCase()+'%', 'like'],
                            ['customer_fullname', '%'+this.searchKey.toLowerCase()+'%', 'like']
                        ]
                    );
                if (this.statusArray.length > 0)
                    this.collection.addFieldToFilter('status', this.statusArray, 'in');
                else
                    this.collection.addFieldToFilter('status', this.statusArrayDefault, 'in');
                if (this.viewPermission.indexOf('manage_all_order') >= 0) {
                } else {
                    if(this.viewPermission.indexOf('manage_order_me') >= 0 && this.viewPermission.indexOf('manage_order_location') >= 0)
                        this.collection.addFieldToFilter(
                            [
                                ['webpos_staff_id', staffHelper.getStaffId(), 'eq'],
                                ['location_id', window.webposConfig.locationId, 'eq'],
                            ] 
                        );
                    else if (this.viewPermission.indexOf('manage_order_me') >= 0)
                        this.collection.addFieldToFilter('webpos_staff_id', staffHelper.getStaffId(), 'eq');
                    else if (this.viewPermission.indexOf('manage_order_location') >= 0)
                        this.collection.addFieldToFilter('location_id', window.webposConfig.locationId, 'eq');
                }

                this.collection.setOrder('created_at', 'DESC');
                this.collection.setPageSize(this.pageSize).setCurPage(this.curPage);
                var deferred = $.Deferred();
                this.collection.load(deferred);
                deferred.done(function (response) {
                    self.isOnline = true;
                    var items = self._processResponse(response);
                    self.items(items);
                    self.finishLoading();
                    self.isSearching(false);
                });
            },
    });
});