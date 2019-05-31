<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular Elemens para DadoBancario.
 */
trait DadoBancario
{

    /**
     * Metodo responsavel em inserir os Elements para DadoBancario, sendo esses
     * BANCO, AGENCIA, DIGITO VERIFICADOR AGENCIA, CONTA CORRENTE, DIGITO VERIFICADOR
     * CONTA CORRENTE e PIS/PASEP.
     * 
     * @param string $strLabel
     * @param array $arrPlaceHolder
     * @param array $arrRequired
     * @param string $strTypeValidateMessage
     * @param array $arrDisabled
     * @param array $arrResource
     * @param string $strActionToResourceNotAllowed
     * @param array $arrReadonly
     * @param array $arrNotShow
     * @param array $arrSuggestion
     * @param array $arrAttributeData
     * @return mix
     */
    public function addDadoBancario($strLabel = null, $arrPlaceHolder = null, $arrRequired = null, $strTypeValidateMessage = null, $arrDisabled = null, $arrResource = null, $strActionToResourceNotAllowed = null, $arrReadonly = null, $arrNotShow = null, $arrSuggestion = null, $arrAttributeData = null)
    {
        $arrParamExtra = array(
            array('readonly', 'strReadonly'),
            array('not_show', 'arrNotShow'),
            array('suggestion', 'arrSuggestion'),
            array('attr_data', 'arrAttributeData'),
        );
        $arrParam = $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false, $this->removeParamDefault(array(0, 1, 2, 6, 7, 8, 9, 10, 11, 16, 17, 18, 19)));
        $arrParam['type'] = 'DadoBancario';
        $strLabel = @$arrParam['label'];
        if (empty($strLabel))
            $strLabel = 'Dados Bancários';
        return $this->addGroup($arrParam, self::getElementToDadoBancario(), $strLabel);
    }

    /**
     * Metodo responsavel em retornar um array com os Elements que serao utilizados
     * para o DadoBancario.
     * 
     * @return array
     */
    public static function getElementToDadoBancario()
    {
        return array(
            'co_banco' => array(
                'type' => 'Banco',
            ),
            'nu_agencia' => array(
                'type' => 'Number',
                'label' => 'Agência',
                'placeholder' => 'Entre com a Agência',
                'style' => 'float: left;',
                'group_style' => 'width: 25%;',
                'maxlength' => 4,
            ),
            'nu_agencia_dv' => array(
                'type' => 'Number',
                'label' => 'DV da Agência',
                'placeholder' => 'DV da Agência',
                'style' => 'width: 50%; float: left;',
                'group_style' => 'width: 25%;',
                'maxlength' => 2,
            ),
            'nu_conta' => array(
                'type' => 'Number',
                'label' => 'Conta Corrente',
                'placeholder' => 'Entre com a Conta Corrente',
                'style' => 'float: left;',
                'group_style' => 'width: 25%;',
                'maxlength' => 13,
            ),
            'nu_conta_dv' => array(
                'type' => 'Number',
                'label' => 'DV da Conta Corrente',
                'placeholder' => 'DV da Conta Corrente',
                'style' => 'width: 50%;',
                'maxlength' => 2,
            ),
            'nu_pis_pasep' => array(
                'type' => 'PisPasep',
            ),
        );
    }

    public function editGroupDadoBancario($arrParam = null, &$arrElement = null)
    {
        if (@$arrParam['type'] == 'DadoBancario') {
            $arrParamDv = array('nu_agencia', 'nu_conta');
            foreach ($arrParamDv as $strParamDv) {
                if (($this->getParamValue($arrParam, 'not_show', $strParamDv) !== true) && ($this->getParamValue($arrParam, 'not_show', $strParamDv . '_dv') === true)) {
                    $arrElement[$strParamDv]['label'] .= ' (sem DV)';
                    $arrElement[$strParamDv]['placeholder'] .= ' (sem DV)';
                    $arrElement[$strParamDv]['title'] = 'Informe o código SEM o dígito verificador caso este exista.
Exemplo: 1234-5, sendo 1234 o código e 5 o dígito verificador.
Neste caso, informe 1234 e não inclua o 5 referente ao dígito verificador.';
                }
            }
            if ((!@empty($arrParam['suggestion'])) && (is_array($arrParam['suggestion']))) {
                foreach ($arrParam['suggestion'] as $strAttribute => $mixSuggestion) {
                    if ((!is_bool($mixSuggestion)) && (!is_array($mixSuggestion)))
                        continue;
                    $arrElement[$strAttribute]['suggestion'] = $mixSuggestion;
                }
            }
        }
        return $this;
    }

}