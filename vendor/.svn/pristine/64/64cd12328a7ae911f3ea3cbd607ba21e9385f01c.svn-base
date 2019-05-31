<?php

namespace InepZend\WebService\Client\Corporative\Mec\Sae;

use InepZend\Util\Format;

class Beneficiario extends Sae
{

    public function consultarLimites($intNuCpf = null, $intNuAno = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if (empty($intNuCpf))
            return self::MSG_PARAM_NOT_FOUND;
        if (empty($intNuAno))
            $intNuAno = date('Y');
        return $this->runService(__FUNCTION__, array('p_nucpf' => Format::clearCpfCnpj($intNuCpf), 'p_ano' => $intNuAno), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    public function consultar($intNuCpf = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        $arrParam = array(
            'nu_cpf' => $intNuCpf,
        );
        if (empty($arrParam['nu_cpf']))
            unset($arrParam['nu_cpf']);
        else
            $arrParam['nu_cpf'] = Format::clearCpfCnpj($arrParam['nu_cpf']);
        return $this->runService(__FUNCTION__, $arrParam, $strUrl, $arrHeader, 'GET', $booDebug);
    }

}
