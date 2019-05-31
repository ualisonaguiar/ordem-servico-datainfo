<?php

namespace InepZend\FormGenerator;

use Zend\Form\Form;
use InepZend\Filter\Filter;
use InepZend\FormGenerator\InputElement;
use InepZend\View\ThemeTrait;
use InepZend\Authentication\AuthTrait;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zend\Http\PhpEnvironment\Request;
use Zend\View\Helper\Url;

/**
 * Classe responsavel pela geracao de formularios.
 *
 * @package InepZend
 * @subpackage FormGenerator
 */
class FormGenerator extends Form
{

    use AuthTrait, 
        InputElement,
        ThemeTrait;

    const ACTION_RESOURCE_NOT_ALLOWED_DISABLED = 'disabled';
    const ACTION_RESOURCE_NOT_ALLOWED_READONLY = 'readonly';
    const ACTION_RESOURCE_NOT_ALLOWED_HIDDEN = 'hidden';

    protected $requestPhpEnvironment;
    protected $booViewValidate = false;
    protected $strTemplateViewValidate = 'default';

    /**
     * Metodo responsavel em instanciar um formulario com nome e opcoes.
     *
     * @example $form = new FormGenerator($strName, $arrOption);
     *
     * @param string $strName
     * @param array $arrOption
     * @return object
     */
    public function __construct($strName = null, $arrOption = array())
    {
        if (empty($strName))
            $strName = 'frm';
        parent::__construct($strName, $arrOption);
        $this->setHydrator(new ClassMethodsHydrator(false))
                ->setAttribute('method', 'post')
                ->setAttribute('class', 'classForm')
                ->setInputFilter(new Filter());
        if (self::isThemeAdministrativeResponsible())
            $this->setViewValidate(true);
    }

    /**
     * Metodo responsavel em gerar um nome para o formulario.
     *
     * @example $this->generateFormName('MyForm');
     *
     * @param string $strClass
     * @return string
     */
    protected function generateFormName($strClass = null)
    {
        return (empty($strClass)) ? 'frm' : 'frm[' . end($arrExplode = explode('\\', $strClass)) . ']';
    }

    /**
     * Metodo responsavel em retornar os dados das variaveis de ambiente de uma
     * requisicao.
     *
     * @example $this->getRequestPhpEnvironment();
     *
     * @return object
     */
    public function getRequestPhpEnvironment()
    {
        if (!$this->requestPhpEnvironment)
            $this->requestPhpEnvironment = new Request();
        return $this->requestPhpEnvironment;
    }

    /**
     * Metodo responsavel em retornar os dados das variaveis de ambiente de uma
     * requisicao, realizando a chamada ao metodo getRequestPhpEnvironment().
     *
     * @example $this->getRequest();
     *
     * @return object
     */
    public function getRequest()
    {
        return $this->getRequestPhpEnvironment();
    }

    /**
     * Metodo responsavel em retornar o basePath da URL.
     *
     * @example $this->getBaseUrl();
     *
     * @return mix
     */
    public function getBaseUrl()
    {
        return $this->getRequest()->getBaseUrl();
    }

    /**
     * Metodo responsavel em setar o uso da validacao a ser realizada em uma submissao
     * de um formulario.
     *
     * @example $this->setViewValidate(true);
     *
     * @param boolean $booViewValidate
     * @param string $strTemplate
     * @return object
     */
    public function setViewValidate($booViewValidate = false, $strTemplate = 'default')
    {
        $this->booViewValidate = (boolean) $booViewValidate;
        $this->strTemplateViewValidate = $strTemplate;
        return $this;
    }

    /**
     * Metedo responsavel em retornar o uso da validacao a ser realizada em uma
     * submissao de um formulario.
     *
     * @example $this->getViewValidate();
     *
     * @return boolean
     */
    public function getViewValidate()
    {
        return $this->booViewValidate;
    }

    /**
     * Metedo responsavel em retornar o template da validacao a ser realizada em
     * uma submissao de um formulario.
     *
     * @example $this->getTemplateViewValidate();
     *
     * @return string
     */
    public function getTemplateViewValidate()
    {
        return $this->strTemplateViewValidate;
    }

    /**
     * Metodo responsavel em retornar os dados/valores contidos nos elementos do
     * formulario.
     *
     * @example $this->getDataForm();
     *
     * @return mix
     */
    public function getDataForm()
    {
        return $this->data;
    }

    public function getDataEdited($arrPk = null)
    {
        $arrData = $this->getData();
        if ((!empty($arrData)) && (!empty($arrPk))) {
            foreach ($arrData as $strAttribute => $mixValue) {
                if (($strAttribute == 'addHtml') || (stripos($strAttribute, 'btn') === 0)) {
                    unset($arrData[$strAttribute]);
                }
                if ((is_array($arrPk)) && (in_array($strAttribute, $arrPk)) && (is_numeric($mixValue))) {
                    $arrData[$strAttribute] = (integer) $mixValue;
                }
            }
        }
        return $arrData;
    }

    public function setData($mixData)
    {
        if (is_array($mixData)) {
            $arrMerge = array();
            $arrKeyFile = array('name', 'tmp_name');
            foreach ($mixData as $strAttribute => $mixValue) {
                if (!is_array($mixValue))
                    continue;
                foreach ($arrKeyFile as $strKeyFile)
                    if (!is_null(@$mixValue[$strKeyFile]))
                        $arrMerge[$strAttribute . '[' . $strKeyFile . ']'] = $mixValue[$strKeyFile];
            }
            $mixData = array_merge($mixData, $arrMerge);
        }
        return parent::setData($mixData);
    }

    /**
     * Metodo responsavel em montar uma URL utilizando a helper Url.
     *
     * @example $this->url('name', array('id' => 1), array(), false);
     *
     * @param string $strName
     * @param array $arrParam
     * @param array $arrOption
     * @param boolean $booReuseMatchedParam
     * @return mix
     */
    public function url($strName = null, $arrParam = array(), $arrOption = array(), $booReuseMatchedParam = false)
    {
        if ((is_object(@$GLOBALS['router'])) && (is_object(@$GLOBALS['routeMatch']))) {
            $url = new Url();
            $url->setRouter($GLOBALS['router']);
            $url->setRouteMatch($GLOBALS['routeMatch']);
            return $url->__invoke($strName, $arrParam, $arrOption, $booReuseMatchedParam);
        }
        $strUrl = $this->getRequestPhpEnvironment()->getBaseUrl() . '/' . $strName;
        if (!empty($arrParam))
            $strUrl .= '/' . implode('/', $arrParam);
        return str_replace('//', '/', $strUrl);
    }

    /**
     * Metodo responsavel em disabilitar elementos de um formulario.
     *
     * @example $this->disableElement(array('element1', 'element2'));
     *
     * @param array $arrAttribute
     * @return void
     */
    public function disableElement($arrAttribute = null)
    {
        if (!empty($arrAttribute)) {
            foreach ($arrAttribute as $strName => $mixValue) {
                if ((empty($mixValue)) || (!$this->has($strName)))
                    continue;
                $this->get($strName)->setAttribute('disabled', 'disabled');
            }
        }
    }

}
