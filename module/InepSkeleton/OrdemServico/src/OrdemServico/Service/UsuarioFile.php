<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractService;
use InepZend\Service\ServiceAngularTrait;
use InepZend\Exception\Exception;
use OrdemServico\Message\Message;
use OrdemServico\Entity\Usuario as UsuarioEntity;
use InepZend\Paginator\Paginator;

class UsuarioFile extends AbstractService
{
    use ServiceAngularTrait,
        Message;

    public function __construct($entityManager = null, $strService = null)
    {
        parent::__construct($entityManager, $strService);
        $this->arrPk = array('id_usuario');
    }

    public function findByPaged(
        array $arrCriteria = null,
        $strSortName = null,
        $strSortOrder = null,
        $intPage = 1,
        $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT,
        $mixDQLQuery = null
    ) {
        $register = parent::findByPaged($arrCriteria, $strSortName, $strSortOrder, $intPage, $intItemPerPage, $mixDQLQuery);
        if ($register) {
            $arrTpVinculo = UsuarioEntity::$arrPerfilUsuario;
            foreach ($register->getRegister() as $intIndice => $infoRegister) {
                $register->getRegister()[$intIndice]->setInAtivo(($infoRegister->getInAtivo()) ? 'Ativo' : 'Inativo');
                $register->getRegister()[$intIndice]->setTpVinculo($arrTpVinculo[$infoRegister->getTpVinculo()]);
            }
        }
        return $register;
    }

    protected function hasUserBanco()
    {
        $userSession = $this->getIdentity()->usuarioSistema;
        $arrUsuario = $this->getUserSession();
        if (!$arrUsuario && $userSession) {
            foreach ($userSession->perfis as $perfil) {
                # @TODO conferir se o perfil do ldap sera de servidor
                if (strtolower($perfil->nome) !== 'servidor') {
                    throw new Exception('Usuário sem acesso ao sistema');
                }
            }
            $this->save([
                'no_usuario' => $userSession->usuario->nome,
                'ds_email' => $userSession->usuario->email,
                'ds_login' => strtolower($userSession->usuario->login),
                'tp_vinculo' => UsuarioEntity::CO_PERFIL_SERVIDOR,
                'in_ativo' => UsuarioEntity::CO_SITUACAO_ATIVO,
            ]);
        }
    }

    protected function hasUserAtivo()
    {
        $arrUsuario = $this->getUserSession();
        if ($arrUsuario[0]->getInAtivo() != UsuarioEntity::CO_SITUACAO_ATIVO) {
            throw new \Exception('Usuário com acesso bloqueado.');
        }
    }

    protected function getUserSession()
    {
        $userSession = $this->getIdentity()->usuarioSistema;
        $arrUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->findBy([
            'ds_login' => strtolower($userSession->usuario->login)
        ]);
        return $arrUsuario;
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_SERVICE_DELETE
     */
    protected function deleteAction(array $arrData)
    {
        try {
            $usuario = $this->find($arrData['id_usuario']);
            $booAtivo = ($usuario->getInAtivo()) ? UsuarioEntity::CO_SITUACAO_INATIVO : UsuarioEntity::CO_SITUACAO_ATIVO;
            $usuario->setInPreposto(UsuarioEntity::CO_SITUACAO_INATIVO)
                ->setInAtivo($booAtivo);
            $arrUsuario = $usuario->toArray();
            if (array_key_exists('ds_senha', $arrUsuario)) {
                unset($arrUsuario['ds_senha']);
            }
            return $this->save($arrUsuario);
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
