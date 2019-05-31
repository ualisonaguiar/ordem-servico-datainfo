<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular o Element Radio para selecao de Sexo.
 */
trait Sexo
{

    /**
     * Metodo responsavel em adicionar o Element Radio para selecao de Sexo.
     * 
     * @example $this->addSexo($strName, $strValue, $strId, $strLabel, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $arrTitleOption);
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
     * @param array $arrTitleOption
     * @return mix
     */
    public function addSexo($strName = null, $strValue = null, $strId = null, $strLabel = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $arrTitleOption = array())
    {
        $arrParamExtra = array(
            array('title_options', 'arrTitleOption'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'tpSexo',
            'label' => 'Sexo',
            'value' => 'M',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrAttribute = array(
            'value_options' => array('addOption', $this->listSexo()),
        );
        return $this->getElementConfiguredExtended($arrParam, $arrParamExtra, $arrAttribute, 'addRadio');
    }

    /**
     * Metodo responsavel em retornar os tipos de Sexo.
     * 
     * @example $this->listSexo();
     * 
     * @return array
     */
    protected function listSexo()
    {
        return array(
            'M' => 'Masculino',
            'F' => 'Feminino',
        );
    }

}
