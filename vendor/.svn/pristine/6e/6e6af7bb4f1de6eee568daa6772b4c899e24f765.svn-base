<?php

namespace InepZend\Module\Ssi\Form;

use InepZend\Filter\Filter;

class AcaoMenuFilter extends Filter
{

    public function __construct($strShortNameForm = null)
    {
        parent::__construct($strShortNameForm);
        switch (strtolower($strShortNameForm)) {
            case 'index':
                $this->addFilter(array('name' => 'from'));
                $this->addFilter(array('name' => 'acao'));
                $this->addFilter(array('name' => 'ds_tree'));
                break;
            case 'show':
                $this->addFilter(array('name' => 'id_perfil'));
                break;
            case 'keep-action':
                $this->addFilter(array('name' => 'level_menu'));
                $this->addFilter(array('name' => 'function_callback', 'required' => true));
                $this->addFilter(array('name' => 'no_acao', 'required' => true));
                $this->addFilter(array('name' => 'sg_acao'));
                $this->addFilter(array('name' => 'ds_acao', 'required' => true));
                break;
        }
    }

}
