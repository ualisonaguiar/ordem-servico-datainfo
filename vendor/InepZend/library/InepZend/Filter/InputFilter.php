<?php

namespace InepZend\Filter;

use InepZend\Filter\Add;
use InepZend\Filter\InputFilterSpecification;
use InepZend\Util\ArrayParamTrait;
use InepZend\Util\Debug;

/**
 * Trait responsavel em manipular os filters.
 * 
 * @package InepZend
 * @subpackage Filter
 */
trait InputFilter
{

    use Add\Filter,
        Add\DateTime,
        Add\Phone,
        Add\Editor,
        Add\Float,
        Add\Select,
        Add\Transfer,
        Add\Email,
        Add\Group,
        Add\Contato,
        Add\Endereco,
        Add\DadoPessoal,
        Add\DadoBancario,
        ArrayParamTrait;

    private $arrFilter = array();
    private $arrParamDefault = array(
        array('name', 'strName'), #0
        array('required', 'booRequired'), #1
        array('filters', 'arrFilters'), #2
        array('validators', 'arrValidators'), #3
        array('message_required', 'strMessageRequired'), #4
    );

    /**
     * Metodo responsavel em inserir os FILTERS e VALIDATORS.
     * 
     * @example $this->addDefault($arrParam, $arrParamDefault);
     * 
     * @param array $arrParam
     * @param array $arrParamDefault
     * @return mix
     */
    private function addDefault($arrParam, $arrParamDefault = null)
    {
        if ((empty($arrParam)) || (!is_array($arrParam)))
            return false;
        $strName = null;
        $booRequired = null;
        $arrFilters = null;
        $arrValidators = null;
        $strMessageRequired = null;
        if (empty($arrParamDefault))
            $arrParamDefault = $this->arrParamDefault;
        foreach ($arrParamDefault as $intArgument => $arrArgument) {
            eval('$this->getArgumentParam($arrParam, $' . $arrArgument[1] . ', ' . $intArgument . ');');
            eval('if (empty($' . $arrArgument[1] . ')) $this->getArgumentArray($arrParam, $' . $arrArgument[1] . ', "' . $arrArgument[0] . '");');
        }
        if (empty($strName))
            return false;
        if (!is_bool($booRequired))
            $booRequired = false;
        $arrFilter = array(
            'name' => $strName
        );
        $this->addAttribute($arrFilter, 'required', $booRequired);
        $this->createFiltersValidators($arrFilters);
        if (empty($arrFilters['StripTags']))
            $arrFilters['StripTags'] = array();
        if (empty($arrFilters['StringTrim']))
            $arrFilters['StringTrim'] = array();
        foreach ($arrFilters as $strFilter => $arrOption)
            $this->addFilters($arrFilter, $strFilter, $arrOption);
        $this->createFiltersValidators($arrValidators);
        if (empty($arrValidators['NotEmpty'])) {
            $arrOption = array('messages' => array('isEmpty' => ((empty($strMessageRequired)) ? 'Campo obrigatório.' : $strMessageRequired)));
            $arrValidators['NotEmpty'] = $arrOption;
        }
        if (!$booRequired)
            unset($arrValidators['NotEmpty']);
        foreach ($arrValidators as $strValidator => $arrOption)
            $this->addValidators($arrFilter, $strValidator, $arrOption);
        $this->setFilter($arrFilter);
        return $arrFilter;
    }

    /**
     * Metodo responsavel em retornar os Filters.
     * 
     * @example $this->getFilter($strName);
     * 
     * @param string $strName
     * @return mix
     */
    public function getFilter($strName = null)
    {
        return (empty($strName)) ? $this->arrFilter : @$this->arrFilter[$strName];
    }

    /**
     * Metodo responsavel em excluir o element Filter.
     * 
     * @example $this->removeFilter($strName);
     * 
     * @param type $strName
     * @return type
     */
    public function removeFilter($strName = null)
    {
        if (empty($strName))
            return false;
        if (array_key_exists($strName, $this->arrFilter))
            unset($this->arrFilter[$strName]);
        if (!$this instanceof InputFilterSpecification) {
            if (($this->has($strName)) && (is_object($this->get($strName))))
                $this->remove($strName);
        }
    }

    /**
     * Metodo responsavel em debugar os Elements Filter
     * 
     * @example $this->debug(true | false);
     * 
     * @param boolean $booExit
     */
    public function debug($booExit = false)
    {
        Debug::simpleDebug($_REQUEST, false, 1);
        $arrShow = array();
        if ((method_exists($this, 'add')) && (!$this instanceof InputFilterSpecification)) {
            foreach ($this->arrFilter as $strName => $arrFilter) {
                $arrShow[$strName] = array($arrFilter);
                if (is_object($this->inputs[$strName]))
                    $arrShow[$strName][1] = serialize($this->inputs[$strName]);
            }
        } else
            $arrShow = $this->arrFilter;
        Debug::simpleDebug($arrShow, $booExit, 2);
    }

    /**
     * 
     * @param type $arrFiltersValidators
     */
    private function createFiltersValidators(&$arrFiltersValidators)
    {
        if (!is_array($arrFiltersValidators))
            $arrFiltersValidators = array();
        foreach ($arrFiltersValidators as $mixKey => $mixValue) {
            if ((is_numeric($mixKey)) && (is_string($mixValue))) {
                $arrFiltersValidators[$mixValue] = array();
                unset($arrFiltersValidators[$mixKey]);
            }
        }
        return true;
    }

    /**
     * Metodo responsavel em inserir um atributo ao Filter
     * 
     * @example $this->addAttribute($arrFilter, $strAttribute, $mixValue);
     * 
     * @param array $arrFilter
     * @param string $strAttribute
     * @param mix $mixValue
     */
    private function addAttribute(array &$arrFilter, $strAttribute, $mixValue)
    {
        $this->addGeneric($arrFilter, $strAttribute, null, $mixValue);
    }

    /**
     * Metodo responsavel em inserir um Filter.
     * 
     * @example $this->addFilters($arrFilter, $strFilter, $arrOption);
     * 
     * @param array $arrFilter
     * @param string $strFilter
     * @param array $arrOption
     */
    private function addFilters(array &$arrFilter, $strFilter, $arrOption)
    {
        $this->addGeneric($arrFilter, 'filters', $strFilter, $arrOption);
    }

    /**
     * Metodo responsavel em inserir um Validator.
     * 
     * @example $this->addValidators($arrFilter, $strValidator, $arrOption);
     * 
     * @param array $arrFilter
     * @param string $strValidator
     * @param array $arrOption
     */
    private function addValidators(array &$arrFilter, $strValidator, $arrOption)
    {
        $this->addGeneric($arrFilter, 'validators', $strValidator, $arrOption);
    }

    /**
     * Metodo responsavel em inserir um filter ou validator ao element Filter.
     * 
     * @example $this->addGeneric($arrFilter, 'validators', $strValidator, $arrOption); <br />
     *          $this->addGeneric($arrFilter, 'filters', $strFilter, $arrOption);
     * 
     * @param array $arrFilter
     * @param string $strKey
     * @param string $strSubKey
     * @param mix $mixValue
     * @return boolean
     */
    private function addGeneric(array &$arrFilter, $strKey, $strSubKey, $mixValue)
    {
        if ((empty($arrFilter)) || (empty($strKey)))
            return false;
        if (in_array($strKey, array('filters', 'validators'))) {
            if (empty($strSubKey))
                return false;
            $intKey = (integer) @count($arrFilter[$strKey]);
            $arrFilter[$strKey][$intKey]['name'] = $strSubKey;
            if (!empty($mixValue))
                $arrFilter[$strKey][$intKey]['options'] = $mixValue;
            return true;
        } else {
            if (!empty($strSubKey))
                $arrFilter[$strKey][$strSubKey] = $mixValue;
            else
                $arrFilter[$strKey] = $mixValue;
            return true;
        }
        return false;
    }

    /**
     * Metodo responsavel em remover atributo do Element Filter.
     * 
     * @example $this->delAttribute($arrFilter, $strAttribute);
     * 
     * @param array $arrFilter
     * @param string $strAttribute
     */
    private function delAttribute(array &$arrFilter, $strAttribute)
    {
        $this->delGeneric($arrFilter, $strAttribute);
    }

    /**
     * Metodo responsavel em remover um filter do Element Filter.
     * 
     * @example $this->delFilters($arrFilter, $strFilter);
     * 
     * @param array $arrFilter
     * @param string $strFilter
     */
    protected function delFilters(array &$arrFilter, $strFilter)
    {
        $this->delGeneric($arrFilter, 'filters', $strFilter);
    }

    /**
     * Metodo responsavel em remover um validator do Element Filter.
     * 
     * @example $this->delValidators($arrFilter, $strValidator);
     * 
     * @param array $arrFilter
     * @param string $strValidator
     */
    private function delValidators(array &$arrFilter, $strValidator)
    {
        $this->delGeneric($arrFilter, 'validators', $strValidator);
    }

    /**
     * Metodo responsavel em deletar um filter ou validator do Element Filter.
     * 
     * @example $this->delGeneric($arrFilter, 'validators', $strValidator); <br />
     *          $this->delGeneric($arrFilter, 'filters', $strFilter);
     * 
     * @param array $arrFilter
     * @param string $strKey
     * @param string $strSubKey
     * @return boolean
     */
    private function delGeneric(array &$arrFilter, $strKey, $strSubKey)
    {
        if ((empty($arrFilter)) || (empty($strKey)))
            return false;
        if (in_array($strKey, array('filters', 'validators'))) {
            if (empty($strSubKey))
                return false;
            $intKey = null;
            foreach ($arrFilter[$strKey] as $intCount => $arrFilterInfo) {
                if ($arrFilterInfo['name'] == $strSubKey) {
                    $intKey = $intCount;
                    break;
                }
            }
            if ((!empty($intKey)) || ($intKey === 0))
                unset($arrFilter[$strKey][$intKey]);
            return true;
        } else {
            if (!empty($strSubKey))
                unset($arrFilter[$strKey][$strSubKey]);
            else
                unset($arrFilter[$strKey]);
            return true;
        }
        return false;
    }

    private function getFilterName(array $arrFilter)
    {
        $strName = @(!empty($arrFilter['name'])) ? $arrFilter['name'] : count($this->arrFilter);
        return $strName;
    }

    private function setFilter(array $arrFilter)
    {
        $strName = $this->getFilterName($arrFilter);
        $this->removeFilter($strName);
        $this->arrFilter[$strName] = $arrFilter;
        if ((method_exists($this, 'add')) && (!$this instanceof InputFilterSpecification))
            $this->add($arrFilter);
    }

}
