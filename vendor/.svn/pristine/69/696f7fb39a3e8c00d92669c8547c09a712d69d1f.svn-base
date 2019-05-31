<?php

namespace InepZend\FormGenerator;

use InepZend\FormGenerator\Add;
use InepZend\Permission\PermissionTrait;
use InepZend\Service\ServiceManagerTrait;
use InepZend\Util\AttributeStaticTrait;
use InepZend\Util\ArrayParamTrait;
use InepZend\Util\Html;
use InepZend\Util\Debug;

/**
 * Trait responsavel pela manipulacao de elementos de formularios.
 *
 * @package InepZend
 * @subpackage FormGenerator
 */
trait InputElement
{

    use Add\Hidden,
        Add\Text,
        Add\Cpf,
        Add\Cnpj,
        Add\Cep,
        Add\Money,
        Add\Float,
        Add\Phone,
        Add\DateTime,
        Add\Number,
        Add\Password,
        Add\Select,
        Add\Transfer,
        Add\Textarea,
        Add\Editor,
        Add\Checkbox,
        Add\Radio,
        Add\File,
        Add\Captcha,
        Add\Email,
        Add\Url,
        Add\Html,
        Add\Submit,
        Add\InputImage,
        Add\Button,
        Add\Label,
        Add\Image,
        Add\Link,
        Add\OrgaoEmissor,
        Add\RegiaoUfMunicipio,
        Add\EstadoCivil,
        Add\CorRaca,
        Add\Sexo,
        Add\Nacionalidade,
        Add\Pais,
        Add\Nascimento,
        Add\PisPasep,
        Add\Banco,
        Add\Table,
        Add\Group,
        Add\Contato,
        Add\Endereco,
        Add\DadoPessoal,
        Add\DadoBancario,
        Add\FormCrud,
        PermissionTrait,
        ServiceManagerTrait,
        AttributeStaticTrait,
        ArrayParamTrait;

    private $arrElement = array();
    private $arrParamDefault = array(
        array('name', 'strName'), #0
        array('value', 'strValue'), #1
        array('id', 'strId'), #2
        array('label', 'strLabel'), #3
        array('placeholder', 'strPlaceHolder'), #4
        array('required', 'booRequired'), #5
        array('title', 'strTitle'), #6
        array('class', 'strClass'), #7
        array('style', 'strStyle'), #8
        array('label_class', 'strLabelClass'), #9
        array('label_style', 'strLabelStyle'), #10
        array('help_text', 'strHelpText'), #11
        array('validate_message', 'strTypeValidateMessage'), #12
        array('disabled', 'strDisabled'), #13
        array('resource', 'strResource'), #14
        array('action_to_resource_not_allowed', 'strActionToResourceNotAllowed'), #15
        array('tabindex', 'intTabindex'), #16
        array('attr_data', 'arrAttributeData'), #17
        array('group_class', 'strGroupClass'), #18
        array('group_style', 'strGroupStyle'), #19
    );
    private static $arrCountName = array();
    private $arrGlobalParam = array();

    /**
     * Metodo responsavel em definir informacoes e tratamentos padroes a todos os
     * elementos adicionados em um formulario.
     *
     * @param array $arrParam
     * @param array $arrParamDefault
     * @param boolean $booReturnVars
     * @return mix
     */
    private function addDefault($arrParam, $arrParamDefault = null, $booReturnVars = false)
    {
        if ((empty($arrParam)) || (!is_array($arrParam)))
            return false;
        foreach ($this->mergeParam(array_merge($this->arrParamDefault, (array) $arrParamDefault), $arrParam) as $arrArgument)
            $$arrArgument[1] = $arrArgument[2];
        if (empty($strId))
            $strId = $strName;
        if ((empty($strTitle)) && (!empty($strLabel)))
            $strTitle = $strLabel;
        if (!empty($strTitle)) {
            $strTitle = trim($strTitle);
            $intLen = strlen($strTitle) - 1;
            if ($strTitle{$intLen} == ':')
                $strTitle = substr($strTitle, 0, $intLen);
        }
        if (empty($strTypeValidateMessage))
            $strTypeValidateMessage = $this->getValidateMessage();
        if ($booReturnVars === true) {
            if ($this->controllResource($strResource, $strActionToResourceNotAllowed) === false)
                return false;
            $arrVars = array();
            foreach ($arrParamDefault as $arrArgument) {
                $strVar = $arrArgument[1];
                $arrVars[$strVar] = $$strVar;
            }
            return $arrVars;
        }
        if (empty($strName))
            return false;
        $strNameOriginal = null;
        if (strpos($strName, '[]') !== false) {
            $strNameOriginal = $strName;
            $strName = str_replace('[]', '[' . self::getCountName($strName, true) . ']', $strName);
        }
        $arrElement = $this->getElement($strName);
        if (empty($arrElement))
            $arrElement = array(
                'name' => $strName,
                'attributes' => array(
                    'id' => $strId,
                ),
            );
        $arrGlobalParam = $this->getGlobalParam();
        if (is_bool(@$arrGlobalParam['required']))
            $booRequired = $arrGlobalParam['required'];
        if (!@empty($arrGlobalParam['validate_message']))
            $strTypeValidateMessage = $arrGlobalParam['validate_message'];
        if (!@empty($arrGlobalParam['disabled']))
            $strDisabled = $arrGlobalParam['disabled'];
        if (!@empty($arrGlobalParam['readonly']))
            $strReadonly = $arrGlobalParam['readonly'];
        $this->addAttribute($arrElement, 'value', $strValue);
        $this->addOption($arrElement, 'label', $strLabel);
        $this->addAttribute($arrElement, 'placeholder', $strPlaceHolder);
        $this->addAttribute($arrElement, 'required', (($booRequired === true) ? 'required' : null));
        $this->addAttribute($arrElement, 'title', $strTitle);
        $this->addAttribute($arrElement, 'class', $strClass);
        $this->addAttribute($arrElement, 'style', $strStyle);
        $this->addAttribute($arrElement, 'label_class', $strLabelClass);
        $this->addAttribute($arrElement, 'label_style', $strLabelStyle);
        $this->addAttribute($arrElement, 'help_text', $strHelpText);
        $this->addAttribute($arrElement, 'validate_message', $strTypeValidateMessage);
        $this->addAttribute($arrElement, 'disabled', $strDisabled);
        $this->addAttribute($arrElement, 'tabindex', $intTabindex);
        if (is_array($arrAttributeData))
            foreach ($arrAttributeData as $strAttribute => $mixValue)
                $this->addAttribute($arrElement, 'data-' . $strAttribute, $mixValue);
        $this->addAttribute($arrElement, 'group_class', $strGroupClass);
        $this->addAttribute($arrElement, 'group_style', $strGroupStyle);
        if (!empty($strNameOriginal))
            $this->addOption($arrElement, 'name_original', $strNameOriginal);
        if ($this->controllResource($strResource, $strActionToResourceNotAllowed, $arrElement) === false) {
            $this->delElement($arrElement);
            return false;
        }
        $this->setElement($arrElement);
        return $arrElement;
    }

    /**
     * Metodo responsavel em setar o tipo de visualizacao da mensagem de validacao
     * dos elementos de um formulario.
     *
     * @param string $strType
     * @return boolean
     */
    public function setValidateMessage($strType = null)
    {
        $arrValidType = array('fieldset_group', 'fieldset_single', 'field');
        if (empty($strType))
            $strType = $arrValidType[0];
        elseif (!in_array($strType, $arrValidType))
            return false;
        $this->setAttribute('validate_message', strtolower($strType));
        return true;
    }

    /**
     * Metodo responsavel em retornar o tipo de visualizacao da mensagem de validacao
     * dos elementos de um formulario.
     *
     * @return string
     */
    public function getValidateMessage()
    {
        $strType = $this->getAttribute('validate_message');
        if (empty($strType))
            $this->setValidateMessage();
        return $this->getAttribute('validate_message');
    }

    /**
     * Metodo responsavel em debugar todos os elementos de um formulario.
     * Deve ser inserido ao final do metodo da classe Form.
     *
     * @param boolean $booExit
     * @param object $fieldset
     * @return mix
     */
    public function debug($booExit = false, $fieldset = null)
    {
        $arrShow = array();
        if (!is_object($fieldset))
            $fieldset = $this;
        if (count($fieldset->getFieldsets()) > 0) {
            $arrFieldset = $fieldset->getFieldsets();
            foreach ($arrFieldset as $fieldsetIntern)
                $arrShow = array_merge($arrShow, $this->debug($booExit, $fieldsetIntern));
        }
        foreach ($fieldset->getElements() as $strName => $element) {
            $arrShow[$strName] = array();
            $arrElement = $fieldset->getElement($strName);
            if (!empty($arrElement))
                $arrShow[$strName][0] = $arrElement;
            $arrShow[$strName][1] = $element;
        }
        if ($fieldset == $this)
            Debug::simpleDebug($arrShow, $booExit);
        else
            return $arrShow;
    }

    /**
     * Metodo responsavel em adicionar valores de atributos a um elemento de formulario.
     *
     * @param array $arrElement
     * @param string $strAttribute
     * @param mix $mixValue
     * @return void
     */
    public function addAttribute(array &$arrElement, $strAttribute, $mixValue)
    {
        $this->addGeneric($arrElement, 'attributes', $strAttribute, $mixValue);
    }

    /**
     * Metodo responsavel em adicionar valores de opcoes a um elemento de formulario.
     *
     * @param array $arrElement
     * @param string $strOption
     * @param mix $mixValue
     * @return void
     */
    public function addOption(array &$arrElement, $strOption, $mixValue)
    {
        $this->addGeneric($arrElement, 'options', $strOption, $mixValue);
    }

    /**
     * Metodo responsavel em remover atributos de um elemento de formulario.
     *
     * @param array $arrElement
     * @param string $strAttribute
     * @return void
     */
    public function delAttribute(array &$arrElement, $strAttribute)
    {
        $this->delGeneric($arrElement, 'attributes', $strAttribute);
    }

    /**
     * Metodo responsavel em remover opcoes de um elemento de formulario.
     *
     * @param array $arrElement
     * @param string $strOption
     * @return void
     */
    public function delOption(array &$arrElement, $strOption)
    {
        $this->delGeneric($arrElement, 'options', $strOption);
    }

    /**
     * Metodo responsavel em setar/adicionar um elemento a um formulario.
     *
     * @param array $arrElement
     * @return void
     */
    public function setElement(array $arrElement)
    {
        $strKey = @(!empty($arrElement['name'])) ? $arrElement['name'] : count($this->arrElement);
        $this->delElement($arrElement);
        $this->arrElement[$strKey] = $arrElement;
        $this->add($arrElement);
    }

    /**
     * Metodo responsavel em retornar um elemento ou todos elementos de um formulario.
     *
     * @param string $strName
     * @return mix
     */
    public function getElement($strName = null)
    {
        return empty($strName) ? $this->arrElement : @$this->arrElement[$strName];
    }

    /**
     * Metodo responsavel em remover um elemento de um formulario.
     *
     * @param array $arrElement
     * @return boolean
     */
    public function delElement(array $arrElement)
    {
        $strKey = @(!empty($arrElement['name'])) ? $arrElement['name'] : count($this->arrElement);
        if (array_key_exists($strKey, $this->arrElement))
            unset($this->arrElement[$strKey]);
        if (($this->has($strKey)) && (is_object($this->get($strKey))))
            $this->remove($strKey);
        return true;
    }

    /**
     * Metodo responsavel em remover todos elementos de um formulario.
     *
     * @return boolean
     */
    public function delElementAll()
    {
        $arrElementAll = (array) $this->arrElement;
        foreach ($arrElementAll as $arrElement)
            $this->delElement($arrElement);
        return true;
    }

    /**
     * Metodo responsavel em retornar dados de uma entidade para serem utilizados
     * em elementos de um formulario, sobretudo Select (combo).
     *
     * @param string $strService
     * @param array $arrCriteria
     * @param string $strMethodValue
     * @param string $strMethodText
     * @param array $arrOrderBy
     * @param int $intLimit
     * @param int $intOffset
     * @param string $strMethodService
     * @return mix
     */
    protected function listEntity($strService = null, array $arrCriteria = null, $strMethodValue = null, $strMethodText = null, array $arrOrderBy = null, $intLimit = null, $intOffset = null, $strMethodService = null)
    {
        $mixResult = null;
        if (!empty($strService)) {
            if (empty($strMethodService))
                $strMethodService = 'fetchPairs';
            $mixResult = $this->getService($strService)->$strMethodService($arrCriteria, $strMethodValue, $strMethodText, $arrOrderBy, $intLimit, $intOffset);
        }
        return (is_array($mixResult)) ? $mixResult : array();
    }

    protected function setGlobalParam($arrParam = null)
    {
        $this->arrGlobalParam = (array) $arrParam;
        return $this;
    }

    protected function getGlobalParam($strParam = null)
    {
        return (is_null($strParam)) ? $this->arrGlobalParam : @$this->arrGlobalParam[$strParam];
    }

    /**
     * Metodo responsavel em atualizar o filter de um formulario.
     *
     * @return boolean
     */
    private function refreshInputFilter()
    {
        $inputFilter = $this->getInputFilter();
        if (is_object($inputFilter)) {
            $strClass = '\\' . get_class($inputFilter);
            $strShortNameForm = $inputFilter->getShortNameForm();
            unset($inputFilter);
            $this->setInputFilter(new $strClass($strShortNameForm));
            return true;
        }
        return false;
    }

    /**
     * Metodo responsavel em adicionar valores de atributos ou opcoes a um elemento
     * de formulario.
     *
     * @param array $arrElement
     * @param string $strKey
     * @param string $strSubKey
     * @param mix $mixValue
     * @return boolean
     */
    private function addGeneric(array &$arrElement, $strKey, $strSubKey, $mixValue)
    {
        if ((empty($arrElement)) || (empty($strKey)) || (is_null($mixValue)))
            return false;
        if (!empty($strSubKey))
            $arrElement[$strKey][$strSubKey] = $mixValue;
        else
            $arrElement[$strKey] = $mixValue;
        return true;
    }

    /**
     * Metodo responsavel em remover atributos ou opcoes de um elemento de formulario.
     *
     * @example $this->delGeneric($arrElement, $strKey, $strSubKey);
     *
     * @param array $arrElement
     * @param string $strKey
     * @param string $strSubKey
     * @return boolean
     */
    private function delGeneric(array &$arrElement, $strKey, $strSubKey)
    {
        if ((empty($arrElement)) || (empty($strKey)))
            return false;
        if (!empty($strSubKey))
            unset($arrElement[$strKey][$strSubKey]);
        else
            unset($arrElement[$strKey]);
        return true;
    }

    /**
     * Metodo responsavel em controlar o acesso a um elemento de formulario de acordo
     * com um resource vinculado ao mesmo e uma acao (disabled, readonly ou hidden)
     * quando nao possuir o devido acesso.
     *
     * @param string $strResource
     * @param string $strActionToResourceNotAllowed
     * @param array $arrElement
     * @return boolean
     */
    private function controllResource($strResource = null, $strActionToResourceNotAllowed = null, &$arrElement = null)
    {
        $booPermitted = $this->isPermitted($strResource);
        if ($booPermitted === false) {
            switch (strtolower($strActionToResourceNotAllowed)) {
                case 'disabled':
                    if (!empty($arrElement)) {
                        $this->addAttribute($arrElement, 'disabled', 'disabled');
                        return true;
                    }
                    break;
                case 'readonly':
                    if (!empty($arrElement)) {
                        $this->addAttribute($arrElement, 'readonly', 'readonly');
                        return true;
                    }
                    break;
                case 'hidden':
                default:
                    break;
            }
        }
        return $booPermitted;
    }

    /**
     * Metodo responsavel em retornar a quantidade de nomes de elementos em um formulario.
     *
     * @example $this->getCountName('elementName', false);
     *
     * @param string $strName
     * @param boolean $booSet
     * @return mix
     */
    private function getCountName($strName, $booSet = false)
    {
        if (!empty($strName)) {
            if ($booSet)
                self::setCountName($strName);
            return (array_key_exists($strName, self::$arrCountName)) ? self::$arrCountName[$strName] : 0;
        }
        return self::$arrCountName;
    }

    /**
     * Metodo responsavel em inserir um nome no controle da quantidade de nomes
     * de elementos em um formulario.
     *
     * @example $this->setCountName('elementName', 1);
     *
     * @param string $strName
     * @param integer $intAdd
     * @return boolean
     */
    private function setCountName($strName, $intAdd = null)
    {
        if (empty($strName))
            return false;
        if (empty($intAdd))
            $intAdd = 1;
        if (!array_key_exists($strName, self::$arrCountName))
            self::$arrCountName[$strName] = -1;
        self::$arrCountName[$strName] += $intAdd;
        return true;
    }

    /**
     * Metodo responsavel em retornar o valor de um elementos de formulario, inclusive
     * em uma requisicao de submissao POST.
     *
     * @example $his->getElementValue('element');
     *
     * @param string $strName
     * @return mix
     */
    private function getElementValue($strName)
    {
        if (empty($strName))
            return null;
        $mixValue = null;
        if ($this->has($strName))
            $mixValue = $this->get($strName)->getValue();
        if (is_null($mixValue)) {
            $arrData = array_merge($this->getRequest()->getPost()->toArray(), $this->getRequest()->getFiles()->toArray());
            if (array_key_exists($strName, $arrData))
                $mixValue = $arrData[$strName];
        }
        return $mixValue;
    }

    /**
     * Metodo responsavel em retornar um elemento de formulario ja configurado de
     * acordo com as informacoes parametrizadas.
     *
     * @example $this->getElementConfigured(array('name', 'value'), 2, array(array('maxlength', 'intMaxlength')), array('type' => array('addGeneric', 'InepZend\FormGenerator\Element\Textarea')));
     *
     * @param array $arrParam
     * @param integer $intArgumentTotal
     * @param array $arrParamExtra
     * @param array $arrAttribute
     * @param array $arrElement
     * @return mix
     */
    private function getElementConfigured($arrParam = null, $intArgumentTotal = null, $arrParamExtra = null, $arrAttribute = null, $arrElement = null)
    {
        if (empty($arrElement))
            $arrElement = $this->addDefault($arrParam);
        if (!is_array($arrElement))
            return false;
        $arrParam = (array) $this->getParamEdited($arrParam, $intArgumentTotal, $arrParamExtra);
        if (is_array($arrAttribute))
            foreach ($arrAttribute as $strAttribute => $arrMethodValue) {
                if ((!is_array($arrMethodValue)) || (empty($arrMethodValue)))
                    continue;
                $strMethod = $arrMethodValue[0];
                if ($strMethod == 'delOption')
                    $this->$strMethod($arrElement, $strAttribute);
                else {
                    $mixValue = (array_key_exists(1, $arrMethodValue)) ? $arrMethodValue[1] : (array_key_exists($strAttribute, $arrParam) ? $arrParam[$strAttribute] : null);
                    if (is_null($mixValue))
                        continue;
                    if ($strMethod == 'addGeneric')
                        $this->$strMethod($arrElement, $strAttribute, null, $mixValue);
                    else
                        $this->$strMethod($arrElement, $strAttribute, $mixValue);
                }
            }
        $this->setElement($arrElement);
        return $arrElement;
    }

    /**
     * Metodo responsavel em retornar um elemento de formulario ja configurado de
     * acordo com as informacoes parametrizadas e com as configuracoes herdadadas
     * de outro tipo de elemento.
     * O mesmo realiza a chamada ao metodo getElementConfigured().
     *
     * @example $this->getElementConfiguredExtended(array_merge($element, array('mask' => '99.999.999/9999-99')), $this->getValueConfigured()[2], $this->getValueConfigured()[3]));
     *
     * @param array $arrParam
     * @param array $arrParamExtra
     * @param array $arrAttribute
     * @param string $strMethod
     * @return mix
     */
    private function getElementConfiguredExtended($arrParam = null, $arrParamExtra = null, $arrAttribute = null, $strMethod = null)
    {
        if (empty($strMethod))
            $strMethod = 'addText';
        return $this->getElementConfigured(array($arrParam), 1, $arrParamExtra, $arrAttribute, $this->$strMethod($arrParam));
    }

    /**
     * Metodo responsavel em adicionar o valor da propriedade width do style a um
     * elemento de formulario.
     *
     * @example $this->setStyleWidth($arrElement, '30px');
     *
     * @param array $arrElement
     * @param string $strWidth
     * @return mix
     */
    private function setStyleWidth($arrElement = null, $strWidth = null)
    {
        return $this->setStyleAttribute($arrElement, 'width', $strWidth);
    }

    /**
     * Metodo responsavel em adicionar o valor da propriedade float do style a um
     * elemento de formulario.
     *
     * @example $this->setStyleFloat($arrElement, 'left');
     *
     * @param array $arrElement
     * @param string $strFloat
     * @return mix
     */
    private function setStyleFloat($arrElement = null, $strFloat = null)
    {
        return $this->setStyleAttribute($arrElement, 'float', $strFloat);
    }

    /**
     * Metodo responsavel em adicionar o valor de propriedades do style a um elemento
     * de formulario.
     *
     * @example $this->setStyleAttribute($arrElement, 'float|width', '10px|left');
     *
     * @param array $arrElement
     * @param string $strAttribute
     * @param mix $mixValue
     * @return mix
     */
    private function setStyleAttribute($arrElement = null, $strAttribute = null, $mixValue = null)
    {
        if ((empty($arrElement)) || (empty($mixValue)))
            return false;
        $strStyle = (string) @$arrElement['attributes']['style'];
        if (!Html::hasAttributeStyle($strStyle, $strAttribute)) {
            @$arrElement['attributes']['style'] = $strAttribute . ': ' . $mixValue . '; ' . $strStyle;
            $this->setElement($arrElement);
        }
        return $arrElement;
    }

}
