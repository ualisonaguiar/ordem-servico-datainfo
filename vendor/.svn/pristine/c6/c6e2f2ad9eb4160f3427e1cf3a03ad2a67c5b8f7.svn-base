<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCorp;

use InepZend\Util\stdClass;
use InepZend\Util\Validate;

trait Email
{

    /**
     * Metodo responsavel em enviar email via componente do RestCorp.
     * 
     * @example (new RestCorp())->enviarEmail('seu_email@inep.gov.br', 2, 'RNC', 'Mensagem de texto', 1, 'Assunto');
     * 
     * @param string $strTxDestinatario
     * @param integer $intCoConfiguracao
     * @param string $strNomeUsuarioBD
     * @param string $strTxMensagem
     * @param integer $intCoUsuarioSistema
     * @param string $strAssunto
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @param aray $arrConfig
     * @return mix
     */
    public function enviarEmail($strTxDestinatario = null, $intCoConfiguracao = null, $strNomeUsuarioBD = null, $strTxMensagem = null, $intCoUsuarioSistema = null, $strAssunto = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($strTxDestinatario)) || (empty($intCoConfiguracao)) || (empty($strNomeUsuarioBD)) || (empty($strTxMensagem)))
            return self::MSG_PARAM_NOT_FOUND;
        if (!Validate::validateEmail($strTxDestinatario))
            return 'Email Inválido.';
        return $this->runService('inep/email/' . __FUNCTION__, new stdClass(array('destinatario' => $strTxDestinatario, 'codigoConfiguracao' => $intCoConfiguracao, 'nomeUsuarioBD' => $strNomeUsuarioBD, 'valorAtributoChave' => $intCoUsuarioSistema, 'mensagem' => $strTxMensagem, 'assunto' => $strAssunto, 'idUsuario' => $intCoUsuarioSistema)), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

    /**
     * Metodo responsavel em enviar email em lote via componente do RestCorp.
     * 
     * @example (new RestCorp())->enviarLote(
     *                  (array("emailList" => array(
     *                       array('destinatario' => $strTxDestinatario, 'codigoConfiguracao' => $intCoConfiguracao, 'nomeUsuarioBD' => $strNomeUsuarioBD, 'valorAtributoChave' => $intCoUsuarioSistema, 'mensagem' => $strTxMensagem, 'assunto' => $strAssunto, 'idUsuario' => $intCoUsuarioSistema),
     *                       array('destinatario' => $strTxDestinatario, 'codigoConfiguracao' => $intCoConfiguracao, 'nomeUsuarioBD' => $strNomeUsuarioBD, 'valorAtributoChave' => $intCoUsuarioSistema, 'mensagem' => $strTxMensagem, 'assunto' => $strAssunto, 'idUsuario' => $intCoUsuarioSistema),
     *                       array('destinatario' => $strTxDestinatario, 'codigoConfiguracao' => $intCoConfiguracao, 'nomeUsuarioBD' => $strNomeUsuarioBD, 'valorAtributoChave' => $intCoUsuarioSistema, 'mensagem' => $strTxMensagem, 'assunto' => $strAssunto, 'idUsuario' => $intCoUsuarioSistema),
     *                   )
     *              )));
     * 
     * @param array $arrEmailList
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @param array $arrConfig
     * @return mix
     */
    public function enviarLote(array $arrEmailList, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if (count($arrEmailList['emailList']) > 1000)
            return 'Quantidade de E-mail\'s excede o limite máxima de 1.000';
        return $this->runService('inep/email/' . __FUNCTION__, new stdClass($arrEmailList), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

}
