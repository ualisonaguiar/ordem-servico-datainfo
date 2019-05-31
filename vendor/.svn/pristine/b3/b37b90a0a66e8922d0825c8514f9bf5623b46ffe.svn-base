<?php

namespace InepZend\FormGenerator;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

/**
 * Classe responsavel em agrupar formularios.
 */
class FieldsetGenerator extends Fieldset implements InputFilterProviderInterface
{

    use InputElement;

    public function __construct($strName = null, $arrOption = array())
    {
        parent::__construct($strName, $arrOption);
        $this->setHydrator(new ClassMethodsHydrator(false));
    }

    public function getInputFilterSpecification()
    {
        return array();
    }

}
