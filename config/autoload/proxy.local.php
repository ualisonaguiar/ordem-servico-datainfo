<?php

use InepZend\Util\Environment;

$arrProxyConfig = array(
    'proxyHost' => null,
    'proxyPort' => null,
    'proxyUser' => null,
    'proxyPass' => null,
    'proxyAuth' => null,
);
switch (Environment::getEnvironmentName()) {
    # Local
    case Environment::LOCAL:
        $arrProxyConfig['proxyHost'] = 'proxy.inep.gov.br';
        $arrProxyConfig['proxyPort'] = 8080;
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
    # Treinamento, Clone e Producao
    default:
        $arrProxyConfig['proxyHost'] = 'proxy.inep.gov.br';
        $arrProxyConfig['proxyPort'] = 8080;
        break;
}

return array(
    'proxy' => array(
        'params' => $arrProxyConfig,
    ),
);
