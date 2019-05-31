<?php

namespace InepZend\Module\Oauth\Service\Ssi;

use \Exception as ExceptionNative;

trait UsuarioService
{

    public function alterarEmailAtivo($intCpf = null, $strEmailAnterior = null, $strEmail = null, $arrParam = null)
    {
        return $this->makeCall('private/usuarios/' . __FUNCTION__, array_merge(array('cpf' => $intCpf, 'emailAnterior' => $strEmailAnterior, 'email' => $strEmail), (array) $arrParam), 'POST');
    }

    public function ativarUsuarioSistema($intIdUsuarioSistema = null, $arrParam = null)
    {
        return $this->makeCall('private/usuarios/' . __FUNCTION__, array_merge(array('idUsuarioSistema' => $intIdUsuarioSistema), (array) $arrParam), 'POST');
    }

    public function ativarUsuarioSistemaPerfil($intIdUsuarioSistema = null, $intIdPerfil = null, $arrParam = null)
    {
        return $this->makeCall('private/usuarios/' . __FUNCTION__, array_merge(array('idUsuarioSistema' => $intIdUsuarioSistema, 'idPerfil' => $intIdPerfil), (array) $arrParam), 'POST');
    }

    public function atualizarNomeEmail($intCpf = null, $strNome = null, $strEmail = null, $arrParam = null)
    {
        return $this->makeCall('private/usuarios/' . __FUNCTION__, array_merge(array('cpf' => $intCpf, 'nome' => $strNome, 'email' => $strEmail), (array) $arrParam), 'POST');
    }

    public function cadastrarUsuarioExterior($strLogin = null, $strNome = null, $intIdPerfil = null, $strSexo = null, $arrParam = null)
    {
        return $this->makeCall('private/usuarios/' . __FUNCTION__, array_merge(array('login' => $strLogin, 'nome' => $strNome, 'idPerfil' => $intIdPerfil, 'sexo' => $strSexo), (array) $arrParam), 'POST');
    }

    public function cadastrarUsuario($intCpf = null, $strEmail = null, $intIdPerfil = null, $arrParam = null)
    {
        return $this->makeCall('private/usuarios/' . str_replace('Usuario', '', __FUNCTION__), array_merge(array('cpf' => $intCpf, 'email' => $strEmail, 'idPerfil' => $intIdPerfil), (array) $arrParam), 'POST');
    }
    
    public function cadastrarComPerfis($intCpf = null, $strEmail = null, $arrIdPerfil = null, $arrParam = null)
    {
        return $this->makeCall('private/usuarios/' . __FUNCTION__, array_merge(array('cpf' => $intCpf, 'email' => $strEmail, 'idPerfilList' => $strIdPerfil = implode(',', $arrIdPerfil)), (array) $arrParam), 'POST');
    }
    
    public function desativarUsuarioSistema($intIdUsuarioSistema = null, $arrParam = null)
    {
        return $this->makeCall('private/usuarios/' . __FUNCTION__, array_merge(array('idUsuarioSistema' => $intIdUsuarioSistema), (array) $arrParam), 'POST');
    }

    public function obterUsuarioPorCPF($intCpf = null, $arrParam = null)
    {
        return $this->makeCall('private/usuarios/' . str_replace('Usuario', '', __FUNCTION__) . '/' . $intCpf, array_merge(array('cpf' => $intCpf), (array) $arrParam), 'GET');
    }

    public function cadastrarUsuarioContato($intCpf = null, $strEmail = null, $intIdPerfil = null, $arrContato = null)
    {
        $this->setCheckResultThrow(true);
        try {
            $this->debugExecFile(array($intCpf, $strEmail, $intIdPerfil));
            $usuario = $this->cadastrarUsuario($intCpf, $strEmail, $intIdPerfil);
            $this->debugExecFile($usuario);
            $result = $usuario->response->result;
            $usuarioSistemaReal = $result->usuarioSistema;
            $arrUsuarioReal = $result->usuarios;
            if ((is_array($arrContato)) && (!empty($arrContato))) {
                $this->debugExecFile($arrContato);
                $intIdUsuarioSistema = @$usuario->response->result->usuarioSistema->usuario->id;
                $this->debugExecFile($intIdUsuarioSistema);
                $arrContatoReal = @$usuario->response->result->usuarioSistema->usuario->contatos;
                $this->debugExecFile($arrContatoReal);
                foreach ($arrContato as $arrContatoTipoNew) {
                    $strTipoNew = @$arrContatoTipoNew['tipo'];
                    $strSubTipoNew = @$arrContatoTipoNew['nomeSubTipoContato'];
                    $strContatoNew = @$arrContatoTipoNew['txContato'];
                    if ((empty($strTipoNew)) || (empty($strContatoNew)))
                        continue;
                    foreach ($arrContatoReal as $contatoReal) {
                        $arrContatoTipoReal = (array) $contatoReal;
                        $strTipoReal = @$arrContatoTipoReal['tipo'];
                        $strSubTipoReal = @$arrContatoTipoReal['nomeSubTipoContato'];
                        $strContatoReal = @$arrContatoTipoReal['txContato'];
                        if ((empty($strTipoReal)) || (empty($strContatoReal)))
                            continue;
                        if (($strTipoNew == $strTipoReal) && ($strSubTipoNew == $strSubTipoReal) && ($strContatoNew == $strContatoReal))
                            continue(2);
                    }
                    $arrContatoTipoNew['ativo'] = true;
                    $arrContatoTipoNew['usuarioId'] = $intIdUsuarioSistema;
                    $contatoNew = $this->cadastrarContato(null, null, null, null, null, null, null, null, null, $arrContatoTipoNew);
                    $this->debugExecFile($contatoNew);
                }
                $usuario = $this->obterUsuarioPorCPF($intCpf);
                $this->debugExecFile($usuario);
                $result = $usuario->response->result;
                $arrUsuarioNew = $result->usuarios;
                $usuarioSistemaReal->usuario = reset($arrUsuarioNew);
                $result->usuarioSistema = $usuarioSistemaReal;
                $this->debugExecFile($usuario);
            }
            return $result;
        } catch (ExceptionNative $exception) {
            $this->debugExecFile($exception);
            throw $exception;
        }
    }

}
