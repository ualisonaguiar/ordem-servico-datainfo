<?php

namespace InepZend\View\Helper;

use InepZend\View\Helper\AbstractHelper;
use InepZend\FormGenerator\View\Helper\FormRow;
use InepZend\Util\Html;

class ButtonHelper extends AbstractHelper
{

    public function __invoke($arrHtmlButton = array(), $strUrlBack = null, $arrResource = null)
    {
        if ((empty($arrHtmlButton)) && (empty($strUrlBack)))
            return $this;
        $strResult = '';
        if ((!empty($arrHtmlButton)) && (!is_array($arrHtmlButton)))
            $arrHtmlButton = array($arrHtmlButton);
        if (is_array($arrResource))
            $this->setResource($arrResource);
        if (is_array($arrHtmlButton))
            foreach ($arrHtmlButton as $strHtmlButton)
                $strResult .= $this->prepareHtmlButton($strHtmlButton);
        if (!empty($strUrlBack))
            $strResult .= $this->render('Voltar', array('type' => 'button', 'name' => 'btnVoltar', 'class' => 'btnDefault btnVoltar btn-inep', 'onclick' => 'window.location.href=\'' . $strUrlBack . '\';', 'title' => 'Voltar'));
        return $strResult;
    }

    public function render($strValue = null, $arrAttribute = null)
    {
        if (!is_array($arrAttribute))
            $arrAttribute = array();
        if (@empty($arrAttribute['type']))
            $arrAttribute['type'] = 'button';
        if (@empty($arrAttribute['onclick']))
            $arrAttribute['onclick'] = 'void(0);';
        if (@empty($arrAttribute['title']))
            $arrAttribute['title'] = trim(strip_tags($strValue));
        $strHtmlButton = '<button';
        foreach ($arrAttribute as $strAttribute => $mixValue) {
            if (in_array($strAttribute, array('attr_data')))
                continue;
            $strHtmlButton .= ' ' . $strAttribute . '="' . $mixValue . '"';
        }
        if (@is_array($arrAttribute['attr_data']))
            $strHtmlButton .= Html::getHtmlAttributeData($arrAttribute['attr_data']);
        $strHtmlButton .= '>' . $strValue . '</button>';
        return $this->prepareHtmlButton($strHtmlButton);
    }

    public function setResource($arrResource = null)
    {
        return self::setAttributeStatic('arrResource', $arrResource);
    }

    public function getResource()
    {
        return self::getAttributeStatic('arrResource');
    }

    public function getClassButton($strClass = null, $strClassDefault = null, $booBtn = false)
    {
        $strClassButton = (string) ((empty($strClass)) ? $strClassDefault : $strClass);
        if (strpos($strClassButton, 'btnDefault') === false)
            $strClassButton = trim('btnDefault ' . $strClassButton);
        if (($booBtn === true) && (strpos($strClassButton, 'btn-inep') === false) && (strpos($strClassButton, 'btn ') === false))
            $strClassButton = trim('btn ' . $strClassButton);
        return trim($strClassButton);
    }

    public function editClassButton(&$strClass = null)
    {
        if ((!empty($strClass)) && (self::isThemeAdministrativeResponsible())) {
            $strClass = $this->editClass($strClass);
            $arrClassOld = explode(' ', $strClass);
            $arrClass = $arrClassOld;
            foreach ($arrClass as $intKey => $strClassIntern)
                if ((!in_array($strClassIntern, array('btnDefault', 'btn', 'btn-info'))) && (strpos($strClassIntern, 'btn-') === false))
                    unset($arrClass[$intKey]);
            $arrDiff = array_diff($arrClassOld, $arrClass);
            $strClass = '';
            if (count($arrDiff) > 0)
                $strClass .= implode(' ', $arrDiff) . ' ';
            $strClass .= implode(' ', $arrClass);
            $strClass = trim($strClass);
        }
        return $strClass;
    }

    private function prepareHtmlButton($strHtmlButton = null)
    {
        if (stripos($strHtmlButton, '<button') !== false) {
            /**
             * $arrResource = array(
             *  $strValue => array($strResouce, $strActionToResourceNotAllowed),
             * );
             */
            $arrResource = $this->getResource();
            $strValue = str_ireplace('</button>', '', substr($strHtmlButton, strpos($strHtmlButton, '>') + 1));
            if ((is_array($arrResource)) && (array_key_exists($strValue, $arrResource)) && ($this->controllResource(@$arrResource[$strValue][0], @$arrResource[$strValue][1], $strHtmlButton) === false))
                return '';
            return $this->insertAccesskey($this->editClass($strHtmlButton));
        }
        return $strHtmlButton;
    }

    private function editClass($strHtmlButton = null)
    {
        if ((!empty($strHtmlButton)) && (strpos($strHtmlButton, 'btnDefault btn btn-info') === false) && (self::isThemeAdministrativeResponsible()))
            $strHtmlButton = trim(str_replace(array('btnDefault', 'btn-inep', '  ', 'btn btnDefault btn'), array('btnDefault btn btn-info', '', ' ', 'btnDefault btn'), $strHtmlButton));
        return $strHtmlButton;
    }

    private function insertAccesskey($strHtmlButton = null)
    {
        if ((!empty($strHtmlButton)) && (self::isThemeAdministrativeResponsible()) && (stripos($strHtmlButton, 'accesskey') === false)) {
            $strAccessKey = FormRow::getAccesskey();
            if (!empty($strAccessKey))
                $strHtmlButton = str_replace('<button', '<button accesskey="' . $strAccessKey . '"', $strHtmlButton);
        }
        return $strHtmlButton;
    }

    private function insertDisabledReadonly($strHtmlButton = null, $strValue = null)
    {
        return (empty($strValue)) ? $strHtmlButton : substr($strHtmlButton, 0, strpos($strHtmlButton, '>')) . ' disabled="disabled"' . substr($strHtmlButton, strpos($strHtmlButton, '>'));
    }

    private function controllResource($strResource = null, $strActionToResourceNotAllowed = null, &$strHtmlButton = null)
    {
        $booPermitted = $this->isPermitted($strResource);
        if ($booPermitted === false) {
            switch (strtolower($strActionToResourceNotAllowed)) {
                case 'disabled':
                    if (!empty($strHtmlButton)) {
                        $strHtmlButton = $this->insertDisabledReadonly($strHtmlButton, 'disabled');
                        return true;
                    }
                    break;
                case 'readonly':
                    if (!empty($strHtmlButton)) {
                        $strHtmlButton = $this->insertDisabledReadonly($strHtmlButton, 'readonly');
                        return true;
                    }
                    break;
                case 'hidden':
                default:
                    break;
            }
        }
        return $booPermitted;
    }

}
