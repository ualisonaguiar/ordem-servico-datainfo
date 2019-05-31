<?php

namespace InepZend\Entity\Proxy;

use InepZend\Service\ServiceManagerTrait;
use InepZend\Service\AbstractServiceManager;
use InepZend\Service\AbstractServiceFile;

abstract class AbstractEntityProxy
{

    use ServiceManagerTrait;

    private $strClass;
    private $arrData;
    private $mixResult;

    public function __construct($strClass = null, $arrData = null, $mixResult = null)
    {
        $this->setClass($strClass);
        $this->setData($arrData);
        $this->setResult($mixResult);
    }

    public function setClass($strClass = null)
    {
        $this->strClass = $strClass;
        return $this;
    }

    protected function getClass()
    {
        return $this->strClass;
    }

    public function setData($arrData = null)
    {
        $this->arrData = $arrData;
        return $this;
    }

    protected function getData()
    {
        return $this->arrData;
    }

    public function setResult($mixResult = null)
    {
        $this->mixResult = $mixResult;
        return $this;
    }

    protected function getResult()
    {
        return $this->mixResult;
    }

    protected function getServiceFromClass()
    {
        $strClass = $this->getClass();
        if (!self::hasServiceManager()) {
            if (AbstractServiceManager::hasServiceManager())
                self::setServiceManager(AbstractServiceManager::getServiceManager());
        }
        if (self::hasServiceManager()) {
            $strService = str_replace('\Entity\\', '\Service\\', $strClass);
            $strServiceFile = $strService . AbstractServiceFile::SUFIX_CLASS_SERVICE_FILE;
            if (class_exists($strServiceFile))
                $strService = $strServiceFile;
            $service = $this->getService($strService);
            if (is_object($service))
                return $service;
        }
        return false;
    }

}
