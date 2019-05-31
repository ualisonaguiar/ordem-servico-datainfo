<?php

namespace InepZend\Module\Authentication\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\Authentication\Service\Authentication as AuthenticationService;

class Authentication extends FormGenerator
{

    public function prepareElementsChangePass($booTemp = false)
    {
        $this->setAttribute('action', $this->getBaseUrl() . '/' . (($booTemp) ? 'change_temp_pass' : 'change_pass'));
        $this->setViewValidate(true);
        $this->setInputFilter(new AuthenticationFilter());
        $this->addHtml('<div class="caixaVazada"><h2>Trocar senha' . (($booTemp) ? ' Temporária' : '' ) . '</h2>');
        $this->prepareElementsValidation();
        $this->addHtml('<div class="caixaVazada" style="margin-bottom: 10px;"><h3 class="h-form">Senhas</h3>');
        $this->addPassword(array('name' => 'no_senha_antiga', 'label' => 'Senha Antiga'));
        $this->addPassword(array('name' => 'no_senha_nova', 'label' => 'Senha Nova', 'help_text' => 'A senha nova deverá possuir letras minúsculas, maiúsculas, números, símbolos e tamanho entre 6 a 20 caracteres.', 'onkeyup' => 'validatePass();'));
        $this->addPassword(array('name' => 'no_senha_confirmacao', 'label' => 'Confirmação da Senha Nova'));
        $strButtonNameChancePass = ($booTemp) ? 'btnAlterarSenhaTemporaria' : 'btnAlterarSenha';
        $this->addButton(array('name' => $strButtonNameChancePass, 'title' => 'Alterar Senha' . (($booTemp) ? ' Temporária' : '' ), 'class' => 'btnDefault ' . $strButtonNameChancePass . ' btn-inep', 'style' => 'margin-top: 30px;', 'onclick' => 'if (validatePass(true)) { document.frm.submit(); }'));
        $this->addHtml('</div></div>');
    }

    private function prepareElementsValidation()
    {
        $this->addHtml('<div id="divPassValidation" class="well"><h3>Validação</h3>
            <div class=\'divPassValidation\' style=\'background-color: #9A0000;\' id=\'divPassValidationMinusculo\'>
                LETRAS MINÚSCULAS
            </div>
            <div class=\'divPassValidation\' style=\'background-color: #9A0000;\' id=\'divPassValidationMaiusculo\'>
                LETRAS MAIÚSCULAS
            </div>
            <div class=\'divPassValidation\' style=\'background-color: #9A0000;\' id=\'divPassValidationNumero\'>
                NÚMEROS
            </div>
            <div class=\'divPassValidation\' style=\'background-color: #9A0000;\' id=\'divPassValidationSimbolo\'>
                SÍMBOLOS - !@#$%&*
            </div>
            <div class=\'divPassValidation\' style=\'background-color: #9A0000;\' id=\'divPassValidationTamanho\'>
                TAMANHO DE 6 A 20 CARACTERES
            </div>
        </div>');
    }

    public function prepareElementsRecoverPass()
    {
        $this->addHtml('<div class="caixaVazada"><h2 class="h-form">Recuperar senha</h2>');
        if (AuthenticationService::isOauth())
            $this->addText(array('name' => 'ds_login', 'label' => 'Login', 'placeholder' => 'Digite seu Login', 'maxlength' => 255, 'required' => true));
        else
            $this->addCpf(array('name' => 'nu_cpf', 'required' => true));
        $this->addText(array('name' => 'no_email', 'label' => 'e-Mail', 'placeholder' => 'Entre com o e-Mail', 'required' => true, 'maxlength' => 150));
        $this->addCaptcha(array('name' => 'captcha', 'label' => 'Captcha', 'required' => true, 'word_len' => 4));
        $this->addButton(array('name' => 'btnEnviar', 'title' => 'Enviar solicitação para recuperação de senha', 'class' => 'btnDefault btnEnviar btn-inep', 'type' => 'submit', 'value' => 'Enviar'));
        $this->addButtonBack('/');
        $this->addHtml('</div>');
        $this->setInputFilter(new AuthenticationFilter('recoverPass'));
    }

}
