<?php

namespace InepZend\Authentication;

use Zend\Authentication\AuthenticationService;
use InepZend\Authentication\Session;
use InepZend\Util\AttributeStaticTrait;

class AuthService extends AuthenticationService
{

    use AttributeStaticTrait;

    public function __construct($arrConfig = null, $adapter = null, $booUnitTest = null, $booAdapterDefault = true, $serviceManager = null)
    {
        if ((!is_object($adapter)) && ($booAdapterDefault)) {
            if (!is_bool($booUnitTest))
                $booUnitTest = false;
            $strClass = 'InepZend\Authentication\Adapter\SsiRest';
            if ((!$booUnitTest) && (is_array($arrConfig)) && (array_key_exists('adapter', $arrConfig)) && (!empty($arrConfig['adapter'])))
                $strClass = $arrConfig['adapter'];
            $adapter = new $strClass($arrConfig, $booUnitTest, $serviceManager);
        }
        parent::__construct(new Session(), $adapter);
    }

    public function getUserSystem()
    {
        return $this->getIdentity()->usuarioSistema;
    }

    public function getSystem()
    {
        return $this->getUserSystem()->sistema;
    }

    public function getProfile()
    {
        return $this->getUserSystem()->perfis;
    }

    public function getUser()
    {
        return $this->getUserSystem()->usuario;
    }

    public static function getConsultInstance()
    {
        return self::getAttributeStaticInstance(__CLASS__ . '(null, null, null, false)');
    }

}
