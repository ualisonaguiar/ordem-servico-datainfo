<?php

namespace InepZend\Module\UnitTest\Form;

use InepZend\FormGenerator\FormGenerator;

class SubcategoriaForm extends FormGenerator
{

    const CO_CATEGORIA = 6;

    public function __construct($strName = null, $serviceLocator = null)
    {
        parent::__construct((empty($strName) ? $this->generateFormName(__CLASS__) : $strName));
    }

    public function prepareElementsFilter()
    {
        $this->setInputFilter(new SubcategoriaFilter());
        $this->addText(
                array(
                    'name' => 'co_subcategoria',
                    'label' => 'SubCategoria',
                    'placeholder' => 'Código da SubCategoria',
                )
        );
        $this->addText(
                array(
                    'name' => 'no_subcategoria',
                    'label' => 'Nome da SubCategoria',
                    'placeholder' => 'Nome da SubCategoria',
                )
        );
        $this->addSelect(array('name' => 'co_categoria', 'label' => 'Categoria', 'placeholder' => 'Selecione', 'value_options' => $this->listCategoria(), 'required' => true, 'style' => 'float: left;'));
        $this->addButtonSave();
    }

    private function listCategoria()
    {
        return $this->listEntity('InepZend\Module\UnitTest\Service\Subcategoria', array('categoria' => self::CO_CATEGORIA), null, null, array());
    }

}
