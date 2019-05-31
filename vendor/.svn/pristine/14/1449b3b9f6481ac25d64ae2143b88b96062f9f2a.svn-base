<?php

namespace InepZend\WebService\Client\Corporative\Inep;

use InepZend\WebService\Client\Soap;
use InepZend\WebService\Client\Corporative\Inep\ObieeReport;

class Obiee extends Soap
{

    const URL_WSDL_DESENV = 'http://200.130.24.237:9704/analytics/saw.dll/wsdl/v6';
    const URL_WSDL_ENTREGA = 'http://entrega.inep.gov.br/analytics/saw.dll/wsdl/v6';
    const URL_WSDL_TQS = 'http://200.130.24.237:9704/analytics/saw.dll/wsdl/v6';
    const URL_WSDL_HOMOLOGA = 'http://200.130.24.237:9704/analytics/saw.dll/wsdl/v6';
    const URL_WSDL = 'http://inepdata.inep.gov.br/analytics/saw.dll/wsdl/v6';
    const SESSION_KEY_SESSION_ID = 'sessionId';

    private $strSessionId;
    private $strPromptedFilter;
    private $subjectAreaInstance;
    private $strName;
    private $strPassword;

    public function __construct($strName = null, $strPassword = null)
    {
        if ((!empty($strName)) && (!empty($strPassword)))
            $this->getSessionId($strName, $strPassword);
    }

    public function logonex($strName = null, $strPassword = null, $strSessionId = null, $strUrlWsdl = null, $booDebug = null)
    {
        if ((empty($strName)) || (empty($strPassword)))
            return self::MSG_PARAM_NOT_FOUND;
        $arrParam = array(
            'name' => $strName,
            'password' => $strPassword,
            'sessionparams' => array(
                'userAgent' => $_SERVER['HTTP_USER_AGENT'],
                'asyncLogon' => false,
                'sessionID' => $strSessionId,
            ),
        );
        $result = $this->runService($arrParam, __FUNCTION__, $strUrlWsdl, $booDebug);
        if (isset($result->return)) {
            $return = $result->return;
            if (isset($return->sessionID)) {
                $this->setSessionIdIntoSession($return->sessionID);
                $this->setName($strName);
                $this->setPassword($strPassword);
            }
        }
        return $result;
    }

    public function setBridge($strBridge = null, $strUrlWsdl = null, $booDebug = null)
    {
        $strSessionId = $this->getSessionId();
        if ((empty($strBridge)) || (empty($strSessionId)))
            return self::MSG_PARAM_NOT_FOUND;
        $arrParam = array(
            'bridge' => $strBridge,
            'sessionID' => $strSessionId,
        );
        return $this->runService($arrParam, __FUNCTION__, $strUrlWsdl, $booDebug);
    }

    public function getPromptedFilters($mixReportPath = null, $strUrlWsdl = null, $booDebug = null)
    {
        if (!is_array($mixValidate = ObieeReport::validateParam($mixReportPath, $this)))
            return $mixValidate;
        $arrParam = array(
            'report' => array(
                'reportPath' => $mixValidate[0]
            ),
            'sessionID' => $mixValidate[1],
        );
        $result = $this->runService($arrParam, __FUNCTION__, $strUrlWsdl, $booDebug);
        if (isset($result->promptedFilter))
            $this->setPromptedFilter($result->promptedFilter);
        return $result;
    }

    public function getSubjectAreas($strUrlWsdl = null, $booDebug = null)
    {
        $strSessionId = $this->getSessionId();
        if (empty($strSessionId))
            return self::MSG_PARAM_NOT_FOUND;
        $arrParam = array(
            'sessionID' => $strSessionId,
        );
        $result = $this->runService($arrParam, __FUNCTION__, $strUrlWsdl, $booDebug);
        if (isset($result->subjectArea))
            $this->setSubjectAreaInstance($result->subjectArea);
        return $result;
    }

    public function getSessionId($strName = null, $strPassword = null)
    {
        if ((!empty($strName)) && (!empty($strPassword)))
            $this->logonex($strName, $strPassword, $this->getSessionIdFromSession());
        return $this->getSessionIdFromSession();
    }

    public function hasSessionId($strName = null, $strPassword = null)
    {
        $strSessionId = $this->getSessionId($strName, $strPassword);
        return (!empty($strSessionId));
    }

    public static function getSessionInstance()
    {
        return parent::getSessionInstance(__CLASS__);
    }

    public function getSessionIdFromSession()
    {
        $session = self::getSessionInstance();
        return $session->offsetGet(self::SESSION_KEY_SESSION_ID);
    }

    public function getPromptedFilter()
    {
        return $this->strPromptedFilter;
    }

    public function getSubjectAreaInstance()
    {
        return $this->subjectAreaInstance;
    }

    public function getName()
    {
        return $this->strName;
    }

    public function getPassword()
    {
        return $this->strPassword;
    }

    public function runService($arrParam = null, $strMethod = null, $strUrlWsdl = null, $booDebug = null)
    {
        return parent::runService(__CLASS__, $strMethod, $strUrlWsdl, $booDebug, $arrParam);
    }

    private function setSessionId($strSessionId = null)
    {
        $this->strSessionId = $strSessionId;
        return $this;
    }

    private function setSessionIdIntoSession($strSessionId = null)
    {
        $this->setSessionId($strSessionId);
        return self::getSessionInstance()->offsetSet(self::SESSION_KEY_SESSION_ID, $strSessionId);
    }

    private function setPromptedFilter($strPromptedFilter = null)
    {
        $this->strPromptedFilter = $strPromptedFilter;
        return $this;
    }

    private function setSubjectAreaInstance($subjectAreaInstance = null)
    {
        $this->subjectAreaInstance = $subjectAreaInstance;
        return $this;
    }

    private function setName($strName = null)
    {
        $this->strName = $strName;
        return $this;
    }

    private function setPassword($strPassword = null)
    {
        $this->strPassword = $strPassword;
        return $this;
    }

}
