<?php

/**
 * Product:       Xtento_XtCore (2.0.9)
 * ID:            F0RIhapXqgQvfHUiSDvtff3tZxXjZ8OzKkh6+M6Rq88=
 * Packaged:      2017-08-19T02:11:09+00:00
 * Last Modified: 2017-07-20T19:47:23+00:00
 * File:          app/code/Xtento/XtCore/Setup/InstallData.php
 * Copyright:     Copyright (c) 2017 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

namespace Xtento\XtCore\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * Config Value Factory
     *
     * @var \Magento\Framework\App\Config\ValueFactory
     */
    private $configValueFactory;

    /**
     * Init
     *
     * @param \Magento\Framework\App\Config\ValueFactory $configValueFactory
     */
    public function __construct(\Magento\Framework\App\Config\ValueFactory $configValueFactory)
    {
        $this->configValueFactory = $configValueFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var $configValue \Magento\Framework\App\Config\ValueInterface */
        $configValue = $this->configValueFactory->create();
        $configValue->load('xtcore/adminnotification/installation_date', 'path');
        $configValue->setValue(time())->setPath('xtcore/adminnotification/installation_date')->save();
    }
}
