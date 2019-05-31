<?php

namespace InepZend\WebService\Client\Corporative\Mec\Sae;

use InepZend\Util\Format;

class Pagamento extends Sae
{

    public function consultar($intCoPagamento = null, $intCoAvaliacao = null, $intNuDemanda = null, $intNuCpf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        $arrParam = array(
            'co_pagamento' => $intCoPagamento,
            'co_avaliacao' => $intCoAvaliacao,
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
