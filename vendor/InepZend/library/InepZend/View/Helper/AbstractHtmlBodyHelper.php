<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHtmlHelper;

abstract class AbstractHtmlBodyHelper extends AbstractHtmlHelper
{

    public function open($booEchoResult = true, $arrAttributeExtra = null)
    {
        $arrInfoFromAttributeExtra = $this->getInfoFromAttributeExtra($arrAttributeExtra);
        $strAttributeExtra = $arrInfoFromAttributeExtra[0];
        $strClass = $arrInfoFromAttributeExtra[1];
        return $this->echoReturnResult('<body class="' . $strClass . self::getRenderer()->applicationInfo()->getRoute() . '"' . $strAttributeExtra . '>', $booEchoResult);
    }

    public function close($booEchoResult = true)
    {
        return $this->echoReturnResult('</body>', $booEchoResult);
    }

    public function renderInepBar($booEchoResult = true)
    {
        return $this->echoReturnResult('<a href="http://portal.inep.gov.br" title="Ir para o Portal Inep" class="logo" target="_self"><span>Inep</span></a>
                <div class="logoInepGray no-screen"></div>
                <div id="nomeInep">Instituto Nacional de Estudos e Pesquisas Educacionais Anísio Teixeira</div>', $booEchoResult);
    }

    public function renderBannerButton($booEchoResult = true)
    {
        return $this->echoReturnResult('<div id="botoes_banner" class="no-print">
            <ul class="ulBannerButton">
                <li>' . self::getRenderer()->socialNetwork()->renderTwitter() . '</li>
                <li>' . self::getRenderer()->socialNetwork()->renderRss() . '</li>
                <li>' . self::getRenderer()->fontSize()->renderPortal() . '</li>
            </ul>
        </div>', $booEchoResult);
    }

    public function renderNavBar($strContent = null, $strClass = null, $strId = null, $booEchoResult = true)
    {
        if (empty($strClass))
            $strClass = 'navbar navbar-inverse navbar-fixed-top';
        $strResult = '<nav' . ((!empty($strId)) ? ' id="' . $strId . '"' : '') . ' class="' . $strClass . '">';
        if (!empty($strContent))
            $strResult .= $strContent;
        $strResult .= '</nav>';
        return $this->echoReturnResult($strResult, $booEchoResult);
    }

    public function renderHeader($booEchoResult = true)
    {
        return $this->echoReturnResult('', $booEchoResult);
    }

    public function renderHeaderPortal($booEchoResult = true)
    {
        return $this->echoReturnResult('<div id="header" class="container">
            <header>
                <hgroup id="heading">
                    <h1 class="company-title">' . $this->renderInepBar(false) . '</h1>
                </hgroup>
            </header>
            ' . $this->renderBannerButton(false) . '
            <div id="tituloInternas" class="no-print">
                ' . ((is_object(self::getRenderer()->mixAbaConteudo)) ? self::getRenderer()->form()->render(self::getRenderer()->mixAbaConteudo) : (string) self::getRenderer()->mixAbaConteudo) . '
            </div>
        </div>', $booEchoResult);
    }

    public function renderArchorTop($booEchoResult = true)
    {
        return $this->echoReturnResult('<a name="topo"></a>', $booEchoResult);
    }

    public function renderContent($strClass = null, $arrHtmlHeadInfo = null, $booEchoResult = true)
    {
        $strResult = '<div id="contentBackground"' . ((!empty($strClass)) ? ' class="' . $strClass . '"' : '') . '>';
        if ((is_array($arrHtmlHeadInfo)) && (array_key_exists('mixDivMenu', $arrHtmlHeadInfo)))
            $strResult .= $arrHtmlHeadInfo['mixDivMenu'];
        $strResult .= '<div id="contentContainer" class="controlFontSize" style="overflow: hidden;">
                ' . $this->getRenderer()->message()->showMessage() . $this->getRenderer()->content . '
            </div>
        </div>';
        return $this->echoReturnResult($strResult, $booEchoResult);
    }

    public function renderFooter($strClass = null, $strTextAlign = null, $strComplement = null, $strStyleComplement = null, $booEchoResult = true)
    {
        return $this->echoReturnResult('<div id="footerBackground" class="' . (string) $strClass . '">
            <footer>
                <div style="text-align: ' . ((empty($strTextAlign)) ? 'center' : $strTextAlign) . ';">
                    &copy; ' . date('Y') . ' <b>Inep</b>. Todos os direitos reservados. SIG Quadra 04 lote 327 - Zona Industrial Brasília-DF CEP: 70610-404, Brasília - DF
                    <div class="no-print" style="' . (string) $strStyleComplement . '">
                        ' . (string) $strComplement . '
                    </div>
                </div>
            </footer>
            <div class="appVersion no-print">
                ' . self::getRenderer()->applicationInfo()->showVersion() . '
                <!-- ' . self::getRenderer()->applicationInfo()->showVersion(true) . ' -->
            </div>
        </div>', $booEchoResult);
    }

    public function renderFooterPortal($strClass = null, $strTextAlign = null, $strComplement = null, $strStyleComplement = null, $booEchoResult = true)
    {
        return $this->echoReturnResult('<div id="footerBackground" class="' . (string) $strClass . '">
            <footer>
                <div style="text-align: ' . ((empty($strTextAlign)) ? 'center' : $strTextAlign) . ';">
                    &copy; 2011 <b>Inep</b>. SIG Quadra 04 lote 327 - Zona Industrial CEP: 70610-908, Brasília - DF
                    <div class="no-print" style="' . (string) $strStyleComplement . '">
                        ' . (string) $strComplement . '
                    </div>
                </div>
            </footer>
            <div class="appVersion no-print">
                ' . self::getRenderer()->applicationInfo()->showVersion() . '
                <!-- ' . self::getRenderer()->applicationInfo()->showVersion(true) . ' -->
            </div>
        </div>', $booEchoResult);
    }

}
