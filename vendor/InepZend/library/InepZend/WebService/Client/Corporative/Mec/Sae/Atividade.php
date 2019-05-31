<?php

namespace InepZend\WebService\Client\Corporative\Mec\Sae;

class Atividade extends Sae
{

    public function consultar($intCoAtividade = null, $strDsAtividade = null, $intNuDecreto = null, $strStAtivo = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        $arrParam = array(
            'co_atividade' => $intCoAtividade,
            'ds_atividade' => $strDsAtividade,
            'nu_decreto' => $intNuDecreto,
            'st_ativo' => $strStAtivo,
        );
        return $this->runService(__FUNCTION__, $arrParam, $strUrl, $arrHeader, 'GET', $booDebug);
    }

}
