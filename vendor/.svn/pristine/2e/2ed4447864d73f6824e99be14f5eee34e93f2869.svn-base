<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\Session\SessionTrait;
use InepZend\View\Helper\RendererTrait;
use InepZend\Util\String;

class UserSystemHelper extends AbstractHelper
{

    use SessionTrait,
        RendererTrait;

    const SESSION_USE = true;

    public function render()
    {
        if (!self::getRenderer()->authentication()->hasIdentity())
            return;
        $strResult = '<li id="userAuthenticated" class="dropdown">
                    <a href="#" data-toggle="dropdown" accesskey="u" tabindex="6" class="dropdown-toggle" title="Usuário(a) autenticado(a)">
                        <i class="fa fa-user"></i> ' . strtoupper(String::beautifulProperName(self::getRenderer()->authentication()->getIdentity()->usuarioSistema->usuario->nome, true)) . '
                        <span class="caret"></span>
                    </a>
                    <ul role="menu" class="dropdown-menu">';
        if ($this->getThemeOption('profile') === true)
            $strResult .= $this->renderProfile() . '<li class="divider"></li>';
        $strResult .= '<li class="hide-print" title="Sair do sistema">
                            <a href="' . self::getRenderer()->url('logoff') . '" target="_self"><i class="fa fa-sign-out"></i> Sair</a>
                       </li>
                    </ul>
                </li>';
        return $strResult;
    }

    private function renderProfile()
    {
        if ((self::SESSION_USE) && (!is_null($strResult = self::getAttributeSession('strHtmlProfile'))))
            return $strResult;
        $strResult = '';
        foreach ($this->getProfile() as $profile)
            $strResult .= '
                <li class="hide-print">
                    <a href="javascript: void(0);">' . $profile->nome . '</a>
                </li>';
        if (self::SESSION_USE)
            self::setAttributeSession('strHtmlThemeColor', $strResult);
        return $strResult;
    }

    private function getProfile()
    {
        $arrProfile = array();
        foreach ((array) self::getRenderer()->authentication()->getIdentity()->usuarioSistema->perfis as $perfil) {
            if (strtoupper($perfil->nome) == 'PERFIL PADRAO PARA O SISTEMA')
                continue;
            $arrProfile[] = $perfil;
        }
        return $arrProfile;
    }

}
