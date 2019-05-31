<?php

use InepZend\Util\Environment;

$arrMemcacheOption = array();
switch (Environment::getEnvironmentName()) {
    # Local
    case Environment::LOCAL:
        break;
    # Desenvolvimento
    case Environment::DESENVOLVIMENTO:
        break;
    # TQS
    case Environment::TQS:
        break;
    # Homologacao
    case Environment::HOMOLOGACAO:
        break;
    # Treinamento e Producao
    default:
//        $arrMemcacheOption['servers'] = array(
//            array('host' => 'localhost', 'port' => 11211),
//        );
        break;
}

return array(
    'cache' => array(
        'memcache' => array(
            'options' => $arrMemcacheOption,
        ),
    ),
);
