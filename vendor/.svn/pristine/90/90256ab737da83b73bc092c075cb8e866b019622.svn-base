<?php

namespace InepZend\Module\Ssi\Form;

use InepZend\Filter\Filter;

class AcaoAclRouteFilter extends Filter
{

    public function __construct($strShortNameForm = null)
    {
        parent::__construct($strShortNameForm);
        switch (strtolower($strShortNameForm)) {
            case 'index':
                $this->addFilter(array('name' => 'from'));
                $this->addFilter(array('name' => 'ds_module'));
                $this->addFilter(array('name' => 'ds_controller'));
                $this->addFilter(array('name' => 'ds_action'));
                $this->addFilter(array('name' => 'no_perfil'));
                $this->addFilter(array('name' => 'ds_route'));
                $this->addFilter(array('name' => 'ds_tree'));
                break;
            case 'show':
                break;
        }
    }

}
