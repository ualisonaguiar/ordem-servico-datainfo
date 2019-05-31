<?php

namespace InepZend\Module\Authentication\Form;

use InepZend\Filter\Filter;
use InepZend\Module\Authentication\Form\Login;
use InepZend\Exception\RuntimeException;

class LoginFilter extends Filter
{

    public function __construct($strMethod = null, $booAuthError = null)
    {
        if (!empty($strMethod))
            $this->$strMethod($booAuthError);
        else
            throw new RuntimeException('Filtro não identificado.');
    }
    
    private function prepareElementsAdministrative($booAuthError = null)
    {
        $this->add(array(
            'name' => 'login',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
                array('name' => 'Int'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'CPF não pode estar em branco')
                    )
                ),
//                array(
//                    'name' => 'regex',
//                    'options' => array(
//                        'pattern' => '/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/',
//                        'messages'=> array('regexNotMatch' => 'CPF fora do formato 999.999.999-99')
//                    )
//                ),
            ),
        ));
        $this->add(array(
            'name' => 'senha',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'Senha não pode estar em branco')
                    )
                ),
            ),
        ));
    }
     
    private function prepareElementsAdministrativeResponsible($booAuthError = null)
    {
        $this->prepareElementsAdministrative();
        if ((Login::checkUseCaptcha()) && ($booAuthError))
            $this->addFilter(array('name' => 'captcha', 'required' => true));
    }

}
