<?php

namespace InepZend\Module\Executor\Service;

use InepZend\Service\AbstractServiceFile as AbstractServiceFileInepZend;
use InepZend\Paginator\Paginator;
use InepZend\Module\Executor\Entity\Usuario as UsuarioEntity;
use InepZend\Dto\ResultDto;
use InepZend\Module\Executor\Message\Message;

class Usuario extends AbstractServiceFileInepZend
{
    use Message;

    public function __construct()
    {
        parent::__construct();
        $this->arrPk = array('idUsuario');
    }

    /**
     * Metodo responsavel verificar se o usuario tem acesso ao sistema.
     *
     * @return boolean
     */
    protected function hasAccessSystem()
    {
        if (!$this->hasAdministrador()) {
            $arrUser = $this->getService('InepZend\Module\Executor\Service\Usuario')->findBy(
                array(
                    'dsLogin' => $this->getService('InepZend\Module\Executor\Service\EmailHistoricoQuery')->getLoginUser(),
                    'inAtivo' => (int) UsuarioEntity::SITUACAO_ATIVO
                )
            );
            if (!$arrUser) {
                return false;
            }
        }
        return true;
    }
    
    protected function hasProductOwner()
    {
        $usuarioSistema = $this->getIdentity()->usuarioSistema;
        $usuarioLogado = reset($this->findBy(array('dsLogin' => $usuarioSistema->usuario->login)));
        return ($usuarioLogado) ? $usuarioLogado->getInProductOwner() : false;
    }

    /**
     * Metodo responsavel que verificar se o usuario logado pertecem ao perfil adminsitrador.
     *
     * @return boolean
     */
    protected function hasAdministrador()
    {
        $booAdmin = false;
        foreach ((array) $this->getIdentity()->usuarioSistema->perfis as $perfil) {
            $strProfile = strtoupper($perfil->nome);
            $booAdmin = ((strpos($strProfile, 'ARQUITETURA') !== false) || (strpos($strProfile, 'ADMIN') !== false) || ($this->hasProductOwner()));
            if ($booAdmin)
                break;
        }
        return $booAdmin;
    }

    /**
     * Metodo responsavel pela listagem dos usuario cadastrados.
     *
     * @param array $arrCriteria
     * @param string $strSortName
     * @param string $strSortOrder
     * @param integer $intPage
     * @param integer $intItemPerPage
     * @param mix $mixDQL
     * @return Paginator
     */
    public function findByPaged(array $arrCriteria = null, $strSortName = 'dsLogin', $strSortOrder = 'asc', $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQL = null)
    {
        $arrDataQuery = $this->findBy($arrCriteria, array('dsLogin' => 'asc'));
        $arrDataResult = array();
        foreach ($arrDataQuery as $infoQuery) {
            $arrDataResult[] = array(
                'ID_USUARIO' => $infoQuery->getIdUsuario(),
                'IN_ATIVO' => UsuarioEntity::$arrSituacao[$infoQuery->getInAtivo()],
                'DS_LOGIN' => $infoQuery->getDsLogin(),
                'IN_PRODUCT_OWNER' => UsuarioEntity::$arrProductOwner[$infoQuery->getInProductOwner()],
            );
        }
        return new Paginator($arrDataResult, $intPage, $intItemPerPage);
    }

    public function insert($arrData, array $arrSetterFk = array(), $strEntity = null, $booCheckSequence = true)
    {
        if ($arrData['inAtivo'] != UsuarioEntity::SITUACAO_ATIVO) {
            $arrData['inAtivo'] = UsuarioEntity::SITUACAO_INATIVO;
        }
        return parent::insert($arrData, $arrSetterFk, $strEntity, $booCheckSequence);
    }

    /**
     *
     * @param array $arrData
     * @param array $arrSetterFk
     * @return type
     */
    public function update(array $arrData, array $arrSetterFk = array())
    {
        $arrData['idUsuario'] = (int) $arrData['idUsuario'];
        return parent::update($arrData, $arrSetterFk);
    }

    /**
     * Metodo responsavel por alterar a situacao do usuario.
     *
     * @param type $intIdUsuario
     * @return type
     */
    protected function changeSituation($intIdUsuario)
    {
        try {
            $strStatus = ResultDto::STATUS_OK;
            $mixMessage = $this->strMsgSucesso06;
            $dataUser = $this->find((int) $intIdUsuario);
            $arrDataQuery = $dataUser->toArray();
            $arrDataQuery['inAtivo'] = (($arrDataQuery['inAtivo'] == UsuarioEntity::SITUACAO_ATIVO) ? UsuarioEntity::SITUACAO_INATIVO : UsuarioEntity::SITUACAO_ATIVO);
            $this->save($arrDataQuery);
        } catch (Exception $exception) {
            $strStatus = ResultDto::STATUS_ERROR;
            $mixMessage = $exception->getMessage();
        }
        return self::getResult($strStatus, $mixMessage);
    }

    /**
     * Metodo responsavel por retornar o cpf do usuario logado que esteja cadastro na tabela tb_usuario
     *
     * @return string
     */
    protected function getCpfUsuarioLogado()
    {
        $strLogin = $this->getService('InepZend\Module\Executor\Service\EmailHistoricoQuery')->getLoginUser();
        $arrUser = $this->findBy(array('dsLogin' => $strLogin));
        if (!$arrUser) {
            return '';
        }
        return $arrUser[0]->getNuCpf();
    }
}
