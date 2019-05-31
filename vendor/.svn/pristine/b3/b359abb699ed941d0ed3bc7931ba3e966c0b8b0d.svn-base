<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\View\Helper\RendererTrait;
use InepZend\Util\String;
use InepZend\Util\Server;
use InepZend\Util\ApplicationInfo;
use InepZend\Util\Environment;
use InepZend\View\Helper\AbstractHtmlHeadHelper;

class ApplicationInfoHelper extends AbstractHelper
{

    use RendererTrait;

    private static $strName;
    private static $strAcronym;
    private static $strClassCssBackground;
    private static $strClassCssLogo;
    private static $strClassCssBar;
    private static $strTextBar;
    private static $strLink;
    private static $strIdAcompanhamento;
    private static $strUrlPadrao;
    private static $strVersion;
    private static $strBuildNumber;
    private static $strRevision;
    private static $strBuildTag;
    private static $strBuildDate;
    private static $strResponsible;
    private static $strServerInstance;
    private static $arrInepZendVersion;
    private static $arrAutoloadApplicationInfo;
    private static $arrAutoloadApplicationInfoParams;
    private static $arrAutoloadApplicationInfoParamsControlAlterSessionId;
    private static $arrAutoloadApplicationInfoParamsControlAlterSessionIdActive;
    private static $arrAutoloadApplicationInfoParamsControlAlterSessionIdCallback;
    private static $arrAutoloadApplicationInfoParamsEditMyInfo;
    private static $arrAutoloadApplicationInfoParamsEditMyInfoActive;
    private static $arrAutoloadApplicationInfoRoutes;
    private static $arrAutoloadApplicationInfoRoutesNotSpa;
    private static $strBrowserName;
    private static $strBrowserVersion;
    private static $strRoute;
    private static $strModule;
    private static $strSufixCssMin;
    private static $strSufixJsMin;
    private static $strSufixCssGzip;
    private static $strSufixJsGzip;

    public function getApplicationInfo()
    {
        return ApplicationInfo::getApplicationInfo();
    }

    public function getApplicationInfoName()
    {
        return $this->getApplicationInfoAttribute('strName', 'NAME', true);
    }

    public function getApplicationInfoAcronym()
    {
        return $this->getApplicationInfoAttribute('strAcronym', 'ACRONYM', true);
    }

    public function getApplicationInfoClassCssBackground()
    {
        return $this->getApplicationInfoAttribute('strClassCssBackground', 'CLASS_CSS_BACKGROUND');
    }

    public function getApplicationInfoClassCssLogo()
    {
        return $this->getApplicationInfoAttribute('strClassCssLogo', 'CLASS_CSS_LOGO');
    }

    public function getApplicationInfoClassCssBar()
    {
        return $this->getApplicationInfoAttribute('strClassCssBar', 'CLASS_CSS_BAR');
    }

    public function getApplicationInfoTextBar()
    {
        return $this->getApplicationInfoAttribute('strTextBar', 'TEXT_BAR');
    }

    public function getApplicationInfoLink()
    {
        return $this->getApplicationInfoAttribute('strLink', 'LINK');
    }

    public function getApplicationInfoIdAcompanhamento()
    {
        return $this->getApplicationInfoAttribute('strIdAcompanhamento', 'ID_ACOMPANHAMENTO');
    }

    public function getApplicationInfoUrlPadrao()
    {
        return $this->getApplicationInfoAttribute('strUrlPadrao', 'URL_PADRAO');
    }

    public function getApplicationInfoVersion()
    {
        return $this->getApplicationInfoAttribute('strVersion', 'VERSION');
    }

    public function getApplicationInfoBuildNumber()
    {
        return $this->getApplicationInfoAttribute('strBuildNumber', 'BUILD_NUMBER');
    }

    public function getApplicationInfoRevision()
    {
        return $this->getApplicationInfoAttribute('strRevision', 'REVISION');
    }

    public function getApplicationInfoBuildTag()
    {
        return $this->getApplicationInfoAttribute('strBuildTag', 'BUILD_TAG');
    }

    public function getApplicationInfoBuildDate()
    {
        return $this->getApplicationInfoAttribute('strBuildDate', 'BUILD_DATE');
    }

    public function getApplicationInfoResponsible()
    {
        return $this->getApplicationInfoAttribute('strResponsible', 'RESPONSIBLE');
    }

    public function getApplicationInfoServerInstance()
    {
        if (empty(self::$strServerInstance))
            self::$strServerInstance = ApplicationInfo::getServerInstance();
        return self::$strServerInstance;
    }

    public function getApplicationInfoInepZendVersion()
    {
        if (empty(self::$arrInepZendVersion))
            self::$arrInepZendVersion = ApplicationInfo::getInepZendVersion();
        return self::$arrInepZendVersion;
    }

    public function showHeader()
    {
        $strClassCssBackground = $this->getApplicationInfoClassCssBackground();
        $strClassCssLogo = $this->getApplicationInfoClassCssLogo();
        $strClassCssBar = $this->getApplicationInfoClassCssBar();
        $strTextBar = $this->getApplicationInfoTextBar();
        $strLink = $this->getApplicationInfoLink();
        if (!empty($strLink))
            $strLink = ' onclick="popup(\'' . $strLink . '\', \'popupLinkHeader\');" style="cursor: pointer;"';
        if ((empty($strClassCssBackground)) && (empty($strClassCssLogo)))
            $strResult = '<div class="container" id="headerApplicationBackground"' . $strLink . '>
                    <div title="' . $this->getApplicationInfoName() . '" id="headerApplicationLogo">
                        ' . $this->getApplicationInfoName() . '
                    </div>
                </div>';
        else
            $strResult = '<div title="' . $this->getApplicationInfoName() . '" class="container ' . $this->getApplicationInfoClassCssBackground() . '"' . $strLink . '>
                    <div class="' . $this->getApplicationInfoClassCssLogo() . '"></div>
                </div>';
        if ((!empty($strClassCssBar)) || (!empty($strTextBar)))
            $strResult .= '<div title="' . $strTextBar . '" class="container ' . $strClassCssBar . '">' . $strTextBar . '</div>';
        return $strResult;
    }

    /**
     * Formata as informacoes para exibicao da versao
     *
     * @param boolean $booFullVersion
     * @param boolean $booReturnString
     * @param boolean $booResponsible
     * @return mix
     */
    public function showVersion($booFullVersion = false, $booReturnString = true, $booResponsible = false)
    {
        $arrInfoVersion = array();
        $arrInfoVersion['build_number'] = (($this->getApplicationInfoBuildNumber()) && (strpos($this->getApplicationInfoBuildNumber(), '@') === false)) ? '#' . $this->getApplicationInfoBuildNumber() : '';
        $arrInfoVersion['version'] = (($this->getApplicationInfoVersion()) && (strpos($this->getApplicationInfoVersion(), '@VERSION@') === false)) ? $this->getApplicationInfoVersion() : '';
        $arrInfoVersion['revision'] = (($this->getApplicationInfoRevision()) && (strpos($this->getApplicationInfoRevision(), '@') === false)) ? 'r' . $this->getApplicationInfoRevision() : '';
        $arrInfoVersion['server_instance'] = (($this->getApplicationInfoServerInstance()) && (strpos($this->getApplicationInfoServerInstance(), '@') === false)) ? $this->getApplicationInfoServerInstance() : '';
        if ($booFullVersion == true) {
            $arrInfoVersion['build_tag'] = (($this->getApplicationInfoBuildTag()) && (strpos($this->getApplicationInfoBuildTag(), '@') === false)) ? $this->getApplicationInfoBuildTag() : '';
            $arrInfoVersion['build_date'] = (($this->getApplicationInfoBuildDate()) && (strpos($this->getApplicationInfoBuildDate(), '@') === false)) ? 'Build Date: ' . $this->getApplicationInfoBuildDate() : '';
        }
        $strDivisor = ' ';
        if ($booResponsible == true) {
            $strDivisor = ' | ';
            $arrInfoVersionNew = array();
            $arrInepZendVersion = $this->getApplicationInfoInepZendVersion();
            if (array_key_exists('vendor', $arrInepZendVersion))
                $arrInfoVersion['inepzend_version'] = $arrInepZendVersion['vendor'];
            $arrKeyResponsible = array('inepzend_version' => 'shield', 'version' => 'cogs', 'server_instance' => 'desktop');
            foreach ($arrKeyResponsible as $strKeyResponsible => $strClassIcon) {
                if ((!array_key_exists($strKeyResponsible, $arrInfoVersion)) || (empty($arrInfoVersion[$strKeyResponsible])))
                    continue;
                $arrInfoVersionNew[$strKeyResponsible] = ((empty($strClassIcon)) ? '' : '<i class="fa fa-' . $strClassIcon . '"></i>&nbsp;') . $arrInfoVersion[$strKeyResponsible];
            }
            $arrInfoVersion = $arrInfoVersionNew;
        }
        return ($booReturnString === false) ? $arrInfoVersion : implode($strDivisor, array_filter(array_values($arrInfoVersion)));
    }

    public function showGoogleAnalytics()
    {
        $strIdAcompanhamento = $this->getApplicationInfoIdAcompanhamento();
        if (empty($strIdAcompanhamento))
            return;
        return '<script type="text/javascript" src="http://public.inep.gov.br/ga/ga_' . $strIdAcompanhamento . '.js"></script>';
    }

    public function showGoogleAnalyticsExtern()
    {
        $strIdAcompanhamento = $this->getApplicationInfoIdAcompanhamento();
        $strUrlPadrao = $this->getApplicationInfoUrlPadrao();
        if ((empty($strIdAcompanhamento)) || (empty($strUrlPadrao)))
            return;
        return "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', '" . $strIdAcompanhamento . "', '" . $strUrlPadrao . "');
  ga('send', 'pageview');
</script>";
    }

    public function showFromThemeOption()
    {
        $arrOption = $this->getThemeOption();
        $strResult = '';
        if ((is_array($arrOption)) && (count($arrOption) > 0)) {
            if (@$arrOption['accesskey'] === false)
                $strResult .= '<style>a[accesskey]:after, button[accesskey]:after, input[accesskey]:after, label[accesskey]:after, legend[accesskey]:after, textarea[accesskey]:after { display: none; }</style>';
            if (@$arrOption['menu_fix'] === false)
                $strResult .= '<script type="text/javascript">$(document).ready(function () { scriptMenuNotFix(); });</script>';
            if (@$arrOption['help'] === false)
                $strResult .= '<style>.navbarHelp { display: none !important; }</style>';
            if (@$arrOption['contrast'] === false)
                $strResult .= '<style>.navbarContrast { display: none !important; }</style>';
            if (@$arrOption['font_size'] === false)
                $strResult .= '<style>.navbarFontSize { display: none !important; }</style>';
        }
        return $strResult;
    }

    public function getAutoloadApplication()
    {
        return ((!is_array($arrConfig = $this->getService('Config'))) || (!array_key_exists('application', $arrConfig))) ? null : $arrConfig['application'];
    }

    public function getAutoloadApplicationInfo()
    {
        return $this->getApplicationInfoAttribute('arrAutoloadApplicationInfo', 'info', false, $this->getAutoloadApplication(), false);
    }

    public function getAutoloadApplicationInfoParams()
    {
        return $this->getApplicationInfoAttribute('arrAutoloadApplicationInfoParams', 'params', false, $this->getAutoloadApplicationInfo(), false);
    }

    public function getAutoloadApplicationInfoParamsControlAlterSessionId()
    {
        return $this->getApplicationInfoAttribute('arrAutoloadApplicationInfoParamsControlAlterSessionId', 'control_alter_session_id', false, $this->getAutoloadApplicationInfoParams(), false);
    }

    public function getAutoloadApplicationInfoParamsControlAlterSessionIdActive()
    {
        return $this->getApplicationInfoAttribute('arrAutoloadApplicationInfoParamsControlAlterSessionIdActive', 'active', false, $this->getAutoloadApplicationInfoParamsControlAlterSessionId(), false);
    }

    public function getAutoloadApplicationInfoParamsControlAlterSessionIdCallback()
    {
        if (!$this->getAutoloadApplicationInfoParamsControlAlterSessionIdActive())
            return $this->getControlAlterSessionIdCallbackDefault();
        return $this->getApplicationInfoAttribute('arrAutoloadApplicationInfoParamsControlAlterSessionIdCallback', 'callback', false, $this->getAutoloadApplicationInfoParamsControlAlterSessionId(), false);
    }

    public function getAutoloadApplicationInfoParamsEditMyInfo()
    {
        return $this->getApplicationInfoAttribute('arrAutoloadApplicationInfoParamsEditMyInfo', 'edit_my_info', false, $this->getAutoloadApplicationInfoParams(), false);
    }

    public function getAutoloadApplicationInfoParamsEditMyInfoActive()
    {
        return $this->getApplicationInfoAttribute('arrAutoloadApplicationInfoParamsEditMyInfoActive', 'active', false, $this->getAutoloadApplicationInfoParamsEditMyInfo(), false);
    }

    public function getAutoloadApplicationInfoRoutes()
    {
        return $this->getApplicationInfoAttribute('arrAutoloadApplicationInfoRoutes', 'routes', false, $this->getAutoloadApplicationInfo(), false);
    }

    public function getAutoloadApplicationInfoRoutesNotSpa()
    {
        return $this->getApplicationInfoAttribute('arrAutoloadApplicationInfoRoutesNotSpa', 'not_spa', false, $this->getAutoloadApplicationInfoRoutes(), false);
    }

    public function getControlAlterSessionIdCallbackDefault()
    {
        return 'void(0);';
    }

    public function getBrowserName()
    {
        return $this->getBrowserInfo('strBrowserName', 'browser');
    }

    public function getBrowserVersion()
    {
        return 'v' . str_replace('.', '_', $this->getBrowserInfo('strBrowserVersion', 'version'));
    }
    
    public function getEnvironmentName()
    {
        return Environment::getEnvironmentName();
    }

    public function getRoute()
    {
        if (empty(self::$strRoute))
            self::$strRoute = parent::getRoute(true);
        return self::$strRoute;
    }

    public function getModule()
    {
        if ((empty(self::$strModule)) && (array_key_exists('module', $GLOBALS)))
            self::$strModule = $GLOBALS['module'];
        return self::$strModule;
    }

    public function getModuleTheme($strType = null)
    {
        if (!empty($strType))
            return self::getTheme($strType);
        $renderer = self::getRenderer();
        if (is_object($renderer))
            return ApplicationInfo::getThemeFromLayout($renderer->layout()->getTemplate());
    }

    public function getSufixCssMin()
    {
        if (empty(self::$strSufixCssMin))
            self::$strSufixCssMin = AbstractHtmlHeadHelper::getSufixCssMin();
        return self::$strSufixCssMin;
    }

    public function getSufixJsMin()
    {
        if (empty(self::$strSufixJsMin))
            self::$strSufixJsMin = AbstractHtmlHeadHelper::getSufixJsMin();
        return self::$strSufixJsMin;
    }

    public function getSufixCssGzip()
    {
        if (empty(self::$strSufixCssGzip))
            self::$strSufixCssGzip = AbstractHtmlHeadHelper::getSufixCssGzip();
        return self::$strSufixCssGzip;
    }

    public function getSufixJsGzip()
    {
        if (empty(self::$strSufixJsGzip))
            self::$strSufixJsGzip = AbstractHtmlHeadHelper::getSufixJsGzip();
        return self::$strSufixJsGzip;
    }

    private function getBrowserInfo($strAttribute = null, $strKey = null)
    {
        if ((empty($strAttribute)) || (empty($strKey)))
            return;
        eval('$strBrowserInfo = self::$' . $strAttribute . ';');
        if (empty($strBrowserInfo)) {
            $arrBrowserInfo = Server::getBrowser();
            if ((is_array($arrBrowserInfo)) && (array_key_exists($strKey, $arrBrowserInfo))) {
                $strBrowserInfo = $arrBrowserInfo[$strKey];
                eval('self::$' . $strAttribute . ' = $strBrowserInfo;');
            }
        }
        return $strBrowserInfo;
    }

    private function getApplicationInfoGeneric($strKey = null, $arrApplicationInfo = null, $booUseDefault = true)
    {
        if (empty($strKey))
            return;
        if ((empty($arrApplicationInfo)) && ($booUseDefault !== false))
            $arrApplicationInfo = $this->getApplicationInfo();
        if ((!is_array($arrApplicationInfo)) || (!array_key_exists($strKey, $arrApplicationInfo)))
            return;
        return $arrApplicationInfo[$strKey];
    }

    private function getApplicationInfoAttribute($strAttribute = null, $strKey = null, $booUtf8Encode = false, $arrApplicationInfo = null, $booUseDefault = true)
    {
        if ((empty($strAttribute)) || (empty($strKey)))
            return;
        if (empty(self::$$strAttribute)) {
            self::$$strAttribute = $this->getApplicationInfoGeneric($strKey, $arrApplicationInfo, $booUseDefault);
            if (($booUtf8Encode === true) && (is_string(self::$$strAttribute)) && (!String::isUTF8(self::$$strAttribute)))
                self::$$strAttribute = utf8_encode(self::$$strAttribute);
        }
        return self::$$strAttribute;
    }

}
