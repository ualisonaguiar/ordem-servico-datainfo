<?php

namespace InepZend\Module\Oauth\Service\Ssi;

trait UsuarioSistemaService
{

    public function desvincularPerfil($intIdUsuarioSistema = null, $intIdPerfil = null, $arrParam = null)
    {
        return $this->makeCall('private/usuariosSistema/' . __FUNCTION__, array_merge(array('idUsuarioSistema' => $intIdUsuarioSistema, 'idPerfil' => $intIdPerfil), (array) $arrParam), 'POST');
    }

    public function obterUsuarioSistema($intIdUsuarioSistema = null, $arrParam = null)
    {
        return $this->makeCall('private/usuariosSistema/' . str_replace('UsuarioSistema', '', __FUNCTION__) . '/' . $intIdUsuarioSistema, array_merge(array('idUsuarioSistema' => $intIdUsuarioSistema), (array) $arrParam), 'GET');
    }

    public function obterUsuarioSistemaPorCPF($intCpf = null, $arrParam = null)
    {
        return $this->makeCall('private/usuariosSistema/' . str_replace('UsuarioSistema', '', __FUNCTION__) . '/' . $intCpf, array_merge(array('cpf' => $intCpf), (array) $arrParam), 'GET');
    }

    public function vincularPerfil($intIdUsuarioSistema = null, $intIdPerfil = null, $arrParam = null)
    {
        return $this->makeCall('private/usuariosSistema/' . __FUNCTION__, array_merge(array('idUsuarioSistema' => $intIdUsuarioSistema, 'idPerfil' => $intIdPerfil), (array) $arrParam), 'POST');
    }

}
