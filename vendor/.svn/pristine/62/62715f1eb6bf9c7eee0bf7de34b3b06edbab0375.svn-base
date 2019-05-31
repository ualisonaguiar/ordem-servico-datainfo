<?php

namespace InepZend\FormGenerator\Add;

use InepZend\Util\Html as HtmlUtil;

/**
 * Trait responsavel em manipular o Element Html para Label.
 */
trait Label
{

    /**
     * Metodo responsavel em inserir o Element Html para Labels de forma customizada.
     * 
     * @example $this->addLabel($strId, $strLabel, $booRequired, $strLabelClass, $strLabelStyle, $arrAttributeData, $strFor);
     * 
     * @param string $strId
     * @param string $strLabel
     * @param boolean $booRequired
     * @param string $strLabelClass
     * @param string $strLabelStyle
     * @param array $arrAttributeData
     * @param string $strFor
     * @return mix
     */
    public function addLabel($strId = null, $strLabel = null, $booRequired = false, $strLabelClass = null, $strLabelStyle = null, $arrAttributeData = null, $strFor = null)
    {
        $arrParamExtra = array(
            array('for', 'strFor'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false, $this->removeParamDefault(array(0, 1, 4, 6, 7, 8, 11, 12, 13, 18, 19)));
        $strLabel = @$arrParam['label'];
        if (empty($strLabel))
            return;
        $strFor = @$arrParam['for'];
        $strLabelClass = @$arrParam['label_class'];
        $strLabelStyle = @$arrParam['label_style'];
        $strId = @$arrParam['id'];
        $strDisplayRequired = (stripos(str_replace(' ', '', $strLabelStyle), 'display:none') === false) ? '' : 'none';
        $booRequired = @$arrParam['required'];
        if ((self::isThemeAdministrativeResponsible()) && ($booRequired === true))
            $strLabel .= '<i style="color: #9A0000" class="fa fa-asterisk"><div class="clearfix"></div></i>';
        $strHtml = '<label' .
                ((!empty($strFor)) ? ' for="' . $strFor . '"' : '') .
                ((!empty($strLabelClass)) ? ' class="' . $strLabelClass . '"' : '') .
                ((!empty($strLabelStyle)) ? ' style="' . $strLabelStyle . '"' : '') .
                ((!empty($strId)) ? ' id="' . $strId . '"' : '') .
                HtmlUtil::getHtmlAttributeData(@$arrParam['attr_data']) . '>' . $strLabel . '</label>';
        if (!self::isThemeAdministrativeResponsible())
            $strHtml .= '<div' .
                ((!empty($strId)) ? ' id="' . $strId . 'DivRequired"' : '') .
                ' class="divRequired" style="display: ' . $strDisplayRequired . ';">' . (($booRequired === true) ? '*' : '') . '</div>';
        return $this->addHtml($strHtml, null, false);
    }

}
