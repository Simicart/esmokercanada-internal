<?php

/**
 * Product:       Xtento_XtCore (2.0.9)
 * ID:            F0RIhapXqgQvfHUiSDvtff3tZxXjZ8OzKkh6+M6Rq88=
 * Packaged:      2017-08-19T02:11:09+00:00
 * Last Modified: 2017-07-20T19:42:38+00:00
 * File:          app/code/Xtento/XtCore/Model/System/Config/Backend/License.php
 * Copyright:     Copyright (c) 2017 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

namespace Xtento\XtCore\Model\System\Config\Backend;

class License extends \Magento\Framework\App\Config\Value
{
    public function beforeSave()
    {
        $this->_registry->register('xtento_configuration_license_key', $this->getValue(), true);
    }
}
