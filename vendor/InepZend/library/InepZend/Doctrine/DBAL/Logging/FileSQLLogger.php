<?php

namespace InepZend\Doctrine\DBAL\Logging;

use Doctrine\DBAL\Logging\SQLLogger;
use InepZend\Log\LogPersistence;
use InepZend\Module\Log\Service\LogModule;

class FileSQLLogger implements SQLLogger
{

    use LogPersistence;

    private $intMicrotime;
    private $booShow = false;
    private $strRepository;

    private function getMicrotime()
    {
        return $this->intMicrotime;
    }

    private function setMicrotime($intMicrotime = null)
    {
        $this->intMicrotime = $intMicrotime;
        return $this;
    }

    public function getShow()
    {
        return $this->booShow;
    }

    public function setShow($booShow = false)
    {
        $this->booShow = (bool) $booShow;
        return $this;
    }

    public function getRepository()
    {
        return $this->strRepository;
    }

    public function setRepository($strRepository = null)
    {
        $this->strRepository = $strRepository;
        return $this;
    }

    public function startQuery($strSql, array $arrParam = null, array $arrType = null)
    {
        $this->setMicrotime(microtime(true));
        if ($this->getShow()) {
            echo $strSql . PHP_EOL;
            if (!empty($arrParam))
                var_dump($arrParam);
            if (!empty($arrType))
                var_dump($arrType);
        }
        $arrMessage = array();
        $arrMessage[] = $strSql;
        if (!empty($arrParam))
            $arrMessage[] = $arrParam;
        if (!empty($arrType))
            $arrMessage[] = $arrType;
        $this->persistenceMessage($arrMessage);
    }

    public function stopQuery()
    {
        $intMicrotimeExecution = microtime(true) - $this->getMicrotime();
        $this->setMicrotime();
        if ($this->getShow()) {
            if (!empty($intMicrotimeExecution))
                var_dump($intMicrotimeExecution);
        }
        $this->persistenceMessage(array($intMicrotimeExecution));
    }

    public static function editConfiguration($config = null)
    {
        if ((is_object($config)) && ((@$GLOBALS['doctrine_debug_sql'] === true) || (@$GLOBALS[LogModule::KEY_ROOT][LogModule::KEY_OPTION][LogModule::KEY_OPTION_PERSISTENCE] === true))) {
            $fileSQLLogger = new FileSQLLogger();
            $fileSQLLogger->setShow((array_key_exists('doctrine_debug_sql', $GLOBALS)) && ($GLOBALS['doctrine_debug_sql'] === true));
            $fileSQLLogger->setRepository(__CLASS__);
            $config->setSQLLogger($fileSQLLogger);
        }
        return $config;
    }

}
