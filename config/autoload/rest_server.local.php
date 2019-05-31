<?php

use InepZend\Util\Environment;

return array(
    'restServer' => array(
        'security' => array(
            'authorization' => array(
                # Usuarios/Senhas liberados para acesso
                array('InepAuthUser', 'InepAuthPass'),
            ),
            'ip' => array(
                # IPs liberados para acesso
//                Environment::IP_LOCALHOST,
//                Environment::IP_DESENVOLVIMENTO,
//                Environment::IP_DESENVOLVIMENTO2,
//                Environment::IP_TQS,
//                Environment::IP_HOMOLOGACAO,
//                '172.?.?.?', //PRODUCAO
            ),
        ),
    ),
);
