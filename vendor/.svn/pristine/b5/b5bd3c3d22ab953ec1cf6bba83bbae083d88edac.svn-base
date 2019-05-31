<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\Util\stdClass;

trait CodigoSegurancaGru
{

    public function obterCodigoSegurancaGru($strCpf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('obterCodigoSegurancaGruWithoutCache', func_get_args());
    }

    public function obterCodigoSegurancaGruWithoutCache($strCpf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        $arrDto = array(
            'cpf' => $strCpf,
        );
        return $this->runService('codigoSegurancaGru/' . str_replace('WithoutCache', '', __FUNCTION__), new stdClass($arrDto), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

    public function obterCpfCodigoSegurancaGru($intCoSeguranca = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('obterCpfCodigoSegurancaGruWithoutCache', func_get_args());
    }

    public function obterCpfCodigoSegurancaGruWithoutCache($intCoSeguranca = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        $arrDto = array(
            'codigoSeguranca' => $intCoSeguranca,
        );
        return $this->runService('codigoSegurancaGru/' . str_replace('WithoutCache', '', __FUNCTION__), new stdClass($arrDto), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

}
