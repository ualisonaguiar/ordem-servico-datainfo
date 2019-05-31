<?php

namespace InepZend\Module\UnitTest\Form;

use InepZend\Filter\Filter;

class SearchSchoolFilter extends Filter
{
    public function __construct()
    {
        $this->addFilter(array('coEscola'));
        $this->addFilter(array('coUF'));
        $this->addFilter(array('coMunicipio'));
        $this->addFilter(array('coDependenciaAdministrativa'));
        $this->addFilter(array('coLocalizacao'));
        $this->addFilter(array('coLocalizacaoDiferenciada'));
        $this->addFilter(array('coEscola'));
    }
}
