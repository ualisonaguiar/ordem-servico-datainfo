<?php

namespace InepZend\WebService\Client\Corporative\Mec\Sae;

use InepZend\WebService\Client\Rest;

class Sae extends Rest
{

    const URL_DESENV = 'https://10.1.3.231:443/service/integracao/server-rest/';
    const URL_ENTREGA = 'https://10.1.3.231:443/service/integracao/server-rest/';
    const URL_TQS = 'https://10.1.3.231:443/service/integracao/server-rest/';
    const URL_HOMOLOGA = 'https://10.1.3.231:443/service/integracao/server-rest/';
    const URL = 'https://sae.mec.gov.br:443/service/integracao/server-rest/';
    const KEY_INEP = 'MjQzNjFiNjRkZGJiMzZlMzYwMjEyY2Y4ZWM5ZDQ0ZmM';

    public function runService($strMethod = null, array $arrParam = array(), $strUrl = null, array $arrHeader = array(), $strDataMethod = 'POST', $booDebug = null)
    {
        $strClass = get_class($this);
        foreach ($arrParam as $strKey => $mixValue) {
            if (is_null($mixValue))
                unset($arrParam[$strKey]);
        }
        $arrParamNew = array(
            'method' => 'call',
            'arg0' => self::KEY_INEP,
            'arg1' => str_replace(__NAMESPACE__ . '\\', '', $strClass),
            'arg2' => $strMethod,
            'arg3' => $arrParam,
        );
        return parent::runService($strClass, null, $arrParamNew, $strUrl, $arrHeader, $strDataMethod, $booDebug);
    }

}
