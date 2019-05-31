<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular Element Select para pesquisa de Nacionalidade.
 */
trait Nacionalidade
{

    /**
     * Metodo responsavel em adicionar o Element Select para selecao de Nacionalidade.
     * 
     * @example $this->addNacionalidade($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired = false, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $strEmptyOption, $strOnChange);
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
     * @param string $strEmptyOption
     * @param string $strOnChange
     * @return mix
     */
    public function addNacionalidade($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strEmptyOption = null, $strOnChange = null)
    {
        $arrParamExtra = array(
            array('empty_option', 'strEmptyOption'),
            array('onchange', 'strOnChange'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'tpNacionalidade',
            'label' => 'Nacionalidade',
            'placeholder' => 'Selecione',
            'empty_option' => 'Selecione',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrAttribute = array(
            'value_options' => array('addOption', $this->listNacionalidade()),
        );
        return $this->getElementConfiguredExtended($arrParam, $arrParamExtra, $arrAttribute, 'addSelect');
    }

    /**
     * Metodo responsavel em retornar os dados contidos no Sistema Corporativo
     * via servico referente a Nacionalidade.
     * 
     * @example $this->listNacionalidade();
     * 
     * @return array
     */
    protected function listNacionalidade()
    {
        return array(
            1 => 'Brasileiro Nato',
            2 => 'Brasileiro Naturalizado',
            3 => 'Estrangeiro',
        );
    }

}
