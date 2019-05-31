<?php

return array(
    'cache' => array(
        'memcache' => array(
            'options' => array(
                'servers' => array(
                    array('host' => 'localhost', 'port' => 11211),
//                    array('host' => '172.29.9.215', 'port' => 11211),
//                    array('host' => '10.0.0.20', 'port' => 11211, 'status' => true, 'weight' => 3, 'persistent' => false, 'timeout' => 2, 'retry_interval' => 20),
                ),
                'auto_compress_threshold' => 100,
                'auto_compress_min_savings' => 0.2,
                'server_defaults' => array(
                    'persistent' => true,
                    'weight' => 1,
                    'timeout' => 10,
                    'retry_interval' => 15,
                ),
                'compression' => false,
                'ttl' => (8 * 60 * 60),
                'readable' => true,
                'writable' => true,
            ),
        ),
    ),
);
