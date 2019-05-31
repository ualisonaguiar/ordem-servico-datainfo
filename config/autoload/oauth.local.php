<?php

use InepZend\Util\Environment;

$arrOAuth = array();
switch (Environment::getEnvironmentName()) {
    # Local
    case Environment::LOCAL:
        $arrOAuth['oauth1']['twitter'] = array(0, '', '', '');
        $arrOAuth['oauth2']['instagram'] = array(0, '', '', '');
        $arrOAuth['oauth2']['facebook'] = array(0, '', '', '');
        $arrOAuth['oauth2']['google'] = array(1, '965012260285-e2pcdu9bc4og9ku2qjn1elnjabi0ots4.apps.googleusercontent.com', '4u5ICwf3_JNOJjKTsBAae3hc', 'http://localhost/ordem-servico/branches/2.0/public/index.php/googlecallback');
        $arrOAuth['oauth1']['ssi'] = array(0, '', '', '');
        break;
    # Desenvolvimento
    case Environment::DESENVOLVIMENTO:
        $arrOAuth['oauth1']['twitter'] = array(0, '', '', '');
        $arrOAuth['oauth2']['instagram'] = array(0, '', '', '');
        $arrOAuth['oauth2']['facebook'] = array(0, '', '', '');
        $arrOAuth['oauth2']['google'] = array(0, '693429576553-a8rdout6mo4bbpdb23gi319jv02lorh8.apps.googleusercontent.com', 'vuMTeL33l9JmZdTfJ_L0nOXN', 'http://desenvphp2.inep.gov.br/ordemservico/googlecallback');
        $arrOAuth['oauth1']['ssi'] = array(1, '', '', 'http://desenvphp.inep.gov.br/inepsimpleskeleton/vendor/InepZend/php/ssicallback.php');
        break;
    # TQS
    case Environment::TQS:
        $arrOAuth['oauth1']['twitter'] = array(0, '', '', '');
        $arrOAuth['oauth2']['instagram'] = array(0, '', '', '');
        $arrOAuth['oauth2']['facebook'] = array(0, '', '', '');
        $arrOAuth['oauth2']['google'] = array(0, '', '', '');
        $arrOAuth['oauth1']['ssi'] = array(0, '', '', '');
        break;
    # Homologacao
    case Environment::HOMOLOGACAO:
        $arrOAuth['oauth1']['twitter'] = array(0, '', '', '');
        $arrOAuth['oauth2']['instagram'] = array(0, '', '', '');
        $arrOAuth['oauth2']['facebook'] = array(0, '', '', '');
        $arrOAuth['oauth2']['google'] = array(0, '', '', '');
        $arrOAuth['oauth1']['ssi'] = array(0, '', '', '');
        break;
    # Treinamento
    case Environment::TREINAMENTO:
        $arrOAuth['oauth1']['twitter'] = array(0, '', '', '');
        $arrOAuth['oauth2']['instagram'] = array(0, '', '', '');
        $arrOAuth['oauth2']['facebook'] = array(0, '', '', '');
        $arrOAuth['oauth2']['google'] = array(0, '', '', '');
        $arrOAuth['oauth1']['ssi'] = array(0, '', '', '');
        break;
    # Producao
    default:
        $arrOAuth['oauth1']['twitter'] = array(0, '', '', '');
        $arrOAuth['oauth2']['instagram'] = array(0, '', '', '');
        $arrOAuth['oauth2']['facebook'] = array(0, '', '', '');
        $arrOAuth['oauth2']['google'] = array(0, '', '', '');
        $arrOAuth['oauth1']['ssi'] = array(0, '', '', '');
        break;
}

if (!function_exists('constructConfigOAuth')) {

    function constructConfigOAuth($arrOAuth)
    {
        $arrResult = array();
        if (is_array($arrOAuth)) {
            $arrResult = $arrOAuth;
            $arrKey = array(
                0 => 'enable',
                1 => 'consumerKey',
                2 => 'consumerSecret',
                3 => 'callbackUrl',
                4 => 'proxyHost',
                5 => 'proxyPort',
            );
            foreach ($arrResult as $strOAuthVersion => $arrOAuthApi) {
                foreach ($arrOAuthApi as $strApi => $arrInfo) {
                    $arrInfoNew = array();
                    foreach ($arrInfo as $intKey => $mixValue)
                        $arrInfoNew[$arrKey[$intKey]] = $mixValue;
                    foreach ($arrKey as $intKey => $strKey) {
                        if (!array_key_exists($strKey, $arrInfoNew))
                            $arrInfoNew[$strKey] = null;
                    }
                    $arrResult[$strOAuthVersion][$strApi] = $arrInfoNew;
                }
            }
        }
        return array('oAuth' => $arrResult);
    }

}

return constructConfigOAuth($arrOAuth);
