<?php

return array(
    'logEvent' => array(
        'reservedVariables' => array(
//            'GLOBALS',
//            'HTTP_RAW_POST_DATA',
//            '_COOKIE',
//            '_ENV',
//            '_FILES',
            '_GET',
            '_POST',
//            '_REQUEST',
//            '_SERVER',
            '_SERVER["REQUEST_URI"]',
//            '_SESSION',
//            'argc',
//            'argv',
//            'http_response_header',
//            'php_errormsg',
        ),
        'options' => array(
            'trace' => true,
            'persistence' => true,
            'show' => false,
            'errorHandler' => true,
        ),
        'namespaces' => array(
            'Controller' => array(
//                'InepZend\Module\Application',
//                'Publicacao',
            ),
            'Service' => array(
//                'InepZend\Module\Application',
//                'Publicacao',
            ),
            'Repository' => array(
//                'InepZend\Module\Application',
//                'Publicacao',
            ),
        ),
        'usersSystem' => array(
//            19231702,
        ),
        'cpfs' => array(
//            '09723347776',
        ),
    ),
);
