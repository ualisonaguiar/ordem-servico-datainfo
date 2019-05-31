<?php

namespace InepZend\Module\Oauth\Service\Ssi;

trait SenhaService
{

    public function alterarSenha($intIdUsuario = null, $strSenhaAtualOfuscada = null, $strSenhaNovaOfuscada = null, $arrParam = null)
    {
        return $this->makeCall('private/senhas/' . str_replace('Senha', '', __FUNCTION__) . '/' . $intIdUsuario, array_merge(array('idUsuario' => $intIdUsuario, 'senhaAtualOfuscada' => $strSenhaAtualOfuscada, 'senhaNovaOfuscada' => $strSenhaNovaOfuscada), (array) $arrParam), 'PUT');
    }

    public function redefinirSenha($strLogin = null, $strEmail = null, $intTokenId = null, $arrParam = null)
    {
        if (empty($intTokenId))
            $intTokenId = $this->generateSsiTokenId($strLogin, $strEmail);
        return $this->makeCall('private/senhas/' . str_replace('Senha', '', __FUNCTION__) . '/' . $intTokenId, array_merge(array('tokenId' => $intTokenId), (array) $arrParam), 'PUT');
    }

    public function resetarSenha($strLogin = null, $strEmail = null, $intTokenId = null, $arrParam = null)
    {
        return $this->redefinirSenha($strLogin, $strEmail, $intTokenId, $arrParam);
    }

}
