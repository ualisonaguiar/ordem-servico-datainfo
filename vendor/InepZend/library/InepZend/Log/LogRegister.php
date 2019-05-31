<?php

namespace InepZend\Log;

use InepZend\Module\Log\Service\LogModule;

/**
 * Trait responsavel pelo controle de utilizacao do log e sua escrita em arquivo.
 *
 * [-] LogStatic
 *      [+] LogRegister
 *          [-] LogTrace
 *              [-] LogTraceInstance
 *              [-] LogCall
 *          [-] LogPersistence
 *
 * @package InepZend
 * @subpackage Log
 */
trait LogRegister
{

    use LogStatic;

    public function log($mixMessage = null, $strLogMethod = null, $strLevel = null, $strPath = null)
    {
        if ((empty($mixMessage)) || (!$this->checkRegister($mixMessage)))
            return false;
        if (empty($strLogMethod))
            $strLogMethod = 'info';
        self::setLog();
        $log = self::getLog();
        $log->setTraceLevel($strLevel);
        $log->setTracePath($strPath);
        $log->$strLogMethod($mixMessage);
        if (@$GLOBALS[LogModule::KEY_ROOT][LogModule::KEY_OPTION][LogModule::KEY_OPTION_SHOW] === true)
            var_dump($mixMessage);
        return true;
    }

    protected function register($strMethod = null, $mixArgument = null, $strClass = null, $mixMessage = null, $strLogMethod = null, $strLevel = null, $strPath = null)
    {
        $arrMessage = array();
        if ((empty($strClass)) && (!empty($strMethod)))
            $strClass = get_class($this);
        if (!empty($strClass))
            $arrMessage['class'] = $strClass;
        if (!empty($strMethod))
            $arrMessage['method'] = $strMethod;
        if (!empty($mixArgument)) {
            if (((is_array($mixArgument)) || ((is_object($mixArgument)) && (!is_resource($mixArgument)))) && ($this->getUserMemory($mixArgument) > (1024 * 1024 * 0.1)))
                $mixArgument = null;
            $arrMessage['argument'] = $mixArgument;
        }
        if (!is_array($mixMessage))
            $mixMessage = (!empty($mixMessage)) ? array($mixMessage) : array();
        $arrMessage = array_merge($arrMessage, (array) $mixMessage);
        return (count($arrMessage) == 0) ? false : $this->log($arrMessage, $strLogMethod, $strLevel, $strPath);
    }

    private function getUserMemory($mixArgument = null)
    {
        $intStartMemory = memory_get_usage();
        $mixArgument = @unserialize(@serialize($mixArgument));
        return (memory_get_usage() - $intStartMemory);
    }

    private function checkRegister($mixMessage = null)
    {
        if (!$this->checkRegisterUri())
            return false;
        if (!$this->checkRegisterUsersSystem())
            return false;
        if (!$this->checkRegisterCpfs())
            return false;
        if (!$this->checkRegisterNamespaces($mixMessage))
            return false;
        return true;
    }

    private function checkRegisterUri()
    {
        if (!array_key_exists('REQUEST_URI', $_SERVER))
            return true;
        $arrPartUri = array('/message', '/renderscript/', '/js_entityconst/', '/js_entityattribute/', '/js_message/');
        foreach ($arrPartUri as $strPartUri) {
            if (strpos($_SERVER['REQUEST_URI'], $strPartUri) !== false)
                return false;
        }
        return true;
    }

    private function checkRegisterUsersSystem()
    {
        $arrUsersSystem = (array) @$GLOBALS[LogModule::KEY_ROOT][LogModule::KEY_USER_SYSTEM];
        if (count($arrUsersSystem) > 0) {
            if (!$this->hasIdentity())
                return false;
            if (!in_array(@$this->getUserSystem()->id, $arrUsersSystem))
                return false;
        }
        return true;
    }

    private function checkRegisterCpfs()
    {
        $arrCpfs = (array) @$GLOBALS[LogModule::KEY_ROOT][LogModule::KEY_CPF];
        if (count($arrCpfs) > 0) {
            if (!$this->hasIdentity())
                return false;
            if (!in_array(@$this->getUser()->cpf, $arrCpfs))
                return false;
        }
        return true;
    }

    private function checkRegisterNamespaces($mixMessage = null)
    {
        $strClassExec = $this->getClassExec($mixMessage);
        $arrNamespace = (array) @$GLOBALS[LogModule::KEY_ROOT][LogModule::KEY_NAMESPACE];
        $booCheck = false;
        foreach ($arrNamespace as $strDivision => $arrNamespaceDivision) {
            if (count($arrNamespaceDivision) == 0)
                continue;
            if (strpos($strClassExec, $strDivision) !== false) {
                $booCheck = true;
                break;
            }
        }
        $booContinue = true;
        if ($booCheck) {
            $booContinue = false;
            foreach ($arrNamespaceDivision as $strNamespaceDivision) {
                if (strpos($strClassExec, $strNamespaceDivision . '\\' . $strDivision) === 0) {
                    $booContinue = true;
                    break;
                }
            }
        }
        return $booContinue;
    }

    private function getClassExec($mixMessage = null)
    {
        $strClassExec = get_class($this);
        if (($strClassExec == 'InepZend\ModuleConfig\ModuleInit') && (is_array($mixMessage))) {
            if (array_key_exists('target', $mixMessage))
                $strClassExec = $mixMessage['target'];
            elseif (array_key_exists('controller', $mixMessage))
                $strClassExec = $mixMessage['controller'];
        } elseif ($strClassExec == 'InepZend\Doctrine\DBAL\Logging\FileSQLLogger') {
            $strRepository = $this->getRepository();
            if (!empty($strRepository))
                $strClassExec = $strRepository;
        }
        return $strClassExec;
    }

}
