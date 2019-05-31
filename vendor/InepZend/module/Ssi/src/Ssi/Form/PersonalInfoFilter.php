<?php

namespace InepZend\Module\Ssi\Form;

use InepZend\Filter\Filter;

class PersonalInfoFilter extends Filter
{

    public function __construct($strForm = null)
    {
        switch ($strForm) {
            case 'editMyInfo':
            default:
                $this->addFilterDadoPessoal(array());
                $this->addFilterEmailCrud();
                $this->addFilterPhoneCrud();
                break;
        }
    }

}
