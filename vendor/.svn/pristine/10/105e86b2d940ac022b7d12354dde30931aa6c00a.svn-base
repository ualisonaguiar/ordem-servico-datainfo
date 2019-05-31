<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular Elemens para Endereco.
 */
trait Endereco
{

    /**
     * Metodo responsavel em inserir os Elements para Endereco, sendo esses
     * CEP, LOGRADOURO, NUMERO, COMPLEMENTO, BAIRRO, UF e MUNICIPIO.
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
     * @param boolean $booLinkCorreios
     * @param boolean $booAjaxCorreiosDne
     * @param array $arrReadonlyAfterAjax
     * @param array $arrAttributeData
     * @return mix
     */
    public function addEndereco($strLabel = null, $arrPlaceHolder = null, $arrRequired = null, $strTypeValidateMessage = null, $arrDisabled = null, $arrResource = null, $strActionToResourceNotAllowed = null, $arrReadonly = null, $arrNotShow = null, $booLinkCorreios = null, $booAjaxCorreiosDne = null, $arrReadonlyAfterAjax = null, $arrAttributeData = null)
    {
        $arrParamExtra = array(
            array('readonly', 'strReadonly'),
            array('not_show', 'arrNotShow'),
            array('link_correios', 'booLinkCorreios'),
            array('ajax_correios_dne', 'booAjaxCorreiosDne'),
            array('readonly_ajax_correios_dne', 'arrReadonlyAfterAjax'),
            array('attr_data', 'arrAttributeData'),
        );
        $arrParam = $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false, $this->removeParamDefault(array(0, 1, 2, 6, 7, 8, 9, 10, 11, 16, 17, 18, 19)));
        $arrParam['type'] = 'Endereco';
        $strLabel = @$arrParam['label'];
        if (empty($strLabel))
            $strLabel = 'Endereço';
        $arrReadonlyAfterAjax = (array) @$arrParam['readonly_ajax_correios_dne'];
        $this->addGroup($arrParam, self::getElementToEndereco(@$arrParam['link_correios'], @$arrParam['ajax_correios_dne'], $arrReadonlyAfterAjax), $strLabel);
        $strHtml = '<script type="text/javascript">';
        foreach ($arrReadonlyAfterAjax as $strAttribute => $booActive)
            if ($booActive !== false)
                $strHtml .= 'configReadonlyFromValue("' . $strAttribute . '", true);';
        $strHtml .= '</script>';
        $this->addHtml($strHtml);
        return $this;
    }

    /**
     * Metodo responsavel em retornar um array com os Elements que serao utilizados
     * para o Endereco.
     * 
     * @param boolean $booLinkCorreios
     * @param boolean $booAjaxCorreiosDne
     * @param array $arrReadonlyAfterAjax
     * @return array
     */
    public static function getElementToEndereco($booLinkCorreios = null, $booAjaxCorreiosDne = null, $arrReadonlyAfterAjax = null)
    {
        return array(
            'co_cep' => array(
                'type' => 'Cep',
                'link_correios' => (!is_bool($booLinkCorreios)) ? true : $booLinkCorreios,
                'ajax_correios_dne' => (!is_bool($booAjaxCorreiosDne)) ? true : $booAjaxCorreiosDne,
                'readonly_ajax_correios_dne' => $arrReadonlyAfterAjax,
                'js_convert_map' => 'arrConvertMap[\'sg_uf\'] = new Array(\'co_uf_endereco\', \'ajaxGetCoUfFromSigla\'); arrConvertMap[\'no_complemento_logradouro\'] = \'ds_complemento\'; arrConvertMap[\'co_ibge\'] = new Array(\'co_municipio_endereco\', \'ajaxUfOnChange\');',
            ),
            'no_logradouro' => array(
                'type' => 'Text',
                'label' => 'Logradouro',
                'placeholder' => 'Entre com o Logradouro',
                'maxlength' => 100,
                'style' => 'float: left;',
                'group_style' => 'width: 60%;',
                'attr_data' => array('domain' => 'co_cep'),
            ),
            'nu_endereco' => array(
                'type' => 'Text',
                'label' => 'Número',
                'placeholder' => 'Entre com o Número',
                'maxlength' => 10,
                'attr_data' => array('domain' => 'co_cep'),
            ),
            'ds_complemento' => array(
                'type' => 'Text',
                'label' => 'Complemento',
                'placeholder' => 'Entre com o Complemento',
                'maxlength' => 100,
                'style' => 'float: left;',
                'group_style' => 'width: 60%;',
                'attr_data' => array('domain' => 'co_cep'),
            ),
            'no_bairro' => array(
                'type' => 'Text',
                'label' => 'Bairro',
                'placeholder' => 'Entre com o Bairro',
                'maxlength' => 100,
                'attr_data' => array('domain' => 'co_cep'),
            ),
            'co_uf_endereco' => array(
                'type' => 'Uf',
                'style' => 'float: left;',
                'group_style' => 'width: 25%;',
                'name_municipio' => 'co_municipio_endereco',
                'attr_data' => array('domain' => 'co_cep'),
            ),
            'co_municipio_endereco' => array(
                'type' => 'Municipio',
                'attr_data' => array('domain' => 'co_cep'),
            ),
        );
    }

}