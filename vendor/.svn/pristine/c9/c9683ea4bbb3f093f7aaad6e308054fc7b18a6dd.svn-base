<?php

namespace InepZend\WebService\Client\Corporative\Mec\Sae;

use InepZend\Util\Format;

class DadosBancarios extends Sae
{

    public function consultar($intNuCpf = null, $strStAtivo = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        $arrParam = array(
            'nu_cpf' => $intNuCpf,
            'st_ativo' => $strStAtivo,
        );
        if (empty($arrParam['nu_cpf']))
            unset($arrParam['nu_cpf']);
        else
            $arrParam['nu_cpf'] = Format::clearCpfCnpj($arrParam['nu_cpf']);
        return $this->runService(__FUNCTION__, $arrParam, $strUrl, $arrHeader, 'GET', $booDebug);
    }

}
