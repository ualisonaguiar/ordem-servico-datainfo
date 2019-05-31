<?php

namespace InepZend\FormGenerator\Element;

use Zend\Form\Element;
use Zend\Validator\Regex as RegexValidator;

/**
 * Classe estendida da ZendFramework para que a mesma seja extendida do InepZend
 * ao Invés do ZendFramework.
 */
class Email extends Element\Email
{
    
    public function getEmailValidator()
    {
        if (null === $this->emailValidator) {
            $this->emailValidator = new RegexValidator(
                '/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i'
            );
        }
        return $this->emailValidator;
    }
    
}
