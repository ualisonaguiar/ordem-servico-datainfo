<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular o Element Text para Cep.
 */
trait Cep
{

    /**
     * Metodo resposanvel em adicionar o Element Text customizado para adicao
     * de CEP, podendo esse acessar o Servico de Correio.
     * 
     * @example $this->addCep($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $strReadonly, $booLinkCorreios, $booAjaxCorreiosDne, $strJsConvertMap, $arrReadonlyAfterAjax);
     * 
     * @param string $strName
     * @param string $strValue
     * @param integer $strId
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
     * @param boolean $booLinkCorreios
     * @param boolean $booAjaxCorreiosDne
     * @param string $strJsConvertMap
     * @param array $arrReadonlyAfterAjax
     * @return mix
     */
    public function addCep($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $strReadonly = null, $booLinkCorreios = null, $booAjaxCorreiosDne = null, $strJsConvertMap = null, $arrReadonlyAfterAjax = null)
    {
        $arrParamExtra = array(
            array('readonly', 'strReadonly'),
            array('link_correios', 'booLinkCorreios'),
            array('ajax_correios_dne', 'booAjaxCorreiosDne'),
            array('js_convert_map', 'strJsConvertMap'),
            array('readonly_ajax_correios_dne', 'arrReadonlyAfterAjax'),
        );
        $arrParam = $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'coCep',
            'label' => 'CEP',
            'placeholder' => 'Entre com o CEP',
            'mask' => '99999-999',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrElement = $this->setStyleWidth($this->addText($arrParam), '130px');
        if (@$arrParam['link_correios']) {
            $arrElement = $this->setStyleFloat($arrElement, 'left');
            $this->addHtml('<div class="divHeightRow linkCorreios"><a href="http://www.correios.com.br" target="_blank" title="Abre a página dos Correios.">Consulte seu CEP</a></div>');
        }
        if (@$arrParam['ajax_correios_dne'])
            $this->addHtml('<script>
                    var arrConvertMap = new Array();
                    ' . (string) @$arrParam['js_convert_map'] . '
                    ' . self::renderJsEventAjaxCorreiosDne($arrParam) . '
                    ' . self::renderJsEventAjaxCorreiosDne($arrParam, 'blur') . '
                    ' . self::renderJsEventAjaxCorreiosDne($arrParam, 'keydown') . '
                    </script>');
        return $arrElement;
    }

    private static function renderJsEventAjaxCorreiosDne($arrParam = null, $strEvent = 'keyup')
    {
        return 'setEvent(\'' . @$arrParam['name'] . '\', \'' . $strEvent . '\', \'var strCepValue = replaceAll(document.getElementById(\"' . @$arrParam['name'] . '\").value, new Array(\"_\", \"-\"), \"\");' .
                    'if (("' . $strEvent . '" != "keydown") && (strCepValue.length == 8)) {' .
                        'ajaxCorreiosDne(\"' . @$arrParam['name'] . '\", arrConvertMap, ' . json_encode((array) @$arrParam['readonly_ajax_correios_dne']) . ');' .
                    '} else {' .
                        'strGlobalCepValue = undefined;' .
                    '}\');';
    }

}
