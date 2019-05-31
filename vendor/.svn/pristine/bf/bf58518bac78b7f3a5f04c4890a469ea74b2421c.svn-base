<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular o Element Number.
 */
trait Number
{

    /**
     * Metodo responsavel em inserir o Element Number dentro do Form.
     * 
     * @example $this->addNumber($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $intMaxlength, $intMax, $intMin, $strReadonly);
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
     * @param integer $intMax
     * @param integer $intMin
     * @param string $strReadonly
     * @param string $strSeparator
     * @return mix
     */
    public function addNumber($strName, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $intMaxlength = null, $intMax = null, $intMin = null, $strReadonly = null, $strSeparator = null)
    {
        $arrParamExtra = array(
            array('maxlength', 'intMaxlength'),
            array('max', 'intMax'),
            array('min', 'intMin'),
            array('readonly', 'strReadonly'),
            array('separator', 'strSeparator'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra);
        $intMax = @$arrParam['max'];
        $intMin = @$arrParam['min'];
        if ((!empty($intMax)) || (!empty($intMin)))
            $arrAttribute = array(
                'type' => array('addGeneric', 'InepZend\FormGenerator\Element\Number'),
                'maxlength' => array('addOption'),
                'max' => array('addAttribute'),
                'min' => array('addAttribute'),
            );
        else
            $arrAttribute = array(
                'number' => array('addOption', true),
                'maxlength' => array('addAttribute'),
            );
        $arrAttribute = array_merge($arrAttribute, array('separator' => array('addOption')));
        $arrElement = $this->getElementConfiguredExtended($arrParam, $arrParamExtra, $arrAttribute);
        if ((!empty($intMax)) || (!empty($intMin))) {
            $this->delOption($arrElement, 'type');
            $this->setElement($arrElement);
        }
        return $arrElement;
    }

}
