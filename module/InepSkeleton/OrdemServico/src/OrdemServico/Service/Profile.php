<?php

namespace OrdemServico\Service;

use InepZend\Service\AbstractServiceManager;
use OrdemServico\Entity\Usuario as UsuarioEntity;

class Profile extends AbstractServiceManager
{
    protected function hasUsuarioPreposto()
    {
        return ($this->getTipoVinculo() == UsuarioEntity::CO_PERFIL_PREPOSTO);
    }

    protected function hasUsuarioGestorContrato()
    {
        return ($this->getTipoVinculo() == UsuarioEntity::CO_PERFIL_GESTOR);
    }

    protected function hasUsuarioServidor()
    {
        return ($this->getTipoVinculo() == UsuarioEntity::CO_PERFIL_SERVIDOR);
    }

    protected function getTipoVinculo()
    {
        $strUserLogado = strtolower($this->getIdentity()->usuarioSistema->usuario->login);
        $arrUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->findBy(['ds_login' => $strUserLogado]);
        return $arrUsuario[0]->getTpVinculo();
    }

    protected function getIdUsuarioLogado()
    {
        $intIdUsuarioSistema = 62;
        if (!$this->getIdentity()) {
            return $intIdUsuarioSistema;
        }
        $arrUsuario = $this->getService('OrdemServico\Service\UsuarioFile')->findBy([
            'ds_login' => strtolower($this->getIdentity()->usuarioSistema->usuario->login)
        ]);
        if (!$arrUsuario) {
            throw new \Exception('Usuário não cadastrado no sistema.');
        }
        return $arrUsuario[0]->getIdUsuario();
    }
}
