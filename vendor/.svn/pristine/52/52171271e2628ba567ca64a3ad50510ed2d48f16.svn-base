<?php

namespace InepZend\WebService\Client\Corporative\Mec\Sae;

use InepZend\Util\Format;

class AvaliacaoBeneficiario extends Sae
{

    public function consultar($intCoAtividade = null, $intNuDemanda = null, $intNuCpf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        $arrParam = array(
            'co_atividade' => $intCoAtividade,
            'nu_demanda' => $intNuDemanda,
            'nu_cpf' => $intNuCpf,
        );
        if (empty($arrParam['nu_cpf']))
            unset($arrParam['nu_cpf']);
        else
            $arrParam['nu_cpf'] = Format::clearCpfCnpj($arrParam['nu_cpf']);
        return $this->runService(__FUNCTION__, $arrParam, $strUrl, $arrHeader, 'GET', $booDebug);
    }

}
