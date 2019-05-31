<?php

namespace InepZend\Module\Authentication\Form;

use InepZend\Filter\Filter;
use InepZend\Module\Authentication\Service\Authentication as AuthenticationService;

class AuthenticationFilter extends Filter
{

    public function __construct($strForm = null)
    {
        switch ($strForm) {
            case 'recoverPass': {
                    $this->addFilter(array('name' => ((AuthenticationService::isOauth()) ? 'ds_login' : 'nu_cpf'), 'required' => true));
                    $this->addFilter(array('name' => 'no_email', 'required' => true));
                    break;
                }
            case 'chancePass':
            default: {
                    $this->addFilter(array('name' => 'no_senha_antiga', 'required' => true, 'message_required' => 'Senha Antiga é de preenchimento obrigatório.'));
                    $this->addFilter(array('name' => 'no_senha_nova', 'required' => true, 'message_required' => 'Senha Nova é de preenchimento obrigatório.'));
                    $this->addFilter(array('name' => 'no_senha_confirmacao', 'required' => true, 'message_required' => 'Confirmação da Senha Nova é de preenchimento obrigatório.'));
                    break;
                }
        }
    }

}
