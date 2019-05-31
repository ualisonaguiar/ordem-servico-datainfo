<?php

namespace InepZend\Module\Authentication\Service;

use InepZend\Authentication\Adapter\AuthBasic;
use InepZend\Service\AbstractServiceManager;
use InepZend\Authentication\AuthService;
use InepZend\Ssi\SsiRest;
use InepZend\Session\SessionTrait;
use InepZend\Mail\Mail;
use InepZend\Util\ArrayCollection;
use InepZend\Util\Format;
use InepZend\Util\stdClass;
use InepZend\Exception\Exception;
use \Exception as ExceptionNative;

class Authentication extends AbstractServiceManager
{

    use SessionTrait;

    public static function isSsiRest()
    {
        $strAdapter = @$GLOBALS['authServiceAdapter']['adapter'];
        return ((empty($strAdapter)) || ($strAdapter == 'InepZend\Authentication\Adapter\SsiRest'));
    }

    public static function isSsiServices()
    {
        return (@$GLOBALS['authServiceAdapter']['adapter'] == 'InepZend\Authentication\Adapter\SsiServices');
    }

    public static function isOauth()
    {
        return self::isSsiServices();
    }

    public static function isLdap()
    {
        return (@$GLOBALS['authServiceAdapter']['adapter'] == 'InepZend\Authentication\Adapter\LdapInep');
    }

    public static function isFacebook()
    {
        return (@$GLOBALS['authServiceAdapter']['adapter'] == 'InepZend\Authentication\Adapter\Facebook');
    }

    public static function isGoogle()
    {
        return (@$GLOBALS['authServiceAdapter']['adapter'] == 'InepZend\Authentication\Adapter\Google');
    }


    public static function isAuthBasic()
    {
        return (@$GLOBALS['authServiceAdapter']['adapter'] == AuthBasic::class);
    }

    public static function getAdapterName()
    {
        if (self::isLdap())
            return 'LDAP';
        if (self::isFacebook())
            return 'Facebook';
        if (self::isGoogle())
            return 'Google';
        if (self::isSsiRest())
            return 'SSIRest';
        if (self::isSsiServices())
            return 'SSIServices';
        if (self::isAuthBasic())
            return 'Sistema';
        return 'SSI';
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_LOGIN
     * @rest_auth no
     */
    protected function authenticate(array $arrData = array(), $arrConfig = null)
    {
        if (empty($arrConfig))
            $arrConfig = $this->getAuthServiceAdapter();
        $authService = new AuthService($arrConfig, null, null, true, self::getServiceManager());
        $authService->getAdapter()->setLogin(@$arrData['login']);
        $authService->getAdapter()->setPass(@$arrData['senha']);
        $result = null;
        $booAuthenticate = false;
        try {
            $result = $authService->authenticate();
            $booAuthenticate = $result->isValid();
        } catch (ExceptionNative $exception) {

        }
        return array($booAuthenticate, $result);
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_LOGIN_ACTION
     * @rest_auth no
     */
    protected function authenticateAction(array $arrData = array(), $arrConfig = null, $mixForm = null)
    {
        try {
            $session = self::getSessionInstance('InepZend\Module\Authentication\Controller\indexAction');
            if ((!self::isFacebook()) && (!self::isGoogle()) && (!empty($mixForm)) && (!self::isAuthBasic())) {
                if ($mixForm == 'InepZend\Module\Authentication\Form\Login')
                    $form = new $mixForm('prepareElementsAdministrativeResponsible', (bool)$session->offsetGet('auth_error'), 'prepareElementsAdministrativeResponsible');
                else
                    $form = (is_object($mixForm)) ? $mixForm : new $mixForm();
                $form->setData($arrData);
                if (!$form->isValid()) {
                    $session->offsetSet('auth_error', true);
                    $arrMessage = $form->getMessages();
                    $strValidate = '';
                    foreach ($arrMessage as $strName => $arrValidate)
                        foreach ($arrValidate as $strMessage)
                            $strValidate .= $strMessage . "\n";
                    throw new Exception($strValidate);
                }
            }
            $arrResultAuth = $this->authenticate($arrData);
            $booAuthenticate = $arrResultAuth[0];
            $result = $arrResultAuth[1];
            if ($booAuthenticate) {
                $permission = $this->getService('InepZend\Permission\Permission');
                if ($permission->isValid()) {
                    $session->offsetSet('auth_error', false);
                    $this->evalExtraCommand();
                    return $arrResultAuth;
                }
                $session->offsetSet('auth_error', true);
                throw new Exception('Ocorreu uma falha no sistema de segurança e a operação não pôde ser realizada!');
            }
            $arrMessageAuth = (is_object($result)) ? $result->getMessages() : array();
            $strMessageAuth = ((!is_array($arrMessageAuth)) || (count($arrMessageAuth) == 0) || (is_null($arrMessageAuth[0]))) ? 'Não foi possível realizar a operação!' : $arrMessageAuth;
            if (is_array($strMessageAuth))
                $strMessageAuth = (count($strMessageAuth) == 1) ? end($strMessageAuth) : var_export($strMessageAuth, true);
            $session->offsetSet('auth_error', true);
            throw new Exception($strMessageAuth);
        } catch (ExceptionNative $exception) {
            while (is_object($exception->getPrevious()))
                $exception = $exception->getPrevious();
            $booAuthenticate = false;
            $result = new stdClass(['messages' => [$exception->getMessage()]]);
        }
        return array($booAuthenticate, $result);
    }

    protected function logoff($arrConfig = null)
    {
        if (empty($arrConfig))
            $arrConfig = $this->getAuthServiceAdapter();
        $authService = new AuthService($arrConfig);
        $authService->clearIdentity();
        session_regenerate_id();
        return true;
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_LOGIN
     */
    protected function changePass(array $arrData = array())
    {
        $this->debugExec($arrData);
        $this->managerDataPass($arrData);
        $this->debugExec($arrData);
        $mixValidationPass = $this->validatePass($arrData);
        $this->debugExec($mixValidationPass);
        if ($mixValidationPass === true) {
            $mixResult = $this->getProviderService()->alterarSenha($arrData['co_usuario'],
                $this->hashPass($arrData['no_senha_antiga']),
                $this->hashPass($arrData['no_senha_nova']));
            $this->debugExec($mixResult);
            $arrReturn = array();
            if (is_object($mixResult))
                $arrReturn = ArrayCollection::objectToArray((is_object($mixResult->response)) ? $mixResult->response : $mixResult);
            elseif (!is_array($mixResult))
                $arrReturn = array($mixResult);
        } else
            $arrReturn = array('status' => 'VALIDACAO', 'messages' => $mixValidationPass);
        $this->debugExec($arrReturn);
        return $arrReturn;
    }

    /**
     * @rest yes
     * @rest_resource WS_RSRC_LOGIN
     * @rest_auth no
     */
    protected function recoverPass(array $arrData = array())
    {
        $this->debugExec($arrData);
        $mixResult = $this->getProviderService()->resetarSenha(((self::isOauth()) ? $arrData['ds_login'] : $arrData['nu_cpf']), $arrData['no_email']);
        $this->debugExec($mixResult);
        $arrReturn = array();
        if (is_object($mixResult))
            $arrReturn = ArrayCollection::objectToArray((is_object($mixResult->response)) ? $mixResult->response : $mixResult);
        elseif (!is_array($mixResult))
            $arrReturn = array($mixResult);
        if ($arrReturn['status'] === 'OK') {
            $arrMessage = $arrReturn['messages'];
            $arrMessage[] = 'Senha temporária de acesso enviada para o e-Mail.';
            if (self::isOauth())
                $arrReturn['messages'] = $arrMessage;
            else {
                $mixPass = $this->unhashPass(@$mixResult->response->result->usuarioSistema->usuario->txSenhaTemporaria);
                if ($mixPass !== false) {
                    $strContent = '<p>Prezado(a),</p>
                        <p>Conforme solicitado, seguem seus dados de acesso aos sistemas do Inep.</p>
                        <p>Login: ' . Format::formatCpfCnpj($arrData['nu_cpf']) . '</p>
                        <p>Senha temporária: ' . $mixPass . '</p>
                        <p>***Importante: Email automático, favor não responder.</p>';
                    $mail = new Mail();
                    $mixResult = $mail->sendMail($strContent, 'Envio de senha temporária de acesso', $arrData['no_email']);
                    if ((is_object($mixResult)) && ($mixResult instanceof Exception))
                        array_pop($arrMessage);
                }
            }
            $arrReturn['messages'] = $arrMessage;
        }
        $this->debugExec($arrReturn);
        return $arrReturn;
    }

    protected function hashPass($strPass)
    {
        return (empty($strPass)) ? false : base64_encode($this->getHex() . base64_encode($strPass));
    }

    protected function unhashPass($strHash)
    {
        return (empty($strHash)) ? false : base64_decode(substr(base64_decode($strHash), strlen($this->getHex())));
    }

    protected function getAuthServiceAdapter()
    {
        $arrConfig = $this->getService('Config');
        if (array_key_exists('authServiceAdapter', $arrConfig))
            $arrConfig = $arrConfig['authServiceAdapter'];
        return $arrConfig;
    }

    private function getHex()
    {
        $strHash = hash('sha256', 'r&$T%$@#I%n*e@P');
        $strHex = '';
        for ($i = 0; $i < strlen($strHash); ++$i)
            $strHex .= dechex((int)$strHash[$i]);
        return $strHex;
    }

    private function managerDataPass(array &$arrData = array())
    {
        $arrAttributeValid = array('no_senha_antiga', 'no_senha_nova', 'no_senha_confirmacao', 'co_usuario');
        foreach ($arrData as $strKey => $mixValue) {
            if (!in_array($strKey, $arrAttributeValid))
                unset($arrData[$strKey]);
        }
        if ((!array_key_exists('co_usuario', $arrData)) || (empty($arrData['co_usuario']))) {
            if (($this->hasIdentity()) && (is_object($this->getUser())))
                $arrData['co_usuario'] = $this->getUser()->id;
        }
    }

    private function validatePass(array $arrData = array())
    {
        $arrValidation = array(
            array('no_senha_antiga', 'Senha Antiga é de preenchimento obrigatório.', 'empty'),
            array('no_senha_nova', 'Senha Nova é de preenchimento obrigatório.', 'empty'),
            array('no_senha_confirmacao', 'Confirmação da Senha Nova é de preenchimento obrigatório.', 'empty'),
            array('co_usuario', 'Usuário é de preenchimento obrigatório.', 'empty'),
            array('no_senha_nova', 'Senha Nova deve possuir letras minúsculas.', 'regex', '/.*[a-z]+.*/'),
            array('no_senha_nova', 'Senha Nova deve possuir letras maiúsculas.', 'regex', '/.*[A-Z]+.*/'),
            array('no_senha_nova', 'Senha Nova deve possuir números.', 'regex', '/.*[\\d]+.*/'),
            array('no_senha_nova', 'Senha Nova deve possuir símbolos.', 'regex', '/.*[!@#$%&*]+.*/'),
            array('no_senha_nova', 'Senha Nova deve possuir 6 a 20 caracteres', 'size', 6, 20),
            array('no_senha_nova', 'Confirmação da Senha Nova deve ser igual a Senha Nova', 'compare', 'no_senha_confirmacao'),
        );
        $mixValidationPass = true;
        foreach ($arrValidation as $arrValidationInfo) {
            $booValid = true;
            switch (strtolower($arrValidationInfo[2])) {
                case 'empty': {
                    $booValid = (!empty($arrData[$arrValidationInfo[0]]));
                    break;
                }
                case 'regex': {
                    $arrMatch = array();
                    $booValid = (preg_match($arrValidationInfo[3], $arrData[$arrValidationInfo[0]], $arrMatch) === 1);
                    break;
                }
                case 'size': {
                    if ((!empty($arrValidationInfo[3])) && (!empty($arrValidationInfo[4])))
                        $booValid = ((strlen($arrData[$arrValidationInfo[0]]) >= $arrValidationInfo[3]) && (strlen($arrData[$arrValidationInfo[0]]) <= $arrValidationInfo[4]));
                    elseif ((!empty($arrValidationInfo[3])) && (empty($arrValidationInfo[4])))
                        $booValid = (strlen($arrData[$arrValidationInfo[0]]) >= $arrValidationInfo[3]);
                    elseif ((empty($arrValidationInfo[3])) && (!empty($arrValidationInfo[4])))
                        $booValid = (strlen($arrData[$arrValidationInfo[0]]) <= $arrValidationInfo[4]);
                    break;
                }
                case 'compare': {
                    $booValid = ($arrData[$arrValidationInfo[0]] == $arrData[$arrValidationInfo[3]]);
                    break;
                }
            }
            if (!$booValid) {
                if (is_bool($mixValidationPass)) {
                    $mixValidationPass = array();
                }
                $mixValidationPass[] = $arrValidationInfo[1];
            }
        }
        return $mixValidationPass;
    }

    private function getProviderService()
    {
        if (self::isAuthBasic()) {
            if (empty($arrConfig))
                $arrConfig = $this->getAuthServiceAdapter();
            $authService = new AuthService($arrConfig, null, null, true, self::getServiceManager());
            return $authService->getAdapter();
        }
        return (self::isOauth()) ? $this->getService('InepZend\Module\Oauth\Service\SsiService') : new SsiRest();
    }

}
