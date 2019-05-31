<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular o Element Password.
 */
trait Password
{

    /**
     * Metodo responsavel em inserir o Element Password dentro do Form.
     * 
     * @example $this->addPassword($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $intMaxlength, $strOnKeyUp);
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
     * @param string $strOnKeyUp
     * @return mix
     */
    public function addPassword($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $intMaxlength = null, $strOnKeyUp = null)
    {
        $arrParamExtra = array(
            array('maxlength', 'intMaxlength'),
            array('onkeyup', 'strOnKeyUp'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'txSenha',
            'label' => 'Senha',
            'placeholder' => 'Entre com a Senha',
            'required' => true,
            'maxlength' => 20,
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrAttribute = array(
            'type' => array('addGeneric', 'InepZend\FormGenerator\Element\Password'),
            'maxlength' => array('addAttribute'),
            'onkeyup' => array('addAttribute'),
        );
        $arrElement = $this->getElementConfigured(array($arrParam), 1, $arrParamExtra, $arrAttribute);
        return $this->setStyleWidth($arrElement, '220px');
    }

}
