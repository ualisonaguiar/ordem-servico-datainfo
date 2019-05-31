<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular Element TextArea
 */
trait Textarea
{

    /**
     * Metodo responsavel em inserir o Element TextArea
     * 
     * @example $this->addTextarea($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $intMaxlength, $booShowCounter);
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
     * @param integer $intMaxlength
     * @param boolean $booShowCounter
     * @return mix
     */
    public function addTextarea($strName, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $intMaxlength = null, $booShowCounter = null)
    {
        $arrParamExtra = array(
            array('maxlength', 'intMaxlength'),
            array('show_counter', 'booShowCounter'),
        );
        $arrAttribute = array(
            'type' => array('addGeneric', 'InepZend\FormGenerator\Element\Textarea'),
            'maxlength' => array('addAttribute'),
            'show_counter' => array('addOption'),
            'is_editor' => array('addOption', false),
        );
        return $this->getElementConfigured(func_get_args(), func_num_args(), $arrParamExtra, $arrAttribute);
    }

}
