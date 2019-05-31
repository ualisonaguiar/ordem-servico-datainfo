<?php

namespace InepZend\Module\Authentication\Controller;

use InepZend\Controller\AbstractCrudController;
use InepZend\View\View;
use InepZend\Module\Authentication\Form\Login;
use InepZend\Session\Session;
use InepZend\Module\Authentication\Form\Authentication;

class IndexController extends AbstractCrudController
{

    /**
     * @auth no
     */
    public function indexAction($form = null)
    {
        $session = self::getSessionInstance(__NAMESPACE__ . '\\' . __FUNCTION__);
        if (!is_object($form))
            $form = new Login(null, (bool) $session->offsetGet('auth_error'));
        $authenticationService = $this->getService('InepZend\Module\Authentication\Service\Authentication');
        $arrConfig = $authenticationService->getAuthServiceAdapter();
        $arrPost = $this->getPostOauth();
        if (!empty($arrPost)) {
            $form->setData($arrPost);
            if ($form->isValid()) {
                $arrResultAuth = $authenticationService->authenticate($arrPost);
                $booAuthenticate = $arrResultAuth[0];
                $result = $arrResultAuth[1];
                if ($booAuthenticate) {
                    $permission = $this->getService('InepZend\Permission\Permission');
                    if ($permission->isValid()) {
                        $session->offsetSet('auth_error', false);
                        $this->evalExtraCommand();
                        return $this->redirect()->toRoute(($arrConfig['callback']['route']) ? $arrConfig['callback']['route'] : 'inicial');
                    }
                    $this->getServiceMessage()->addMessageError('Ocorreu uma falha no sistema de segurança e a operação não pôde ser realizada!');
                } else {
                    $arrMessageAuth = (is_object($result)) ? $result->getMessages() : array();
                    $strMessageAuth = ((!is_array($arrMessageAuth)) || (count($arrMessageAuth) == 0) || (is_null($arrMessageAuth[0]))) ? 'Não foi possível realizar a operação!' : $result->getMessages();
                    $this->getServiceMessage()->addMessageError($strMessageAuth);
                }
            } else
                $this->getServiceMessage()->addMessageValidate(self::CONST_MESSAGE_VALIDATE, $form);
            $session->offsetSet('auth_error', true);
            $form->execOperation(null, true, true);
        } else {
            if ($this->hasIdentity())
                return $this->redirect()->toRoute(($arrConfig['callback']['route']) ? $arrConfig['callback']['route'] : 'inicial');
            $arrMessage = $this->getServiceMessage()->getMessageCollection();
            $booAuthError = $session->offsetGet('auth_error');
            Session::unsetSessionKey();
            if ((is_array($arrMessage)) && (count($arrMessage) > 0)) {
                $arrTypeMessage = array('Success', 'Error', 'Warning', 'Notice', 'Validate');
                foreach ($arrTypeMessage as $strTypeMessage) {
                    $strMethodMessage = 'addMessage' . $strTypeMessage;
                    if (array_key_exists($strTypeMessage, $arrMessage))
                        $this->getServiceMessage()->$strMethodMessage($arrMessage[$strTypeMessage]['arrMessage']);
                }
            }
            $session = self::getSessionInstance(__NAMESPACE__ . '\\' . __FUNCTION__);
            $session->offsetSet('auth_error', $booAuthError);
        }
        return new View(array('form' => $form));
    }

    /**
     * @auth no
     */
    public function logoffAction()
    {
        $this->getService('InepZend\Module\Authentication\Service\Authentication')->logoff();
        return $this->indexAction();
    }

    public function changeTempPassAction()
    {
        return $this->changePassAction(true);
    }

    public function changePassAction($booTemp = false)
    {
        if (!is_bool($booTemp))
            $booTemp = false;
        $form = new Authentication();
        $form->prepareElementsChangePass($booTemp);
        $arrPost = $this->getPostOauth();
        if (!empty($arrPost)) {
            $form->setData($arrPost);
            if ($form->isValid()) {
                $authenticationService = $this->getService('InepZend\Module\Authentication\Service\Authentication');
                $arrResult = $authenticationService->changePass($form->getData());
                if ($arrResult['status'] === 'OK') {
                    $arrData = $this->getPost();
                    $arrData = array('senha' => $arrData['no_senha_nova']);
                    $arrData['login'] = $this->getIdentity()->usuarioSistema->usuario->login;
                    $arrResultAuth = $authenticationService->authenticate($arrData);
                    $result = $arrResultAuth[1];
                    if ($booAuthenticate = $arrResultAuth[0]) {
                        $permission = $this->getService('InepZend\Permission\Permission');
                        if ($permission->isValid()) {
                            $this->evalExtraCommand();
                            $this->getServiceMessage()->addMessageSuccess($arrResult['messages']);
                            return $this->redirect()->toRoute((@$GLOBALS['authServiceAdapter']['callback']['route']) ? $GLOBALS['authServiceAdapter']['callback']['route'] : 'inicial');
                        }
                        $this->getServiceMessage()->addMessageError('Ocorreu uma falha no sistema de segurança e a operação não pôde ser realizada!');
                    } else {
                        $arrMessageAuth = (is_object($result)) ? $result->getMessages() : array();
                        $strMessageAuth = ((!is_array($arrMessageAuth)) || (count($arrMessageAuth) == 0) || (is_null($arrMessageAuth[0]))) ? 'Não foi possível realizar a operação!' : $result->getMessages();
                        $this->getServiceMessage()->addMessageError($strMessageAuth);
                    }
                } else
                    $this->getServiceMessage()->addMessageValidate($arrResult['messages']);
            } else
                $this->getServiceMessage()->addMessageValidate(AbstractCrudController::CONST_MESSAGE_VALIDATE, $form);
        }
        return new View(array('form' => $form, 'booTemp' => $booTemp));
    }

    /**
     * @auth no
     */
    public function recoverPassAction()
    {
        $form = new Authentication();
        $form->prepareElementsRecoverPass();
        $arrPost = $this->getPostOauth();
        if (!empty($arrPost)) {
            $form->setData($arrPost);
            if ($form->isValid()) {
                $arrResult = $this->getService('InepZend\Module\Authentication\Service\Authentication')->recoverPass($form->getData());
                if ($arrResult['status'] === 'OK') {
                    $this->getServiceMessage()->addMessageSuccess($arrResult['messages']);
                    return $this->redirect()->toRoute('login');
                }
                $this->getServiceMessage()->addMessageValidate($arrResult['messages']);
            } else
                $this->getServiceMessage()->addMessageValidate(AbstractCrudController::CONST_MESSAGE_VALIDATE, $form);
        }
        return new View(array('form' => $form));
    }
    
    /**
     * @auth no
     */
    public function loginExternalAction()
    {
        $strAdapter = @$GLOBALS['authServiceAdapter']['adapter'];
        if ((stripos($strAdapter, 'Ssi') === false) && (stripos($strAdapter, 'Ldap') === false)) {
            $authenticationService = $this->getService('InepZend\Module\Authentication\Service\Authentication');
            $arrResultAuth = $authenticationService->authenticate();
            $booAuthenticate = $arrResultAuth[0];
            $result = $arrResultAuth[1];
            if ($booAuthenticate) {
                $permission = $this->getService('InepZend\Permission\Permission');
                if ($permission->isValid()) {
                    $this->evalExtraCommand();
                    return $this->redirect()->toRoute(($arrConfig['callback']['route']) ? $arrConfig['callback']['route'] : 'inicial');
                }
                $strMessageAuth = 'Ocorreu uma falha no sistema de segurança e a operação não pôde ser realizada!';
            } else {
                $arrMessageAuth = (is_object($result)) ? $result->getMessages() : array();
                $strMessageAuth = ((!is_array($arrMessageAuth)) || (count($arrMessageAuth) == 0) || (is_null($arrMessageAuth[0]))) ? 'Não foi possível realizar a operação!' : $result->getMessages();
            }
        } else
            $strMessageAuth = 'Operação não permitida!';
        $this->getServiceMessage()->addMessageError($strMessageAuth);
        return $this->redirect()->toRoute('logoff');
    }

    private function evalExtraCommand()
    {
        $booReturn = false;
        $arrConfig = $this->getService('InepZend\Module\Authentication\Service\Authentication')->getAuthServiceAdapter();
        if (array_key_exists('eval', $arrConfig)) {
            $mixEval = $arrConfig['eval'];
            if (!empty($mixEval)) {
                if (!is_array($mixEval))
                    $mixEval = array($mixEval);
                foreach ($mixEval as $strEval) {
                    if (empty($strEval))
                        continue;
                    eval($strEval);
                }
                $booReturn = true;
            }
        }
        return $booReturn;
    }

}
