<?php

namespace InepZend\FormGenerator\Add;

use InepZend\Util\ArrayCollection;
use InepZend\Exception\RuntimeException;

trait Transfer
{

    private static $intHeightTransfer = 200;
    private static $strSufixTransferNotSelectable = '[NotSelectable]';

    /**
     * Metodo responsavel em inserir o Element Html customizado para o Transfer.
     * Ao instanciar o AddTransfer() no Form todas as acoes de transferencia de
     * dados, sendo esses acionados pelos botoes, entre os multiple select ja serao
     * inseridos nao sendo sendo necessario a criacao de JS e nem CSS.
     *
     * @example $this->addTransfer($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $arrValueOption, $strCallbackJsTransferOptions);
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
     * @param string $arrValueOption
     * @param string $strCallbackJsTransferOptions
     * @param string $strCallbackJsCheck
     * @return mix
     */
    public function addTransfer($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $arrValueOption = array(), $strCallbackJsTransferOptions = null, $strCallbackJsCheck = null)
    {
        $arrParamExtra = array(
            array('value_options', 'arrValueOption'),
            array('callback_transfer_options', 'strCallbackJsTransferOptions'),
            array('callback_check', 'strCallbackJsCheck'),
        );
        $arrParam = (array) $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'coTransfer',
            'label' => 'Transfer',
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrParam = array($arrParam);
//        $arrParam = $this->getParam(func_get_args(), func_num_args(), array_merge($this->arrParamDefault, $arrParamExtra));
        $this->addHtml('<div style="overflow: hidden; width: 100%; *height: ' . (self::$intHeightTransfer - 2) . 'px;">');
        if (self::isThemeAdministrativeResponsible())
            $this->addHtml('<div class="divTransferBlock">');
        $this->makeTransferNotSelectable($arrParam);
        if (self::isThemeAdministrativeResponsible())
            $this->addHtml('</div>');
        $this->makeTransferButton($arrParam);
        if (self::isThemeAdministrativeResponsible())
            $this->addHtml('<div class="form-group" style="width: 37%; float: left; position: relative; overflow: hidden; border: 0px; padding-top: 24px;">');
        $this->makeTransferSelectable($arrParam);
        if (self::isThemeAdministrativeResponsible())
            $this->addHtml('</div>');
        $this->addHtml('</div>');
        $strOnSubmit = trim((string) $this->getAttribute('onsubmit'));
        if (strpos($strOnSubmit, 'managerTransfer(') === false) {
            $strJavascript = 'javascript:';
            $strPrefix = (stripos($strOnSubmit, $strJavascript) === 0) ? $strJavascript : '';
            if (!empty($strPrefix))
                $strOnSubmit = substr($strOnSubmit, strlen($strJavascript));
            $this->setAttribute('onsubmit', $strPrefix . 'managerTransfer();' . $strOnSubmit);
        }
        return $this;
    }

    /**
     * Metodo responsavel em retornar a lista dos valores a serem transferidos.
     *
     * @example $this->listNameTransfer($arrParam);
     *
     * @param array $arrParam
     * @return array
     */
    private function listNameTransfer($arrParam = null)
    {
        $this->checkNameParam($arrParam);
        $strSufixNotSelectable = self::getSufixTransferNotSelectable();
        return array($arrParam[0]['name'], $arrParam[0]['name'] . $strSufixNotSelectable, $strSufixNotSelectable);
    }

    /**
     * Metodo responsavel em realizar as transferencias das opcoes nao selecionadas.
     *
     * @param array $arrParam
     * @return mix
     */
    private function makeTransferNotSelectable($arrParam = null)
    {
        return $this->makeTransferSelect($arrParam, __FUNCTION__);
    }

    /**
     * Metodo responsavel em realizar as transferencias das opcoes selecionadas.
     *
     * @param array $arrParam
     * @return mix
     */
    private function makeTransferSelectable($arrParam = null)
    {
        return $this->makeTransferSelect($arrParam, __FUNCTION__);
    }

    /**
     * Metodo responsavel em montar os Element Select para selecao dos elementos
     * e realizar as transferencias.
     *
     * @example $this->makeTransferSelect($arrParam, $strMethod);
     *
     * @param array $arrParam
     * @param string $strMethod
     * @return mix
     */
    private function makeTransferSelect($arrParam = null, $strMethod = null)
    {
        $arrResult = $this->listNameTransfer($arrParam);
        $strNameSelectable = $arrResult[0];
        $strNameNotSelectable = $arrResult[1];
        $strSufixNotSelectable = $arrResult[2];
        $arrParamSelect = $arrParam[0];
        if (array_key_exists('label', $arrParamSelect)) {
            if ((!empty($arrParamSelect['label'])) && ((!array_key_exists('title', $arrParamSelect)) || (empty($arrParamSelect['title']))))
                $arrParamSelect['title'] = $arrParamSelect['label'];
        }
        ArrayCollection::createEmptyParam(array('title', 'style'), $arrParamSelect);
        $arrParamSelect['title'] .= ((empty($arrParamSelect['title'])) ? '' : ' - ') . 'item(ns) ' . (($strMethod == 'makeTransferSelectable') ? '' : 'não ') . 'selecionado(s)';
        $arrParamSelect['style'] = 'height: ' . self::$intHeightTransfer . 'px; ' . $arrParamSelect['style'];
        if ($strMethod == 'makeTransferNotSelectable') {
            $arrParamSelect['style'] = 'float: left; ' . $arrParamSelect['style'];
            $arrParamSelect['name'] = $strNameNotSelectable;
            if ((array_key_exists('id', $arrParamSelect)) && (!empty($arrParamSelect['id'])) && (strpos($arrParamSelect['id'], $strSufixNotSelectable) === false))
                $arrParamSelect['id'] .= $strSufixNotSelectable;
        }
        $arrUnset = array('empty_option', 'onchange');
        if ($strMethod == 'makeTransferSelectable')
            $arrUnset[] = 'label';
        else {
            $arrUnset[] = 'help_text';
            if ((array_key_exists('attr_data', $arrParamSelect)) && (is_array($arrParamSelect['attr_data'])) && (array_key_exists('ng-model', $arrParamSelect['attr_data'])))
                unset($arrParamSelect['attr_data']['ng-model']);
        }
        ArrayCollection::unsetParam($arrUnset, $arrParamSelect);
        $arrElement = $this->addSelect($arrParamSelect);
        if (!is_array($arrElement))
            throw new RuntimeException('Não foi possível construir os selects múltiplos do transfer no formulário.');
        $arrValueOption = ((array_key_exists('options', $arrElement)) && (array_key_exists('value_options', $arrElement['options']))) ? $arrElement['options']['value_options'] : array();
        $arrValue = (empty($arrValueOption)) ? array() : $this->getElementValue($strNameSelectable);
        if (!is_array($arrValueOption))
            $arrValueOption = array();
        if (!is_array($arrValue))
            $arrValue = array();
        $arrValueFinal = array();
        foreach ((array) $arrValueOption as $mixValue => $mixText) {
            $booInArray = in_array($mixValue, $arrValue);
            if ($strMethod == 'makeTransferSelectable') {
                if ($booInArray)
                    $arrValueFinal[$mixValue] = $mixText;
            } else {
                if (!$booInArray)
                    $arrValueFinal[$mixValue] = $mixText;
            }
        }
        $this->addOption($arrElement, 'value_options', $arrValueFinal);
        $this->addAttribute($arrElement, 'multiple', 'multiple');
        $this->addAttribute($arrElement, 'ondblclick', $this->getJsTransferOptions($strNameNotSelectable, $strNameSelectable, (($strMethod == 'makeTransferSelectable') ? '<' : '>'), $arrParamSelect));
        $this->addOption($arrElement, 'transfer', true);
        $this->setElement($arrElement);
        return true;
    }

    /**
     * Metodo responsavel em inserir os Elements Html e Button referente ao Transfer
     * no Form.
     *
     * @param array $arrParam
     */
    private function makeTransferButton($arrParam = null)
    {
        $arrResult = $this->listNameTransfer($arrParam);
        $strNameSelectable = $arrResult[0];
        $strNameNotSelectable = $arrResult[1];
        $arrParamSelect = $arrParam[0];
        $strStyle = (self::isThemeAdministrativeResponsible()) ? 'text-align: center; width: 95px; ' : 'width: 79px; ';
        $arrDefault = (self::isThemeAdministrativeResponsible()) ? array('style' => 'float: none; margin-left: 10px; margin-right: 10px;') : array();
        $arrValue = (self::isThemeAdministrativeResponsible()) ? array('>' => array('value' => '>'), '<' => array('value' => '<'), '>>' => array('value' => '>>'), '<<' => array('value' => '<<')) : array();
        if (!@empty($arrParamSelect['disabled']))
            $arrDefault = array_merge($arrDefault, array('disabled' => $arrParamSelect['disabled']));
        $this->addHtml('<div style="' . $strStyle . 'overflow: hidden; float: left; padding-top: ' . ((self::$intHeightTransfer / 3) - 26) . 'px;" class="divTransferButton">');
        $this->addButton(array_merge($arrDefault, (array) @$arrValue['>'], array('name' => 'btnSetaSimplesAvancar', 'title' => 'Inserir um item selecionado', 'class' => 'btnDefault btnSetaSimplesAvancar', 'onclick' => $this->getJsTransferOptions($strNameNotSelectable, $strNameSelectable, '>', $arrParamSelect))));
        $this->addButton(array_merge($arrDefault, (array) @$arrValue['<'], array('name' => 'btnSetaSimplesVoltar', 'title' => 'Retirar um item selecionado', 'class' => 'btnDefault btnSetaSimplesVoltar', 'onclick' => $this->getJsTransferOptions($strNameNotSelectable, $strNameSelectable, '<', $arrParamSelect))));
        $this->addHtml('<br />');
        $this->addButton(array_merge($arrDefault, (array) @$arrValue['>>'], array('name' => 'btnSetaDuplaAvancar', 'title' => 'Inserir todos itens', 'class' => 'btnDefault btnSetaDuplaAvancar', 'onclick' => $this->getJsTransferOptions($strNameNotSelectable, $strNameSelectable, '>>', $arrParamSelect))));
        $this->addButton(array_merge($arrDefault, (array) @$arrValue['<<'], array('name' => 'btnSetaDuplaVoltar', 'title' => 'Retirar todos itens', 'class' => 'btnDefault btnSetaDuplaVoltar', 'onclick' => $this->getJsTransferOptions($strNameNotSelectable, $strNameSelectable, '<<', $arrParamSelect))));
        $this->addHtml('</div>');
    }

    /**
     * Metodo responsavel em inserir o valor do Height Transfer.
     *
     * @example $this->setHeightTransfer(10);
     *
     * @param integer $intHeightTransfer
     * @return integer
     */
    public static function setHeightTransfer($intHeightTransfer)
    {
        return (self::$intHeightTransfer = $intHeightTransfer);
    }

    /**
     * Metodo responsavel em retornar o valor do Height Transfer.
     *
     * @example $this->getHeightTransfer();
     *
     * @return integer
     */
    public static function getHeightTransfer()
    {
        return self::$intHeightTransfer;
    }

    /**
     * Metodo responsavel em inserir o sufixo ao atributo $strSufixTransferNotSelectable.
     *
     * @param string $strSufixTransferNotSelectable
     * @return string
     */
    public static function setSufixTransferNotSelectable($strSufixTransferNotSelectable)
    {
        return (self::$strSufixTransferNotSelectable = $strSufixTransferNotSelectable);
    }

    /**
     * Metodo responsavel em retornar o sufixo do atributo $strSufixTransferNotSelectable.
     *
     * @return string
     */
    public static function getSufixTransferNotSelectable()
    {
        return self::$strSufixTransferNotSelectable;
    }

    private function getJsTransferOptions($strNameNotSelectable = null, $strNameSelectable = null, $strSymbolDirection = null, $arrParam = array())
    {
        return 'transferOptions(\'' . $strNameNotSelectable . '\', \'' . $strNameSelectable . '\', \'' . $strSymbolDirection . '\', undefined, ' . ((is_null(@$arrParam['callback_transfer_options'])) ? 'undefined' : '\'' . $arrParam['callback_transfer_options'] . '\'') . ', ' . ((is_null(@$arrParam['callback_check'])) ? 'undefined' : '\'' . $arrParam['callback_check'] . '\'') . ');';
    }

}
