<?php

namespace InepZend\Module\UnitTest\Form;

use InepZend\FormGenerator\FormGenerator;

class SearchSchool extends FormGenerator
{
    
    public function prepareElementsFilter()
    {
        $this->setInputFilter(new SearchSchoolFilter());
        $this->addText(
            array(
                'name' => 'coEscola',
                'label' => 'Por Código',
                'placeholder' => 'Código da Escola',
            )
        );
        $this->addHtml('<hr />');
        $this->addLabel('lbl', 'Por área de interesse');
        $this->addSelect(
            array(
                'name' => 'coUF',
                'empty_option' => 'UF',                
            )
        );
        $this->addSelect(
            array(
                'name' => 'coMunicipio',
                'empty_option' => 'Municípios',
            )
        );
        $this->addSelect(
            array(
                'name' => 'coDependenciaAdministrativa',
                'empty_option' => 'Dependência Administrativa' 
           )
        );
        $this->addSelect(
            array(
                'name' => 'coLocalizacao',
                'empty_option' => 'Localização'
            )
        );
        $this->addSelect(
            array(
                'name' => 'coLocalizacaoDiferenciada',
                'empty_option' => 'Localização diferenciada'
            )
        );
        $this->addSelect(
            array(
                'name' => 'codigoEscola', # @TODO ver o name correto
                'empty_option' => 'Escola'
            )
        );
        $this->addHtml('<div>');
        $this->addButton(
            array(
                'name' => 'btnSearch',
                'class' => 'btn btn-warning',
                'value' => 'Buscar',
                'title' => 'Buscar',
                'type' => 'submit'
            )
        );
        $this->addHtml('</div>');
    }
}
