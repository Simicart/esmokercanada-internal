/*
 * Magestore
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magestore.com license that is
 * available through the world-wide-web at this URL:
 * http://www.magestore.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Magestore
 * @package     Magestore_Webpos
 * @copyright   Copyright (c) 2016 Magestore (http://www.magestore.com/)
 * @license     http://www.magestore.com/license-agreement.html
 */

/*global define*/
define(
    [
        'jquery',
        'mage/translate',
        'Magestore_Webpos/js/action/hardware/connect',
        'Magestore_Webpos/js/helper/alert'
    ],
    function ($, $t, connect, Alert) {
        'use strict';
        return function (html) {
            var deferred = connect('printer', html);
            deferred.done(function (response) {
                Alert({
                    priority: 'success',
                    title: $t('Success'),
                    message: $t('Send to POSHub successfully!')
                });

            });
            deferred.always(function () {
                $('.action-button .print').prop('disabled', false);
            });
        }
    }
);
