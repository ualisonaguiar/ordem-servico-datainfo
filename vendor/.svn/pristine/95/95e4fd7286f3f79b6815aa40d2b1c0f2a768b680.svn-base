<?php

namespace InepZend\Module\Authentication\Form;

use InepZend\FormGenerator\FormGenerator;
use InepZend\Module\Authentication\Form\LoginFilter;
use InepZend\Module\Authentication\Service\Authentication as AuthenticationService;
use InepZend\Util\ApplicationInfo;
use InepZend\Util\Server;
use InepZend\Util\Environment;

class Login extends FormGenerator
{

    private static $arrIpNotUseCaptcha = array(
        'localhost',
        '127.0.1.1',
        '172.17.0.2',
        Environment::IP_LOCAL,
        Environment::IP_DESENVOLVIMENTO,
        Environment::IP_DESENVOLVIMENTO2,
    );

    public function __construct($strName = null, $booAuthError = null, $strMethod = null)
    {
        $this->execOperation($strName, $booAuthError, null, $strMethod);
    }

    public function execOperation($strName = null, $booAuthError = null, $booDelElementAll = null, $strMethod = null)
    {
        if ($booDelElementAll === true)
            $this->delElementAll();
        if (empty($strMethod))
            $strMethod = 'prepareElements' . self::getTheme();
        if (!in_array($strMethod, array('prepareElementsAdministrativeResponsible')))
            $strMethod = 'prepareElementsAdministrative';
        $this->$strMethod($strName, $booAuthError);
        $this->setInputFilter(new LoginFilter($strMethod, $booAuthError));
    }

    public static function checkUseCaptcha()
    {
        return (!in_array(Server::getIpServer(), self::$arrIpNotUseCaptcha));
    }

    private function prepareElementsAdministrative($strName = null, $booAuthError = null)
    {
        if (is_null($strName))
            $strName = 'frmLogin';
        parent::__construct($strName);
        $this->addHtml('<div class="tercoTela caixaVazada" style="*margin-left: 28%; *margin-right: 28%;">');
        $this->addCpf(array('name' => 'login', 'required' => true));
        $this->addPassword(array('name' => 'senha'));
        $this->addButtonRoute(array('name' => 'btnRecuperarSenha', 'title' => 'Recuperar Senha', 'class' => 'btnDefault btnRecuperarSenha btn-inep', 'style' => 'float: left; margin-top: 1px;', 'route' => 'recover_pass'));
        $this->addButton(array('name' => 'btnEntrar', 'title' => 'Entrar', 'class' => 'btnDefault btnEntrar btn-inep', 'style' => 'margin-top: 1px;', 'type' => 'submit'));
        $this->addHtml('</div>');
    }

    private function prepareElementsAdministrativeResponsible($strName = null, $booAuthError = null)
    {
        if (is_null($strName))
            $strName = 'login';
        parent::__construct($strName);
        $arrApplicationInfo = (array) ApplicationInfo::getApplicationInfo();
        $this->setViewValidate(true);
        $strTitle = (array_key_exists('NAME', $arrApplicationInfo)) ? $arrApplicationInfo['NAME'] : 'Inep';
        $strHtml = '<section class="login">
                <article>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h2 class="h4 panel-title text-center text-primary">Autenticação via ' . AuthenticationService::getAdapterName() . '</h2>
                        </div>
                        <div class="panel-body">';
        $this->addHtml($strHtml);
        if (
            !(AuthenticationService::isSsiRest()) &&
            !(AuthenticationService::isSsiServices()) &&
            !(AuthenticationService::isLdap()) &&
            !(AuthenticationService::isAuthBasic())
        ) {
            $this->addHtml('<div style="text-align: center; padding-bottom: 5px;">');
            $this->addHidden(array('name' => 'adapter', 'value' => AuthenticationService::getAdapterName()));
            if (AuthenticationService::isFacebook())
                $this->addImage(array('src' => 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xtf1/v/t1.0-1/p160x160/12006203_10154088276211729_2432197377106462187_n.png?oh=6ef5fcfa814f5f95680ac378f20df30b&oe=57765050&__gda__=1467642566_9c1f90269a9feb58bb86b743a5011ecd'));
            elseif (AuthenticationService::isGoogle())
                $this->addImage(array('src' => "http://static1.squarespace.com/static/55b9540ce4b0ae0f6a895370/55b95949e4b0afadc7342bf1/55e6318de4b0cca62d456bd6/1441149326399/Google's+New+Favicon+2015.jpgGoogle's+New+Favicon+2015?format=original"));
            $this->addHtml('</div>');
            $strHtml = '';
        } else {
            if (
                (AuthenticationService::isOauth()) ||
                (AuthenticationService::isLdap()) ||
                (AuthenticationService::isAuthBasic())
            )
                $this->addText(array('name' => 'login', 'id' => 'login', 'label' => 'Login', 'placeholder' => 'Digite seu Login', 'maxlength' => 255, 'required' => true, 'style' => 'width: 100%;', 'tabindex' => 13, 'attr_data' => array('ng-model' => 'data.login')));
            else
                $this->addCpf(array('name' => 'login', 'id' => 'cpf', 'label' => '<abbr title="Cadastro de pessoa física">CPF</abbr>', 'placeholder' => 'Digite seu CPF', 'title' => 'Digite seu CPF', 'required' => true, 'style' => 'width: 100%;', 'tabindex' => 13, 'attr_data' => array('ng-model' => 'data.login')));
            $this->addPassword(array('name' => 'senha', 'placeholder' => 'Digite sua senha', 'style' => 'width: 100%;', 'tabindex' => 14, 'attr_data' => array('ng-model' => 'data.senha')));
            if ((self::checkUseCaptcha()) && ($booAuthError)) {
                $this->addHtml('<div class="form-group has-feedback">');
                $this->addCaptcha(array('name' => 'captcha', 'required' => true, 'tabindex' => 16, 'word_len' => 4, 'attr_data' => array('ng-model' => 'data.captcha.input')));
                $strHtml = '</div>';
            } else
                $strHtml = '';
            if (!AuthenticationService::isLdap() && !AuthenticationService::isAuthBasic())
                $strHtml .= '   <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="' . $this->getBaseUrl() . '/recover_pass" accesskey="s" tabindex="21" target="_self"><i class="fa fa-question-circle text-dark"></i> Esqueceu sua senha?</a>
                                </li>
                            </ul>';
        }
        $strHtml .= '       <footer class="panel-footer p-n p-n" style="border: 0px;">';
        $this->addHtml($strHtml);
        $this->addButton(array('name' => 'btnEntrar', 'value' => '<i class="fa fa-sign-in"></i> Entrar', 'class' => 'btn btn-info btn-block', 'type' => 'submit', 'tabindex' => 25, 'accesskey' => 'e'));
        $strHtml = '        </footer>
                        </div>
                    </div>
                </article>
            </section>';
        $this->addHtml($strHtml);
        if (!(AuthenticationService::isSsiRest()) && !(AuthenticationService::isSsiServices()) && !(AuthenticationService::isLdap()) && !(AuthenticationService::isAuthBasic()))
            $this->setAttribute('action', $this->getBaseUrl() . '/login_external');
        else {
            $this->setAttribute('onsubmit', 'return false;')
                ->setAttribute('novalidate', 'novalidate')
                ->setAttribute('data-ng-submit', 'authenticate();');
        }
    }

}
