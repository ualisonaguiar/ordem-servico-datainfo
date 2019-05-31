<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\View\Helper\RendererTrait;

class TabHelper extends AbstractHelper
{

    use RendererTrait;

    const CSS_CLASS_CURRENT = 'tabCurrent';
    const CSS_CLASS_NOT_VISITED = 'tabNotVisited';
    const CSS_CLASS_VISITED = 'tabVisited';
    const CSS_CLASS_DEFAULT = 'tabDefault';
    const CSS_CLASS_THEME = 'tabTheme';

    public function render($booProgressive = true, $arrTab = null, $intTab = 0, $booUseCaixaVazada = true, $booFirstBlocked = false)
    {
        if ($booFirstBlocked == true)
            $booProgressive = ($intTab == 0);
        return $this->renderStyle($booProgressive) . $this->renderScript($booProgressive, $booUseCaixaVazada) . $this->renderTab($arrTab, $booUseCaixaVazada) . $this->renderSetColorTab($intTab);
    }

    private function renderStyle($booProgressive = true)
    {
        $strResult = '<style type="text/css">
            .' . self::CSS_CLASS_CURRENT . ' {
                background-color: #FFCB65;
            }
            .' . self::CSS_CLASS_NOT_VISITED . ' {
                background-color: #FAFAFA;
                cursor: ' . (($booProgressive) ? 'not-allowed' : 'pointer') . ';
            }
            .' . self::CSS_CLASS_VISITED . ' {
                background-color: #649941;
                cursor: pointer;
            }
            .' . self::CSS_CLASS_DEFAULT . ' {
                    padding: 4px !important;
                    float: left;
                    text-align: center;
                    margin-right: 3px; 
                    color: #000000;
            }
            body.contrast .' . self::CSS_CLASS_CURRENT . ' {
                color: #FFCB65 !important;
            }
            body.contrast .' . self::CSS_CLASS_VISITED . ' {
                color: #649941 !important;
            }
            body.contrast .' . self::CSS_CLASS_DEFAULT . ' {
                color: #FFFFFF;
            }';
        if (!in_array(self::getRenderer()->applicationInfo(self::getRenderer())->getModuleTheme(), array('AdministrativeResponsible')))
            $strResult .= '
                .' . self::CSS_CLASS_THEME . ' {
                    width: 80px;
                }';
        else
            $strResult .= '
                .' . self::CSS_CLASS_THEME . ' {
                    width: 10.2% !important;
                    min-height: 50px;
                    margin-top: 10px;
                    margin-bottom: 5px;
                    margin-left: 0px !important;
                }';
        $strResult .= '</style>';
        return $strResult;
    }

    private function renderScript($booProgressive = true, $booUseCaixaVazada = true)
    {
        return '<script type="text/javascript">
    function setColorTab(intTab)
    {
        if (intTab == undefined)
            return false;
        var arrTab = getElementsFromAttribute(document.body, "DIV", "class", "' . self::getCssClassTab($booUseCaixaVazada) . '");
        for (var intCount = 0; intCount < arrTab.length; ++intCount) {
            var strClass = "' . self::CSS_CLASS_NOT_VISITED . '";
            if (intCount < intTab)
                strClass = "' . (($booProgressive) ? self::CSS_CLASS_VISITED : self::CSS_CLASS_NOT_VISITED) . '";
            else if (intCount == intTab)
                strClass = "' . self::CSS_CLASS_CURRENT . '";
            arrTab[intCount].className = "' . self::getCssClassTab($booUseCaixaVazada) . ' " + strClass;
        }
        ' . (($booProgressive) ? 'checkTab(intTab);' : '') . '
        return true;
    }
    function clickTab(divTab, strRoute)
    {
        if ((divTab == undefined) || (strRoute == undefined))
            return false;
        divTab = getObject(divTab);
        if (divTab == undefined)
            return false;
        var booRoute = ' . (($booProgressive) ? '(divTab.className.indexOf("' . self::CSS_CLASS_VISITED . '") != -1)' : 'true') . ';
        if (booRoute)
            window.location.href = strRoute;
        return true;
    }
    function checkTab(intTab)
    {
        if (intTab == undefined)
            return false;
        var intTabCurrent = getCookie("tab_current");
        if ((intTabCurrent == undefined) || (intTabCurrent == ""))
            intTabCurrent = 0;
        if (intTab >= (intTabCurrent + 2)) {
            alertDialog("Não pode!");
            return false;
        }
        if (intTabCurrent >= intTab)
            intTabCurrent = intTab;
        else
            ++intTabCurrent;
        setCookie("tab_current", intTabCurrent);
        return true;
    }
</script>';
    }

    private function renderTab($arrTab = null, $booUseCaixaVazada = true)
    {
        $strResult = '<div class="caixaVazada" style="border: 0px;">';
        if (is_array($arrTab)) {
            foreach ($arrTab as $arrInfo) {
                if (!is_array($arrInfo))
                    $arrInfo = array($arrInfo);
                $strValue = @$arrInfo[0];
                $strRoute = @$arrInfo[1];
                $strTitle = @$arrInfo[2];
                $strOnClick = @$arrInfo[3];
                $strStyle = @$arrInfo[4];
                if (empty($strValue))
                    continue;
                if (empty($strTitle))
                    $strTitle = $strValue;
                if (!empty($strRoute))
                    $strOnClick = 'clickTab(this, \'' . self::getRenderer()->basePath() . '/' . $strRoute . '\');';
                if (empty($strOnClick))
                    $strOnClick = 'void(0);';
                $strResult .= '<div class="' . self::getCssClassTab($booUseCaixaVazada) . '" style="' . $strStyle . '" title="' . $strTitle . '" onclick="' . $strOnClick . '">' . $strValue . '</div>';
            }
        }
        $strResult .= '</div>';
        return $strResult;
    }

    private function renderSetColorTab($intTab = 0)
    {
        return '<script type="text/javascript">setColorTab(' . (integer) $intTab . ');</script>';
    }

    private static function getCssClassTab($booUseCaixaVazada = true)
    {
        return (($booUseCaixaVazada) ? 'caixaVazada ' : '') . self::CSS_CLASS_DEFAULT . ' ' . self::CSS_CLASS_THEME;
    }

}
