<?php

/**
 * Product:       Xtento_XtCore (2.0.9)
 * ID:            F0RIhapXqgQvfHUiSDvtff3tZxXjZ8OzKkh6+M6Rq88=
 * Packaged:      2017-08-19T02:11:09+00:00
 * Last Modified: 2017-07-20T19:40:48+00:00
 * File:          app/code/Xtento/XtCore/Cron/RegisterCronExecution.php
 * Copyright:     Copyright (c) 2017 XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

namespace Xtento\XtCore\Cron;

class RegisterCronExecution
{
    /**
     * @var \Xtento\XtCore\Model\ResourceModel\Config
     */
    protected $xtCoreConfig;

    /**
     * RegisterCronExecution constructor.
     * @param \Xtento\XtCore\Model\ResourceModel\Config $xtCoreConfig
     */
    public function __construct(
        \Xtento\XtCore\Model\ResourceModel\Config $xtCoreConfig
    ) {
        $this->xtCoreConfig = $xtCoreConfig;
    }

    /**
     * Register last cronjob execution
     *
     * @return void
     */
    public function execute()
    {
        $this->xtCoreConfig->saveConfig('xtcore/crontest/last_execution', time());
    }
}
