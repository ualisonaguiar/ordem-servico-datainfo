<?php
namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\View\Helper\AbstractHtmlHeadHelper;

class AngularHelper extends AbstractHelper
{
    
    const PARAM_URL = 'url';
    const PARAM_HTML = 'html';
    const PARAM_MODULE = 'module';
    const PARAM_DEPENDENCE = 'dependence';
    const PARAM_ECHO = 'echo';
    
    public function addService(array $arrParam = array())
    {
        if ((empty($arrParam)) || (is_null(@$arrParam[self::PARAM_URL])))
            return $this;
        $strUrl = @$arrParam[self::PARAM_URL];
        $mixDependence = @$arrParam[self::PARAM_DEPENDENCE];
        $booEcho = @$arrParam[self::PARAM_ECHO];
        $strResult = $this->getHtmlInclude($mixDependence);
        $strResult .= '<script type="text/javascript" data-angular-controller="true">include_once("' . $strUrl . '");</script>';
        if ($booEcho !== false) {
            echo $strResult;
            return $this;
        }
        return $strResult;
    }

    public function addController(array $arrParam = array())
    {
        if ((empty($arrParam)) || (is_null(@$arrParam[self::PARAM_URL])))
            return $this;
        $strUrl = @$arrParam[self::PARAM_URL];
        $strHtml = @$arrParam[self::PARAM_HTML];
        $strModule = @$arrParam[self::PARAM_MODULE];
        $mixDependence = @$arrParam[self::PARAM_DEPENDENCE];
        $booEcho = @$arrParam[self::PARAM_ECHO];
        $strResult = $this->getHtmlInclude($mixDependence);
        if (! empty($strHtml)) {
            if ((strpos($strUrl, 'renderscript.php') !== false) && (strpos($strUrl, 'filename=') !== false))
                $strController = reset(explode('.', end(explode('filename=', $strUrl))));
            else
                $strController = end(explode('/', str_replace(array('\\', '.js'), array('/', ''), $strUrl)));
            if (is_null($strModule))
                $strModule = $strController;
            $strResult .= '<div id="' . $strController . '" class="' . $strController . '"' . ((empty($strModule)) ? '' : ' ng-app="' . $strModule . '"') . ' ng-controller="' . $strController . '" ng-init="strIdController = \'' . $strController . '\'">' . $strHtml . '</div>';
        }
        $strResult .= '<script type="text/javascript" data-angular-controller="true" src="' . $this->getUrl($strUrl) . '"></script>';
        if ($booEcho !== false) {
            echo $strResult;
            return $this;
        }
        return $strResult;
    }

    public function getHtmlInclude($mixDependence = null)
    {
        $strResult = '';
        if (!is_array($mixDependence))
            $mixDependence = array($mixDependence);
        foreach ($mixDependence as $strDependence) {
            switch ($strDependence) {
                case AbstractHtmlHeadHelper::COMPONENT_ANGULAR_UI_GRID:
                    $strResult .= '<link href="' . $this->getBaseUrl() . '/vendor/angular-ui/ui-grid-3.0.7/ui-grid.min.css' . AbstractHtmlHeadHelper::getSufixCssGzip() . '" media="screen" rel="stylesheet" type="text/css">
<script type="text/javascript" data-angular-controller="true">include_once("/vendor/angular-ui/ui-grid-3.0.7/ui-grid.min.js' . AbstractHtmlHeadHelper::getSufixJsGzip() . '");</script>';
                    break;
                default:
                    switch ($strDependence) {
                        case 'Controller/AbstractCoreController':
                            $strResult .= $this->getHtmlInclude(array('Util/AsyncMessage', 'Util/WindowUtil', 'Util/RestClient'));
                            break;
                        case 'Controller/AbstractFormController':
                            $strResult .= $this->getHtmlInclude('Controller/AbstractCoreController');
                            break;
                        case 'Controller/AbstractGridController':
                            $strResult .= $this->getHtmlInclude(array(AbstractHtmlHeadHelper::COMPONENT_ANGULAR_UI_GRID, 'Controller/AbstractFormController'));
                            break;
                    }
                    $strResult .= '<script type="text/javascript" data-angular-controller="true">include_once("/vendor/InepZend/angular/' . $strDependence . AbstractHtmlHeadHelper::getSufixJs() . '");</script>';
                    break;
            }
        }
        return $strResult;
    }
    
    private function getUrl($strUrl = null)
    {
        $strBaseUrl = $this->getBaseUrl(); 
        return ((!empty($strBaseUrl)) && (strpos($strUrl, $strBaseUrl) === false)) ? $strBaseUrl . $strUrl : $strUrl;
    }
    
}
