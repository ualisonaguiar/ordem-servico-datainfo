<?php

namespace InepZend\FormGenerator\Add;

use InepZend\Util\ArrayCollection;
use InepZend\Util\Format;
use InepZend\Exception\RuntimeException;

/**
 * Trait responsavel em manipular o Element Text para Telefones.
 */
trait Phone
{

    private static $strPrefixDdd = 'nu_ddd_';
    private static $arrDddPhone = array();

    /**
     * Metodo responsavel em inserir Telefone e DDD no Form.
     * 
     * @example $this->addPhone($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $intDigit, $booDdd , $strValueDdd, $strReadonly);
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
     * @param integer $intDigit
     * @param boolean $booDdd
     * @param string $strValueDdd
     * @param string $strReadonly
     * @return mix
     */
    public function addPhone($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $intDigit = null, $booDdd = false, $strValueDdd = null, $strReadonly = null)
    {
        $arrParamExtra = array(
            array('digit', 'intDigit'),
            array('ddd', 'booDdd'),
            array('value_ddd', 'strValueDdd'),
            array('readonly', 'strReadonly'),
        );
        $arrParam = $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'nuTelefone',
            'label' => 'Telefone',
            'placeholder' => 'Entre com o Telefone',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
//        $intDigit = @$arrParam['digit'];
//        if (empty($intDigit))
//            $intDigit = 8;
//        $strMask = '';
//        for ($intCount = 0; $intCount < $intDigit; ++$intCount) {
//            if ($intCount == 4)
//                $strMask .= '-';
//            $strMask .= '9';
//        }
        $strMask = '9999-9999?9';
        $booDdd = ((array_key_exists('ddd', $arrParam)) && ($arrParam['ddd']));
        if ($booDdd) {
            $arrParamSelect = $arrParam;
            $strPrefix = self::getPrefixDdd();
            $arrParamSelect['name'] = $strPrefix . $arrParamSelect['name'];
            $arrParamSelect['placeholder'] = 'DDD';
            $arrParamSelect['title'] = $arrParamSelect['placeholder'];
            $arrParamSelect['style'] = 'float: left; width: 130px;';
            $arrParamSelect['group_style'] = 'width: 145px;';
            $arrParamSelect['empty_option'] = $arrParamSelect['placeholder'];
            if ((array_key_exists('id', $arrParamSelect)) && (!empty($arrParamSelect['id'])) && (strpos($arrParamSelect['id'], $strPrefix) === false))
                $arrParamSelect['id'] = $strPrefix . $arrParamSelect['id'];
            if ((array_key_exists('value_ddd', $arrParamSelect)) && (!empty($arrParamSelect['value_ddd'])))
                $arrParamSelect['value'] = $arrParamSelect['value_ddd'];
            elseif (array_key_exists('value', $arrParamSelect))
                unset($arrParamSelect['value']);
            if ((array_key_exists('attr_data', $arrParamSelect)) && (is_array($arrParamSelect['attr_data'])) && (array_key_exists('ng-model', $arrParamSelect['attr_data'])))
                $arrParamSelect['attr_data']['ng-model'] = str_replace($arrParam['name'], $arrParamSelect['name'], $arrParamSelect['attr_data']['ng-model']);
            $arrUnset = array(
                'digit',
                'ddd',
                'value_ddd',
                'class',
                'help_text',
            );
            ArrayCollection::unsetParam($arrUnset, $arrParamSelect);
            $arrElement = $this->addSelect($arrParamSelect);
            if (!is_array($arrElement))
                throw new RuntimeException('Não foi possível construir o select do DDD no formulário.');
            $this->addOption($arrElement, 'value_options', Format::listDdd());
//            $this->addAttribute($arrElement, 'onchange', 'changeMaskPhoneFromDdd(\'' . (((array_key_exists('id', $arrElement)) && (!empty($arrElement['id']))) ? $arrElement['id'] : $arrElement['name']) . '\', \'' . (((array_key_exists('id', $arrParam)) && (!empty($arrParam['id']))) ? $arrParam['id'] : $arrParam['name']) . '\', \',{completed:function(){validateValueMask(this, \\\'' . $strMask . '\\\', true);}}\');');
            $this->setElement($arrElement);
            $arrUnset = array(
                'digit',
                'ddd',
                'value_ddd',
                'label',
                'label_class',
                'label_style',
            );
            ArrayCollection::unsetParam($arrUnset, $arrParam);
            if (self::isThemeAdministrativeResponsible())
                $this->addHtml('<div class="form-group phoneDdd" style="' . @$arrParam['group_style'] . '">');
        }
        if (array_key_exists('value', $arrParam))
            $arrParam['value'] = str_pad($arrParam['value'], 8, '0', STR_PAD_LEFT);
        $arrElement = $this->addText($arrParam);
        if (!is_array($arrElement)) {
            if (!$booDdd)
                return false;
            throw new RuntimeException('Não foi possível construir os elementos de telefone no formulário.');
        }
        $this->addOption($arrElement, 'mask', $strMask);
        $this->addAttribute($arrElement, 'style', (array_key_exists('style', $arrElement) ? (string) $arrElement['style'] : ''));
        $this->addOption($arrElement, 'phone', true);
        $this->addOption($arrElement, 'ddd', $booDdd);
        $arrElement = $this->setStyleWidth($arrElement, '200px');
        $this->setElement($arrElement);
        $this->setDddPhone($arrElement['name'], $booDdd);
        if ($booDdd) {
            $this->refreshInputFilter();
            if (self::isThemeAdministrativeResponsible())
                $this->addHtml('</div>');
        }
        return (!$booDdd) ? $arrElement : $this;
    }

    /**
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
     * @param string strJsEvalValidate
     * @param boolean $booRestCorp
     */
    public function addPhoneCrud($strLabel = null, $arrPlaceHolder = null, $arrRequired = null, $strTypeValidateMessage = null, $arrDisabled = null, $arrResource = null, $strActionToResourceNotAllowed = null, $arrReadonly = null, $arrNotShow = null, $arrSuggestion = null, $strJsEvalValidate = null, $booRestCorp = false)
    {
        $arrParamExtra = array(
            array('readonly', 'strReadonly'),
            array('not_show', 'arrNotShow'),
            array('suggestion', 'arrSuggestion'),
            array('js_eval_validate', 'strJsEvalValidate'),
            array('rest_corp', 'booRestCorp'),
        );
        $arrParam = $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false, $this->removeParamDefault(array(0, 1, 2, 6, 7, 8, 9, 10, 11, 16, 17, 18, 19)));
        $strLabel = @$arrParam['label'];
        if (empty($strLabel))
            $strLabel = 'Telefone(s)';
        $this->addHtml('<script type="text/javascript">$(document).ready(function () {include_once("/vendor/InepZend/js/form-generator.js" + strGlobalSufixJsGzip);});</script>');
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>' . $strLabel . '</h3><div style="overflow: hidden;">');
        $arrTypePhone = (array_key_exists('rest_corp', $arrParam) ? $this->listTypePhoneRestCorp() : $this->listTypePhone());
        $this->addSelect(array('style' => 'float: left;', 'group_style' => 'width: 25%;', 'name' => 'coTipoTelefone', 'label' => 'Tipo', 'value_options' => $arrTypePhone, 'placeholder' => 'Selecione', 'empty_option' => 'Selecione', 'attr_data' => array('domain' => 'nu_telefone')));
        $this->addPhone(array('group_style' => 'float: left;', 'ddd' => true, 'attr_data' => array('domain' => 'nu_telefone')));
        $this->addButton(array('title' => 'Adicionar Telefone', 'onclick' => 'insertIntoCrud(\'nu_telefone\', undefined, undefined, undefined, ' . ((@empty($arrParam['js_eval_validate'])) ? 'undefined' : '\'' . $arrParam['js_eval_validate'] . '\'') . ');'));
        $this->addHtml('</div>');
        $this->addTable(array('name' => 'nu_telefone', 'title' => array('Tipo' => array('nomeSubTipoContato', 'width: 30%;'), 'Telefone' => array(array('txContatoFormated', 'txContato'))), 'sort' => 'event', 'icon' => array(array('class' => 'fa fa-trash', 'title' => 'Excluir Telefone', 'onclick' => 'removeFromCrud(this);'))));
        $this->addHtml('</div>');
        return $this;
    }

    /**
     * Metodo responsavel em retornar os DDD formatados entre colchetes.
     * 
     * @example self::listDdd(true|false);
     * 
     * @param boolean $boo9Digit
     * @return string
     */
    public static function listDdd($boo9Digit = false)
    {
        return '[' . implode(', ', Format::listDdd($boo9Digit)) . ']';
    }

    /**
     * Metodo responsavel em inserir prefixos no atributo $strPrefixDdd.
     * 
     * @example self::setPrefixDdd('777');
     * 
     * @param string $strPrefixDdd
     * @return string
     */
    public static function setPrefixDdd($strPrefixDdd)
    {
        return (self::$strPrefixDdd = $strPrefixDdd);
    }

    /**
     * Metodo responsavel em retorna os prefixos contidos no atributo $strPrefixDdd.
     * 
     * @example self::getPrefixDdd();
     * 
     * @return string
     */
    public static function getPrefixDdd()
    {
        return self::$strPrefixDdd;
    }

    /**
     * Metodo responsavel em inserir DDDs no atributo $arrDddPhone.
     * 
     * @example self::setDddPhone($strName, true|false);
     * 
     * @param string $strName
     * @param boolean $booDdd
     * @return boolean
     */
    private static function setDddPhone($strName = null, $booDdd = false)
    {
        if (empty($strName))
            return false;
        return (self::$arrDddPhone[$strName] = (bool) $booDdd);
    }

    /**
     * Metodo responsavel em retornar os DDDs contidos no atributo $arrDddPhone.
     * 
     * @example self::getDddPhone($strName);
     * 
     * @param string $strName
     * @return array
     */
    public static function getDddPhone($strName = null)
    {
        return (empty($strName)) ? self::$arrDddPhone : @self::$arrDddPhone[$strName];
    }

    private function listTypePhone()
    {
        $arrResult = array();
        $arrSubtipoContato = $this->getService('InepZend\Module\Oauth\Service\SsiService')->obterSubtipoContatoTelefone();
        foreach ($arrSubtipoContato as $subtipoContato)
            $arrResult[$subtipoContato->id] = $subtipoContato->nome;
        return $arrResult;
    }

    private function listTypePhoneRestCorp()
    {
        return [
            2 => 'Celular',
            1 => 'Telefone Fixo',
            5 => 'Telefone Comercial',
        ];
    }
}