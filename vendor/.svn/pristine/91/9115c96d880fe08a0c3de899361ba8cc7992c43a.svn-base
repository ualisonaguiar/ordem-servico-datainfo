<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular o Element Text.
 */
trait Text
{

    /**
     * Metodo responsavel em inserir o Element Text de forma customizada.
     * 
     * @example $this->addText($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $strMask, $intMaxlength, $strOnKeyUp, $strReadonly, $strPattern, $arrSuggestion);
     * 
     * @param string $strName
     * @param string $strValue
     * @param string $strId
     * @param string $strLabel
     * @param string $strPlaceHolder
     * @param boolean $booRequired
     * @param string $strTitle
     * @param string $strClass
     * @param string $strStyle
     * @param string $strLabelClass
     * @param string $strLabelStyle
     * @param string $strHelpText
     * @param string $strTypeValidateMessage
     * @param string $strDisabled
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param integer $intTabindex
     * @param array $arrAttributeData
     * @param string $strGroupClass
     * @param string $strGroupStyle
     * @param string $strMask
     * @param integer $intMaxlength
     * @param string $strOnKeyUp
     * @param string $strReadonly
     * @param string $strPattern
     * @param array $arrSuggestion
     * @return mix
     */
    public function addText($strName, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strMask = null, $intMaxlength = null, $strOnKeyUp = null, $strReadonly = null, $strPattern = null, $arrSuggestion = null)
    {
        $arrParamExtra = array(
            array('mask', 'strMask'),
            array('maxlength', 'intMaxlength'),
            array('onkeyup', 'strOnKeyUp'),
            array('readonly', 'strReadonly'),
            array('pattern', 'strPattern'),
            array('suggestion', 'arrSuggestion'),
        );
        $arrAttribute = array(
            'type' => array('addOption', 'text'),
            'mask' => array('addOption'),
            'maxlength' => array('addAttribute'),
            'onkeyup' => array('addAttribute'),
            'readonly' => array('addAttribute'),
            'pattern' => array('addAttribute'),
            'suggestion' => array('addOption'),
        );
        return $this->getElementConfigured(func_get_args(), func_num_args(), $arrParamExtra, $arrAttribute);
    }

}
