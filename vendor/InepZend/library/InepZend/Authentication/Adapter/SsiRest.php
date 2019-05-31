<?php

namespace InepZend\Authentication\Adapter;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use InepZend\WebService\Client\Corporative\Inep\SsiRest as WebServiceSsiRest;
use InepZend\WebService\Client\AbstractWebService;
use InepZend\Util\DebugExec;
use InepZend\Exception\Exception;

class SsiRest implements AdapterInterface
{

    use DebugExec;

    const DEBUG = AbstractWebService::DEBUG;

    protected $login;
    protected $pass;
    protected $arrConfig;

    public function __construct($arrConfig = array(), $booUnitTest = null, $serviceManager = null)
    {
        $this->setArrConfig(null);
        if ($booUnitTest)
            $this->setArrConfig($arrConfig);
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($strLogin)
    {
        $this->login = str_replace('.', '', str_replace('-', '', $strLogin));
        return $this;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($strPass)
    {
        $strHash = hash('sha256', 'r&$T%$@#I%n*e@P');
        $strHex = '';
        for ($intCount = 0; $intCount < strlen($strHash); ++$intCount)
            $strHex .= dechex((int) $strHash[$intCount]);
        $this->pass = base64_encode($strHex . base64_encode($strPass));
        return $this;
    }

    public function authenticate()
    {
        $mixResult = null;
        $booResponse = false;
        try {
            $ssiRest = new WebServiceSsiRest();
            $mixResult = ($this->getArrConfig() != null) ?
                    $ssiRest->authUserService($this->getLogin(), $this->getPass(), array(), null, null, $this->getArrConfig()) :
                    $ssiRest->authUserService($this->getLogin(), $this->getPass());
            $booResponse = is_object($mixResult);
        } catch (Exception $exception) {
            $this->debugExecFile($exception);
        } catch (\Exception $exception) {
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
        $this->debugExecFile($authenticateResult);
        return $authenticateResult;
    }

    public function getArrConfig()
    {
        return $this->arrConfig;
    }

    public function setArrConfig($arrConfig)
    {
        $this->arrConfig = $arrConfig;
        return $this;
    }

}
