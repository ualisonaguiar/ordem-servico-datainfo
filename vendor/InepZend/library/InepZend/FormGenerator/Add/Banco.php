<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular Element Select para pesquisa de Instituicoes Bancarias.
 */
trait Banco
{

    /**
     * Metodo responsavel em adicionar o Element Select para selecao das Instituicoes
     * Bancarias.
     * 
     * @example $this->addBanco($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $strEmptyOption, $strOnChange);
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
    public function addBanco($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strEmptyOption = null, $strOnChange = null, $mixSuggestion = null)
    {
        $arrParamExtra = array(
            array('empty_option', 'strEmptyOption'),
            array('onchange', 'strOnChange'),
            array('suggestion', 'mixSuggestion'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'coBanco',
            'label' => 'Banco',
            'placeholder' => 'Selecione',
            'empty_option' => 'Selecione',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        if ((@$arrParam['suggestion'] === true) || (is_array(@$arrParam['suggestion']))) {
            unset($arrParam['empty_option'], $arrParam['onchange']);
            $arrSuggestion = (is_bool($arrParam['suggestion'])) ? array() : $arrParam['suggestion'];
            $arrParam['suggestion'] = array_merge(array('url_list' => '/corp_banco/ajaxFindBy'), $arrSuggestion);
            return $this->addText($arrParam);
        }
        unset($arrParam['suggestion']);
        $arrAttribute = array(
            'value_options' => array('addOption', $this->listBanco()),
        );
        return $this->getElementConfiguredExtended($arrParam, $arrParamExtra, $arrAttribute, 'addSelect');
    }

    /**
     * Metodo responsavel em retornar os dados via servico referente as Instituicoes
     * Bancarias.
     * 
     * @example $this->listBanco();
     * 
     * @return array
     */
    protected function listBanco()
    {
        $arrBanco = $this->listEntity('InepZend\Module\Corporative\Service\VwBanco', array(), null, null, array('coBanco' => 'ASC', 'dsBanco' => 'ASC'));
        foreach ($arrBanco as $intCodBanco => $strNameBanco)
            $arrBanco[$intCodBanco] = str_pad($intCodBanco, 3, '0', STR_PAD_LEFT) . ' - ' . $strNameBanco;
        return $arrBanco;
    }

}
