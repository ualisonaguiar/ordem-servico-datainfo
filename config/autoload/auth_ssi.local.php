<?php

use InepZend\Util\Environment;
use OrdemServico\Service\UsuarioFile;
use InepZend\Util\ApplicationProperties;

$strSecretId = null;
$strClientId = null;
switch (Environment::getEnvironmentName()) {
    # Local e Desenvolvimento
    case Environment::LOCAL:
    case Environment::DESENVOLVIMENTO:
        $strSecretId = '';
        $strClientId = '';
        break;
    # TQS
    case Environment::TQS:
        $strSecretId = '';
        $strClientId = '';
        break;
    # Homologacao
    case Environment::HOMOLOGACAO:
        $strSecretId = '';
        $strClientId = '';
        break;
    # Treinamento e Producao
    default:
        $strSecretId = '';
        $strClientId = '';
        break;
}

return array(
    'authServiceAdapter' => array(
        'adapter' => ApplicationProperties::get('auth.type'),
        'paramHeaderRequest' => array(
            'service' => UsuarioFile::class,
            'user' => 'ds_login',
            'password' => 'ds_senha',
        ),
        'callback' => array(
            'route' => ApplicationProperties::get('auth.url.callback'),
        ),
    ),
);
