<?php

namespace InepZend\WebService\Client\Corporative\Mec\Sae;

class Demanda extends Sae
{

    public function consultar($intNuDemanda = null, $intCoSecretaria = null, $intCoSituacao = null, $strDsDemanda = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        $arrParam = array(
            'nu_demanda' => $intNuDemanda,
            'co_secretaria' => $intCoSecretaria,
            'co_situacao' => $intCoSituacao,
            'ds_demanda' => $strDsDemanda,
        );
        return $this->runService(__FUNCTION__, $arrParam, $strUrl, $arrHeader, 'GET', $booDebug);
    }

}
