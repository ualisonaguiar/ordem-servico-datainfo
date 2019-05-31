<?php

namespace InepZend\WebService\Client\Corporative\Mec\Sae;

class DemandaAvaliacao extends Sae
{

    public function consultar($intCoAvaliacao = null, $intNuDemanda = null, $strDsAvaliacao = null, $mixTpCategoria = null, $intCoAtividade = null, $intCoIes = null, $intCoIesCurso = null, $intCoIesEndereco = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        $arrParam = array(
            'co_avaliacao' => $intCoAvaliacao,
            'nu_demanda' => $intNuDemanda,
            'ds_avaliacao' => $strDsAvaliacao,
            'tp_categoria' => $mixTpCategoria,
            'co_atividade' => $intCoAtividade,
            'co_ies' => $intCoIes,
            'co_ies_curso' => $intCoIesCurso,
            'co_ies_endereco' => $intCoIesEndereco,
        );
        return $this->runService(__FUNCTION__, $arrParam, $strUrl, $arrHeader, 'GET', $booDebug);
    }

}
