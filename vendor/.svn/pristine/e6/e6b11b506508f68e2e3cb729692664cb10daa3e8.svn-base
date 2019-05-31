<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular o Element Text para Data de Nascimento.
 */
trait Nascimento
{

    /**
     * Metodo responsavel em inserir o Element Text para Data de Nascimento com
     * suas regras especificas para Data.
     * 
     * @example $this->addNascimento($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $strReadonly);
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
     * @param string $strReadonly
     * @return mix
     */
    public function addNascimento($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strReadonly = null)
    {
        $arrParamExtra = array(
            array('readonly', 'strReadonly'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'dtNascimento',
            'label' => 'Nascimento',
            'placeholder' => 'Data de nascimento',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        return $this->getElementConfiguredExtended($arrParam, $arrParamExtra, array(), 'addDate');
    }

}
