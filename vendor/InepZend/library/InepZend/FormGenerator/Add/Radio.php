<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular o Element Html para Radio.
 */
trait Radio
{

    /**
     * Metodo responsavel em inserir o Element Html para Labels de forma customizada.
     * 
     * @example $this->addRadio($strName, $strValue, $strId, $strLabel, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $arrValueOption, $arrTitleOption);
     * 
     * @param string $strName
     * @param string $strValue
     * @param string $strId
     * @param string $strLabel
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
     * @param array $arrTitleOption
     * @return mix
     */
    public function addRadio($strName, $strValue = null, $strId = null, $strLabel = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $arrValueOption = array(), $arrTitleOption = array())
    {
        $arrParamExtra = array(
            array('value_options', 'arrValueOption'),
            array('title_options', 'arrTitleOption'),
        );
        $arrAttribute = array(
            'type' => array('addGeneric', 'InepZend\FormGenerator\Element\Radio'),
            'value_options' => array('addOption'),
            'title_options' => array('addOption'),
        );
        return $this->getElementConfigured(func_get_args(), func_num_args(), $arrParamExtra, $arrAttribute, $this->addDefault(func_get_args(), $this->removeParamDefault(4)));
    }

}
