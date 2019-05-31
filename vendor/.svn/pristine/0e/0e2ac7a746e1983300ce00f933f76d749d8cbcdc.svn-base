<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular o Element Url.
 */
trait Url
{

    /**
     * Metodo responsavel em inserir o Element Url de forma customizada.
     * 
     * @example $this->addUrl($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $intMaxlength, $strReadonly);
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
     * @param string $strReadonly
     * @return mix
     */
    public function addUrl($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $intMaxlength = null, $strReadonly = null)
    {
        $arrParamExtra = array(
            array('maxlength', 'intMaxlength'),
            array('readonly', 'strReadonly'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'txUrl',
            'label' => 'URL',
            'placeholder' => 'Entre com a URL',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrAttribute = array(
            'type' => array('addGeneric', 'InepZend\FormGenerator\Element\Url'),
            'maxlength' => array('addAttribute'),
        );
        return $this->getElementConfiguredExtended($arrParam, $arrParamExtra, $arrAttribute);
    }

}
