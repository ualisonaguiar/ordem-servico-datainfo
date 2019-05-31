<?php

namespace InepZend\ModuleConfig;

use InepZend\Authentication\AuthTrait;
use InepZend\Message\Message;
use InepZend\Permission\Permission;
use InepZend\Util\Reflection;
use InepZend\Util\String;
use InepZend\Util\Server;

class ModuleSecurity
{

    use AuthTrait,
        ModuleTrait;

    private static $event;
    private static $strController;
    private static $strAction;
    private static $arrAnnotationActions = array();

    public function preDispatch($event)
    {
        if (!self::checkEvent($event))
            return;
        self::$event = $event;
        self::$strController = self::getController($event);
        self::$strAction = lcfirst(String::camelize(str_replace('Action', '', self::getAction($event))));
        if (!$this->hasIdentity()) {
            if ($this->getCheckAuth()) {
                return $this->showMessage('É necessário estar autenticado para realizar a operação!', 'login');
            }
        } else if(false == array_key_exists('platform',$event->getRequest()->getPost()->toArray())) {
            if ($this->getCheckPermission() === false)
                return $this->showMessage('É necessário possuir as devidas permissões para realizar a operação!', 'login');
            if ((!in_array(self::$strAction, array('changeTempPass', 'logoff', 'showfile', 'recoverPass'))) && (is_object($this->getUser())) && ($this->getUser()->senhaTemporaria === true))
                return $this->showMessage('É necessário alterar sua senha temporária para dar continuidade ao acesso às funcionalidades do sistema!', 'change_temp_pass');
            $strResource = $this->getResource();
            if ((!is_null($strResource)) && (!$this->getCheckResourceFromSsi($strResource)))
                return $this->showMessage('É necessário possuir as devidas permissões para realizar a operação!', (@$GLOBALS['authServiceAdapter']['callback']['route']) ? $GLOBALS['authServiceAdapter']['callback']['route'] : 'inicial');
        }
    }

    private static function getAnnotationFromAction($strController = null, $strAction = null)
    {
        if (is_null($strController))
            $strController = self::$strController;
        if (is_null($strAction))
            $strAction = self::$strAction;
        if ((is_null($strController)) || (is_null($strAction)))
            return;
        if (!array_key_exists($strController, self::$arrAnnotationActions))
            self::$arrAnnotationActions[$strController] = array();
        if (!array_key_exists($strAction, self::$arrAnnotationActions[$strController]))
            self::$arrAnnotationActions[$strController][$strAction] = array();
        if (count(self::$arrAnnotationActions[$strController][$strAction]) == 0) {
            $arrAnnotation = Reflection::listAnnotationsFromMethod($strController, $strAction . 'Action');
            if (is_array($arrAnnotation))
                self::$arrAnnotationActions[$strController][$strAction] = $arrAnnotation;
        }
        return self::$arrAnnotationActions[$strController][$strAction];
    }

    private function getCheckAuth()
    {
        return $this->getCheckAnnotationFromAction('AUTH');
    }

    private function getCheckPermission()
    {
        $permission = new Permission();
        $strResource = strtoupper(Permission::CONST_KEY_PREFIXO_RESOURCE . str_ireplace('Controller', '', end($arrExplode = explode('\\', self::$strController))) . '_' . self::$strAction);
        return $permission->isAllowedIdentityIfExists($strResource);
    }

    private function getResource()
    {
        return $this->getValueAnnotationFromAction('RESOURCE');
    }

    private function getCheckResourceFromSsi($strResource = null)
    {
        $booCheckResource = false;
        if (!is_null($strResource)) {
            $permission = new Permission();
            if ($permission->hasResource($strResource))
                $booCheckResource = $permission->isAllowedIdentity($strResource, true);
            else
                $booCheckResource = Server::isPhpUnit();
        }
        return $booCheckResource;
    }

    private function getSessionExpired()
    {
        $strSessionExpired = (stripos((string) self::$strAction, 'ajax') !== false) ? 'message' : 'redirect';
        $strValueAnnotation = $this->getValueAnnotationFromAction('SESSIONEXPIRED');
        if (!is_null($strValueAnnotation))
            $strSessionExpired = strtolower($strValueAnnotation);
        return $strSessionExpired;
    }

    private function getCheckAnnotationFromAction($strAnnotation = null, $arrValue = null, $booCheckValueDefault = null)
    {
        if (!is_bool($booCheckValueDefault))
            $booCheckValueDefault = true;
        $booCheckAnnotationFromAction = $booCheckValueDefault;
        if (!empty($strAnnotation)) {
            $strValueAnnotation = $this->getValueAnnotationFromAction($strAnnotation);
            if (!is_null($strValueAnnotation)) {
                if ((is_array($arrValue)) && (count($arrValue) > 0))
                    $booCheckAnnotationFromAction = (in_array($strValueAnnotation, $arrValue));
                else
                    $booCheckAnnotationFromAction = (in_array(strtolower($strValueAnnotation), array('1', 'true', 'yes', 'sim')));
            }
        }
        return $booCheckAnnotationFromAction;
    }

    private function getValueAnnotationFromAction($strAnnotation = null)
    {
        $strValueAnnotation = null;
        if (!empty($strAnnotation)) {
            $strAnnotation = strtoupper($strAnnotation);
            $arrAnnotation = self::getAnnotationFromAction();
            if ((is_array($arrAnnotation)) && (array_key_exists($strAnnotation, $arrAnnotation)))
                $strValueAnnotation = (string) $arrAnnotation[$strAnnotation];
        }
        return $strValueAnnotation;
    }

    private function showMessage($strMessage = null, $strRoute = null)
    {
        if ((is_null($strMessage)) || (is_null($strRoute)))
            return;
        if (($this->getSessionExpired() == 'message') || (!is_object(self::$event)))
            exit($strMessage);
        $message = new Message();
        $message->addMessageWarning($strMessage);
        return self::$event->getTarget()->redirect()->toRoute($strRoute);
    }

}