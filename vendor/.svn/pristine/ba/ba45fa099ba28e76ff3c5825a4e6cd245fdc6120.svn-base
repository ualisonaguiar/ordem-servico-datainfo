<?php

namespace InepZend\Authentication\Adapter;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use InepZend\Module\Oauth\Service\AbstractService;
use InepZend\Util\DebugExec;
use \Exception as ExceptionNative;

class Facebook implements AdapterInterface
{
    
    use DebugExec;
    
    const DEBUG = AbstractService::DEBUG;

    protected $login;
    protected $pass;
    protected $serviceManager;

    public function __construct($arrConfig = array(), $booUnitTest = null, $serviceManager = null)
    {
        $this->setServiceManager($serviceManager);
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($strLogin)
    {
        $this->login = $strLogin;
        return $this;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($strPass)
    {
        $this->pass = $strPass;
        return $this;
    }

    public function authenticate()
    {
        $mixResult = null;
        $booResponse = false;
        try {
            $mixResult = $this->getServiceManager()->get('InepZend\Module\Oauth\Service\FacebookService')->authenticate();
            $booResponse = is_object($mixResult);
        } catch (ExceptionNative $exception) {
            $this->debugExecFile($exception);
        }
        $this->debugExecFile($mixResult);
        $this->debugExecFile($booResponse);
        if ($booResponse) {
            $response = $mixResult->response;
            $arrContent = $response->messages;
            $this->debugExecFile($arrContent);
            if ($response->status == 'FALHA')
                $authenticateResult = new Result(Result::FAILURE_CREDENTIAL_INVALID, null, $arrContent);
            else
                $authenticateResult = new Result(Result::SUCCESS, $response->result, $arrContent);
        } else
            $authenticateResult = new Result(Result::FAILURE_UNCATEGORIZED, null, array('Não foi possível realizar a operação!'));
        $this->debugExecFile($booResponse);
        $this->debugExecFile($authenticateResult, null, false, true);
        return $authenticateResult;
    }

    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    public function setServiceManager($serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

}
