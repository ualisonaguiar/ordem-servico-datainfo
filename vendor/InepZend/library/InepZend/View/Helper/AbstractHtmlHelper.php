<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\View\Helper\RendererTrait;
use InepZend\Util\ArrayCollection;

abstract class AbstractHtmlHelper extends AbstractHelper
{

    use RendererTrait;

    public function open($booEchoResult = true, $arrAttributeExtra = null)
    {
        $arrInfoFromAttributeExtra = $this->getInfoFromAttributeExtra($arrAttributeExtra);
        $strAttributeExtra = $arrInfoFromAttributeExtra[0];
        $strClass = $arrInfoFromAttributeExtra[1];
        $strResult = self::getRenderer()->doctype();
        $strResult .= '<html lang="pt_BR" id="' . self::getRenderer()->applicationInfo()->getBrowserName() . '" class="' . $strClass . self::getRenderer()->applicationInfo()->getBrowserVersion() . '"' . $strAttributeExtra . '>';
        return $this->echoReturnResult($strResult, $booEchoResult);
    }

    public function close($booEchoResult = true)
    {
        return $this->echoReturnResult('</html>', $booEchoResult);
    }

    protected function getInfoFromAttributeExtra(&$arrAttributeExtra = null)
    {
        $strClass = '';
        if ((is_array($arrAttributeExtra)) && (array_key_exists('class', $arrAttributeExtra))) {
            $strClass = $arrAttributeExtra['class'] . ' ';
            unset($arrAttributeExtra['class']);
        }
        $strAttributeExtra = (is_array($arrAttributeExtra)) ? ' ' . ArrayCollection::implodeToAttribute($arrAttributeExtra) : '';
        return array($strAttributeExtra, $strClass);
    }

    protected function basePath()
    {
        if (!is_object(self::getRenderer()))
            return '';
        return self::getRenderer()->basePath();
    }

    protected function echoReturnResult($strResult = null, $booEchoResult = true)
    {
        if ($booEchoResult === true)
            echo $strResult;
        return $strResult;
    }

}
