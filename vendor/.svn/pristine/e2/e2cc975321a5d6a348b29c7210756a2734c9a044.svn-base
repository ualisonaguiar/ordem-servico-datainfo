<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHtmlHelper;
use InepZend\View\Helper\InterfaceHtmlHeadHelper;
use InepZend\View\Helper\MapHtmlHead;
use InepZend\View\Util\JavaScriptPacker;
use InepZend\View\Util\Minify_CSS_Compressor;
use InepZend\FormGenerator\FormGenerator;
use InepZend\Navigation\Navigation;
use InepZend\View\ThemeTrait;
use InepZend\Util\FileSystem;
use InepZend\Util\PhpIni;
use Zend\View\Helper\HeadLink;
use Zend\View\Helper\HeadScript;

abstract class AbstractHtmlHeadHelper extends AbstractHtmlHelper implements InterfaceHtmlHeadHelper
{

    use MapHtmlHead,
        ThemeTrait;

    const OPTIMIZER = true;
    const GULP = true;
    const FULL_GENERATE = false;
    const THEME_INEPVENDOR = self::OPTIMIZER;
    const INEPZEND_CSS_MIN_USE = self::OPTIMIZER;
    const INEPZEND_JAVASCRIPT_MIN_USE = self::OPTIMIZER;
    const ALL_CSS_GZIP_USE = self::OPTIMIZER;
    const ALL_JAVASCRIPT_GZIP_USE = self::OPTIMIZER;
    const INEPZEND_CSS_MIN_GENERATE = false;
    const INEPZEND_JAVASCRIPT_MIN_GENERATE = false;
    const ALL_CSS_GZIP_GENERATE = false;
    const ALL_JAVASCRIPT_GZIP_GENERATE = false;
    const COMPONENT_JQUERY_VALIDATE = 'jquery-validate';
    const COMPONENT_JQUERY_UI_TIMEPICKER_ADDON = 'jquery-ui-timepicker-addon';
    const COMPONENT_JQUERY_UI = 'jquery-ui';
    const COMPONENT_JQUERY_MIGRATE = 'jquery-migrate';
    const COMPONENT_JQUERY_MASKMONEY = 'jquery-maskmoney';
    const COMPONENT_JQUERY_MASKEDINPUT = 'jquery-maskedinput';
    const COMPONENT_JQUERY_FORM = 'jquery-form';
    const COMPONENT_JQUERY_BASE64 = 'jquery-base64';
    const COMPONENT_JQUERY_ALPHANUMERIC = 'jquery-alphanumeric';
    const COMPONENT_BOOTSTRAP = 'bootstrap';
    const COMPONENT_JQUERY = 'jquery';
    const COMPONENT_RESPONSIVE = 'responsive';
    const COMPONENT_HTML5 = 'html5';
    const COMPONENT_CUFON = 'cufon';
    const COMPONENT_PLACEHOLDERS = 'placeholders';
    const COMPONENT_FONT_AWESONE = 'font-awesome';
    const COMPONENT_EXTENDJS = 'extendjs';
    const COMPONENT_JQUERY_GRITTER = 'jquery-gritter';
    const COMPONENT_ANGULAR = 'angular';
    const COMPONENT_ANGULAR_LOADING_BAR = 'angular-loading-bar';
    const COMPONENT_ANGULAR_UI_GRID = 'ui-grid';
    const COMPONENT_JQUERY_MARK = 'jquery-mark';
    const COMPONENT_MARK = 'mark';
    const PATH_GENERATED_JSON = 'data/tmp/html-header/generated.json';
    const PATH_DIST_ALL_JS = '/vendor/InepZend/dist/js/all.min.js';
    const PATH_DIST_ALL_CSS = '/vendor/InepZend/dist/css/all.min.css';
    const FILE_THEME_INEPVENDOR = 'inep-vendor';

    private $arrComponentVersion = array(
        self::COMPONENT_ANGULAR_LOADING_BAR => '0.8.0',
        self::COMPONENT_ANGULAR => '1.4.8',
        self::COMPONENT_JQUERY_GRITTER => '1.7.4',
        self::COMPONENT_EXTENDJS => '0.2.3',
        self::COMPONENT_PLACEHOLDERS => '3.0.2',
        self::COMPONENT_JQUERY_VALIDATE => '1.11.0pre',
        self::COMPONENT_JQUERY_UI => '1.11.4',
        self::COMPONENT_JQUERY_MIGRATE => '1.2.1',
        self::COMPONENT_JQUERY_MASKEDINPUT => '1.3.1',
        self::COMPONENT_CUFON => '1.09i',
        self::COMPONENT_BOOTSTRAP => '3.0.3',
        self::COMPONENT_JQUERY => '1.10.2',
        self::COMPONENT_RESPONSIVE => '1.1.0',
        self::COMPONENT_HTML5 => '3.6.2',
        self::COMPONENT_JQUERY_MARK => '8.10.1',
        self::COMPONENT_MARK => '8.9.1',
    );

    public function __invoke($renderer = null)
    {
        $this->debugExec(__FUNCTION__);
        parent::__invoke($renderer);
        $this->generateOther();
        $this->generateFull();
        return $this;
    }

    public function meta()
    {
        $this->debugExec(__FUNCTION__);
        if (!is_object(self::getRenderer()))
            return;
        return self::getRenderer()->headMeta()->appendName('viewport', 'width=device-width, initial-scale=1.0')
                        ->appendHttpEquiv('X-UA-Compatible', 'IE=edge')
                        ->appendHttpEquiv('Content-Type', 'text/html; charset=utf-8');
    }

    public function title($strTitle)
    {
        $this->debugExec(__FUNCTION__);
        if (!is_object(self::getRenderer()))
            return;
        if (empty($strTitle))
            $strTitle = 'Inep';
        return self::getRenderer()->headTitle($strTitle)->setSeparator(' - ')->setAutoEscape(false);
    }

    public function link($arrPrependStylesheet = null, $arrDefautFileRemove = null)
    {
        $this->debugExec(__FUNCTION__);
        if (!is_object(self::getRenderer()))
            return;
        $headLink = self::getRenderer()->headLink(array('rel' => 'shortcut icon', 'type' => 'image/vnd.microsoft.icon', 'href' => $this->basePath() . '/vendor/InepZend/images/favicon-inep.ico'));
        $arrFile = [];
        if (self::hasGulp() === true) {
            if ($this->getThemeOption('style_application') !== false)
                $arrFile[] = '/css/style-application.css';
            foreach ($arrPrependStylesheet as $intKey => $mixPrependStylesheet) {
                if (is_array($mixPrependStylesheet))
                    unset($arrPrependStylesheet[$intKey]);
                elseif (strpos($mixPrependStylesheet, '/theme-color/') !== false)
                    $arrFile[] = $mixPrependStylesheet;
            }
            $arrFile[] = [self::PATH_DIST_ALL_CSS, 'all'];
            $this->setComponentVersionFile($headLink, 'prependStylesheet', $arrFile, null, true);
            return $headLink;
        }
        $arrFile[] = '/vendor/InepZend/css/style-general.css';
        if ($this->getThemeOption('style_application') !== false)
            $arrFile[] = '/css/style-application.css';
        if (is_array($arrPrependStylesheet))
            $arrFile = array_merge($arrFile, $arrPrependStylesheet);
        $arrFile = array_merge($arrFile, array(
            array('/vendor/InepZend/css/print.css', 'print'),
            '/vendor/InepZend/css/style-button-basic.css',
            '/vendor/InepZend/css/style-icon-basic.css',
        ));
        $this->removeFile($arrFile, $arrDefautFileRemove);
        if (self::isThemeInepVendor()) {
            $strFileThemeInepVendor = $this::PATH . '/css/' . self::FILE_THEME_INEPVENDOR . '.css';
            $arrFileMerge = array();
            foreach ($arrFile as $intKey => $mixFile) {
                if ((is_array($mixFile)) || (stripos($mixFile, '/vendor/InepZend/') === false) || (stripos($mixFile, '/vendor.') !== false) || (stripos($mixFile, '/main.') !== false) || (stripos($mixFile, '/theme-color/') !== false) || (stripos($mixFile, 'style-screen') !== false) || (stripos($mixFile, 'style-mobile') !== false)) {
                    $arrFileMerge[] = $mixFile;
                    if ((!is_array($mixFile)) && (stripos($mixFile, '/theme-color/') !== false))
                        $arrFileMerge[self::FILE_THEME_INEPVENDOR] = null;
                }
            }
            if (self::FULL_GENERATE) {
                $strThemeInepVendor = '';
                $strPublicPath = self::getPathPublic();
                foreach ($arrFile as $intKey => $mixFile) {
                    if ((empty($mixFile)) || (in_array($mixFile, $arrFileMerge)) || (stripos($mixFile, self::FILE_THEME_INEPVENDOR) !== false))
                        continue;
                    $strThemeInepVendor .= FileSystem::getContentFromFile($strPublicPath . $mixFile);
                }
                FileSystem::insertContentIntoFile($strPublicPath . $strFileThemeInepVendor, $strThemeInepVendor);
                $this->generateIncludeFile(array('css' => array($strFileThemeInepVendor)), true);
            }
            if (array_key_exists(self::FILE_THEME_INEPVENDOR, $arrFileMerge)) {
                $arrFileMerge[self::FILE_THEME_INEPVENDOR] = $strFileThemeInepVendor;
                $arrFile = array_values($arrFileMerge);
            } else
                $arrFile = array_merge(array($strFileThemeInepVendor), $arrFileMerge);
        }
        $this->setComponentVersionFile($headLink, 'prependStylesheet', $arrFile, null, true);
        $this->setComponentVersionFileFromMap($headLink);
        return $headLink;
    }

    public function script($arrPrependFile = null, $arrDefautFileRemove = null, $intOrderFile = null, $intOrderFileFromMap = null)
    {
        $this->debugExec(__FUNCTION__);
        if (!is_object(self::getRenderer()))
            return;
        $headScript = self::getRenderer()->headScript();
        if (self::hasGulp() === true) {
            $arrFile = [self::PATH_DIST_ALL_JS];
            $this->setComponentVersionFile($headScript, 'prependFile', $arrFile);
            return $headScript;
        }
        $arrFile = array(
            '/vendor/InepZend/js/cookie.js',
            '/vendor/InepZend/js/corporative-ajax.js',
            '/vendor/InepZend/js/webservice-ajax.js',
            '/vendor/InepZend/js/message.js',
            '/vendor/InepZend/js/ajax.js',
            '/vendor/InepZend/js/dialog.js',
            '/vendor/InepZend/js/form.js',
            '/vendor/InepZend/js/xml.js',
            '/vendor/InepZend/js/validate.js',
            '/vendor/InepZend/js/string.js',
            '/vendor/InepZend/js/print.js',
            '/vendor/InepZend/js/popup.js',
            '/vendor/InepZend/js/native.js',
            '/vendor/InepZend/js/json.js',
            '/vendor/InepZend/js/format.js',
            '/vendor/InepZend/js/event.js',
            '/vendor/InepZend/js/dom.js',
            '/vendor/InepZend/js/date.js',
            '/vendor/InepZend/js/client.js',
            '/vendor/InepZend/js/array.js',
            '/vendor/InepZend/js/include.js',
        );
        $this->removeFile($arrFile, $arrDefautFileRemove);
        if (self::isThemeInepVendor()) {
            $strFileThemeInepVendor = $this::PATH . '/js/' . self::FILE_THEME_INEPVENDOR . '.js';
            if (self::FULL_GENERATE) {
                if (is_array($arrPrependFile))
                    $arrFile = array_merge($arrFile, $arrPrependFile);
                $strPublicPath = self::getPathPublic();
                $strThemeInepVendor = '';
                foreach ($arrFile as $intKey => $strFile) {
                    if ((stripos($strFile, '/vendor/InepZend/') === false) || (stripos($strFile, self::FILE_THEME_INEPVENDOR) !== false))
                        continue;
                    $strThemeInepVendor .= FileSystem::getContentFromFile($strPublicPath . $strFile);
                }
                FileSystem::insertContentIntoFile($strPublicPath . $strFileThemeInepVendor, $strThemeInepVendor);
                $this->generateIncludeFile(array('js' => array($strFileThemeInepVendor)), true);
            }
            $arrFile = array($strFileThemeInepVendor);
        }
        foreach ($arrFile as $intKey => $strFile) {
            if ($this->managerInepZendJavascriptMin($strFile) === false)
                continue;
            $arrFile[$intKey] = $strFile;
        }
        if (((!self::THEME_INEPVENDOR) || (!defined('static::PATH'))) && (is_array($arrPrependFile)))
            $arrFile = array_merge($arrFile, $arrPrependFile);
        if (is_null($intOrderFile))
            $intOrderFile = 0;
        if (is_null($intOrderFileFromMap))
            $intOrderFileFromMap = 1;
        if ($intOrderFile == $intOrderFileFromMap)
            ++$intOrderFileFromMap;
        if ($intOrderFile > $intOrderFileFromMap) {
            $this->setComponentVersionFileFromMap($headScript);
            $this->setComponentVersionFile($headScript, 'prependFile', $arrFile);
        } else {
            $this->setComponentVersionFile($headScript, 'prependFile', $arrFile);
            $this->setComponentVersionFileFromMap($headScript);
        }
        return $headScript;
    }

    public function complement()
    {
        $this->debugExec(__FUNCTION__);
        if (!is_object(self::getRenderer()))
            return;
        return self::getRenderer()->applicationInfo()->showGoogleAnalytics() . self::getRenderer()->applicationInfo()->showFromThemeOption();
    }

    public static function checkCompress()
    {
        $booZlibOutputCompression = PhpIni::getZlibOutputCompression();
        return (empty($booZlibOutputCompression));
    }

    public static function getSufixCssMin()
    {
        return (self::INEPZEND_CSS_MIN_USE) ? '.min' : '';
    }

    public static function getSufixJsMin()
    {
        return (self::INEPZEND_JAVASCRIPT_MIN_USE) ? '.min' : '';
    }

    public static function getSufixCssGzip()
    {
        return (self::ALL_CSS_GZIP_USE) ? '.php' : '';
    }

    public static function getSufixJsGzip()
    {
        return (self::ALL_JAVASCRIPT_GZIP_USE) ? '.php' : '';
    }

    public static function getSufixCss()
    {
        return self::getSufixCssMin() . '.css' . self::getSufixCssGzip();
    }

    public static function getSufixJs()
    {
        return self::getSufixJsMin() . '.js' . self::getSufixJsGzip();
    }

    public static function prependIncludeFile(&$arrIncludeFile = null, $viewJs = null, $viewCss = null, $strComponentPath = null)
    {
        if (!is_array($arrIncludeFile))
            return false;
        foreach ($arrIncludeFile as $strTypeFile => &$arrPathFile) {
            $strMethodManagerAllGzip = null;
            $view = null;
            $strMethod = null;
            if ($strTypeFile == 'js') {
                $strMethodManagerAllGzip = 'managerAllJavascriptGzip';
                $view = $viewJs;
                $strMethod = 'prependFile';
            } elseif ($strTypeFile == 'css') {
                $strMethodManagerAllGzip = 'managerAllCssGzip';
                $view = $viewCss;
                $strMethod = 'prependStylesheet';
            }
            if ((!empty($strMethodManagerAllGzip)) && (!empty($strMethod))) {
                foreach ($arrPathFile as &$strPath) {
                    $strFile = self::execMethodManagerAllGzip($strPath, $strMethodManagerAllGzip, $strComponentPath);
                    if (is_object($view))
                        $view->$strMethod($strComponentPath . $strPath);
                    if (!is_bool($strFile))
                        $strPath = $strFile;
                }
            }
        }
        return true;
    }

    public static function execMethodManagerAllGzip(&$strFile, $strMethodManagerAllGzip, $strComponentPath)
    {
        if ((empty($strFile)) || (empty($strMethodManagerAllGzip)) || (!in_array($strMethodManagerAllGzip, array('managerAllJavascriptGzip', 'managerAllCssGzip'))))
            return false;
        if (empty($strComponentPath))
            self::$strMethodManagerAllGzip($strFile);
        else {
            $strComponentPathEd = (string) $strComponentPath . $strFile;
            self::$strMethodManagerAllGzip($strComponentPathEd);
            $strFile = str_replace((string) $strComponentPath, '', $strComponentPathEd);
        }
        return $strFile;
    }

    public function render($booMenu = true, $booEchoResult = true, $strClassMenuHelper = null, $strNameMenu = null, $strClassNavigation = null, $arrAttributeExtraOpen = null)
    {
        $strResult = $this->open(false, $arrAttributeExtraOpen);
        $strHtmlBreadCrumbsResult = '<div><div id="Breadcrumbs" class="breadcrumb" style="display: none;"></div></div>';
        $mixDivMenu = null;
        if ($booMenu) {
            if (empty($strNameMenu))
                $strNameMenu = @$GLOBALS['view_variable']['strNameMenu'];
            if (empty($strNameMenu))
                $strNameMenu = Navigation::NAME_MENU_PUBLIC;
            if ((($strNameMenu == Navigation::NAME_MENU_AUTHENTICATED) && (self::getRenderer()->authentication()->hasIdentity())) || ($strNameMenu != Navigation::NAME_MENU_AUTHENTICATED)) {
                if (empty($strClassNavigation))
                    $strClassNavigation = @$GLOBALS['view_variable']['strClassNavigation'];
                if (empty($strClassNavigation))
                    $strClassNavigation = self::getRenderer()->applicationInfo()->getModule() . '\Navigation\Navigation';
                if (empty($strClassMenuHelper))
                    $strClassMenuHelper = @$GLOBALS['view_variable']['strClassMenuHelper'];
                if (empty($strClassMenuHelper))
                    $strClassMenuHelper = str_replace('HtmlHead', 'Menu', get_class($this));
//                try {
                $navigation = self::getRenderer()->navigation($strClassNavigation)->setTranslatorEnabled(false);
                $navigation->getPluginManager()->setInvokableClass('menu', $strClassMenuHelper);
                if ($navigationConsult = $navigation->findOneByLabel($strNameMenu)) {
                    $menuHelper = $navigation->menu();
                    $mixDivMenu = $menuHelper->renderMenu($navigationConsult, $navigation->breadcrumbs(), ($strClassNavigation == 'InepZend\Navigation\Navigation') ? null : self::getRenderer()->applicationInfo()->getModule());
                    if (method_exists($menuHelper, 'getHtmlBreadCrumbsResult'))
                        $strHtmlBreadCrumbsResult = $menuHelper->getHtmlBreadCrumbsResult();
                }
//                } catch (\Exception $exception) {
//
//                }
            }
        }
        $strResult .= $this->meta();
        $strResult .= $this->title(self::getRenderer()->applicationInfo()->getApplicationInfoName());
        $strResult .= self::getRenderer()->globalJs(array(
            'strGlobalBasePath' => self::getRenderer()->basePath(),
            'strGlobalSufixTransferNotSelectable' => FormGenerator::getSufixTransferNotSelectable(),
            'strGlobalPrefixDdd' => FormGenerator::getPrefixDdd(),
//            'strGlobalListDdd' => FormGenerator::listDdd(),
            'strGlobalListDdd9Digit' => FormGenerator::listDdd(true),
            'strGlobalControlAlterSessionIdCallback' => self::getRenderer()->applicationInfo()->getAutoloadApplicationInfoParamsControlAlterSessionIdCallback(),
            'strGlobalControlAlterSessionIdCallbackDefault' => self::getRenderer()->applicationInfo()->getControlAlterSessionIdCallbackDefault(),
            'strGlobalShowFileUrl' => getShowFileUrl(),
            'strGlobalSufixCssMin' => self::getRenderer()->applicationInfo()->getSufixCssMin(),
            'strGlobalSufixJsMin' => self::getRenderer()->applicationInfo()->getSufixJsMin(),
            'strGlobalSufixCssGzip' => self::getRenderer()->applicationInfo()->getSufixCssGzip(),
            'strGlobalSufixJsGzip' => self::getRenderer()->applicationInfo()->getSufixJsGzip(),
            'strGlobalThemeDefined' => $this->getTheme(),
            'intGlobalOptimizer' => (integer) self::OPTIMIZER,
            'intGlobalGulp' => (integer) self::hasGulp(),
            'strGlobalInitRoute' => (@$GLOBALS['authServiceAdapter']['callback']['route']) ? $GLOBALS['authServiceAdapter']['callback']['route'] : 'inicial',
            'strGlobalEnvironmentName' => self::getRenderer()->applicationInfo()->getEnvironmentName(),
            'intGlobalMenuFix' => (integer) (!(self::getRenderer()->applicationInfo()->getThemeOption('menu_fix') === false)),
        ));
        $strResult .= $this->link();
        $strResult .= $this->script();
        $strResult .= $this->complement();
        $strResult .= $this->close(false);
        $arrInfo = array();
        if (!empty($mixDivMenu))
            $arrInfo['mixDivMenu'] = $mixDivMenu;
        $arrInfo['strHtmlBreadCrumbsResult'] = $strHtmlBreadCrumbsResult;
        if ($booEchoResult)
            echo $strResult;
        return array($strResult, $arrInfo);
    }

    public function open($booEchoResult = true, $arrAttributeExtra = null)
    {
        $arrInfoFromAttributeExtra = $this->getInfoFromAttributeExtra($arrAttributeExtra);
        $strAttributeExtra = $arrInfoFromAttributeExtra[0];
        return $this->echoReturnResult('<head' . $strAttributeExtra . '>', $booEchoResult);
    }

    public function close($booEchoResult = true)
    {
        return $this->echoReturnResult('</head>', $booEchoResult);
    }
    
    public static function hasGulp()
    {
        return (self::isThemeAdministrativeResponsible()) ? self::GULP : false;
    }

    protected function removeFile(&$arrFile = null, $arrFileRemove = null)
    {
        if ((is_array($arrFile)) && (count($arrFile) > 0) && (is_array($arrFileRemove)) && (count($arrFileRemove) > 0)) {
            foreach ($arrFileRemove as $mixFileRemove)
                if (($mixKey = array_search($mixFileRemove, $arrFile)) !== false)
                    unset($arrFile[$mixKey]);
            return true;
        }
        return false;
    }

    protected function setComponentVersion($arrComponentVersion)
    {
        $this->arrComponentVersion = $arrComponentVersion;
        return $this;
    }

    protected function getComponentVersion()
    {
        return (array) $this->arrComponentVersion;
    }

    private function setComponentVersionFileFromMap($headElement = null)
    {
        if (!is_object($headElement))
            return;
        $arrMapComponentVersionFile = $this->getMapComponentVersionFile();
        if ((!is_array($arrMapComponentVersionFile)) || (count($arrMapComponentVersionFile) == 0))
            return;
        foreach ($this->getComponentVersion() as $strComponent => $strVersion) {
            if (is_null($strVersion))
                continue;
            $strComponentPath = '/vendor/' . str_replace(array('ui-grid'), array('angular-ui'), $strComponent) . '/' . $strComponent . '-' . $strVersion . '/';
            if (array_key_exists($strComponent, $arrMapComponentVersionFile)) {
                $arrVersion = array($strVersion, 'default');
                foreach ($arrVersion as $strVersionToMap) {
                    if (array_key_exists($strVersionToMap, $arrMapComponentVersionFile[$strComponent])) {
                        foreach ($arrMapComponentVersionFile[$strComponent][$strVersionToMap] as $strMethod => $arrFile)
                            $this->setComponentVersionFile($headElement, $strMethod, $arrFile, $strComponentPath, true);
                    }
                }
            }
        }
    }

    private function setComponentVersionFile($headElement = null, $strMethod = null, &$arrFile = null, $strComponentPath = null, $booManagerInepZendMin = false)
    {
        if ((!$headElement instanceof HeadScript) && (!$headElement instanceof HeadLink))
            return false;
        if ((stripos($strMethod, 'file') === false) && (stripos($strMethod, 'stylesheet') === false))
            return false;
        if ((!is_array($arrFile)) || (count($arrFile) == 0))
            return false;
        if (((stripos($strMethod, 'file') !== false) && (!$headElement instanceof HeadScript)) || ((stripos($strMethod, 'stylesheet') !== false) && (!$headElement instanceof HeadLink)))
            return false;
//        if (!is_dir('./public' . (string) $strComponentPath)) // validacao de alto custo de processamento
//            return false;
        if ($booManagerInepZendMin === true) {
            $strMethodManagerInepZendMin = (stripos($strMethod, 'file') !== false) ? 'managerInepZendJavascriptMin' : 'managerInepZendCssMin';
            foreach ($arrFile as $intKey => $mixFile) {
                $strFile = (is_array($mixFile)) ? $mixFile[0] : $mixFile;
                if ($this->$strMethodManagerInepZendMin($strFile) === false)
                    continue;
                if (is_array($mixFile))
                    $arrFile[$intKey][0] = $strFile;
                else
                    $arrFile[$intKey] = $strFile;
            }
        }
        $strComponentBasePath = $this->basePath() . (string) $strComponentPath;
        $strMethodManagerAllGzip = (stripos($strMethod, 'file') !== false) ? 'managerAllJavascriptGzip' : 'managerAllCssGzip';
        foreach ($arrFile as $mixFile) {
            if (!is_array($mixFile)) {
                self::execMethodManagerAllGzip($mixFile, $strMethodManagerAllGzip, $strComponentPath);
                $headElement->$strMethod(((strpos($mixFile, 'http') === false) ? $strComponentBasePath : '') . $mixFile);
            } else {
                if (count($mixFile) == 0)
                    continue;
                self::execMethodManagerAllGzip($mixFile[0], $strMethodManagerAllGzip, $strComponentPath);
                if (count($mixFile) == 1)
                    $headElement->$strMethod($strComponentBasePath . $mixFile[0]);
                else {
                    if (stripos($strMethod, 'file') !== false)
                        $headElement->$strMethod($strComponentBasePath . $mixFile[0], 'text/javascript', $mixFile[1]);
                    else
                        $headElement->$strMethod($strComponentBasePath . $mixFile[0], $mixFile[1]);
                }
            }
        }
        return true;
    }

    private function managerInepZendCssMin(&$strFile = null)
    {
        return self::managerInepZendMin($strFile, 'css');
    }

    private function managerInepZendJavascriptMin(&$strFile = null)
    {
        return self::managerInepZendMin($strFile, 'javascript');
    }

    private function managerInepZendMin(&$strFile = null, $strType = null)
    {
        if ((empty($strFile)) || (!in_array(strtolower($strType), array('css', 'javascript'))) || ((strpos($strFile, 'vendor/InepZend') === false) && (strpos($strFile, '/inep-zend.') === false)))
            return false;
        eval('$booGenerate = (self::INEPZEND_' . strtoupper($strType) . '_MIN_GENERATE);');
        eval('$booUse = (self::INEPZEND_' . strtoupper($strType) . '_MIN_USE);');
        if (($booGenerate === true) && (self::FULL_GENERATE !== true))
            self::insertMinContent($strFile, $strType);
        if ($booUse === true)
            $strFile = self::concatMinIntoFileName($strFile);
        return true;
    }

    private static function managerAllCssGzip(&$strFile = null)
    {
        return self::managerAllGzip($strFile, 'css');
    }

    private static function managerAllJavascriptGzip(&$strFile = null)
    {
        return self::managerAllGzip($strFile, 'javascript');
    }

    private static function managerAllGzip(&$strFile = null, $strType = null)
    {
        if ((empty($strFile)) || (!in_array(strtolower($strType), array('css', 'javascript'))) || (strpos($strFile, '/css/') === 0) || (strpos($strFile, '/images/') === 0) || (strpos($strFile, '/js/') === 0))
            return false;
        eval('$booGenerate = (self::ALL_' . strtoupper($strType) . '_GZIP_GENERATE);');
        eval('$booUse = (self::ALL_' . strtoupper($strType) . '_GZIP_USE);');
        if (($booGenerate === true) && (self::FULL_GENERATE !== true))
            self::insertGzipContent($strFile, $strType);
        if ($booUse === true)
            $strFile = self::concatPhpIntoFileName($strFile);
        return true;
    }

    private static function hasMinContent($strFile = null)
    {
        $arrNotMinContent = array(
            '/vendor/InepZend/theme/administrative-responsible/js/vendor/',
            '/vendor/InepZend/theme/administrative-responsible/js/demo.js',
            '/vendor/InepZend/theme/administrative-responsible/js/main.js',
            '/vendor/InepZend/theme/administrative-responsible/js/vendor.js',
        );
        foreach ($arrNotMinContent as $strNotMinContent) {
            if (stripos($strFile, $strNotMinContent) === false)
                continue;
            return false;
        }
        return true;
    }

    private static function insertMinContent($strFile = null, $strType = null)
    {
        if ((empty($strFile)) || (!in_array(strtolower($strType), array('css', 'javascript'))))
            return false;
        if (!is_file($strComponentFile = './public' . $strFile))
            return false;
        if (!self::hasMinContent($strFile))
            return $strFile;
        $strOldContent = FileSystem::getContentFromFile($strComponentFile);
        $strNewFile = self::concatMinIntoFileName($strFile);
        if (self::hasGeneratedContent($strNewFile, $strOldContent))
            return true;
        self::insertGeneratedContent($strNewFile, $strOldContent);
        $strType = strtolower($strType);
        if ($strType == 'css') {
            PhpIni::setMaxExecutionTime(0);
            PhpIni::setMemoryLimit(-1);
        }
        $strContent = ($strType == 'css') ? Minify_CSS_Compressor::process($strOldContent) : (new JavaScriptPacker($strOldContent, 'None', true, false))->pack();
        FileSystem::insertContentIntoFile(self::concatMinIntoFileName($strComponentFile), $strContent);
        return $strNewFile;
    }

    private static function insertGzipContent($strFile = null, $strType = null)
    {
        if ((empty($strFile)) || (!in_array(strtolower($strType), array('css', 'javascript'))))
            return false;
        if (!is_file($strComponentFile = './public' . $strFile))
            return false;
        $strOldContent = FileSystem::getContentFromFile($strComponentFile);
        $strNewFile = self::concatPhpIntoFileName($strFile);
        if (self::hasGeneratedContent($strNewFile, $strOldContent))
            return true;
        self::insertGeneratedContent($strNewFile, $strOldContent);
        $strContent = '<?php 
$intLastModifiedTime = filemtime(__FILE__);
$strETag = md5_file(__FILE__);
header("Last-Modified: " . gmdate("D, d M Y H:i:s", $intLastModifiedTime) . " GMT");
header("Etag: " . $strETag);
header("Content-Type: text/' . strtolower($strType) . '");
header("Cache-Control: max-age=604800, public, must-revalidate");
header("Pragma: max-age=604800, public, must-revalidate");
if ((is_null($mixZlib = ini_get("zlib.output_compression"))) || ($mixZlib == ""))
    ini_set("zlib.output_compression", true);
header("Accept-Encoding: gzip");
if ((@strtotime($_SERVER["HTTP_IF_MODIFIED_SINCE"]) == $intLastModifiedTime) || (trim(@$_SERVER["HTTP_IF_NONE_MATCH"]) == $strETag)) {
    header("HTTP/1.1 304 Not Modified");
    exit;
}
?>
' . $strOldContent;
        FileSystem::insertContentIntoFile(self::concatPhpIntoFileName($strComponentFile), $strContent);
        return $strNewFile;
    }

    private static function concatMinIntoFileName($strFile = null)
    {
        if (empty($strFile))
            return;
        if ((!self::hasMinContent($strFile)) || (stripos($strFile, '.min.') !== false))
            return $strFile;
        $intLen = strlen(end($arrExplode = explode('.', $strFile))) + 1;
        return substr($strFile, 0, (strlen($strFile) - $intLen)) . '.min' . substr($strFile, (strlen($strFile) - $intLen));
    }

    private static function concatPhpIntoFileName($strFile = null)
    {
        if (empty($strFile))
            return;
        return (stripos($strFile, '.php') === false) ? $strFile . '.php' : $strFile;
    }

    private function globFromPublicVendor($strExtension = null, $booExcludeInepZend = null)
    {
        if (empty($strExtension))
            return array();
        $strPublicPath = self::getPathPublic();
        $arrPathRestrict = ($booExcludeInepZend !== false) ? array($strPublicPath . '/vendor/InepZend') : array();
        $arrPathRestrict = array_merge($arrPathRestrict, array($strPublicPath . '/vendor/angular/angular-1.4.8/docs', $strPublicPath . '/vendor/node_modules'));
        $arrFile = FileSystem::scandirRecursive($strPublicPath . '/vendor', $strExtension, $arrPathRestrict);
        foreach ($arrFile as &$strFile)
            $strFile = str_replace($strPublicPath, '', $strFile);
        return $arrFile;
    }

    private function generateOther()
    {
        $arrIncludeFile = array();
        if (self::FULL_GENERATE !== true) {
            if ((self::ALL_CSS_GZIP_GENERATE === true) && (count($arrFile = $this->globFromPublicVendor('css')) > 0))
                $arrIncludeFile['css'] = $arrFile;
            if ((self::ALL_JAVASCRIPT_GZIP_GENERATE === true) && (count($arrFile = $this->globFromPublicVendor('js')) > 0))
                $arrIncludeFile['js'] = $arrFile;
        }
        if (count($arrIncludeFile) == 0)
            return false;
        self::prependIncludeFile($arrIncludeFile, null, null, $this->basePath());
        return true;
    }

    private function generateFull()
    {
        $this->debugExec(__FUNCTION__);
        $arrIncludeFile = array();
        if (self::FULL_GENERATE === true) {
            if (count($arrFile = $this->globFromPublicVendor('css', false)) > 0)
                $arrIncludeFile = array_merge(array('css' => $arrFile), $arrIncludeFile);
            if (count($arrFile = $this->globFromPublicVendor('js', false)) > 0)
                $arrIncludeFile = array_merge(array('js' => $arrFile), $arrIncludeFile);
        }
        $booGenerate = $this->generateIncludeFile($arrIncludeFile);
        return (!$booGenerate) ? false : self::clearGeneratedContent();
    }

    private function generateIncludeFile($arrIncludeFile = null, $booThemeInepVendor = null)
    {
        if ((!is_array($arrIncludeFile)) || (count($arrIncludeFile) == 0))
            return false;
        foreach ($arrIncludeFile as $strExtension => &$arrFile)
            foreach ($arrFile as $intKey => $strFile) {
                if ((strpos($strFile, '/all.min.') === false) && ((strpos($strFile, '/vendor/InepZend') !== false) || (strpos($strFile, '/inep-zend.') !== false)))
                    if ((stripos($strFile, '.min.' . $strExtension) !== false) || (($booThemeInepVendor !== true) && (stripos($strFile, self::FILE_THEME_INEPVENDOR) !== false)))
                        unset($arrFile[$intKey]);
            }
        foreach ($arrIncludeFile as $strExtension => &$arrFile) {
            $arrNewFile = array();
            $strType = (strtolower($strExtension) == 'js') ? 'javascript' : strtolower($strExtension);
            foreach ($arrFile as $strFile) {
                $mixResult = self::insertGzipContent($strFile, $strType);
                if (!is_bool($mixResult))
                    $arrNewFile[] = $mixResult;
                if ((strpos($strFile, '/all.min.') === false) && ((strpos($strFile, '/vendor/InepZend') !== false) || (strpos($strFile, '/inep-zend.') !== false))) {
                    $mixResult = self::insertMinContent($strFile, $strType);
                    if (!is_bool($mixResult)) {
                        $arrNewFile[] = $mixResult;
                        $mixResult = self::insertGzipContent($mixResult, $strType);
                        if (!is_bool($mixResult))
                            $arrNewFile[] = $mixResult;
                    }
                }
            }
            $arrFile = array_merge($arrFile, $arrNewFile);
            sort($arrFile);
            $arrFile = array_values($arrFile);
        }
        return true;
    }

    private static function getPathGeneratedJson()
    {
        return __DIR__ . '/../../../../' . self::PATH_GENERATED_JSON;
    }

    private static function getPathPublic()
    {
        return __DIR__ . '/../../../../../../public';
    }

    private static function hasGeneratedContent($strFile = null, $strContent = null)
    {
        $arrResult = self::getGeneratedContent();
        if (!array_key_exists($strFile, $arrGenerated = $arrResult[0]))
            return false;
        return (md5($strContent) === $arrGenerated[$strFile]);
    }

    private static function insertGeneratedContent($strFile = null, $strContent = null)
    {
        $arrResult = self::getGeneratedContent();
        $arrGenerated = $arrResult[0];
        $generated = $arrResult[1];
        $arrGenerated[$strFile] = md5($strContent);
        return self::writeGeneratedContent($arrGenerated, $generated);
    }

    private static function clearGeneratedContent()
    {
        $arrResult = self::getGeneratedContent();
        $arrGenerated = $arrResult[0];
        $generated = $arrResult[1];
        foreach ($arrGenerated as $strFile => $strContentMd5) {
            if ((stripos($strFile, '/vendor/InepZend/theme/') === false) && (!is_file('./public' . $strFile)))
                unset($arrGenerated[$strFile]);
        }
        return self::writeGeneratedContent($arrGenerated, $generated);
    }

    private static function getGeneratedContent()
    {
        $strGenerated = FileSystem::getContentFromFile(self::getPathGeneratedJson());
        $generated = (empty($strGenerated)) ? new \stdClass() : json_decode($strGenerated);
        if (!property_exists($generated, 'arrGenerated'))
            $generated->arrGenerated = array();
        $arrGenerated = (array) $generated->arrGenerated;
        return array($arrGenerated, $generated);
    }

    private static function writeGeneratedContent(array $arrGenerated = array(), $generated = null)
    {
        if (!is_object($generated))
            return false;
        ksort($arrGenerated);
        $generated->arrGenerated = $arrGenerated;
        ob_start();
        echo trim(json_encode($generated, JSON_PRETTY_PRINT));
        $strGenerated = ob_get_clean();
        return FileSystem::insertContentIntoFile(self::getPathGeneratedJson(), $strGenerated);
    }

    private static function isThemeInepVendor()
    {
        return ((self::THEME_INEPVENDOR) && (defined('static::PATH')));
    }

}
