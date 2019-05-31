<?php

namespace InepZend\FormGenerator\Add;

use InepZend\Module\Corporative\Entity\VwPais;

/**
 * Trait responsavel em manipular Elemens para DadoPessoal.
 */
trait DadoPessoal
{

    /**
     * Metodo responsavel em inserir os Elements para DadoPessoal, sendo esses
     * CPF, NUMERO DA IDENTIDADE, ORGAO EXPEDIDOR, UF DA IDENTIDADE, NOME, NOME DA
     * MAE, ESTADO CIVIL, COR/RACA, SEXO, NASCIMENTO, NACIONALIDADE, PAIS DE ORIGEM,
     * UF DE NASCIMENTO e MUNICIPIO DE NASCIMENTO.
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
     */
    public function addDadoPessoal($strLabel = null, $arrPlaceHolder = null, $arrRequired = null, $strTypeValidateMessage = null, $arrDisabled = null, $arrResource = null, $strActionToResourceNotAllowed = null, $arrReadonly = null, $arrNotShow = null, $arrSuggestion = null, $arrAttributeData = null)
    {
        $arrParamExtra = array(
            array('readonly', 'strReadonly'),
            array('not_show', 'arrNotShow'),
            array('suggestion', 'arrSuggestion'),
            array('attr_data', 'arrAttributeData'),
        );
        $arrParam = $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false, $this->removeParamDefault(array(0, 1, 2, 6, 7, 8, 9, 10, 11, 16, 17, 18, 19)));
        $arrParam['type'] = 'DadoPessoal';
        $strLabel = @$arrParam['label'];
        if (empty($strLabel))
            $strLabel = 'Dados Pessoais';
        $this->addGroup($arrParam, self::getElementToDadoPessoal(), $strLabel);
        $this->addHtml('<script type="text/javascript">
    function controlFromNacionalidade()
    {
        var nacionalidade = getObject("tpNacionalidade");
        if (nacionalidade == undefined)
            nacionalidade = getObject("tp_nacionalidade");
        var paisOrigem = getObject("coPaisOrigem");
        if (paisOrigem == undefined)
            paisOrigem = getObject("co_pais_origem");
        var ufNascimento = getObject("coUfNascimento");
        if (ufNascimento == undefined)
            ufNascimento = getObject("co_uf_nascimento");
        var municipioNascimento = getObject("coMunicipioNascimento");
        if (municipioNascimento == undefined)
            municipioNascimento = getObject("co_municipio_nascimento");
        if ((nacionalidade == undefined) || (paisOrigem == undefined) || (ufNascimento == undefined) || (municipioNascimento == undefined))
            return false;
        if (nacionalidade.value == "")
            return true;
        var arrOption = $(paisOrigem).find(\'option:contains(Brasil)\').get();
        var optionBrasil = (arrOption.length > 0) ? arrOption[0] : null;
        var booBrasileiroNato = (nacionalidade.value == 1);
        if (booBrasileiroNato) {
            if (isObject(optionBrasil))
                optionBrasil.style.display = "";
            paisOrigem.value = (isObject(optionBrasil)) ? optionBrasil.value : ' . VwPais::CO_PAIS_BRASIL . ';
            if (ufNascimento.hasAttribute("disabled")) {
                ufNascimento.removeAttribute("disabled");
                ufNascimento.value = "";
            }
            if (municipioNascimento.hasAttribute("disabled")) {
                municipioNascimento.removeAttribute("disabled");
                municipioNascimento.value = "";
            }
        } else {
            if (isObject(optionBrasil))
                optionBrasil.style.display = "none";
            ufNascimento.value = "";
            municipioNascimento.value = "";
            if (paisOrigem.hasAttribute("disabled")) {
                paisOrigem.removeAttribute("disabled");
                paisOrigem.value = "";
            }
        }
        configReadonlyFromValue(paisOrigem, true, booBrasileiroNato);
        configReadonlyFromValue(ufNascimento, true, (!booBrasileiroNato));
        configReadonlyFromValue(municipioNascimento, true, (!booBrasileiroNato));
        return true;
    }
    controlFromNacionalidade();
</script>');
        return $this;
    }

    /**
     * Metodo responsavel em retornar um array com os Elements que serao utilizados
     * para o DadoPessoal.
     * 
     * @example self::getElementToDadoPessoal();
     * 
     * @return array
     */
    public static function getElementToDadoPessoal()
    {
        return array(
            'nu_cpf' => array(
                'type' => 'Cpf',
                'style' => 'float: left;',
                'group_style' => 'width: 25%;',
            ),
            'nu_rg' => array(
                'type' => 'Text',
                'label' => 'N° da identidade',
                'placeholder' => 'Entre com o N° da identidade',
                'maxlength' => 20,
                'style' => 'float: left;',
                'group_style' => 'width: 25%;',
            ),
            'co_orgao_emissor' => array(
                'type' => 'OrgaoEmissor',
                'style' => 'float: left;',
                'group_style' => 'width: 25%;',
                'order_by' => 'DESC',
            ),
            'co_uf_rg' => array(
                'type' => 'Uf',
                'label' => 'UF da Identidade',
            ),
            'no_pessoa_fisica' => array(
                'type' => 'Text',
                'label' => 'Nome',
                'placeholder' => 'Entre com o Nome',
                'maxlength' => 150,
                'style' => 'float: left;',
                'group_style' => 'width: 37%;',
            ),
            'no_mae' => array(
                'type' => 'Text',
                'label' => 'Nome da Mãe',
                'placeholder' => 'Entre com o Nome da Mãe',
                'maxlength' => 150,
                'group_style' => 'width: 37%;',
            ),
            'dt_nascimento' => array(
                'type' => 'Nascimento',
                'style' => 'float: left;',
                'group_style' => 'width: 25%;',
            ),
            'tp_sexo' => array(
                'type' => 'Sexo',
                'style' => 'float: left;',
                'group_style' => 'width: 25%;',
            ),
            'co_estado_civil' => array(
                'type' => 'EstadoCivil',
                'style' => 'float: left;',
                'group_style' => 'width: 25%;',
            ),
            'co_cor_raca' => array(
                'type' => 'CorRaca',
            ),
            'tp_nacionalidade' => array(
                'type' => 'Nacionalidade',
                'style' => 'float: left;',
                'group_style' => 'width: 25%;',
                'onchange' => 'controlFromNacionalidade();',
            ),
            'co_pais_origem' => array(
                'type' => 'Pais',
                'label' => 'País de Origem',
                'style' => 'float: left;',
                'group_style' => 'width: 25%;',
            ),
            'co_uf_nascimento' => array(
                'type' => 'Uf',
                'label' => 'UF de Nascimento',
                'style' => 'float: left;',
                'group_style' => 'width: 25%;',
                'name_municipio' => 'co_municipio_nascimento',
            ),
            'co_municipio_nascimento' => array(
                'type' => 'Municipio',
                'label' => 'Município de Nascimento',
            ),
        );
    }

    /**
     * Metodo responsavel em editar Elements do addDadoPessoal sendo o segundo
     * parametro referenciado.
     * 
     * @example $this->editGroupDadoPessoal($arrParam, &$arrElement);
     * 
     * @param array $arrParam
     * @param array $arrElement
     * @return mix
     */
    public function editGroupDadoPessoal($arrParam = null, &$arrElement = null)
    {
        if (@$arrParam['type'] == 'DadoPessoal') {
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