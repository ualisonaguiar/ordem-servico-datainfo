<?php

namespace InepZend\FormGenerator\Add;

use InepZend\Util\ArrayCollection;

/**
 * Trait responsavel em manipular o Element Text para CNPJ.
 */
trait Cnpj
{

    /**
     * Metodo resposanvel em adicionar o Element Text customizado para insercao
     * de CNPJ com seus respectivos tratamentos/validadores.
     * 
     * @example $this->addCnpj($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $booShowValidate, $strReadonly);
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
     * @param boolean $booShowValidate
     * @param string $strReadonly
     * @return mix
     */
    public function addCnpj($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $booShowValidate = true, $strReadonly = null)
    {
        $arrParamExtra = array(
            array('show_validate', 'booShowValidate'),
            array('readonly', 'strReadonly'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'nuCnpj',
            'label' => 'CNPJ',
            'placeholder' => 'Entre com o CNPJ',
            'mask' => '99.999.999/9999-99',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrAttribute = array(
            'show_validate' => array('addOption'),
        );
        $arrParam = ArrayCollection::merge($arrParam, array('attr_data' => array('cnpj' => 'true')));
        $arrElement = $this->getElementConfiguredExtended($arrParam, $arrParamExtra, $arrAttribute);
        return $this->setStyleWidth($arrElement, '180px');
    }

}
