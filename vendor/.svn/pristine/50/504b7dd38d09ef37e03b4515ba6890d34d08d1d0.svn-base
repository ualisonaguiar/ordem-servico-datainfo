<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular Element Select para pesquisa de Regiao, Municipio
 * e Uf.
 */
trait RegiaoUfMunicipio
{

    /**
     * Metodo responsavel em adicionar o Element Select para selecao de Regiao.
     * 
     * @example $this->addRegiao($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $strEmptyOption, $strOnChange);
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
    public function addRegiao($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strEmptyOption = null, $strOnChange = null)
    {
        $arrParamExtra = array(
            array('empty_option', 'strEmptyOption'),
            array('onchange', 'strOnChange'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'coRegiao',
            'label' => 'Região',
            'placeholder' => 'Selecione',
            'empty_option' => 'Selecione',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrAttribute = array(
            'value_options' => array('addOption', $this->listRegiao()),
        );
        return $this->getElementConfiguredExtended($arrParam, $arrParamExtra, $arrAttribute, 'addSelect');
    }

    /**
     * Metodo responsavel em adicionar o Element Select para selecao de UFs.
     * 
     * @example $this->addUf($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $strEmptyOption, $strOnChange, $strNameMunicipio, $strMethodValue, $strMethodText);
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
     * @param string $strNameMunicipio
     * @param string $strMethodValue
     * @param string $strMethodText
     * @param boolean $booBr
     * @return mix
     */
    public function addUf($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strEmptyOption = null, $strOnChange = null, $strNameMunicipio = null, $strMethodValue = null, $strMethodText = null, $booBr = null)
    {
        $arrParamExtra = array(
            array('empty_option', 'strEmptyOption'),
            array('onchange', 'strOnChange'),
            array('name_municipio', 'strNameMunicipio'),
            array('method_value', 'strMethodValue'),
            array('method_text', 'strMethodText'),
            array('br', 'booBr'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $strNameMunicipio = @$arrParam['name_municipio'];
        unset($arrParam['name_municipio']);
        $arrParamValue = array(
            'name' => 'coUf',
            'label' => 'UF',
            'placeholder' => 'Selecione',
            'empty_option' => 'Selecione',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrParam['attr_data'] = array_merge((array) @$arrParam['attr_data'], ((!empty($strNameMunicipio)) ? array('depend' => $strNameMunicipio) : array()));
        if ((@empty($arrParam['onchange'])) && (!empty($strNameMunicipio)))
            $arrParam['onchange'] = 'feedSelect(\'' . $arrParam['name'] . '\', \'' . $strNameMunicipio . '\', \'/corp_municipio/ajaxFetchPairs\', undefined, true);';
        $arrOption = $this->listUf(@$arrParam['method_value'], @$arrParam['method_text']);
        if (@$arrParam['br'] === true)
            $arrOption = array_merge(array('BR' => 'BR'), $arrOption);
        $arrAttribute = array(
            'value_options' => array('addOption', $arrOption),
        );
        $arrElement = $this->getElementConfiguredExtended($arrParam, $arrParamExtra, $arrAttribute, 'addSelect');
        $this->addOption($arrElement, 'name_municipio', $strNameMunicipio);
        $this->setElement($arrElement);
        if (!empty($strHtml))
            $this->addHtml($strHtml);
        return $arrElement;
    }

    /**
     * Metodo responsavel em adicionar o Element Select para selecao de Municipios.
     * 
     * @example $this->addMunicipio($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $strEmptyOption, $strOnChange);
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
     * @param mix $mixSuggestion
     * @return mix
     */
    public function addMunicipio($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strEmptyOption = null, $strOnChange = null, $mixSuggestion = null)
    {
        $arrParamExtra = array(
            array('empty_option', 'strEmptyOption'),
            array('onchange', 'strOnChange'),
            array('suggestion', 'mixSuggestion'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'coMunicipio',
            'label' => 'Município',
            'placeholder' => 'Selecione',
            'empty_option' => 'Selecione',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        if ((@$arrParam['suggestion'] === true) || (is_array(@$arrParam['suggestion']))) {
            unset($arrParam['empty_option'], $arrParam['onchange']);
            $arrSuggestion = (is_bool($arrParam['suggestion'])) ? array() : $arrParam['suggestion'];
            $arrParam['suggestion'] = array_merge(array('url_list' => '/corp_municipio/ajaxFindBy'), $arrSuggestion);
            return $this->addText($arrParam);
        }
        unset($arrParam['suggestion']);
        $arrAttribute = array(
            'value_options' => array('addOption', array()),
        );
        return $this->getElementConfiguredExtended($arrParam, $arrParamExtra, $arrAttribute, 'addSelect');
    }

    /**
     * Metodo responsavel em retornar os dados contidos no Sistema Corporativo
     * via servico referente as Regioes.
     * 
     * @param string $strMethodValue
     * @param string $strMethodText
     * @return array
     */
    protected function listRegiao($strMethodValue = null, $strMethodText = null)
    {
        return $this->listEntity('InepZend\Module\Corporative\Service\VwRegiao', array(), $strMethodValue, $strMethodText, array('noRegiao' => 'ASC'));
    }

    /**
     * * Metodo responsavel em retornar os dados contidos no Sistema Corporativo
     * via servico referente as UFs.
     * 
     * @param string $strMethodValue
     * @param string $strMethodText
     * @return array
     */
    protected function listUf($strMethodValue = null, $strMethodText = null)
    {
        return $this->listEntity('InepZend\Module\Corporative\Service\VwUf', array(), $strMethodValue, $strMethodText, array('sgUf' => 'ASC'));
    }

}
