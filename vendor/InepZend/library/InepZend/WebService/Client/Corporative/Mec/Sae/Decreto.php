<?php

namespace InepZend\WebService\Client\Corporative\Mec\Sae;

class Decreto extends Sae
{

    public function consultar($intNuDecreto = null, $strStAtivo = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        $arrParam = array(
            'nu_decreto' => $intNuDecreto,
            'st_ativo' => $strStAtivo,
        );
        return $this->runService(__FUNCTION__, $arrParam, $strUrl, $arrHeader, 'GET', $booDebug);
    }

}
