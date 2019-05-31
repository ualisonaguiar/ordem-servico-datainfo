<?php

namespace InepZend\FormGenerator\Add;

trait Checkbox
{

    public function addCheckbox($strName, $strValue = null, $strId = null, $strLabel = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strCheckedValue = null, $strUncheckedValue = null, $booUseHidden = true)
    {
        $arrParamExtra = array(
            array('checked_value', 'strCheckedValue'),
            array('unchecked_value', 'strUncheckedValue'),
            array('use_hidden_element', 'booUseHidden'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra);
        $booUseHidden = @$arrParam['use_hidden_element'];
        if (!is_bool($booUseHidden))
            $booUseHidden = true;
        $arrAttribute = array(
            'type' => array('addGeneric', 'InepZend\FormGenerator\Element\Checkbox'),
            'checked_value' => array('addOption'),
            'unchecked_value' => array('addOption'),
            'use_hidden_element' => array('addOption', $booUseHidden),
        );
        return $this->getElementConfigured(func_get_args(), func_num_args(), $arrParamExtra, $arrAttribute, $this->addDefault(func_get_args(), $this->removeParamDefault(4)));
    }

    public function addMultiCheckbox($strName, $strValue = null, $strId = null, $strLabel = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $arrValueOption = array(), $arrTitleOption = array())
    {
        $arrParamExtra = array(
            array('value_options', 'arrValueOption'),
            array('title_options', 'arrTitleOption'),
        );
        $arrAttribute = array(
            'type' => array('addGeneric', 'InepZend\FormGenerator\Element\MultiCheckbox'),
            'value_options' => array('addOption'),
            'title_options' => array('addOption'),
        );
        return $this->getElementConfigured(func_get_args(), func_num_args(), $arrParamExtra, $arrAttribute, $this->addDefault(func_get_args(), $this->removeParamDefault(4)));
    }

}
