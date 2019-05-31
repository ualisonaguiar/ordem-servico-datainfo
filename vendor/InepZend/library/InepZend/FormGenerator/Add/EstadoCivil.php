<?php

namespace InepZend\FormGenerator\Add;

use InepZend\WebService\Client\Corporative\Inep\RestCorp;

/**
 * Trait responsavel em manipular Element Select para pesquisa de Estado Civil.
 */
trait EstadoCivil
{

    /**
     * Metodo responsavel em adicionar o Element Select para selecao de Cor/Raca.
     * 
     * @example $this->addEstadoCivil($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $strEmptyOption, $strOnChange);
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
    public function addEstadoCivil($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strEmptyOption = null, $strOnChange = null)
    {
        $arrParamExtra = array(
            array('empty_option', 'strEmptyOption'),
            array('onchange', 'strOnChange'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'coEstadoCivil',
            'label' => 'Estado Civil',
            'placeholder' => 'Selecione',
            'empty_option' => 'Selecione',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrAttribute = array(
            'value_options' => array('addOption', $this->listEstadoCivil()),
        );
        return $this->getElementConfiguredExtended($arrParam, $arrParamExtra, $arrAttribute, 'addSelect');
    }

    /**
     * Metodo responsavel em retornar os dados contidos no Sistema Corporativo
     * via servico referente a Estado Civil.
     * 
     * @example $this->listEstadoCivil();
     * 
     * @return array
     */
    protected function listEstadoCivil()
    {
        $arrEstadoCivil = array();
        $mixResult = (new RestCorp())->estadoCivil();
        if (is_object($mixResult)) {
            foreach ($mixResult->listaEstadoCivil as $estadoCivil)
                $arrEstadoCivil[$estadoCivil->codigoEstadoCivil] = $estadoCivil->nomeEstadoCivil;
            asort($arrEstadoCivil);
        }
        if (count($arrEstadoCivil) == 0)
            $arrEstadoCivil = $this->listEntity('InepZend\Module\Corporative\Service\EstadoCivil', array(), null, null, array('noEstadoCivil' => 'ASC'));
        return $arrEstadoCivil;
    }

}
