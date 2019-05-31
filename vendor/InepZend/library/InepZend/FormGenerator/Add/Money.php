<?php

namespace InepZend\FormGenerator\Add;

use InepZend\Util\ArrayCollection;

/**
 * Trait responsavel em manipular o Element Text para Dinheiro/Money.
 */
trait Money
{

    /**
     * 
     * Metodo resposanvel em adicionar o Element Text customizado para insercao
     * de Dinheiro com seus respectivos tratamentos/validadores.
     * 
     * @example $this->addMoney($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired = false, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $intMaxlength, $strReadonly);
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
    public function addMoney($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $intMaxlength = null, $strReadonly = null)
    {
        $arrParamExtra = array(
            array('maxlength', 'intMaxlength'),
            array('readonly', 'strReadonly'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'vlMoney',
            'label' => 'Valor',
            'placeholder' => 'Entre com o Valor',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrAttribute = array(
            'type' => array('addOption', 'money'),
            'maxlength' => array('addAttribute'),
        );
        $arrParam = ArrayCollection::merge($arrParam, array('attr_data' => array('maskmoney' => 'true', 'money' => 'true')));
        return $this->getElementConfiguredExtended($arrParam, $arrParamExtra, $arrAttribute);
    }

}
