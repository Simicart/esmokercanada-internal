/*
 *  Copyright © 2016 Magestore. All rights reserved.
 *  See COPYING.txt for license details.
 *
 */

define(
    [
        'jquery',
        'Magestore_Webpos/js/model/resource-model/online-abstract',
        'Magestore_Webpos/js/model/log/action-log',
        'Magestore_Webpos/js/model/url-builder',
        'mage/storage',
        'Magestore_Webpos/js/lib/cookie',
        'Magestore_Webpos/js/model/event-manager',
        'Magestore_Webpos/js/helper/general'
    ],
    function ($, onlineAbstract, actionLog, urlBuilder, storage, Cookies, eventManager, Helper) {
        "use strict";

        return onlineAbstract.extend({
            data: [],
            /* Declare key path*/
            keyPath: '',
            requireActionIdPath: '',
            /* interface name of param in API */
            interfaceName:'',
            type:'',
            /* interface name of param in massUpdate, pushData */
            interfaceNames:'',
            /* Declare delete api url*/
            deleteApiUrl: '',
            /* Declare create api url*/
            createApiUrl: '',
            /* Declare update api url*/
            updateApiUrl: '',
            /* Declare load api url*/
            loadApiUrl: '',
            /* Declare search api url*/
            searchApiUrl: '',
            actionId: '',
            requireActionId: '',
            log: true,
            push: false,
            setType: function (type) {
                this.type = type;
                return this;
            },
            setPush: function (mode) {
                this.push = mode;
                return this;
            },
            setLog: function (mode) {
                this.log = mode;
                return this;
            },
            setActionId: function (actionId) {
                this.actionId = actionId;
                return this;
            },
            setRequireActionId: function (requireActionId) {
                this.requireActionId = requireActionId;
                return this;
            },
            /* Get Data*/
            getData: function () {
                return this.data;
            },
            /* Set Data*/
            setData: function (data) {
                this.data = data;
                return this;
            },
            /* Set Delete Api Url*/
            setDeleteApiUrl: function (deleteApiUrl) {
                this.deleteApiUrl = deleteApiUrl;
            },
            /* Set Create Api Url*/
            setCreateApiUrl: function (createApiUrl) {
                this.createApiUrl = createApiUrl;
            },
            /* Set Update Api Url*/
            setUpdateApiUrl: function (updateApiUrl) {
                this.updateApiUrl = updateApiUrl;
            },
            /* Set Load Api Url*/
            setLoadApi: function (loadApiUrl) {
                this.loadApiUrl = loadApiUrl;
            },
            /* Set Search Api Url*/
            setSearchApiUrl: function (searchApiUrl) {
                this.searchApiUrl = searchApiUrl;
            },
            /* Set Mass Update Api Url*/
            setMassUpdateApiUrl: function (massUpdateApiUrl) {
                this.massUpdateApiUrl = massUpdateApiUrl;
            },
            /* Set Mass Update Api Url*/
            setPushDataApiUrl: function (pushDataApiUrl) {
                this.pushDataApiUrl = pushDataApiUrl;
            },
            /* load by id*/
            load: function (id, deferred) {
                if (!deferred) {
                    deferred = $.Deferred();
                }
                this.callRestApi(
                    this.loadApiUrl + id,
                    'get',
                    {},
                    {},
                    deferred
                );
                return deferred;
            },
            update: function (model, deferred) {
                return this.save(model, deferred);
            },
            /* save*/
            save: function (model, deferred) {
                var self = this;
                if (!deferred) {
                    deferred = $.Deferred();
                }
                var postData = {};
                if (this.interfaceName) {
                    postData[this.interfaceName] = this.prepareSaveData(model.getData());
                }
                else {
                    postData = this.prepareSaveData(model.getData());
                }
                if (model.getData()[this.keyPath] == '' || typeof model.getData()[this.keyPath] == 'undefined') {
                    this.callRestApi(
                        this.createApiUrl,
                        'post',
                        {},
                        postData,
                        deferred,
                        this.interfaceName + '_afterSave'
                    );
                } else {
                    this.callRestApi(
                        this.updateApiUrl + model.getData()[this.keyPath],
                        'put',
                        {},
                        postData,
                        deferred,
                        this.interfaceName + '_afterSave'
                    );
                }
                return deferred;
            },
            /**
             * Mass Update items
             *
             * @param object items
             * @param object deferred
             */
            massUpdate: function (data, deferred) {
                if (!deferred) {
                    deferred = $.Deferred();
                }
                var items = [];
                for (var i in data.items) {
                    items.push(this.prepareSaveData(data.items[i]));
                }
                if (this.massUpdateApiUrl) {
                    var postData = {}
                    if (this.interfaceNames) {
                        postData[this.interfaceNames] = items;
                    } else {
                        postData = items;
                    }
                    this.callRestApi(
                        this.massUpdateApiUrl,
                        'put',
                        {},
                        postData,
                        deferred,
                        this.interfaceName + '_afterMassUpdate'
                    );
                }
                return deferred;
            },
            /* Delete by id*/
            delete: function (id, deferred) {
                var self = this;
                if (!deferred) {
                    deferred = $.Deferred();
                }
                this.callRestApi(
                    this.deleteApiUrl + id,
                    'delete',
                    {},
                    {},
                    deferred,
                    this.interfaceName + '_afterDelete'
                );
                return deferred;
            },
            /* Query to search collection*/
            queryCollectionData: function (collection, deferred) {
                if (!deferred) {
                    deferred = $.Deferred();
                }
                var queryParams = collection.queryParams;
                var filterParams = queryParams.filterParams;
                var paramOrFilter = queryParams.paramOrFilter;
                var orderParams = queryParams.orderParams;
                var pageSize = queryParams.pageSize;
                var currentPage = queryParams.currentPage;
                var paramToFilter = queryParams.paramToFilter;
                var querySearchString = '';
                var querySearchStringArray = [];
                var numerGroup = 0;
                $.each(filterParams, function (index, value) {
                    querySearchStringArray.push('searchCriteria[filter_groups][' + index + '][filters][' + index + '][field]=' + value.field);
                    querySearchStringArray.push('searchCriteria[filter_groups][' + index + '][filters][' + index + '][value]=' + value.value);
                    querySearchStringArray.push('searchCriteria[filter_groups][' + index + '][filters][' + index + '][condition_type]=' + value.condition);
                    numerGroup++;
                });
                $.each(paramOrFilter, function (index, orValue) {
                    $.each(orValue, function (index, value) {
                        querySearchStringArray.push('searchCriteria[filter_groups][' + numerGroup + '][filters][' + index + '][field]=' + value.field);
                        querySearchStringArray.push('searchCriteria[filter_groups][' + numerGroup + '][filters][' + index + '][value]=' + value.value);
                        querySearchStringArray.push('searchCriteria[filter_groups][' + numerGroup + '][filters][' + index + '][condition_type]=' + value.condition);
                    });
                    numerGroup++;
                });

                $.each(orderParams, function (index, value) {
                    querySearchStringArray.push('searchCriteria[sortOrders][' + index + '][field]=' + value.field);
                    querySearchStringArray.push('searchCriteria[sortOrders][' + index + '][direction]=' + value.direction);
                });

                $.each(paramToFilter, function (index, value) {
                    querySearchStringArray.push(value.field + '=' + value.value);
                });

                if (pageSize) {
                    querySearchStringArray.push('searchCriteria[pageSize]=' + pageSize);
                }

                if (currentPage) {
                    querySearchStringArray.push('searchCriteria[currentPage]=' + currentPage);
                }

                querySearchString = querySearchString + querySearchStringArray.join('&');

                if (querySearchString == '') {
                    querySearchString = 'searchCriteria';
                }

                var url = '';
                if(this.searchApiUrl.indexOf('?') >= 0){
                    url = this.searchApiUrl+ '&' + encodeURI(querySearchString);
                }else{
                    url = this.searchApiUrl + '?' + encodeURI(querySearchString);
                }
                this.callRestApi(
                    url,
                    'get',
                    {},
                    {},
                    deferred
                );
                return deferred.promise();
            },
            pushData: function (items, deferred) {
                if (!deferred) {
                    deferred = $.Deferred();
                }
                if (this.pushDataApiUrl) {
                    var postData = {};
                    if (this.interfaceNames) {
                        postData[this.interfaceNames] = items;
                    } else {
                        postData = items;
                    }
                    this.callRestApi(
                        this.pushDataApiUrl,
                        'post',
                        {},
                        postData,
                        deferred,
                        this.interfaceName + '_afterPush'
                    );
                }
                return deferred;
            },

            /* Call Magento Rest Api*/
            callRestApi: function (apiUrl, method, params, payload, deferred, callBack) {
                var self = this;
                var serviceUrl = urlBuilder.createUrl(apiUrl, params);
                if (apiUrl != '/webpos/staff/login' && apiUrl.indexOf('/webpos/staff/logout') == -1) {
                    var sessionId = Cookies.get('WEBPOSSESSION');
                    serviceUrl = self.addParamsToUrl(serviceUrl, {'session':sessionId});
                }

                switch (method) {
                    case 'post':
                        if (self.push) {
                            storage.post(
                                serviceUrl, JSON.stringify(payload)
                            ).done(
                                function (response) {

                                    deferred.resolve(response);
                                    if(callBack) {
                                        eventManager.dispatch(callBack, {'response': response});
                                    }


                                }
                            ).fail(
                                function (response) {
                                    if (self.log) {
                                        var defer = self.saveLog(apiUrl, method, params, payload, callBack, self.interfaceName);
                                        defer.done(function () {
                                            //log save
                                        });
                                    }
                                    if (response.status == 401) {
                                        window.location.reload();
                                    } else {
                                        deferred.reject(response);
                                    }
                                }
                            ).always(
                                function (response) {
                                    if (apiUrl != '/webpos/staff/login' &&  apiUrl != '/webpos/staff/logout') {
                                        Cookies.set('WEBPOSSESSION', sessionId, {expires: parseInt(window.webposConfig.timeoutSession)});
                                    }
                                    var checkNetWork = !(response.statusText == 'error' && response.status == 0);
                                }
                            );
                        } else {
                            var defer = self.saveLog(apiUrl, method, params, payload, callBack, self.interfaceName);
                            defer.done(function () {
                                //log save
                            });
                        }
                        break;
                    case 'get':

                        storage.get(
                            serviceUrl, JSON.stringify(payload)
                        ).done(
                            function (response) {
                                deferred.resolve(response);
                            }
                        ).fail(
                            function (response) {
                                if (response.status == 401) {
                                    window.location.reload();
                                } else {
                                    deferred.reject(response);
                                    //var defer = self.saveLog(apiUrl, method, params, payload);
                                    //defer.done(function () {
                                    //    //log save
                                    //});
                                }
                            }
                        ).always(
                            function (response) {
                                Cookies.set('WEBPOSSESSION', sessionId, {expires: 1});
                                var checkNetWork = !(response.statusText == 'error' && response.status == 0);
                            }
                        );

                        /*.error(
                         function (response) {
                         var error = JSON.parse(response.responseText);
                         error.status = response.status;
                         deferred.reject(error);
                         }

                         )*/

                        break;
                    case 'put':

                        if (self.push) {
                            storage.put(
                                serviceUrl, JSON.stringify(payload)
                            ).done(
                                function (response) {
                                    deferred.resolve(response);
                                    if (callBack) {
                                        eventManager.dispatch(callBack, {'response': response});
                                    }
                                }
                            ).fail(
                                function (response) {
                                    if (self.log) {
                                        var defer = self.saveLog(apiUrl, method, params, payload, callBack, self.interfaceName);
                                        defer.done(function () {
                                            //log save
                                        });
                                    }
                                    if (response.status == 401) {
                                        window.location.reload();
                                    } else {
                                        deferred.reject(response);
                                    }
                                }
                            ).always(
                                function (response) {
                                    Cookies.set('WEBPOSSESSION', sessionId, {expires: 1});
                                    var checkNetWork = !(response.statusText == 'error' && response.status == 0);
                                }
                            );
                        } else {
                            var defer = self.saveLog(apiUrl, method, params, payload, callBack, self.interfaceName);
                            defer.done(function () {
                                //log save
                            });
                        }
                        break;
                    case 'delete':
                        serviceUrl = self.addParamsToUrl(serviceUrl, payload);
                        if (self.push) {
                            storage.delete(
                                serviceUrl, JSON.stringify(payload)
                            ).done(
                                function (response) {
                                    deferred.resolve(response);
                                    if (callBack) {
                                        eventManager.dispatch(callBack, {'response': response});
                                    }
                                }
                            ).fail(
                                function (response) {
                                    if (self.log) {
                                        var defer = self.saveLog(apiUrl, method, params, payload, callBack, self.interfaceName);
                                        defer.done(function () {
                                            //log save done
                                        });
                                    }
                                    if (response.status == 401) {
                                        window.location.reload();
                                    } else {
                                        deferred.reject(response);
                                    }
                                }
                            ).always(
                                function (response) {
                                    Cookies.set('WEBPOSSESSION', sessionId, {expires: 1});
                                    var checkNetWork = !(response.statusText == 'error' && response.status == 0);
                                }
                            );
                        } else {
                            var defer = self.saveLog(apiUrl, method, params, payload, callBack, self.interfaceName);
                            defer.done(function () {
                                //log save
                            });
                        }
                        break;
                    default:
                        break;
                }
            },

            saveLog: function (apiUrl, method, params, payload, callBack, interfaceName) {
                var self = this;
                if (!self.actionId && self.keyPath && payload[self.keyPath]) {
                    self.setActionId(payload[self.keyPath]);
                }
                if (!self.actionId && self.interfaceName && self.keyPath && payload[interfaceName][self.keyPath]) {
                    self.setActionId(payload[interfaceName][self.keyPath]);
                }
                if (!self.requireActionId && self.requireActionIdPath && payload[self.requireActionIdPath]) {
                    self.setRequireActionId(payload[self.requireActionIdPath]);
                }
                if (!self.requireActionId && self.interfaceName && self.requireActionIdPath && payload[interfaceName][self.requireActionIdPath]) {
                    self.setRequireActionId(payload[interfaceName][self.requireActionIdPath]);
                }
                if(!self.type){
                    self.type = self.interfaceName;
                }
                var log = actionLog().setData({
                    'api_url': apiUrl,
                    'method': method,
                    'params': params,
                    'payload': payload,
                    'callBack' : callBack,
                    'key_path' : self.keyPath,
                    'action_id' : self.actionId,
                    'requireActionIdPath' : self.requireActionIdPath,
                    'require_action_id' : self.requireActionId,
                    'order' : new Date().getTime(),
                    'interfaceName': interfaceName,
                    'type': self.type,
                    'number': 0
                });

                return (apiUrl)?log.save():$.Deferred();
            },

            addParamsToUrl: function(url, params){
                $.each(params, function(key, value){
                    if(key){
                        if (url.indexOf("?") != -1) {
                            url = url + '&'+key+'=' + value;
                        }
                        else {
                            url = url + '?'+key+'=' + value;
                        }
                    }
                });
                return url;
            },

            /**
             * Function to send API request and control respose
             * @param apiUrl
             * @param params
             * @param deferred
             * @param callBackEvent
             * @param method
             */
            callApi: function(apiUrl, params, deferred, callBackEvent, method){
                var self = this;
                method = (method)?method:'post';
                self.callRestApi(apiUrl, method, {}, params, deferred, callBackEvent);
                deferred.done(function (response) {
                    if(typeof response == 'string'){
                        response = JSON.parse(response);
                    }
                    self.processResponseData(response);
                }).fail(function (response) {
                    if(typeof response == 'string'){
                        response = JSON.parse(response);
                    }
                    if(response.responseText){
                        var error = JSON.parse(response.responseText);
                        if(error.message != undefined){
                            Helper.alert({priority:"danger",title: Helper.__("Error"),message: error.message});
                        }
                    }else{
                        Helper.alert({priority:"danger",title: Helper.__("Error"),message: Helper.__('Please check your network connection. Or disable checkout online to continue.')});
                    }
                }).always(function(response){
                    if(typeof response == 'string'){
                        response = JSON.parse(response);
                    }
                    response = (response.responseText)?JSON.parse(response.responseText):response;
                    if(response.messages){
                        self.processResponseMessages(response.messages, response.status);
                    }
                });
            },
            /**
             * Function to process response data
             * @param data
             */
            processResponseData: function(data){

            },
            /**
             * Function to process API response messages
             * @param messages
             */
            processResponseMessages: function(messages, status){
                if(messages && messages.error){
                    $.each(messages.error, function(index, message){
                        if(message.message){
                            Helper.alert({
                                priority: 'danger',
                                title: Helper.__('Error'),
                                message: message.message
                            });
                        }
                    });
                }
                if(messages && messages.success){
                    $.each(messages.success, function(index, message){
                        if(message.message){
                            Helper.alert({
                                priority: 'success',
                                title: Helper.__('Message'),
                                message: message.message
                            });
                        }
                    });
                }
                if($.isArray(messages)){
                    var priority = (status == '1')?'success':'danger';
                    var title = (status == '1')?'Message':'Error';
                    $.each(messages, function(index, message){
                        Helper.alert({
                            priority: priority,
                            title: Helper.__(title),
                            message: message
                        });
                    });
                }
            }
        });
    }
);