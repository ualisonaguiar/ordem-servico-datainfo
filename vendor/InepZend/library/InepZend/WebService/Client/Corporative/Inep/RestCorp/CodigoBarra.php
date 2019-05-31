<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\Util\stdClass;

trait CodigoBarra
{

    public function obterCodigoBarra($strOitoUgGestao = null, $strTresIdValor = null, $strUmIdArrecadacao = null, $strNoveTipoContribuinte = null, $strIdSerie = null, $strCpf = null, $strSeisStn = null, $strSeteCodRecolhimento = null, $intContadorGRU = null, $strCampoDoisSegmento = null, $strCincoValor = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        return $this->controlCache('obterCodigoBarraWithoutCache', func_get_args());
    }

    public function obterCodigoBarraWithoutCache($strOitoUgGestao = null, $strTresIdValor = null, $strUmIdArrecadacao = null, $strNoveTipoContribuinte = null, $strIdSerie = null, $strCpf = null, $strSeisStn = null, $strSeteCodRecolhimento = null, $intContadorGRU = null, $strCampoDoisSegmento = null, $strCincoValor = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        $arrDto = array(
            'campoOitoUgGestao' => $strOitoUgGestao,
            'campoTresIdValor' => $strTresIdValor,
            'campoUmIdArrecadacao' => $strUmIdArrecadacao,
            'campoNoveTipoContribuinte' => $strNoveTipoContribuinte,
            'idSerie' => $strIdSerie,
            'cpf' => $strCpf,
            'campoSeisStn' => $strSeisStn,
            'campoSeteCodRecolhimento' => $strSeteCodRecolhimento,
            'contadorGRU' => $intContadorGRU,
            'campoDoisSegmento' => $strCampoDoisSegmento,
            'campoCincoValor' => $strCincoValor,
        );
        return $this->runService('codigoBarra/' . str_replace('WithoutCache', '', __FUNCTION__), new stdClass($arrDto), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

}
