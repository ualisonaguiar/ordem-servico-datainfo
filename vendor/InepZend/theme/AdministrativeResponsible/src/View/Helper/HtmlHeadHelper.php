<?php

namespace InepZend\Theme\AdministrativeResponsible\View\Helper;

use InepZend\View\Helper\AbstractHtmlHeadHelper;
use InepZend\Navigation\Navigation;
use InepZend\Util\FileSystem;
use InepZend\Util\Server;

class HtmlHeadHelper extends AbstractHtmlHeadHelper
{

    const PATH = '/vendor/InepZend/theme/administrative-responsible';

    public function meta()
    {
        if (!is_object(self::getRenderer()))
            return;
        return self::getRenderer()->headMeta()->appendName('viewport', 'width=device-width')
                        ->appendName('robots', 'index, follow')
                        ->appendName('language', 'portuguese')
                        ->appendName('email', 'contato@inep.gov.br')
                        ->appendName('author', 'INEP')
                        ->appendName('publisher', 'INEP')
                        ->appendHttpEquiv('X-UA-Compatible', 'IE=edge')
                        ->appendHttpEquiv('Content-Language', 'pt-br')
                        ->appendHttpEquiv('Content-Type', 'text/html; charset=utf-8');
    }

    public function link()
    {
        $arrComponentVersion = $this->getComponentVersion();
        $arrComponentVersion[self::COMPONENT_FONT_AWESONE] = '4.4.0';
        $arrComponentVersion[self::COMPONENT_BOOTSTRAP] = '3.2.0';
        $this->setComponentVersion($arrComponentVersion);
        $arrFiles = array();
        $intStyleThemeColor = @$_COOKIE['style_theme_color'];
        if (is_null($intStyleThemeColor))
            $intStyleThemeColor = self::getThemeColor();
        if (empty($intStyleThemeColor))
            $intStyleThemeColor = 1;
        $arrFiles[] = self::PATH . '/theme-color/style' . $intStyleThemeColor . '.css';
        $arrFiles = array_merge($arrFiles, $this->getFileTheme('css'));
        $intPosicao = array_search(self::PATH . '/css/style-print.css', $arrFiles);
        $arrFiles[$intPosicao] = array($arrFiles[$intPosicao], 'all');
        $intPosicao = array_search(self::PATH . '/css/vendor-print.css', $arrFiles);
        $arrFiles[$intPosicao] = array($arrFiles[$intPosicao], 'all');
        $intLast = count($arrFiles);
        $arrFiles[$intLast] = $arrFiles[8];
        $arrFiles[8] = $arrFiles[5];
        $arrFiles[5] = $arrFiles[$intLast];
        unset($arrFiles[$intLast]);
        $arrFiles = array_values($arrFiles);
        return parent::link(array_merge($arrFiles, array('/vendor/InepZend/menu/menu-bootstrap/css/style-responsible.css', '/vendor/InepZend/css/form-validate.css')), array(
                    '/vendor/InepZend/css/style-general.css',
                    array('/vendor/InepZend/css/print.css', 'print'),
                    '/vendor/InepZend/css/style-button-basic.css',
                        )
        );
    }

    public function script()
    {
        $arrComponentVersion = $this->getComponentVersion();
        $arrComponentVersion[self::COMPONENT_JQUERY] = '2.1.1';
        $this->setComponentVersion($arrComponentVersion);
        $arrDefautFileRemove = array(
            '/vendor/InepZend/theme/administrative-responsible/js/vendor.js', // comentado
            '/vendor/InepZend/theme/administrative-responsible/js/vendor/modernizr.js',
            '/vendor/InepZend/theme/administrative-responsible/js/main.js', // comentado
            '/vendor/InepZend/theme/administrative-responsible/js/demo.js',
        );
        $arrFile = array_merge(array('/vendor/InepZend/menu/menu-bootstrap/js/script.js', '/vendor/InepZend/js/form-validate.js'), $this->getFileTheme('js'));
        $this->removeFile($arrFile, $arrDefautFileRemove);
//        return parent::script($arrFile, $arrDefautFileRemove, 1, 0); // nao comentado
        return parent::script($arrFile, $arrDefautFileRemove);
    }

    public function render($booMenu = true, $booEchoResult = true)
    {
        $strNameMenu = @$GLOBALS['view_variable']['strNameMenu'];
        if (empty($strNameMenu))
            $strNameMenu = Navigation::NAME_MENU_AUTHENTICATED;
        $strClassNavigation = @$GLOBALS['view_variable']['strClassNavigation'];
        if (empty($strClassNavigation))
            $strClassNavigation = 'InepZend\Navigation\Navigation';
        return parent::render($booMenu, $booEchoResult, null, $strNameMenu, $strClassNavigation, array('lang' => 'pt', 'dir' => 'ltr'));
    }

    private function getFileTheme($strPath = null, $strExtension = null)
    {
        $arrFilePrepend = FileSystem::scandirRecursive(Server::getReplacedBasePathApplication('/../../../../../../../public' . self::PATH . '/' . $strPath), (empty($strExtension) ? $strPath : $strExtension));
        $arrPrepend = array();
        foreach ($arrFilePrepend as $strFile) {
            if ((stripos($strFile, '.min.') !== false) || (stripos($strFile, self::FILE_THEME_INEPVENDOR) !== false))
                continue;
            $arrExplode = explode('/' . $strPath . '/', $strFile);
            $arrPrepend[] = self::PATH . '/' . $strPath . '/' . end($arrExplode);
        }
        return $arrPrepend;
    }

}
