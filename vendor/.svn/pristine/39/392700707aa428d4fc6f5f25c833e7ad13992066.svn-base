<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular o Element Html para Select.
 */
trait Select
{

    /**
     * Metodo responsavel em inserir o Element Html para Select de forma customizada.
     * 
     * @example $this->addSelect($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $arrValueOption, $strEmptyOption, $strOnChange);
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
     * @param string $arrValueOption
     * @param string $strEmptyOption
     * @param string $strOnChange
     * @return mix
     */
    public function addSelect($strName, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $arrValueOption = array(), $strEmptyOption = null, $strOnChange = null)
    {
        $arrParamExtra = array(
            array('value_options', 'arrValueOption'),
            array('empty_option', 'strEmptyOption'),
            array('onchange', 'strOnChange'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra);
        $arrAttribute = array(
            'type' => array('addGeneric', 'InepZend\FormGenerator\Element\Select'),
            'value_options' => array('addOption', ((is_array(@$arrParam['value_options'])) ? $arrParam['value_options'] : array())),
            'empty_option' => array('addOption'),
            'onchange' => array('addAttribute'),
        );
        return $this->getElementConfigured(func_get_args(), func_num_args(), $arrParamExtra, $arrAttribute);
    }

}
