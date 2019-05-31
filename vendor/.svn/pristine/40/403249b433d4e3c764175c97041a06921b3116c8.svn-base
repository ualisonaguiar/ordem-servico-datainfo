<?php

namespace InepZend\Module\Oauth\Service\Ssi;

trait AutenticadorService
{

    public function autenticar($strLogin = null, $strSenha = null, $arrParam = null)
    {
        return $this->makeCall('private/autenticador/' . __FUNCTION__, array_merge(array('tokenId' => $this->generateSsiTokenId($strLogin, $strSenha)), (array) $arrParam), 'POST');
    }

}
