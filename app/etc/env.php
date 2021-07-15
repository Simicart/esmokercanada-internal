<?php
return [
    'backend' => [
        'frontName' => 'admin'
    ],
    'crypt' => [
        'key' => '1687c3cc8d725f070bc04c299c84c508'
    ],
    'session' => [
        'save' => 'files'
    ],
    'db' => [
        'table_prefix' => '',
        'connection' => [
            'default' => [
                'host' => 'localhost',
                'dbname' => 'esmoke',
                'username' => 'root',
                'password' => 'magestore123@#*',
                'model' => 'mysql4',
                'engine' => 'innodb',
                'initStatements' => 'SET NAMES utf8;',
                'active' => '1'
            ]
        ]
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'developer',
    'cache_types' => [
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'full_page' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'translate' => 1,
        'config_webservice' => 1,
        'compiled_config' => 1,
        'vertex' => 1
    ],
    'install' => [
        'date' => 'Fri, 21 Jul 2017 10:39:56 +0000'
    ],
    'downloadable_domains' => [
        '127.0.0.1',
        'www.cloud9distributions.com'
    ],
    'directories' => [
        'document_root_is_pub' => true
    ]
];
