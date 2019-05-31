<?php

namespace InepZend\WebService\Client\Corporative\Inep;

use InepZend\WebService\Client\Corporative\Inep\Rest;
use InepZend\Util\Format;
use InepZend\Util\stdClass;

class SsiRest extends Rest
{

    const URL_DESENV = 'http://desenvolvimento.inep.gov.br/ssiServices/';
    const URL_ENTREGA = 'http://entrega.inep.gov.br/ssiServices/';
    const URL_TQS = 'http://tqs.inep.gov.br/ssiServices/';
    const URL_HOMOLOGA = 'http://homologacao.inep.gov.br/ssiServices/';
    const URL_TREINAMENTO = 'http://172.31.0.15/ssiServices/';
    const URL_CLONE_D1 = 'http://clone.inep.gov.br/ssiServices/';
    const URL = 'http://172.31.0.30/ssiServices/';
    const CONTACT_TYPE_EMAIL = 'EMAIL';
    const CONTACT_TYPE_PHONE = 'TELEFONE';
    const CONTACT_TYPE_FAX = 'FAX';
    const CONTACT_TYPE_PAGER = 'PAGER';
    const CONTACT_TYPE_POST_OFFICE_BOX = 'CAIXA_POSTAL';

    public function authUserService($strLogin = null, $strPass = null, array $arrHeader = array(), $strUrl = null, $booDebug = null, $arrConfig = null)
    {
        if ((empty($strLogin)) || (empty($strPass)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService(__FUNCTION__, array('login' => $strLogin, 'senha' => $strPass), $strUrl, $arrHeader, 'POST', $booDebug, $arrConfig);
    }

    public function resetarSenha($intNuCpf = null, $strEmail = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if ((empty($intNuCpf)) || (empty($strEmail)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('authUserService/' . __FUNCTION__, array('cpf' => Format::clearCpfCnpj($intNuCpf), 'email' => $strEmail), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    public function alterarSenha($intCoUsuario = null, $strPassOld = null, $strPassNew = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if ((empty($intCoUsuario)) || (empty($strPassOld)) || (empty($strPassNew)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('secure/senhaService/' . __FUNCTION__, array('codigoUsuario' => $intCoUsuario, 'senhaAntiga' => $strPassOld, 'senhaNova' => $strPassNew), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    public function alterarNomeEmail($intNuCpf = null, $strNome = null, $strEmail = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if ((empty($intNuCpf)) || (empty($strNome)) || (empty($strEmail)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('secure/usuarioService/' . __FUNCTION__, array('cpf' => Format::clearCpfCnpj($intNuCpf), 'nomeUsuario' => $strNome, 'email' => $strEmail), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    public function verificaCpfComNome($intNuCpf = null, $strNome = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if ((empty($intNuCpf)) || (empty($strNome)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('secure/usuarioService/' . __FUNCTION__, array('cpf' => Format::clearCpfCnpj($intNuCpf), 'nomeUsuario' => $strNome), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    public function vincularUsuario($intNuCpf = null, $strNome = null, $strEmail = null, $intCoPerfil = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if ((empty($intNuCpf)) || (empty($strNome)) || (empty($strEmail)) || (empty($intCoPerfil)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('secure/usuarioService/' . __FUNCTION__, array('cpf' => Format::clearCpfCnpj($intNuCpf), 'nomeUsuario' => $strNome, 'email' => $strEmail, 'codigoPerfil' => $intCoPerfil), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    public function preVincularUsuarioSemLogar($intNuCpf = null, $strNome = null, $strEmail = null, $intCoPerfil = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if ((empty($intNuCpf)) || (empty($strNome)) || (empty($strEmail)) || (empty($intCoPerfil)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('authUserService/' . __FUNCTION__, array('cpf' => Format::clearCpfCnpj($intNuCpf), 'nomeUsuario' => $strNome, 'email' => $strEmail, 'codigoPerfil' => $intCoPerfil), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    public function addPerfil($intCoUsuarioSistema = null, $intCoPerfil = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if ((empty($intCoUsuarioSistema)) || (empty($intCoPerfil)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('secure/usuarioService/' . __FUNCTION__, array('codigoUsuarioSistema' => $intCoUsuarioSistema, 'codigoPerfil' => $intCoPerfil), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    public function removePerfil($intCoUsuarioSistema = null, $intCoPerfil = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if ((empty($intCoUsuarioSistema)) || (empty($intCoPerfil)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('secure/usuarioService/' . __FUNCTION__, array('codigoUsuarioSistema' => $intCoUsuarioSistema, 'codigoPerfil' => $intCoPerfil), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    public function desativarUsuarioSistema($intCoUsuarioSistema = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if (empty($intCoUsuarioSistema))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('secure/usuarioService/' . __FUNCTION__, array('codigoUsuarioSistema' => $intCoUsuarioSistema), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    public function ativarUsuarioSistema($intCoUsuarioSistema = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if (empty($intCoUsuarioSistema))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('secure/usuarioService/' . __FUNCTION__, array('codigoUsuarioSistema' => $intCoUsuarioSistema), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    public function ativarUsuario($intCoUsuarioSistema = null, $intCoPerfil = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if ((empty($intCoUsuarioSistema)) || (empty($intCoPerfil)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('secure/usuarioService/' . __FUNCTION__, array('codigoUsuarioSistema' => $intCoUsuarioSistema, 'codigoPerfil' => $intCoPerfil), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    public function adicionarEmails($intNuCpf = null, $strEmail = null, $intIdSubtipoContato = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if (empty($intNuCpf))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('secure/usuarioService/' . __FUNCTION__, array('cpf' => Format::clearCpfCnpj($intNuCpf), 'emails' => $strEmail, 'idSubTipoContato' => $intIdSubtipoContato), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    public function removerEmails($intNuCpf = null, $strEmail = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if (empty($intNuCpf))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('secure/usuarioService/' . __FUNCTION__, array('cpf' => Format::clearCpfCnpj($intNuCpf), 'emails' => $strEmail), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    /**
     * Metodo responsavel em retornar os dados do contato cadastrado no SSI.
     * 
     * @example $this->getContact($intNuCpf, $strLogin, $intIdUsuario, $arrHeader, $strUrl, $booDebug);
     * 
     * @param int $intNuCpf
     * @param string $strLogin
     * @param int $intIdUsuario
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @return object
     */
    public function getContact($intNuCpf = null, $strLogin = null, $intIdUsuario = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        return $this->obter($intNuCpf, $strLogin, $intIdUsuario, $arrHeader, $strUrl, $booDebug);
    }

    /**
     * Metodo responsavel pelo cadastro do contato no SSI.
     * 
     * @example $this->setContact(true, null, self::CONTACT_TYPE_EMAIL, 'example@inep.gov.br', 63490573, 'Email');
     * @example $this->setContact(true, '61', self::CONTACT_TYPE_PHONE, '85855858', 63490573, 'Celular');
     * @example $this->setContact(true, '61', self::CONTACT_TYPE_FAX, '85855858', 63490573, 'Fax');
     * @example $this->setContact(true, '61', self::CONTACT_TYPE_PAGER, '85855858', 63490573, 'Pages');
     * @example $this->setContact(true, null, self::CONTACT_TYPE_POST_OFFICE_BOX, 123456, 63490573, 'Caixa Postal')
     * 
     * @param boolean $booAtivo
     * @param string $strDdd
     * @param string $strTipo
     * @param string $strTxContato
     * @param int $intIdUsuario
     * @param string $strNomeSubTipoContato
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @return object
     */
    public function setContact($booAtivo = null, $strDdd = null, $strTipo = null, $strTxContato = null, $intIdUsuario = null, $strNomeSubTipoContato = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        return $this->cadastrar($booAtivo, $strDdd, $strTipo, $strTxContato, $intIdUsuario, $strNomeSubTipoContato, $arrHeader, $strUrl, $booDebug);
    }

    /**
     * Metodo responsavel pela edicao do contato no SSI.
     * 
     * @example $this->editContact(111, true, null, self::CONTACT_TYPE_EMAIL, 'example@inep.gov.br', 63490573, 'Email');
     * @example $this->editContact(111, true, '61', self::CONTACT_TYPE_PHONE, '85855858', 63490573, 'Celular');
     * @example $this->editContact(111, true, '61', self::CONTACT_TYPE_FAX, '85855858', 63490573, 'Fax');
     * @example $this->editContact(111, true, '61', self::CONTACT_TYPE_PAGER, '85855858', 63490573, 'Pages');
     * @example $this->editContact(111, true, null, self::CONTACT_TYPE_POST_OFFICE_BOX, 123456, 63490573, 'Caixa Postal');
     * 
     * @param integer $intIdContato
     * @param boolean $booAtivo
     * @param string $strDdd
     * @param string $strTipo
     * @param string $strTxContato
     * @param int $intIdUsuario
     * @param string $strNomeSubTipoContato
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @return object
     */
    public function editContact($intIdContato = null, $booAtivo = null, $strDdd = null, $strTipo = null, $strTxContato = null, $intIdUsuario = null, $strNomeSubTipoContato = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        return $this->atualizar($intIdContato, $booAtivo, $strDdd, $strTipo, $strTxContato, $intIdUsuario, $strNomeSubTipoContato, $arrHeader, $strUrl, $booDebug);
    }

    /**
     * Metodo responsavel em retornar os dados do contato cadastrado no SSI.
     * 
     * @example $this->obter($intNuCpf, $strLogin, $intIdUsuario, $arrHeader, $strUrl, $booDebug);
     * 
     * @param int $intNuCpf
     * @param string $strLogin
     * @param int $intIdUsuario
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @return object
     */
    private function obter($intNuCpf = null, $strLogin = null, $intIdUsuario = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if ((empty($intNuCpf)) && (empty($strLogin)) && (empty($intIdUsuario)))
            return self::MSG_PARAM_NOT_FOUND;
        $arrParam = array();
        if (!empty($intNuCpf))
            $arrParam = array('cpf' => Format::clearCpfCnpj($intNuCpf));
        if (!empty($strLogin))
            $arrParam = array('login' => $strLogin);
        if (!empty($intIdUsuario))
            $arrParam = array('idUsuario' => $intIdUsuario);
        return $this->runService('secure/contatoService/' . __FUNCTION__, $arrParam, $strUrl, $arrHeader, 'GET', $booDebug);
    }

    /**
     * Metodo responsavel pelo cadastro do contato no SSI.
     * 
     * @example $this->cadastrar(true, null, self::CONTACT_TYPE_EMAIL, 'example@inep.gov.br', 63490573, 'Email');
     * @example $this->cadastrar(true, '61', self::CONTACT_TYPE_PHONE, '85855858', 63490573, 'Celular');
     * @example $this->cadastrar(true, '61', self::CONTACT_TYPE_FAX, '85855858', 63490573, 'Fax');
     * @example $this->cadastrar(true, '61', self::CONTACT_TYPE_PAGER, '85855858', 63490573, 'Pages');
     * @example $this->cadastrar(true, null, self::CONTACT_TYPE_POST_OFFICE_BOX, 123456, 63490573, 'Caixa Postal');
     * 
     * @param boolean $booAtivo
     * @param string $strDdd
     * @param string $strTipo
     * @param string $strTxContato
     * @param int $intIdUsuario
     * @param string $strNomeSubTipoContato
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @return object
     */
    private function cadastrar($booAtivo = null, $strDdd = null, $strTipo = null, $strTxContato = null, $intIdUsuario = null, $strNomeSubTipoContato = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if ((empty($intIdUsuario)) || (empty($strNomeSubTipoContato)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('secure/contatoService/' . __FUNCTION__, new stdClass(array('ativo' => $booAtivo, 'ddd' => $strDdd, 'tipo' => $strTipo, 'txContato' => $strTxContato, 'usuarioId' => $intIdUsuario, 'nomeSubTipoContato' => $strNomeSubTipoContato)), $strUrl, $arrHeader, 'POST', $booDebug);
    }

    /**
     * Metodo responsavel pela alteracao do contato no SSI.
     * 
     * @example $this->atualizar(111, true, null, self::CONTACT_TYPE_EMAIL, 'example@inep.gov.br', 63490573, 'Email');
     * @example $this->atualizar(111, true, '61', self::CONTACT_TYPE_PHONE, '85855858', 63490573, 'Celular');
     * @example $this->atualizar(111, true, '61', self::CONTACT_TYPE_FAX, '85855858', 63490573, 'Fax');
     * @example $this->atualizar(111, true, '61', self::CONTACT_TYPE_PAGER, '85855858', 63490573, 'Pages');
     * @example $this->atualizar(111, true, null, self::CONTACT_TYPE_POST_OFFICE_BOX, 123456, 63490573, 'Caixa Postal');
     * 
     * @param integer $intIdContato
     * @param boolean $booAtivo
     * @param string $strDdd
     * @param string $strTipo
     * @param string $strTxContato
     * @param int $intIdUsuario
     * @param string $strNomeSubTipoContato
     * @param array $arrHeader
     * @param string $strUrl
     * @param boolean $booDebug
     * @return object
     */
    private function atualizar($intIdContato = null, $booAtivo = null, $strDdd = null, $strTipo = null, $strTxContato = null, $intIdUsuario = null, $strNomeSubTipoContato = null, array $arrHeader = array(), $strUrl = null, $booDebug = null)
    {
        if ((empty($intIdUsuario)) || (empty($intIdContato)))
            return self::MSG_PARAM_NOT_FOUND;
        return $this->runService('secure/contatoService/' . __FUNCTION__, new stdClass(array('id' => $intIdContato, 'ativo' => $booAtivo, 'ddd' => $strDdd, 'tipo' => $strTipo, 'txContato' => $strTxContato, 'usuarioId' => $intIdUsuario, 'nomeSubTipoContato' => $strNomeSubTipoContato)), $strUrl, $arrHeader, 'POST', $booDebug);
    }

}
