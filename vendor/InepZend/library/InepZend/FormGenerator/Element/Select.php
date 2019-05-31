<?php

namespace InepZend\FormGenerator\Element;

use Zend\Form\Element;

/**
 * Classe estendida da ZendFramework para que a mesma seja extendida do InepZend
 * ao Invés do ZendFramework.
 */
class Select extends Element\Select
{

    protected $disableInArrayValidator = true;

}
