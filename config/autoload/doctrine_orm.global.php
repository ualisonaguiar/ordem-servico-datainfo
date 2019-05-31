<?php

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\OCI8\Driver',
                'params' => array(
                    'driverOptions' => array(
                        1002 => "SET NAMES 'UTF-8'",
                    ),
                ),
            ),
        ),
        'configuration' => array(
            'orm_default' => array(
                'proxy_dir' => __DIR__ . '/../../data/DoctrineORMModule/Proxy',
            ),
        ),
    ),
);
