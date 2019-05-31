<?php

namespace InepZend\Module\Oauth\Service\Ssi;

trait PerfilService
{

    public function obterPerfil($intIdPerfil = null, $strNome = null, $arrParam = null)
    {
        if (!empty($intIdPerfil))
            $arrParamService = array('idPerfil' => $intIdPerfil);
        else
            $arrParamService = array('nome' => $strNome);
        return $this->makeCall('private/perfis/' . str_replace('Perfil', '', __FUNCTION__) . ((!empty($intIdPerfil)) ? '/' . $intIdPerfil : ''), array_merge($arrParamService, (array) $arrParam), 'GET');
    }

    public function obterPerfilDoSistema($arrParam = null)
    {
        return $this->makeCall('private/perfis/' . str_replace('Perfil', '', __FUNCTION__), (array) $arrParam, 'GET');
    }

}
