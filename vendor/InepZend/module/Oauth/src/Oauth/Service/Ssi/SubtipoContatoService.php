<?php

namespace InepZend\Module\Oauth\Service\Ssi;

use \Exception as ExceptionNative;

trait SubtipoContatoService
{

    public function obterSubtipoContato($intIdSubtipoContato = null, $arrParam = null)
    {
        $arrParamService = array();
        if (!empty($intIdSubtipoContato))
            $arrParamService = array('idSubtipoContato' => $intIdSubtipoContato);
        return $this->makeCall('private/subtipoContatos/' . str_replace('SubtipoContato', '', __FUNCTION__) . ((!empty($intIdSubtipoContato)) ? '/' . $intIdSubtipoContato : ''), array_merge($arrParamService, (array) $arrParam), 'GET');
    }

    public function obterSubtipoContatoEmail($intIdSubtipoContato = null, $arrParam = null)
    {
        return $this->obterSubtipoContatoTipo($intIdSubtipoContato, 'E', $arrParam);
    }

    public function obterSubtipoContatoFax($intIdSubtipoContato = null, $arrParam = null)
    {
        return $this->obterSubtipoContatoTipo($intIdSubtipoContato, 'F', $arrParam);
    }

    public function obterSubtipoContatoTelefone($intIdSubtipoContato = null, $arrParam = null)
    {
        return $this->obterSubtipoContatoTipo($intIdSubtipoContato, 'T', $arrParam);
    }

    public function obterSubtipoContatoCaixaPostal($intIdSubtipoContato = null, $arrParam = null)
    {
        return $this->obterSubtipoContatoTipo($intIdSubtipoContato, 'C', $arrParam);
    }

    public function obterSubtipoContatoPager($intIdSubtipoContato = null, $arrParam = null)
    {
        return $this->obterSubtipoContatoTipo($intIdSubtipoContato, 'P', $arrParam);
    }

    public function obterSubtipoContatoTipo($intIdSubtipoContato = null, $strTpContato = null, $arrParam = null)
    {
        if (!in_array(strtoupper($strTpContato), array('E', 'F', 'T', 'C', 'P')))
            return array();
        $this->setCheckResultThrow(true);
        try {
            $subtipoContato = $this->obterSubtipoContato($intIdSubtipoContato);
            $result = @$subtipoContato->response->result;
            $arrSubtipoContato = @$result->subtipoContatos;
            $arrResult = array();
            foreach ((array) $arrSubtipoContato as $subtipoContatoIntern) {
                if ($subtipoContatoIntern->tpContato != $strTpContato)
                    continue;
                $arrResult[$subtipoContatoIntern->id] = $subtipoContatoIntern;
            }
            ksort($arrResult);
            return array_values($arrResult);
        } catch (ExceptionNative $exception) {
            $this->debugExecFile($exception);
            throw $exception;
        }
    }

}
