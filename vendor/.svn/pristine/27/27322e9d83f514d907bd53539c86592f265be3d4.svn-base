<?php

namespace InepZend\FormGenerator\Element;

use Zend\Form\Element;

/**
 * Classe estendida da ZendFramework para que a mesma seja extendida do InepZend
 * ao inves do ZendFramework.
 */
class Html extends Element
{

    protected $attributes = array(
        'type' => 'html',
    );

    /**
     * Metodo construtor responsavel em criar uma instancia do Element Html.
     * 
     * @param string $strName
     * @param string $strValue
     * @param array $arrOption
     */
    public function __construct($strName = null, $strValue = null, $arrOption = array())
    {
        parent::__construct($strName, $arrOption);
        if (!empty($strValue))
            $this->setValue($strValue);
    }

    /**
     * Metodo responsavel em converter um valor, mix, em String.
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getValue();
    }

}
