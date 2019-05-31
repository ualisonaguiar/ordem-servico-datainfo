<?php

namespace InepZend\FormGenerator\Element;

use Zend\Form\Element;

/**
 * Classe estendida da ZendFramework para que a mesma seja extendida do InepZend
 * ao Invés do ZendFramework.
 */
class File extends Element\File
{

    /**
     * Metodo responsavel em retornar um array compativel com especificação
     * {@link Zend\InputFilter\Factory::createInput()}.
     *
     * @return array
     */
    public function getInputSpecification()
    {
        $arrInputSpecification = (array) parent::getInputSpecification();
        $arrInputSpecification['type'] = 'InepZend\Filter\FileInput';
        return $arrInputSpecification;
    }

}
