<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\Util\stdClass;

trait Sms
{

    public function smsEnviar($strNoRemetente = null, $intNuDestinatario = null, $strTxMensagem = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($strNoRemetente)) || (empty($intNuDestinatario)) || (empty($strTxMensagem)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('inep/sms/enviar', array('nomeRemetente' => $strNoRemetente, 'numeroDestinatario' => $intNuDestinatario, 'mensagem' => $strTxMensagem), $strUrl, $arrHeader, 'GET', $booDebug, $arrConfig);
    }

    /**
     * Metodo responsavel em enviar SMS via componente do RestCorp.
     * 
     * @example (new RestCorp())->enviarSms('Mensage de Teste', 00, 'RNC', 0000, '00', '000000');
     * 
     * @param string $strTxMensagem
     * @param integer $intCoConfiguracao
     * @param string $strNomeUsuarioBD
     * @param string $strDdd
     * @param string $strTelefone
     * @param integer $intCoUsuarioSistema
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @param array $arrConfig
     * @return mix
     */
    public function enviarSms($strTxMensagem = null, $intCoConfiguracao = null, $strNomeUsuarioBD = null, $strDdd = null, $strTelefone = null, $intCoUsuarioSistema = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($strTxMensagem)) || (empty($intCoConfiguracao)) || (empty($strNomeUsuarioBD)) || (empty($strDdd)) || (empty($strTelefone)))
            return self::MSG_PARAM_NOT_FOUND;
        $intCoUsuarioSistema = $this->getCoUsuarioSistemaDefault($intCoUsuarioSistema);
        return $this->runService('inep/sms/' . __FUNCTION__, new stdClass(array('mensagem' => $strTxMensagem, 'codigoConfiguracao' => $intCoConfiguracao, 'nomeUsuarioBD' => $strNomeUsuarioBD, 'valorAtributoChave' => $intCoUsuarioSistema, 'ddd' => $strDdd, 'telefone' => $strTelefone, 'idUsuario' => $intCoUsuarioSistema)), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

    /**
     * Metodo responsavel em enviar SMS em lote via componente do RestCorp.
     * 
     * @example (new RestCorp())->enviarLoteSms(
     *           array("smsList" => array(
     *                   array('mensagem' => $strTxMensagem, 'codigoConfiguracao' => $intCoConfiguracao, 'nomeUsuarioBD' => $strNomeUsuarioBD, 'valorAtributoChave' => $intCoUsuarioSistema, 'ddd' => $strDdd, 'telefone' => $strTelefone, 'idUsuario' => $intCoUsuarioSistema),
     *                   array('mensagem' => $strTxMensagem, 'codigoConfiguracao' => $intCoConfiguracao, 'nomeUsuarioBD' => $strNomeUsuarioBD, 'valorAtributoChave' => $intCoUsuarioSistema, 'ddd' => $strDdd, 'telefone' => $strTelefone, 'idUsuario' => $intCoUsuarioSistema),
     *                   array('mensagem' => $strTxMensagem, 'codigoConfiguracao' => $intCoConfiguracao, 'nomeUsuarioBD' => $strNomeUsuarioBD, 'valorAtributoChave' => $intCoUsuarioSistema, 'ddd' => $strDdd, 'telefone' => $strTelefone, 'idUsuario' => $intCoUsuarioSistema),
     *               ))
     *   );
     * 
     * @param array $arrSmsList
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @param array $arrConfig
     * @return mix
     */
    public function enviarLoteSms(array $arrSmsList, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (count($arrSmsList['smsList']) > 1000)
            return 'Quantidade de SMS\'s excede o limite máxima de 1.000';
        return $this->runService('inep/sms/enviarLote', new stdClass($arrSmsList), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

}
