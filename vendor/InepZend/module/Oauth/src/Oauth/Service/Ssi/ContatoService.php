<?php

namespace InepZend\Module\Oauth\Service\Ssi;

use InepZend\Util\ArrayCollection;

trait ContatoService
{

    public function atualizarContato($intUsuarioId = null, $intId = null, $strTipo = null, $strNomeSubtipoContato = null, $strTxContato = null, $intDdi = null, $intDdd = null, $intRamal = null, $booAtivo = null, $arrParam = null)
    {
        return $this->makeCall('private/contatos/' . str_replace('Contato', '', __FUNCTION__), $this->getJsonParam(array_merge(array('usuarioId' => $intUsuarioId, 'id' => $intId, 'tipo' => $strTipo, 'nomeSubTipoContato' => $strNomeSubtipoContato, 'txContato' => $strTxContato, 'ddi' => $intDdi, 'ddd' => $intDdd, 'ramal' => $intRamal, 'ativo' => $booAtivo), (array) $arrParam)), 'POST');
    }

    public function cadastrarContato($intUsuarioId = null, $intId = null, $strTipo = null, $strNomeSubtipoContato = null, $strTxContato = null, $intDdi = null, $intDdd = null, $intRamal = null, $booAtivo = null, $arrParam = null)
    {
        return $this->makeCall('private/contatos/' . str_replace('Contato', '', __FUNCTION__), $this->getJsonParam(array_merge(array('usuarioId' => $intUsuarioId, 'id' => $intId, 'tipo' => $strTipo, 'nomeSubTipoContato' => $strNomeSubtipoContato, 'txContato' => $strTxContato, 'ddi' => $intDdi, 'ddd' => $intDdd, 'ramal' => $intRamal, 'ativo' => $booAtivo), (array) $arrParam)), 'POST');
    }

    /**
     * 
     * @param integer $intIdUsuarioSistema
     * @param array $arrContato
     * @param array $arrParam
     * @return mix
     * 
     * @example $arrContato = array(
     *      array(
     *          'id' => null,
     *          'ativo' => true,
     *          'ddd' => 11,
     *          'ddi' => null,
     *          'ramal' => null,
     *          'tipo' => 'TELEFONE',
     *          'txContato' => '77777-5666',
     *          'usuarioId' => 12345,
     *          'nomeSubTipoContato' => 'Comercial',
     *      ),
     *      array(
     *          'id' => null,
     *          'ativo' => true,
     *          'ddd' => 12,
     *          'ddi' => null,
     *          'ramal' => null,
     *          'tipo' => 'TELEFONE',
     *          'txContato' => '88888-7777',
     *          'usuarioId' => 12345,
     *          'nomeSubTipoContato' => 'Celular',
     *      ),
     * );
     */
    public function cadastrarVariosContatos($intIdUsuarioSistema = null, $arrContato = null, $arrParam = null)
    {
        return $this->makeCall('private/contatos/' . str_replace('Contatos', '', __FUNCTION__), $this->getJsonParam(array_merge(array('idUsuarioSistema' => $intIdUsuarioSistema, 'contatos' => $arrContato), (array) $arrParam)), 'POST');
    }

    public function obterContato($intIdContato = null, $intIdUsuario = null, $intCpf = null, $strLogin = null, $arrParam = null)
    {
        $strMethod = str_replace('Contato', '', __FUNCTION__);
        if (!empty($intIdContato))
            $arrParamService = array('idContato' => $intIdContato);
        else {
            $strMethod .= 'PorChave';
            $arrParamService = array('idUsuario' => $intIdUsuario, 'cpf' => $intCpf, 'login' => $strLogin);
            ArrayCollection::clearEmptyParam($arrParamService);
        }
        return $this->makeCall('private/contatos/' . $strMethod . ((!empty($intIdContato)) ? '/' . $intIdContato : ''), array_merge($arrParamService, (array) $arrParam), 'GET');
    }

}
