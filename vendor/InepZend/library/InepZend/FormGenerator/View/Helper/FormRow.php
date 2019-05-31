<?php

namespace InepZend\FormGenerator\View\Helper;

use Zend\Form\View\Helper\FormRow as ZendFormRow;
use Zend\Form\ElementInterface;
use Zend\Http\PhpEnvironment\Request;
use InepZend\FormGenerator\FormGenerator;
use InepZend\View\Helper\AbstractHtmlHeadHelper;
use InepZend\View\ThemeTrait;
use InepZend\Util\AttributeStaticTrait;
use InepZend\Util\Html;
use InepZend\Util\String;
use InepZend\Util\Date;
use InepZend\Util\Format;

class FormRow extends ZendFormRow
{

    use AttributeStaticTrait,
        ThemeTrait;

    private $strPaddingBreakLabel = null;
    private $strPaddingBreakLabelNext = null;
    private $booFloatLeft = null;
    private $booFloatLeftAnterior = null;
    private $strTypeElement;
    private static $intAccesskey = 0;
    private static $arrOnChangeUfMunicipio = array();
    private static $intTabindex = 15;

    public function render(ElementInterface $element)
    {
        $this->booFloatLeftAnterior = $this->booFloatLeft;
        $this->booFloatLeft = null;
        $this->strTypeElement = null;
        $this->hasFloatLeft($element);
        $this->renderValue($element);
        $this->renderClassStyle($element);
        $this->renderAccesskey($element);
        $this->renderTabindex($element);
        if (in_array($element->getAttribute('type'), array('html', 'table'))) {
            $this->strPaddingBreakLabel = null;
            $this->strPaddingBreakLabelNext = null;
            return $this->renderButton($element->getValue());
        }
        $this->renderNameOriginal($element);
        $this->renderHelpRender($element);
        $this->renderReadonlyDisabled($element);
        $strMarkup = html_entity_decode(parent::render($element));
        $this->renderButton($strMarkup);
        $this->renderCaptcha($element, $strMarkup);
        $this->renderMultiCheckRadio($element, $strMarkup);
        $this->renderMaxlength($element, $strMarkup);
        $this->renderLabel($element, $strMarkup);
        $this->renderJs($element, $strMarkup);
        $this->renderHelpIcon($element, $strMarkup);
        $this->renderValidateMessage($element, $strMarkup);
        $this->renderRequired($element, $strMarkup);
        $this->renderTheme($element, $strMarkup);
        $this->renderHiddenValue($element, $strMarkup);
        $this->renderConfirm($element, $strMarkup);
        return $strMarkup;
    }

    public static function getAccesskey()
    {
        $strAccessKey = String::getAlphabeticOrder(self::$intAccesskey, true);
        while (in_array($strAccessKey, array('i', 'u', 'a', 'g', 't', 'n', '+', '-'))) {
            ++self::$intAccesskey;
            $strAccessKey = String::getAlphabeticOrder(self::$intAccesskey, true);
        }
        ++self::$intAccesskey;
        return $strAccessKey;
    }

    private function renderValue(ElementInterface $element)
    {
        if ($element->getOption('type') == 'money') {
            $mixValue = is_float($element->getValue()) ? number_format($element->getValue(), 2) : $element->getValue();
            if (!empty($mixValue))
                $element->setValue(Format::floatToMoney($mixValue));
        }
    }

    private function renderAccesskey(ElementInterface $element)
    {
        if (self::isThemeAdministrativeResponsible()) {
            $strType = $this->getTypeElement($element);
            if (($element->getAttribute('type') == 'html') && (in_array($strType, array('button')))) {
                $strValue = $element->getValue();
                $strValueNew = null;
                $strAccessKey = self::getAccesskey();
                if (stripos($strValue, 'accesskey=""') !== false)
                    $strValueNew = str_replace('accesskey=""', 'accesskey="' . $strAccessKey . '"', $strValue);
                elseif (stripos($strValue, 'accesskey') === false)
                    $strValueNew = str_replace('<' . $strType . ' ', '<' . $strType . ' accesskey="' . $strAccessKey . '" ', $strValue);
                if (!empty($strValueNew))
                    $element->setValue($strValueNew);
            }
        }
    }

    private function renderTabindex(ElementInterface $element)
    {
        $strType = $this->getTypeElement($element);
        if (!in_array($strType, array('text', 'email', 'url', 'password', 'file', 'select', 'textarea', 'captcha', 'radio', 'checkbox', 'multi_checkbox', 'money', 'float')))
            return;
        $intTabindex = $element->getAttribute('tabindex');
        if (!empty($intTabindex))
            self::$intTabindex = (integer) $intTabindex;
        else
            $element->setAttribute('tabindex', self::$intTabindex);
        self::$intTabindex++;
    }

    private function renderClassStyle(ElementInterface $element)
    {
        $strClassOriginal = (string) $element->getAttribute('class');
        $strLabelClassOriginal = (string) $element->getAttribute('label_class');
//        $strStyleOriginal = (string) $element->getAttribute('style');
        $strLabelStyleOriginal = (string) $element->getAttribute('label_style');
        if (self::isThemeAdministrativeResponsible()) {
            $strClassOriginal = str_replace(array('btnDefault', 'btn-inep', '  '), array('btnDefault btn', 'btn-info', ' '), $strClassOriginal);
            $strType = $this->getTypeElement($element);
            if ((empty($strType)) || (!in_array($strType, array('text', 'email', 'url', 'password', 'file', 'select', 'textarea', 'captcha', 'checkbox', 'money', 'float')))) {
                if ($element->getAttribute('type') != 'html')
                    $element->setAttribute('class', trim($strClassOriginal));
                return;
            }
            if (in_array($strType, array('checkbox'))) {
                $arrLabelStyle = array();
                if (!Html::hasAttributeStyle($strLabelStyleOriginal, 'display:block'))
                    $arrLabelStyle[] = 'display: block;';
                if (!Html::hasAttributeStyle($strLabelStyleOriginal, 'float:left'))
                    $arrLabelStyle[] = 'float: left;';
                $element->setAttribute('label_style', trim(implode(' ', $arrLabelStyle) . ' ' . $strLabelStyleOriginal));
                return;
            }
            $strNameId = $this->getNameIdElement($element);
            $arrClass = array();
            if (stripos($strClassOriginal, 'form-control') === false)
                $arrClass[] = 'form-control';
//            if (strpos($strNameId, 'cpf') !== false)
//                $arrClass[] = 'cpf';
            $element->setAttribute('class', trim(implode(' ', $arrClass) . ' ' . $strClassOriginal));
            $arrLabelClass = array();
            if (stripos($strLabelClassOriginal, 'block') === false)
                $arrLabelClass[] = 'block';
            $element->setAttribute('label_class', trim(implode(' ', $arrLabelClass) . ' ' . $strLabelClassOriginal));
        }
    }

    private function renderNameOriginal(ElementInterface $element)
    {
        $strNameOriginal = $element->getOption('name_original');
        if (!empty($strNameOriginal))
            $element->setAttribute('name', $strNameOriginal);
    }

    private function renderHelpRender(ElementInterface $element)
    {
        $strHelpText = $element->getAttribute('help_text');
        $this->strPaddingBreakLabel = $this->strPaddingBreakLabelNext;
        $this->strPaddingBreakLabelNext = null;
        if (!empty($strHelpText)) {
            $strStyle = $element->getAttribute('style');
            if (!$this->hasFloatLeft($element)) {
                $this->strPaddingBreakLabelNext = '15px';
                if ($element->getAttribute('type') == 'textarea') {
                    $strHeight = str_replace(array(' ', ':', ';'), '', end($arrExplode = explode('height', strtolower($element->getAttribute('style')))));
                    if (!empty($strHeight)) {
                        $strUnit = null;
                        $arrUnit = array('px', '%', 'pt', 'cm', 'em', 'in', 'pc', 'ex', 'mm');
                        foreach ($arrUnit as $strUnitCorrect) {
                            if (stripos($strHeight, $strUnitCorrect) !== false) {
                                $strUnit = $strUnitCorrect;
                                break;
                            }
                        }
                        $this->strPaddingBreakLabelNext = (((integer) str_replace($strUnit, '', $strHeight) / 2) + 5) . $strUnit;
                    }
                }
            }
            $element->setAttribute('style', 'float: left; ' . $strStyle);
        }
        if (($element->getOption('transfer') === true) || ($element->getAttribute('type') == 'checkbox')) {
            $this->strPaddingBreakLabel = null;
            $this->strPaddingBreakLabelNext = null;
        }
    }

    private function renderReadonlyDisabled(ElementInterface $element)
    {
        if (($element->getOption('type') == 'money') && ($this->isReadonly($element)))
            $element->setAttribute('disabled', true);
    }

    private function renderButton(&$strMarkup)
    {
        if ((stripos($strMarkup, '<button') !== false) && (!self::isThemeAdministrativeResponsible())) {
            $request = new Request();
            $arrFile = array(
                'form' => array(
                    'SetaSimples',
                ),
                'preview' => array(
                    'Preview',
                    'Publicar',
                    'Imprimir',
                    'Download',
                    'GerarPdf',
                    'Pdf',
                ),
                'authentication' => array(
                    'Entrar',
                    'Sair',
                    'RecuperarSenha',
                    'AlterarSenha',
                    'AlterarSenhaTemporaria',
                    'PrimeiroAcesso',
                ),
                'other' => array(
                    'Calcular',
                    'ConsultarCep',
                    'IncluirArquivo',
                    'FinalizarAvaliacao',
                    'VisualizarObservacoes',
                    'Portal',
                ),
            );
            foreach ($arrFile as $strFilePart => $arrCssClass) {
                foreach ($arrCssClass as $strCssClass) {
                    if (strpos($strMarkup, 'btn' . $strCssClass) !== false) {
                        $strUrl = $request->getBaseUrl() . '/vendor/InepZend/css/style-button-' . $strFilePart . AbstractHtmlHeadHelper::getSufixCss();
                        $booInclude = (bool) self::getAttributeStatic('arrInclude', $strUrl);
                        if (!$booInclude) {
                            $strMarkup = '<link href="' . $strUrl . '" media="screen" rel="stylesheet" type="text/css">' . $strMarkup;
                            self::setAttributeStatic('arrInclude', true, $strUrl);
                        }
                    }
                }
            }
        }
        return $strMarkup;
    }

    private function renderCaptcha(ElementInterface $element, &$strMarkup)
    {
        if ((is_object($captcha = $element->getOption('captcha'))) && (($intPos = stripos($strMarkup, $captcha->getImgUrl())) !== false)) {
            $request = new Request();
            $strSrc = substr($strMarkup, $intPos);
            $strSrc = substr($strSrc, 1, strpos($strSrc, '"') - 1);
            $strMarkup = str_replace($strSrc, $request->getBaseUrl() . getShowFileUrl($strSrc), $strMarkup);
            $strMarkup = str_ireplace(array('<fieldset>', '</fieldset>'), '', $strMarkup);
            $strMarkup = str_ireplace(array('<legend>', '</legend>'), array('<label for="captcha[input]">', '</label>'), $strMarkup);
            $booLabel = (stripos($strMarkup, '<label') !== false);
            $strMarkup = str_replace(array('//', '</label>'), array('/', '</label><div style="overflow: hidden; width: ' . $captcha->getWidth() . 'px;">'), $strMarkup) . (($booLabel) ? '</div>' : '');
            $strMarkup = str_replace('<input', '<input style="width: ' . $captcha->getWidth() . 'px;"', $strMarkup);
            $strMarkup = str_replace('class="' . $element->getAttribute('class') . '" type="hidden"', 'type="hidden"', $strMarkup);
            $strMarkup = str_replace('data-ng-model="data.captcha.input" type="hidden"', 'data-ng-model="data.captcha.id" type="hidden"', $strMarkup);
            $strMarkup = str_replace(array('id="captcha"', 'id="captcha-hidden"'), array('id="captcha[input]"', 'id="captcha[id]"'), $strMarkup);
        }
    }

    private function renderMultiCheckRadio(ElementInterface $element, &$strMarkup)
    {
        if (in_array($element->getAttribute('type'), array('radio', 'multi_checkbox'))) {
            $strMarkup = str_ireplace(array('<fieldset>', '</fieldset>'), '', $strMarkup);
            $strMarkup = (stripos($strMarkup, 'style') === false) ? str_ireplace('<input', '<input style="float: left;"', $strMarkup) : str_ireplace('style="', 'style="float: left;', $strMarkup);
            $strMarkup = str_ireplace(array('<label>', '</label>'), array('<div class="divMultiCheckRadio">', '</label></div>'), $strMarkup);
            $strMarkup = str_ireplace(array('<legend>', '</legend>'), array('<label>', '</label>'), $strMarkup);
            $arrInput = array();
            $strMarkupClone = $strMarkup;
            while (stripos($strMarkupClone, '<input') !== false) {
                $strMarkupClone = substr($strMarkupClone, stripos($strMarkupClone, '<input'));
                $intOffset = (stripos($strMarkupClone, '>') + 1 - stripos($strMarkupClone, '<input'));
                $strInput = substr($strMarkupClone, stripos($strMarkupClone, '<input'), $intOffset);
                $arrInput[] = $strInput;
                $strMarkupClone = substr($strMarkupClone, $intOffset);
            }
            $arrTitleOption = $element->getOption('title_options');
            foreach ($arrInput as $strInput) {
                $strInputEd = $strInput;
                $mixPosId = stripos($strInputEd, ' id="');
                if ($mixPosId !== false) {
                    $strId = substr($strInputEd, $mixPosId + 5);
                    $strId = substr($strId, 0, strpos($strId, '"'));
                    $strInputEd = str_replace(' id="' . $strId . '"', "", $strInputEd);
                }
                $mixPosValue = stripos($strInputEd, ' value="');
                $strId = null;
                $strTitle = '';
                if ($mixPosValue !== false) {
                    $strValue = substr($strInputEd, $mixPosValue + 8);
                    $strValue = substr($strValue, 0, strpos($strValue, '"'));
                    $strId = $element->getAttribute('name') . '[' . $strValue . ']';
                    $strInputEd = str_replace('>', ' id="' . $strId . '">', $strInputEd);
                    if ((is_array($arrTitleOption)) && (array_key_exists($strValue, $arrTitleOption)))
                        $strTitle = 'title="' . $arrTitleOption[$strValue] . '" ';
                }
                $strMarkup = str_replace($strInput, $strInputEd . '<label class="labelMultiCheckRadio" ' . $strTitle . 'for="' . (string) $strId . '">', $strMarkup);
            }
            if (!self::isThemeAdministrativeResponsible())
                $strMarkup .= '<div style="height:39px;">&nbsp;</div>';
        }
    }

    private function getMaxlength(ElementInterface $element)
    {
        $intMaxlength = $element->getOption('maxlength');
        if (is_null($intMaxlength))
            $intMaxlength = $element->getAttribute('maxlength');
        return $intMaxlength;
    }

    private function renderMaxlength(ElementInterface $element, &$strMarkup)
    {
        $intMaxlength = $this->getMaxlength($element);
        $strType = $element->getAttribute('type');
        if ((!is_null($intMaxlength)) && (in_array($strType, array('number'))))
            $strMarkup = str_ireplace('type="' . $strType . '"', 'type="' . $strType . '" maxlength="' . $intMaxlength . '"', $strMarkup);
        if (in_array($strType, array('textarea'))) {
            if ((!is_null($intMaxlength)) && ($element->getOption('is_editor') !== true)) {
                $strMarkup .= '<script type="text/javascript">$("textarea[maxlength]").on("keyup keypress keydown", function(event){ return maxLengthControll(this, ' . $intMaxlength . ', event, true); });</script>';
                $strMarkup .= '<script type="text/javascript">$("textarea[maxlength]").on("paste", function(event){ return maxLengthControllTimeout(this, ' . $intMaxlength . ', undefined, true); });</script>';
            }
            if ($element->getOption('show_counter') !== false) {
                $strMarkup .= '<script type="text/javascript">include_once("/vendor/InepZend/js/character-counter' . AbstractHtmlHeadHelper::getSufixJs() . '");</script>';
                $strMarkup .= '<script type="text/javascript">characterCounter("' . $element->getAttribute('id') . '");</script>';
            }
        }
    }

    private function renderLabel(ElementInterface $element, &$strMarkup)
    {
        if (stripos($strMarkup, '<label') !== false) {
            if (!empty($this->strPaddingBreakLabel))
                $strMarkup = '<p class="paddingBreakLabel" style="padding: ' . $this->strPaddingBreakLabel . ';"></p>' . $strMarkup;
            $strElementRequiredOpen = '<div class="divRequired">';
            if (self::isThemeAdministrativeResponsible())
                $strElementRequiredOpen = '<i class="fa fa-asterisk" style="color: #9A0000"><div class="clearfix"></div>';
            $strElementRequiredClose = str_replace('<', '</', reset($arrExplode = explode(' ', $strElementRequiredOpen))) . '>';
            $strRequiredSymbol = ($element->hasAttribute('required')) ? $strElementRequiredOpen . '*' . $strElementRequiredClose : '';
            if ((empty($strRequiredSymbol)) && (!self::isThemeAdministrativeResponsible()))
                $strRequiredSymbol = $strElementRequiredOpen . $strElementRequiredClose;
            if (($element->hasAttribute('required')) && (self::isThemeAdministrativeResponsible()))
                $strRequiredSymbol = '&nbsp;' . $strElementRequiredOpen . $strElementRequiredClose;
            if (!in_array($element->getAttribute('type'), array('radio', 'multi_checkbox')))
                $strMarkup = str_ireplace('</label>', (self::isThemeAdministrativeResponsible()) ? $strRequiredSymbol . '</label>' : '</label>' . $strRequiredSymbol, $strMarkup);
            else {
                $intPosStart = stripos($strMarkup, '<label');
                if ($intPosStart === 0) {
                    $intPosFinish = stripos($strMarkup, '</label>') + strlen('</label>');
                    $strMarkup = substr($strMarkup, $intPosStart, $intPosFinish) . $strRequiredSymbol . substr($strMarkup, $intPosFinish);
                } /* else
                  $strMarkup = str_ireplace('</label>', '</label>' . $strRequiredSymbol, $strMarkup); */
            }
            if ($element->getOption('transfer') === true) {
                $strLabelFor = '<label for="';
                if (($intPosOpen = stripos($strMarkup, $strLabelFor)) !== false) {
                    $strPartStart = substr($strMarkup, 0, ($intPosOpen + strlen($strLabelFor)));
                    $strPartFinish = substr($strMarkup, ($intPosOpen + strlen($strLabelFor)));
                    if (($intPosClose = stripos($strPartFinish, '"')) !== false) {
                        $strFor = str_replace(FormGenerator::getSufixTransferNotSelectable(), '', substr($strPartFinish, 0, $intPosClose));
                        $strPartFinish = substr($strPartFinish, $intPosClose);
                        $strMarkup = $strPartStart . $strFor . $strPartFinish;
                    }
                }
            }
            $strMarkup = str_ireplace('<label', '<label' . (($element->hasAttribute('label_style')) ? ' style="' . $element->getAttribute('label_style') . '"' : ''), $strMarkup);
            $strMarkup = str_ireplace('<label', '<label' . (($element->hasAttribute('label_class')) ? ' class="' . $element->getAttribute('label_class') . '"' : ''), $strMarkup);
        }
    }

    private function renderJs(ElementInterface $element, &$strMarkup)
    {
        $booShowValidate = $element->getOption('show_validate');
        if (!is_bool($booShowValidate))
            $booShowValidate = true;
        $booShowValidate = ($booShowValidate) ? 'true' : 'false';
        $strMask = $element->getOption('mask');
        $strType = $this->getTypeElement($element);
        $booValidateValueMaskSpecial = in_array($strType, array('email'));
        if ((!empty($strMask)) || ($booValidateValueMaskSpecial)) {
            $booValidateValueMask = false;
            $arrValidateValueMaskEvent = array();
            $strParamMask = '';
            switch ($strMask) {
                case '999.999.999-99':
                case '99.999.999/9999-99':
                case '999.99999.99-9':
                case '9999-9999':
                case '99999-9999':
                case '9999-9999?9':
                case '99999-999?9':
                    $booValidateValueMask = true;
                    break;
                case '99999-999':
                    $strMarkup .= '<script type="text/javascript">$(document).ready(function () {
                        include_once("/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js' . AbstractHtmlHeadHelper::getSufixJsGzip() . '");
                        include_once("/vendor/jquery-base64/jquery-base64-0.1/jquery.base64.min.js' . AbstractHtmlHeadHelper::getSufixJsGzip() . '");
                    });</script>';
                    break;
                case '99/99/9999':
                    if ((!$element->getAttribute('readonly')) && (!$element->getAttribute('disabled'))) {
                        $booValidateValueMask = true;
                        $arrValidateValueMaskEvent['PasteDrop'] = true;
                        $arrValidateValueMaskEvent['Blur'] = true;
                        $strMarkup .= '<script type="text/javascript">include_once("/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js' . AbstractHtmlHeadHelper::getSufixJsGzip() . '");</script>';
                        $strMarkup .= '<script type="text/javascript">$("#' . $element->getAttribute('id') . '").datepicker({
                                ' . $this->getOptionsDatePicker($element) . '
                            });</script>';
                    }
                    break;
                case '99/99/9999 99:99':
                    if ((!$element->getAttribute('readonly')) && (!$element->getAttribute('disabled'))) {
                        $booValidateValueMask = true;
                        $arrValidateValueMaskEvent['PasteDrop'] = true;
                        $arrValidateValueMaskEvent['Blur'] = true;
                        $strMarkup .= '<script type="text/javascript">include_once("/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js' . AbstractHtmlHeadHelper::getSufixJsGzip() . '");</script>';
                        $strMarkup .= '<script type="text/javascript">include_once("/vendor/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon-1.4.3/js/jquery.ui.timepicker.addon.min.js' . AbstractHtmlHeadHelper::getSufixJsGzip() . '");</script>';
                        $strMarkup .= '<script type="text/javascript">$("#' . $element->getAttribute('id') . '").datetimepicker({
                                ' . $this->getOptionsDatePicker($element) . ',
                                ' . $this->getOptionsTimePicker($element) . '
                            });</script>';
                    }
                    break;
                case '99:99':
                    if ((!$element->getAttribute('readonly')) && (!$element->getAttribute('disabled'))) {
                        $booValidateValueMask = true;
                        $strMarkup .= '<script type="text/javascript">include_once("/vendor/jquery-ui/jquery-ui-1.11.4/js/jquery-ui.min.js' . AbstractHtmlHeadHelper::getSufixJsGzip() . '");</script>';
                        $strMarkup .= '<script type="text/javascript">include_once("/vendor/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon-1.4.3/js/jquery.ui.timepicker.addon.min.js' . AbstractHtmlHeadHelper::getSufixJsGzip() . '");</script>';
                        $strMarkup .= '<script type="text/javascript">$("#' . $element->getAttribute('id') . '").timepicker({
                                ' . $this->getOptionsTimePicker($element) . '
                            });</script>';
                    }
                    break;
            }
            if ($strType == 'email') {
                $strMask = '@.';
                $arrValidateValueMaskEvent['Blur'] = true;
            }
            if (strpos($strMask, '9') !== false) {
                if ($booValidateValueMask)
                    $strParamMask = ',{completed:function(){validateValueMask("' . $element->getAttribute('id') . '", "' . $strMask . '", ' . $booShowValidate . ');}}';
//                if ($element->getOption('ddd') !== true) {
                $strMarkup .= '<script type="text/javascript">include_once("/vendor/jquery-maskedinput/jquery-maskedinput-1.3.1/jquery.maskedinput.js' . AbstractHtmlHeadHelper::getSufixJsGzip() . '");</script>';
                if (in_array($strMask, array('9999-9999?9', '99999-999?9'))) {
                    if (strlen($element->getValue()) >= 9)
                        $strMask = '99999-999?9';
                    $strMarkup .= '<script type="text/javascript">$("#' . $element->getAttribute('id') . '").mask("' . $strMask . '"' . $strParamMask . ').keyup(function (event) {
                            var target, phone, element;
                            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                            phone = target.value.replace(/\D/g, "");
                            if ((phone.length != 8) && (phone.length != 9))
                                return;
                            element = $(target);
                            element.unmask();
                            if (phone.length == 9)
                                element.mask("99999-999?9");
                            else
                                element.mask("9999-9999?9");
                        });</script>';
                } else
                    $strMarkup .= '<script type="text/javascript">$("#' . $element->getAttribute('id') . '").mask("' . $strMask . '"' . $strParamMask . ');</script>';
//                }
            }
            foreach ($arrValidateValueMaskEvent as $strEvent => $booUse) {
                if ($booUse !== true)
                    continue;
                $strMarkup .= '<script type="text/javascript">setOn' . $strEvent . '("' . $element->getAttribute('id') . '", "validateValueMask(\'' . $element->getAttribute('id') . '\', \'' . $strMask . '\', ' . $booShowValidate . ')");</script>';
            }
            if (($element->getOption('rangeStart') === true) || ($element->getOption('rangeEnd') === true))
                $strMarkup .= '<script type="text/javascript">setOnKeyPress("' . $element->getAttribute('id') . '", "validateDateRange(\'' . $element->getAttribute('id') . '\')");</script>';
        }
        if (array_key_exists('data-validate-confirmacao-email', $element->getAttributes()))
            $strMarkup .= '<script type="text/javascript">setOnBlur("' . $element->getAttribute('id') . '", "validateFieldConfirmationEmail(\'' . $element->getAttribute('id') . '\', \'' . $element->getAttribute('data-validate-confirmacao-email') . '\')");</script>';
        if (array_key_exists('data-validate-confirmacao-telefone', $element->getAttributes()))
            $strMarkup .= '<script type="text/javascript">setOnBlur("' . $element->getAttribute('id') . '", "validateFieldConfirmationTelefone(\'' . $element->getAttribute('id') . '\', \'' . $element->getAttribute('data-validate-confirmacao-telefone') . '\')");</script>';
        if (in_array($element->getOption('type'), array('money', 'float'))) {
            $strMarkup .= '<script type="text/javascript">include_once("/vendor/jquery-maskmoney/jquery-maskmoney-2.1.2/jquery.maskmoney.js' . AbstractHtmlHeadHelper::getSufixJsGzip() . '");</script>';
            if ($element->getOption('type') == 'money')
                $strMarkup .= '<script type="text/javascript">$("#' . $element->getAttribute('id') . '").maskMoney({symbol: "R$ ", thousands: ".", decimal: ",", allowZero: true, symbolStay: true}); $("#' . $element->getAttribute('id') . '").maskMoney("mask");</script>';
            else
                $strMarkup .= '<script type="text/javascript">$("#' . $element->getAttribute('id') . '").maskMoney({symbol: "", thousands: "", decimal: ".", allowZero: ' . (($element->getOption('allow_zero') === false) ? 'false' : 'true') . ', symbolStay: false, precision: ' . (integer) $element->getOption('precision') . '}); $("#' . $element->getAttribute('id') . '").maskMoney("mask");</script>';
        } elseif (($element->getAttribute('type') == 'number') || ($element->getOption('number') === true)) {
            $strMarkup .= '<script type="text/javascript">include_once("/vendor/jquery-alphanumeric/jquery-alphanumeric-1.0/jquery.alphanumeric.pack.js' . AbstractHtmlHeadHelper::getSufixJsGzip() . '");</script>';
	    $strMarkup .= '<script type="text/javascript">$("#' . $element->getAttribute('id') . '").numeric({ichars:"áàâãäéèêëíìïóòôõöúùûüçÁÀÂÃÄÉÈÊËÍÌÏÓÒÔÕÖÚÙÛÜÇ,.;/<>:?][}{\\\|/*-+=\"\'!@#$%¨\~^´`&*()_ °ªº§¹²³·¬£¢€®ŧ←↓→øþæßðđŋħł«»©“”nµ─-", allow:"' . $element->getOption('separator') . '"}); setOnPasteDrop("' . $element->getAttribute('id') . '", "validateValueMask(\'' . $element->getAttribute('id') . '\', undefined, ' . $booShowValidate . ', \'integer\')");</script>';            
        } elseif (($element->getAttribute('type') == 'textarea') && ($element->getOption('is_editor') === true)) {
            $arrCssText = Html::getCssTextArray($element->getAttribute('style'), array('width' => '99.7%', 'height' => '180px'));
            $strMarkup = str_ireplace(array('<textarea', '</textarea>'), array('<div style="overflow: hidden;"><textarea', '</textarea></div>'), $strMarkup);
            $strScript = '<script type="text/javascript">include_once("/vendor/tinymce/tinymce-4.0.7/js/tinymce/tinymce.min.js");</script>';
            $arrPlugin = $element->getOption('plugins');
            if (!empty($arrPlugin)) {
                $strPlugin = '';
                if (!is_array($arrPlugin))
                    $arrPlugin = array($arrPlugin);
                foreach ($arrPlugin as $intKey => $strPluginIntern) {
                    if ($intKey <> 0)
                        $strPlugin .= ',';
                    $strPlugin .= '"' . str_replace(array('\'', '"'), '', $strPluginIntern) . '"';
                }
            } else
                $strPlugin = '"",
                    "",
                    "insertdatetime nonbreaking save table contextmenu directionality image",
                    "paste textcolor"';
            $arrToolbar = $element->getOption('toolbar');
            if (!empty($arrToolbar)) {
                $strToolbar = '';
                if (!is_array($arrToolbar))
                    $arrToolbar = array($arrToolbar);
                foreach ($arrToolbar as $intKey => $strToolbarIntern)
                    $strToolbar .= 'toolbar' . ($intKey + 1) . ': "' . str_replace(array('\'', '"'), '', $strToolbarIntern) . '",';
            } else
                $strToolbar = 'toolbar1: "undo redo | bold italic underline strikethrough | bullist numlist outdent indent | link image preview forecolor backcolor removeformat | table",
                    toolbar2: " | ",';
            $intMaxlength = $this->getMaxlength($element);
            $strScript .= '
<script type="text/javascript">
var strGlobalTinyMCEInitial;
tinyMCE.init({
    selector: "#' . $element->getAttribute('id') . '", 
    language: "pt_BR",
    theme: "modern",
    plugins: [
        ' . $strPlugin . '
    ],
    ' . $strToolbar . '
    image_advtab: true,
    removed_menuitems: "newdocument",
    width: "' . $arrCssText['width'] . '",
    height: "' . $arrCssText['height'] . '",
    paste_preprocess: function(element, elementPaste) {
        var strContent = elementPaste.content,
            intMaxlength = ' . (($intMaxlength) ? $intMaxlength : 'undefined') . ';
        if (intMaxlength != undefined)
            elementPaste.content = strContent.substr(elementPaste, intMaxlength);
    },
    setup: function(editor) {
        editor.on("KeyDown", function(editor, event) {
            strGlobalTinyMCEInitial = undefined;';
            $this->renderVarCounterCharacter($strScript, $intMaxlength);
            $strScript .= '
            var arrAllowedKeys = [8, 13, 16, 17, 18, 20, 33, 34, 35, 36, 37, 38, 39, 40, 46];
            if ((editor.keyCode == 8) || (editor.keyCode == 36) || (editor.keyCode == 46)) {
                ' . $this->renderContentCounterCharacter() . '
            }
            if (arrAllowedKeys.indexOf(editor.keyCode) != -1)
                return;
            bodyEditor = tinyMCE.activeEditor.getBody();
            strGlobalTinyMCEInitial = bodyEditor.innerText || bodyEditor.textContent;
            if (intCountWithoutHtml >= intMaxlength) {
                editor.stopPropagation();
                editor.preventDefault();
            } else {
                ' . $this->renderContentCounterCharacter() . '
            }
        });
        editor.on("KeyUp", function(editor) {
            if (strGlobalTinyMCEInitial != undefined) {';
            $this->renderVarCounterCharacter($strScript, $intMaxlength);
            $strScript .= '
                if ((intMaxlength != undefined) && (intCountWithoutHtml > intMaxlength)) {
                    var bodyEditor = tinyMCE.activeEditor.getBody();
                    if (bodyEditor.innerText)
                        bodyEditor.innerText = strGlobalTinyMCEInitial;
                    else
                        bodyEditor.textContent = strGlobalTinyMCEInitial;
                } else {
                    ' . $this->renderContentCounterCharacter() . '
                }
            }';
            if ($element->hasAttribute('required'))
                $strScript .= $this->renderControlMessageCountCharacter($element);
            $strScript .= '
        });
        editor.on("Click", function(editor) {';
            if ($element->hasAttribute('required'))
                $strScript .= $this->renderControlMessageCountCharacter($element);
            $strScript .= '
        });
        editor.on("FocusOut", function(editor) {';
            if ($element->hasAttribute('required'))
                $strScript .= $this->renderControlMessageCountCharacter($element);
            $strScript .= '
        });
        editor.on("Submit", function(editor) {';
            if ($element->hasAttribute('required')) {
                $strScript .= $this->renderControlMessageCountCharacter($element);
                $strScript .= 'return hasValidateEditorTinymce("'. $element->getAttribute('id') . '");';
            }
            $strScript .= '
        });
        editor.on("Change", function(editor) {';
            if ($element->hasAttribute('required'))
                $strScript .= '$(".countMin").html(tinyMCE.activeEditor.getContent().length)';
            $strScript .= '
        });
        editor.on("LoadContent", function(editor) {';
            if ($element->hasAttribute('required'))
                $strScript .= 'characterCounterEditor("'. $element->getAttribute('id') . '")';
            $strScript .= '
        });
    }
});

</script>';
            $strMarkup = $strScript . $strMarkup;
        } elseif (($element->getOption('transfer') === true) && (strpos($element->getAttribute('name'), FormGenerator::getSufixTransferNotSelectable()) === false)) {
            $mixValue = $element->getValue();
            if (!empty($mixValue)) {
                if (!is_array($mixValue))
                    $mixValue = array($mixValue);
                foreach ($mixValue as $mixValueSelectable)
                    $strMarkup .= '<script type="text/javascript">transferOptions("' . $element->getAttribute('name') . FormGenerator::getSufixTransferNotSelectable() . '", "' . $element->getAttribute('name') . '", ">", "' . $mixValueSelectable . '");</script>';
            }
//        } elseif ($element->getOption('ddd') === true) {
//            $strMarkup .= '<script type="text/javascript">changeMaskPhoneFromDdd("' . FormGenerator::getPrefixDdd() . $element->getAttribute('id') . '", "' . $element->getAttribute('id') . '", \'' . $strParamMask . '\');</script>';
//            $strMarkup .= '<script type="text/javascript">setOnKeyUp("' . $element->getAttribute('id') . '", \'changeMaskPhoneFromNumber("' . FormGenerator::getPrefixDdd() . $element->getAttribute('id') . '", "' . $element->getAttribute('id') . '", \\\'' . $strParamMask . '\\\');\');</script>';
        } elseif ((!is_null($element->getOption('name_municipio'))) && (!is_null($element->getAttribute('onchange'))))
            self::$arrOnChangeUfMunicipio[$element->getOption('name_municipio')] = $element->getAttribute('onchange');
        elseif (!is_null(@self::$arrOnChangeUfMunicipio[$element->getAttribute('name')]))
            $strMarkup .= '<script type="text/javascript">' . str_replace('undefined', '\'' . $element->getValue() . '\'', self::$arrOnChangeUfMunicipio[$element->getAttribute('name')]) . '</script>';
        elseif (in_array($strType, array('text'))) {
            $arrSuggestion = $element->getOption('suggestion');
            if (is_array($arrSuggestion)) {
                $strUrlListAvailableTag = @$arrSuggestion['url_list'];
                $strFunctionListAvailableTag = @$arrSuggestion['function_list'];
                $intMinLengthStart = @$arrSuggestion['minlength_start'];
                $intMaxLengthItem = @$arrSuggestion['maxlength_item'];
                $strUrlMethod = @$arrSuggestion['url_method'];
                $strHiddenValue = @$arrSuggestion['hidden_value'];
                if ((!empty($strUrlListAvailableTag)) || (!empty($strFunctionListAvailableTag))) {
                    $strMarkup .= '<script type="text/javascript">include_once("/vendor/InepZend/js/suggestion' . AbstractHtmlHeadHelper::getSufixJs() . '");</script>';
                    $strMarkup .= '<script type="text/javascript">suggestion("' . $element->getAttribute('id') . '", "' . $strUrlListAvailableTag . '", "' . $strFunctionListAvailableTag . '", "' . $intMinLengthStart . '", "' . $intMaxLengthItem . '", "' . $strUrlMethod . '", "' . $strHiddenValue . '");</script>';
                }
            }
        } elseif ((in_array($strType, array('file'))) && (!is_null($element->getAttribute('required'))))
            $strMarkup .= '<script type="text/javascript">setOnChange("' . $element->getAttribute('id') . '", "checkElementValueRequired(\'' . $element->getAttribute('id') . '\');");</script>';
    }

    private function renderVarCounterCharacter(&$strScript = null, $intMaxlength = null)
    {
        $strScript .= '
            var intCountWithoutHtml = $.trim(tinyMCE.activeEditor.getContent()).length;
            var intMaxlength = ' . ((!empty($intMaxlength)) ? $intMaxlength : 'undefined') . ';
            var strContentText = "<span class=\'countMin\'>" + intCountWithoutHtml + "</span>";
            var strContentHtml = tinyMCE.activeEditor.getContent().length;
            if (intMaxlength != undefined)
                strContentText += " de " + intMaxlength;';
    }

    private function renderContentCounterCharacter()
    {
        return '
                $(".counterCharacters_" + tinyMCE.activeEditor.id + " span").html(strContentText);
                $(".counterCharacters_" + tinyMCE.activeEditor.id + "_html span").html(strContentHtml);';
    }

    private function renderControlMessageCountCharacter($element = null)
    {
        return '
            if ((editor.keyCode == 8) || (editor.keyCode == 36) || (editor.keyCode == 46))
                $(".countMin").html($.trim(tinyMCE.activeEditor.getContent({format : \'text\'})).length);
            if ($.trim(tinyMCE.activeEditor.getContent({format : \'text\'})).length == 0)
                setErrorIntoLabel(document.getElementById("' . $element->getAttribute('id') . '"));
            else
                $(\'div[for="' . $element->getAttribute('id') . '"]\').each(function() {
                    $(this).remove();
                });';
    }

    private function renderHelpIcon(ElementInterface $element, &$strMarkup)
    {
        $strHelpText = $element->getAttribute('help_text');
        if (empty($strHelpText))
            return;
        $strStyle = '';
        if ((self::isThemeAdministrativeResponsible()) && ($element->getOption('transfer') === true)) {
            $strMarkup .= '</div>';
            $strStyle = 'style="margin-top: 29px;" ';
        }
        $strMarkup .= '<div class="helpText" ' . $strStyle . 'title="' . $strHelpText . '"><i class="fa fa-question-circle"></i></div>';
    }

    private function renderValidateMessage(ElementInterface $element, &$strMarkup)
    {
        $intStartPos = stripos($strMarkup, '<ul><li>');
        if ($intStartPos !== false) {
            $strTypeValidateMessage = $element->getAttribute('validate_message');
            $strHelpText = $element->getAttribute('help_text');
            $strComplement = (empty($strHelpText)) ? '' : '<p style="padding: 15px;"></p>';
            $strFinish = '</li></ul>';
            $intFinishPos = stripos($strMarkup, $strFinish);
            $strValidate = substr($strMarkup, $intStartPos, $intFinishPos - $intStartPos + strlen($strFinish));
            $strMarkup = str_replace($strValidate, '', $strMarkup);
            if (!in_array((string) $strTypeValidateMessage, array('field')))
                return;
            $strTitle = $element->getAttribute('title');
            if (empty($strTitle))
                $strTitle = 'Informação';
            $arrTranslate = array(
                'Value is required and can&#039;t be empty' => $strTitle . ' é de preenchimento obrigatório.',
                'Captcha value is wrong' => 'Valor do ' . $strTitle . ' não confere com a imagem.',
                'The two given tokens do not match' => 'Valor do ' . $strTitle . ' não confere com o original.',
                'Please enter a valid email address' => 'E-mail inválido.',
                'Please enter a valid URL' => 'URL inválida.',
            );
            $strValidate = str_ireplace(array('<ul>', '</ul>'), array($strComplement . '<div class="messageValidate"><ul>', '</ul></div>'), $strValidate);
            foreach ($arrTranslate as $strFind => $strReplace)
                $strValidate = str_ireplace($strFind, $strReplace, $strValidate);
            $strMarkup .= $strValidate;
            $this->strPaddingBreakLabelNext = null;
        }
    }

    private function renderRequired(ElementInterface $element, &$strMarkup)
    {
        if (($element->getOption('transfer') === true) && (strpos($element->getAttribute('name'), FormGenerator::getSufixTransferNotSelectable()) !== false))
            $strMarkup = str_replace(' required="required"', '', $strMarkup);
    }

    private function renderTheme(ElementInterface $element, &$strMarkup)
    {
        $strType = $this->getTypeElement($element);
        if ((empty($strType)) || (!in_array($strType, array('text', 'email', 'url', 'password', 'file', 'select', 'textarea', 'captcha', 'radio', 'checkbox', 'multi_checkbox', 'money', 'float'))) || (stripos($strMarkup, '<label') === false))
            return;
        if (self::isThemeAdministrativeResponsible()) {
            if (($element->getOption('rangeStart') === true) || ($element->getOption('rangeEnd') === true) || ($element->getOption('transfer') === true))
                return;
            $strStyle = ($this->hasFloatLeft($element)) ? 'float: left; margin-right: 5px; ' : '';
            if (in_array($strType, array('checkbox')))
                $strStyle .= 'min-height: 18px; ';
            if (($this->booFloatLeftAnterior === true) && (!Html::hasAttributeStyle($element->getAttribute('style'), 'width')))
                $strStyle .= 'display: block; overflow: hidden; ';
            $strGroupStyle = (string) $element->getAttribute('group_style');
            if (!empty($strGroupStyle))
                $strStyle .= $strGroupStyle . ' ';
            if (!empty($strStyle))
                $strStyle = 'style="' . trim($strStyle) . '"';
            $strClass = (string) $element->getAttribute('group_class');
            if (empty($strClass))
                $strClass = 'form-group';
            $strMarkup = '<div class="' . $strClass . '"' . $strStyle . '>' . $strMarkup . '</div>';
        }
    }

    private function renderHiddenValue(ElementInterface $element, &$strMarkup)
    {
        if (($element->getOption('type') == 'money') && ($this->isReadonly($element)))
            $strMarkup .= '<input type="hidden" name="' . $this->getNameIdElement($element) . '" value="' . $element->getValue() . '" />';
    }

    private function renderConfirm(ElementInterface $element, &$strMarkup)
    {
        if (stripos($element->getAttribute('name'), 'confirmacao') !== false)
            $strMarkup .= '<script>setNotPaste(\'' . $element->getAttribute('name') . '\'); setAutocomplete(\'' . $element->getAttribute('name') . '\', \'off\');</script>';
    }

    private function getTypeElement(ElementInterface $element)
    {
        if (empty($this->strTypeElement)) {
            $strType = $element->getAttribute('type');
            if (empty($strType))
                $strType = $element->getOption('type');
            if ((empty($strType)) && (is_object($element->getOption('captcha'))))
                $strType = 'captcha';
            if ((empty($strType)) && (is_object($element->getOption('transfer'))))
                $strType = 'transfer';
            if ((empty($strType)) && (is_object($element->getOption('is_editor'))))
                $strType = 'editor';
            if ($strType == 'html') {
                $arrTag = Html::listTagHtml();
                unset($arrTag[count($arrTag) - 1], $arrTag[0]);
                $strValue = str_replace(array('<', '/', '>'), '', $element->getValue());
                foreach ($arrTag as $arrTagInfo) {
                    $strTag = str_replace(array('<', '/', '>'), '', $arrTagInfo[0]);
                    if (stripos($strValue, $strTag . ((strpos($strValue, ' ') === false) ? '' : ' ')) === 0) {
                        $strType = $strTag;
                        break;
                    }
                }
            }
            $this->strTypeElement = strtolower($strType);
        }
        return $this->strTypeElement;
    }

    private function getNameIdElement(ElementInterface $element)
    {
        $strNameId = $element->getAttribute('name');
        if (empty($strNameId))
            $strNameId = $element->getAttribute('id');
        return $strNameId;
    }

    private function hasFloatLeft(ElementInterface $element)
    {
        if (!is_bool($this->booFloatLeft))
            $this->booFloatLeft = Html::hasAttributeStyle($element->getAttribute('style'), 'float:left');
        return $this->booFloatLeft;
    }

    private function isReadonly(ElementInterface $element)
    {
        return (in_array($element->getAttribute('readonly'), array('readonly', 'true', true, 1)));
    }

    private function getOptionsDatePicker($element = null)
    {
        $strOptions = 'dateFormat: "dd/mm/yy",
                regional: "pt-BR",
                showOtherMonths: true,
                dayNames: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
                dayNamesMin: ["D", "S", "T", "Q", "Q", "S", "S", "D"],
                dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb", "Dom"],
                monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                nextText: "Próximo",
                prevText: "Anterior"';
        if (is_object($element)) {
            $booDateRange = (($element->getOption('rangeStart') === true) || ($element->getOption('rangeEnd') === true));
            if ($booDateRange) {
                $strOptions .= '
                ,gotoCurrent: true
                ,changeMonth: true
                ,changeYear: true
                ,numberOfMonths: 2';
            }
            $strOptions .= '
                ,onClose: function(strDate) {';
            if (!$booDateRange)
                $strOptions .= 'if ((strDate == undefined) || (strDate == "") || (strDate.indexOf("_") != -1)) return;';
            else
                $strOptions .= 'if ((strDate == undefined) || (strDate == "") || (strDate.indexOf("_") != -1)) { $("#' . $element->getOption('rangeOther') . '").datepicker("option", "' . (($element->getOption('rangeStart') === true) ? 'min' : 'max') . 'Date", null); return; }';
            if ($element->hasAttribute('required'))
                $strOptions .= '$("#' . $element->getAttribute('name') . '").valid();';
            if ($booDateRange)
                $strOptions .= '$("#' . $element->getOption('rangeOther') . '").datepicker("option", "' . (($element->getOption('rangeStart') === true) ? 'min' : 'max') . 'Date", strDate);';
            $strOptions .= '}';
            $arrParam = array('min', 'max');
            foreach ($arrParam as $strParam) {
                if ($strDate = $element->getOption($strParam . '_date')) {
                    $arrInfo = @Date::getInfoDate($strDate, 'base')[0];
                    $strOptions .= ',' . $strParam . 'Date: new Date(' . $arrInfo[2] . ',' . ($arrInfo[1] - 1) . ',' . $arrInfo[0] . ')';
                }
            }
        }
        return $strOptions;
    }

    private function getOptionsTimePicker($element = null)
    {
        $strOptions = 'timeFormat: "HH:mm",
                currentText: "Agora",
                closeText: "OK",
                timeOnlyTitle: "Escolha o Tempo",
                timeText: "Tempo",
                hourText: "Hora",
                minuteText: "Minuto",
                secondText: "Segundo",
                millisecText: "Milisegundo",
                microsecText: "Microsegundo",
                showButtonPanel: false';
        if (is_object($element)) {
            if (($element->getOption('rangeStart') === true) || ($element->getOption('rangeEnd') === true)) {
                $strOptions .= '
                ,onClose: function(strTime) {
                    if ((strTime == undefined) || (strTime == "") || (strTime.indexOf("_") != -1))
                        return;
                    var arrTime = explode(":", strTime);
                    $("#' . $element->getOption('rangeOther') . '").timepicker("option", "' . (($element->getOption('rangeStart') === true) ? 'min' : 'max') . 'DateTime", new Date(' . date('Y') . ',' . (date('m') - 1) . ',' . date('d') . ', arrTime[0], arrTime[1]));
                }';
            }
            $arrParam = array('min', 'max');
            foreach ($arrParam as $strParam) {
                if ($strDate = $element->getOption($strParam . '_time')) {
                    $arrInfo = @Date::getInfoDate($strDate, 'base')[1];
                    $strOptions .= '
                    ,hour' . ucfirst($strParam) . ': ' . $arrInfo[0] . '
                    ,minute' . ucfirst($strParam) . ': ' . $arrInfo[1];
                }
            }
        }
        return $strOptions;
    }

}
