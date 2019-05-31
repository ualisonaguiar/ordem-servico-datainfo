<?php

namespace InepZend\WebService\Client\Soap;

use InepZend\WebService\Client\Soap\Client;
use InepZend\Util\Curl;

class ClientCurl extends Client
{

    const CONNECTION_TIMEOUT = 45;

    public function __construct($strWsdl, array $arrOption = null)
    {
        if (!is_array($arrOption))
            $arrOption = array();
        parent::__construct($strWsdl, array_merge(array('connection_timeout' => self::CONNECTION_TIMEOUT), $arrOption));
    }

    public function __doRequest($strRequest, $strLocation, $strAction, $intVersion, $intOneWay = 0)
    {
        $arrHeader = array(
            'Content-type: text/xml;charset="utf-8"',
//            'Accept: text/xml',
            'Cache-Control: no-cache',
            'Pragma: no-cache',
            'SOAPAction: "' . $strAction . '"',
//            'Content-length: ' . strlen($strRequest),
        );
        $mixCurlResult = Curl::getCurl($strLocation, $strRequest, 'POST', null, null, null, null, $arrHeader);
        if (!is_array($mixCurlResult))
            return 'Não foi possível realizar a conexão via Curl.';
        $mixResult = $mixCurlResult[0];
        $mixCurlError = $mixCurlResult[1];
        return (!empty($mixCurlError)) ? $mixCurlError : $mixResult;
    }

}
