<?php

namespace InepZend\Filter;

use Zend\InputFilter\InputFilter as ZendInputFilter;

/**
 * Classe responsavel pela filtragem de dados nos formularios.
 * 
 * @package InepZend
 * @subpackage Filter
 */
class Filter extends ZendInputFilter
{

    use InputFilter;

    private $strShortNameForm;

    /**
     * Metodo responsavel em instanciar um filter.
     * 
     * @example $filter = new Filter('shortNameForm');
     * 
     * @param string $strShortNameForm
     */
    public function __construct($strShortNameForm = null)
    {
        if (!empty($strShortNameForm))
            $this->setShortNameForm($strShortNameForm);
    }

    /**
     * Metodo responsavel em inserir o nome de um formulario.
     * 
     * @example $filter->setShortNameForm($strShortNameForm);
     * 
     * @param type $strShortNameForm
     * @return type
     */
    protected function setShortNameForm($strShortNameForm)
    {
        return ($this->strShortNameForm = $strShortNameForm);
    }

    /**
     * Metodo responsavel em retornar o nome de um formulario.
     * 
     * @example $filter->getShortNameForm();
     * 
     * @return string
     */
    public function getShortNameForm()
    {
        return $this->strShortNameForm;
    }

}
