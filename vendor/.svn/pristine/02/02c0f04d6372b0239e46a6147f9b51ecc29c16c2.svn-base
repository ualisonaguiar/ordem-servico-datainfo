<?php

namespace InepZend\FormGenerator\Add;

/**
 * Trait responsavel em manipular Element Text para Email.
 */
trait Email
{
    /**
     * Metodo responsavel em inserir o Element Text para email com suas respectivas
     * validacoes.
     *
     * @example $this->addEmail($strName, $strValue, $strId, $strLabel, $strPlaceHolder, $booRequired = false, $strTitle, $strClass, $strStyle, $strLabelClass, $strLabelStyle, $strHelpText, $strTypeValidateMessage, $strDisabled, $strResource, $strActionToResourceNotAllowed, $intTabindex, $arrAttributeData, $strGroupClass, $strGroupStyle, $intMaxlength, $strReadonly);
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
     * @param integer $arrAttributeData
     * @param string $strGroupClass
     * @param string $strGroupStyle
     * @param integer $intMaxlength
     * @param string $strReadonly
     * @return mix
     */
    public function addEmail($strName = null, $strValue = null, $strId = null, $strLabel = null, $strPlaceHolder = null, $booRequired = false, $strTitle = null, $strClass = null, $strStyle = null, $strLabelClass = null, $strLabelStyle = null, $strHelpText = null, $strTypeValidateMessage = null, $strDisabled = null, $strResource = null, $strActionToResourceNotAllowed = null, $intTabindex = null, $arrAttributeData = null, $strGroupClass = null, $strGroupStyle = null, $intMaxlength = null, $strReadonly = null)
    {
        $arrParamExtra = array(
            array('maxlength', 'intMaxlength'),
            array('show_validate', 'booShowValidate'),
            array('readonly', 'strReadonly'),
        );
        $arrParam = (array)$this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false);
        $arrParamValue = array(
            'name' => 'txEmail',
            'label' => 'E-mail',
            'placeholder' => 'Entre com o E-mail',
            'show_validate' => false,
        );
        $this->setValueIntoEmptyParam($arrParam, $arrParamValue);
        $arrAttribute = array(
            'type' => array('addGeneric', 'InepZend\FormGenerator\Element\Email'),
            'maxlength' => array('addAttribute'),
            'show_validate' => array('addOption'),
        );
        return $this->getElementConfiguredExtended($arrParam, $arrParamExtra, $arrAttribute);
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
     * @param integer $intMaxlength
     * @param boolean $booRestCorp
     */
    public function addEmailCrud($strLabel = null, $arrPlaceHolder = null, $arrRequired = null, $strTypeValidateMessage = null, $arrDisabled = null, $arrResource = null, $strActionToResourceNotAllowed = null, $arrReadonly = null, $arrNotShow = null, $arrSuggestion = null, $strJsEvalValidate = null, $intMaxlength = null, $booRestCorp = false)
    {
        $arrParamExtra = array(
            array('readonly', 'strReadonly'),
            array('not_show', 'arrNotShow'),
            array('suggestion', 'arrSuggestion'),
            array('js_eval_validate', 'strJsEvalValidate'),
            array('maxlength', 'intMaxlength'),
            array('rest_corp', 'booRestCorp'),
        );
        $arrParam = $this->getParamEdited(func_get_args(), func_num_args(), $arrParamExtra, false, $this->removeParamDefault(array(0, 1, 2, 6, 7, 8, 9, 10, 11, 16, 17, 18, 19)));
        $strLabel = @$arrParam['label'];
        if (empty($strLabel))
            $strLabel = 'E-mail(s)';
        $this->addHtml('<script type="text/javascript">$(document).ready(function () {include_once("/vendor/InepZend/js/form-generator.js" + strGlobalSufixJsGzip);});</script>');
        $this->addHtml('<div class="well" style="overflow: hidden;"><h3>' . $strLabel . '</h3><div style="overflow: hidden;">');
        $arrTypeEmail = (array_key_exists('rest_corp', $arrParam) ? $this->listTypeEmailRestCorp() : $this->listTypeEmail());
        $this->addSelect(array('style' => 'float: left;', 'group_style' => 'width: 25%;', 'name' => 'coTipoEmail', 'label' => 'Tipo', 'value_options' => $arrTypeEmail, 'placeholder' => 'Selecione', 'empty_option' => 'Selecione', 'attr_data' => array('domain' => 'tx_email')));
        $this->addEmail(array('style' => 'float: left;', 'group_style' => 'width: 25%;', 'maxlength' => @$arrParam['maxlength'], 'attr_data' => array('domain' => 'tx_email')));
        $this->addEmail(array('style' => 'float: left;', 'group_style' => 'width: 25%;', 'maxlength' => @$arrParam['maxlength'], 'name' => 'txEmailConfirmacao', 'label' => 'Confirme o E-mail', 'placeholder' => 'Entre com a Confirmação do E-mail', 'attr_data' => array('domain' => 'tx_email')));
        $this->addButton(array('title' => 'Adicionar E-mail', 'onclick' => 'insertIntoCrud(\'tx_email\', undefined, undefined, undefined, ' . ((@empty($arrParam['js_eval_validate'])) ? 'undefined' : '\'' . $arrParam['js_eval_validate'] . '\'') . ');'));
        $this->addHtml('</div>');
        $this->addTable(array('name' => 'tx_email', 'title' => array('Tipo' => array('nomeSubTipoContato', 'width: 30%;'), 'E-mail' => 'txContato'), 'sort' => 'event', 'icon' => array(array('class' => 'fa fa-trash', 'title' => 'Excluir E-mail', 'onclick' => 'removeFromCrud(this);'))));
        $this->addHtml('</div>');
        return $this;
    }

    private function listTypeEmail()
    {
        $arrResult = array();
        $arrSubtipoContato = $this->getService('InepZend\Module\Oauth\Service\SsiService')->obterSubtipoContatoEmail();
        foreach ($arrSubtipoContato as $subtipoContato)
            $arrResult[$subtipoContato->id] = $subtipoContato->nome;
        return $arrResult;
    }

    private function listTypeEmailRestCorp($strType)
    {
        return [
            3 => 'E-mail',
            4 => 'E-Mail Alternativo',
        ];
    }

}
