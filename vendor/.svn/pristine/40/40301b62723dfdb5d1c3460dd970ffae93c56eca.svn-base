<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\Session\SessionTrait;
use InepZend\Util\FileSystem;
use InepZend\Util\Server;

class ThemeColorHelper extends AbstractHelper
{

    use SessionTrait;

    const PATH = 'public/vendor/InepZend/theme/administrative-responsible/theme-color';
    const SESSION_USE = true;

    public function render()
    {
        if ($this->getThemeOption('theme_color') !== true)
            return;
        return $this->renderStyle() . $this->renderScript() . '<li id="themeColor" class="dropdown" title="Alteração das cores do sistema">
                    <a href="#" data-toggle="dropdown" accesskey="z" tabindex="10" class="dropdown-toggle">
                        <i class="fa fa-paint-brush"></i>
                        <span class="caret"></span>
                    </a>
                    <ul role="menu" class="dropdown-menu">' . $this->renderThemeColor() . '</ul>
                </li>';
    }

    private function renderStyle()
    {
        return '<style type="text/css">
                .themeColor {
                    border: 1px solid #999999;
                    margin-left: 2px;
                }
            </style>';
    }

    private function renderScript()
    {
        return '<script type="text/javascript">
    function themeColor(strUrl, intStyle)
    {
        var link = document.createElement("LINK");
        link.setAttribute("type", "text/css");
        link.setAttribute("rel", "stylesheet");
        link.setAttribute("media", "screen");
        link.setAttribute("href", strUrl);
        document.body.appendChild(link);
        setCookie("url_theme_color", strUrl);
        setCookie("style_theme_color", intStyle);
        return true;
    }
</script>';
    }

    private function renderThemeColor()
    {
        if ((self::SESSION_USE) && (!is_null($strResult = self::getAttributeSession('strHtmlThemeColor'))))
            return $strResult;
        $intStyleDefault = $this->getThemeColor();
        $strResult = '<!--Background (2), Menu (9), Item Selecionado (11), Fundo do conteudo (13), Botao (10)-->';
        foreach ($this->getFileThemeColor() as $strFile) {
            $strUrl = $this->getBaseUrl() . '/' . end($arrExplode = explode('/public/', $strFile));
            $strFileName = end($arrExplode = explode('/', str_replace('\\', '/', $strFile)));
            $arrContent = file($strFile);
            $arrRow = array(1, 8, 10, 12, 9);
            $arrColor = array();
            foreach ($arrRow as $intRow) {
                $strContent = @$arrContent[$intRow];
                if (empty($strContent))
                    continue;
                $arrColor[] = str_replace(array('*', '/', '\\', ' '), '', reset($arrExplode = explode('-', $strContent)));
            }
            $arrColor = array_unique($arrColor);
            $strIcoColor = '';
            foreach ($arrColor as $strColor)
                $strIcoColor .= '<i class="fa fa-stop themeColor" style="color: ' . $strColor . ';"></i>';
            $intStyle = str_replace(array('style', '.css'), '', $strFileName);
            $strResult .= '
                <li class="hide-print">
                    <a href="javascript: themeColor(\'' . $strUrl . '\', ' . $intStyle . '); void(0);">Estilo ' . $intStyle . ' ' . $strIcoColor . (((!is_null($intStyleDefault)) && ($intStyle == $intStyleDefault)) ? ' (padrão)' : '') . '</a>
                </li>';
        }
        if (self::SESSION_USE)
            self::setAttributeSession('strHtmlThemeColor', $strResult);
        return $strResult;
    }

    private function getFileThemeColor()
    {
        $arrFileThemeColor = FileSystem::scandirRecursive(Server::getReplacedBasePathApplication('/../../../../../../' . self::PATH), 'css');
        $arrResult = array();
        foreach ($arrFileThemeColor as $strFile) {
            if (stripos($strFile, '.min.') !== false)
                continue;
            $arrResult[] = $strFile;
        }
        natsort($arrResult);
        return $arrResult;
    }

}
