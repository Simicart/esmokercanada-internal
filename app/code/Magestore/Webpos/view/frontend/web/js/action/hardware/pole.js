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
        'Magestore_Webpos/js/model/config/local-config'
    ],
    function ($, localConfig) {
        'use strict';
        return function (line1, line2) {
            var ajaxUrl;
            if (localConfig.get('hardware/pole') === '1') {
                if (window.location.protocol !== 'https:') {
                    ajaxUrl = 'http://' + localConfig.get('hardware/configuration') + ':60000';
                } else {
                    ajaxUrl = 'https://' + localConfig.get('hardware/configuration') + ':60001';
                }
                $.ajax({
                    url: ajaxUrl,
                    method: 'POST',
                    data: {
                        "device": 'poledisplay',
                        "line1": line1,
                        "line2": line2
                    }
                });
            }
        }
    }
);
