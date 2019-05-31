<?php

namespace InepZend\Module\Ssi\Form;

use InepZend\Filter\Filter;

class AcaoAclFormElementFilter extends Filter
{

    public function __construct($strShortNameForm = null)
    {
        parent::__construct($strShortNameForm);
        switch (strtolower($strShortNameForm)) {
            case 'index':
                $this->addFilter(array('name' => 'from'));
                $this->addFilter(array('name' => 'ds_module'));
                $this->addFilter(array('name' => 'ds_form'));
                $this->addFilter(array('name' => 'ds_prepare_elements'));
                $this->addFilter(array('name' => 'ds_form_element'));
                $this->addFilter(array('name' => 'ds_tree'));
                break;
            case 'show':
                break;
        }
    }

}
