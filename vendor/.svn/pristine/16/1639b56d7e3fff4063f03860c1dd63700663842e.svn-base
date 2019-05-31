<?php

namespace InepZend\Log;

use Psr\Log\AbstractLogger,
    Psr\Log\LogLevel,
    Psr\Log\InvalidArgumentException;
use Zend\Log\Logger,
    Zend\Log\Writer\Stream;
use InepZend\Authentication\AuthTrait;
use InepZend\Util\Server;
use InepZend\Util\FileSystem;
use Zend\Json\Encoder,
    Zend\Json\Decoder;
use Exception as ExceptionNative;

class Log extends AbstractLogger
{
    
    use AuthTrait;

    const CONTAINER_PATH = '/data/log/';
    const FATAL = 'fatal';
    const WARNING = 'warning';
    const NOTICE = 'notice';
    const EXCEPTION = 'exception';
    const UNKNOWN = 'unknown';
    const INFO = 'info';

    private static $booHandler = true;
    private static $arrLogger = array();
    private $arrPsrToZend = array(
        array(LogLevel::EMERGENCY, Logger::EMERG, 'emerg'), // O sistema eh inutilizavel
        array(LogLevel::ALERT, Logger::ALERT, 'alert'), // Eh necessaria uma acao imediata
        array(LogLevel::CRITICAL, Logger::CRIT, 'crit'), // Condicoes criticas
        array(LogLevel::ERROR, Logger::ERR, 'err'), // Erros que nao requerem atencao imediata, mas devem ser monitorizados
        array(LogLevel::WARNING, Logger::WARN, 'warn'), // Ocorrencias anormais ou indesejaveis que nao sao erros
        array(LogLevel::NOTICE, Logger::NOTICE, 'notice'), // Eventos normais, mas significativa
        array(LogLevel::INFO, Logger::INFO, 'info'), // Eventos interessantes
        array(LogLevel::DEBUG, Logger::DEBUG, 'debug'), // Informacoes detalhadas para fins de depuracao
    );
    private $arrLevelReporting = array(
        self::NOTICE => array(E_NOTICE, E_USER_NOTICE),
        self::WARNING => array(E_WARNING, E_USER_WARNING),
        self::FATAL => array(E_ERROR, E_USER_ERROR, E_RECOVERABLE_ERROR)
    );
    private $arrLevelNotLog = array(E_NOTICE, E_USER_NOTICE, E_STRICT);
    private $arrLogged = array();
    private static $arrEvalErrorHandler = array();
    private static $booContainerPath = false;
    private static $arrConvertLevel = array();
    private $strTraceLevel;
    private $strTracePath;

    public static function setHandler($booHandler)
    {
        self::$booHandler = (bool) $booHandler;
        return;
    }

    public static function getHandler()
    {
        return (bool) self::$booHandler;
    }

    public function getLoggerInstance($strLevel)
    {
        $logger = null;
        $strTraceLevel = $this->getTraceLevel();
        if (!empty($strTraceLevel))
            $strLevel = $strTraceLevel;
        if (array_key_exists($strLevel, self::$arrLogger))
            $logger = self::$arrLogger[$strLevel];
        else {
            $intMode = 0777;
            $strPath = $this->getPath();
            $strTracePath = $this->getTracePath();
            if (!empty($strTracePath)) {
                if (!is_dir($strTracePath))
                    mkdir($strTracePath, $intMode, true);
                $strPath = $strTracePath;
            }
            $strFilePath = $strPath . date('YmdH') . substr(date('i'), 0, 1) . '0-' . $strLevel . '.log';
            if ((is_file($strFilePath)) && (!FileSystem::isWritable($strFilePath)))
                chmod($strFilePath, $intMode);
            try {
                $logger = new Logger();
                if (strpos($strFilePath, './') === 0)
                    $strFilePath = Server::getReplacedBasePathApplication('/../../../../../' . substr($strFilePath, 2));
                $logger->addWriter(new Stream($strFilePath, 'a+'));
                self::$arrLogger[$strLevel] = $logger;
            } catch (ExceptionNative $exception) {
                
            }
        }
        return $logger;
    }

    public function log($strLevel, $mixMessage, array $arrContext = array())
    {
        if (empty($mixMessage))
            return false;
        $arrContext = $this->insertOtherInfo($arrContext);
        $logger = $this->getLoggerInstance($strLevel);
        if (!is_object($logger))
            return false;
        $strMethod = $this->getZendMethod($strLevel);
        return $logger->$strMethod(self::encodeContent($mixMessage), $arrContext);
    }

    private static function encodeContent($mixContent)
    {
        if (empty($mixContent))
            return false;
        return Encoder::encode($mixContent);
    }

    public static function decodeContent($strJson)
    {
        if (empty($strJson))
            return false;
        $strJson = str_replace(array('\\\\u', '\\\/'), array('\\u', '\/'), var_export($strJson, true));
        $strJson = substr($strJson, 1, strlen($strJson) - 2);
        return Decoder::decode(trim($strJson));
    }

    public static function printDecodeContent($strJson)
    {
        $mixResult = self::decodeContent($strJson);
        if (is_bool($mixResult))
            return $mixResult;
        $stdClassLog = self::decodeContent($strJson);
        if (!is_object($stdClassLog))
            return false;
        return '<table class="xdebug-error xe-fatal-error" cellspacing="0" cellpadding="1" border="1" dir="ltr"><tbody>' . str_replace('\n', "\n", $stdClassLog->xdebug_message) . '</tbody></table>';
    }

    private function insertOtherInfo(array $arrContext = array())
    {
        if ($this->hasIdentity()) {
            if (!is_array($arrContext))
                $arrContext = array();
            $userSystem = $this->getUserSystem();
            $arrContext['usersystem'] = $userSystem->id;
            if (!@empty($userSystem->usuario->cpf))
                $arrContext['cpf'] = $userSystem->usuario->cpf;
            if (!@empty($userSystem->usuario->nome))
                $arrContext['name'] = $userSystem->usuario->nome;
        }
        if (!array_key_exists('ip', $arrContext))
            $arrContext['ip'] = Server::getIp();
        if (!array_key_exists('ipserver', $arrContext))
            $arrContext['ipserver'] = Server::getIpServer();
        if (!array_key_exists('pid', $arrContext))
            $arrContext['pid'] = getmypid();
        if (!array_key_exists('timestamp', $arrContext))
            $arrContext['timestamp'] = time();
        return $arrContext;
    }

    public function registerHandler()
    {
        $this->registerErrorHandler();
        $this->registerExceptionHandler();
    }

    public function registerErrorHandler()
    {
        if (self::getHandler() === false)
            return false;
        $logger = $this->getLoggerInstance(LogLevel::ERROR);
        if (!is_object($logger))
            return false;
        $booResult = Logger::registerErrorHandler($logger);
        if ($booResult !== false) {
            set_error_handler(function ($intLevelReporting = null, $mixMessage = null, $strFile = null, $intLine = null, $mixContext = null) {
                $this->errorHandler($intLevelReporting, $mixMessage, $strFile, $intLine, $mixContext);
            });
            register_shutdown_function(function ($intLevelReporting = null, $mixMessage = null, $strFile = null, $intLine = null, $mixContext = null) {
                $this->errorHandler($intLevelReporting, $mixMessage, $strFile, $intLine, $mixContext);
            });
        }
        return $booResult;
    }

    public function errorHandler($intLevelReporting = null, $mixMessage = null, $strFile = null, $intLine = null, $mixContext = null)
    {
        if (self::getHandler() === false)
            return false;
        $booHandle = true;
        if (is_null($intLevelReporting)) {
            $booHandle = false;
            $arrLastError = error_get_last();
            if ((!is_null($arrLastError)) && (is_array($arrLastError)) && ($arrLastError['type'] == E_ERROR)) {
                $intLevelReporting = $arrLastError['type'];
                $mixMessage = $arrLastError['message'];
                $strFile = $arrLastError['file'];
                $intLine = $arrLastError['line'];
                $booHandle = true;
            }
        }
        if (($booHandle == false) || (in_array((integer) $intLevelReporting, (array) $this->arrLevelNotLog)))
            return false;
        $this->execEvalErrorHandler($this->getLevelReporting($intLevelReporting));
        if (!is_array($mixContext))
            $mixContext = array();
        $mixContext = array_merge($mixContext, array('type' => $intLevelReporting, 'typename' => $this->getLevelReporting($intLevelReporting), 'filename' => $strFile, 'line' => $intLine, 'timestamp' => time()));
        return ($this->loggedController($mixMessage, $mixContext) == false) ? false : $this->error($mixMessage, $mixContext);
    }

    public function getLevelReporting($intLevelReporting = null)
    {
        $strLevelReportingResult = self::UNKNOWN;
        foreach ((array) $this->arrLevelReporting as $strLevelReporting => $arrReportingLevel) {
            if (in_array($intLevelReporting, (array) $arrReportingLevel)) {
                $strLevelReportingResult = $strLevelReporting;
                break;
            }
        }
        return $strLevelReportingResult;
    }

    public function registerExceptionHandler()
    {
        if (self::getHandler() === false)
            return false;
        $logger = $this->getLoggerInstance(LogLevel::CRITICAL);
        if (!is_object($logger))
            return false;
        $booResult = Logger::registerExceptionHandler($logger);
        if ($booResult !== false) {
            set_exception_handler(function ($mixException) {
                $this->exceptionHandler($mixException);
            });
        }
        return $booResult;
    }

    public function exceptionHandler($mixException = null, $mixContext = null)
    {
        if (self::getHandler() === false)
            return false;
        $this->execEvalErrorHandler(self::EXCEPTION);
        if (!is_array($mixContext))
            $mixContext = array();
        $mixContext = array_merge($mixContext, array('typename' => self::EXCEPTION, 'timestamp' => time()));
        return ($this->loggedController($mixException, $mixContext) == false) ? false : $this->critical($mixException, $mixContext);
    }

    private function loggedController($mixMessage = null, $mixContext = null)
    {
        $strLog = Encoder::encode(array((string) $mixMessage, (array) $mixContext));
        if (in_array($strLog, (array) $this->arrLogged))
            return false;
        $this->arrLogged[] = $strLog;
        return true;
    }

    public function convertLevelZendToPsr($intLevel = null)
    {
        return $this->convertLevel($intLevel, 1, 0);
    }

    public function convertLevelPsrToZend($strLevel = null)
    {
        return $this->convertLevel($strLevel, 0, 1);
    }

    public function getZendMethod($strLevel = null)
    {
        return $this->convertLevel($strLevel, 0, 2);
    }

    private function convertLevel($mixInfo = null, $intKeyCompare = 0, $intKeyResult = 0)
    {
        $strKey = $mixInfo . '-' . $intKeyCompare . '-' . $intKeyResult;
        if (!array_key_exists($strKey, self::$arrConvertLevel)) {
            $mixResult = null;
            foreach ((array) $this->arrPsrToZend as $arrInfo) {
                if ((!array_key_exists($intKeyCompare, $arrInfo)) || (!array_key_exists($intKeyResult, $arrInfo)))
                    continue;
                if ($arrInfo[$intKeyCompare] == $mixInfo) {
                    $mixResult = $arrInfo[$intKeyResult];
                    break;
                }
            }
            if (empty($mixResult))
                throw new InvalidArgumentException('Nível desconhecido ou não encontrado');
            self::$arrConvertLevel[$strKey] = $mixResult;
        }
        return self::$arrConvertLevel[$strKey];
    }

    private function getPath()
    {
        $strContainerPath = Server::getBasePathApplication() . self::CONTAINER_PATH;
        if (self::$booContainerPath === false) {
            $intMode = 0777;
            if (!is_dir($strContainerPath))
                mkdir($strContainerPath, $intMode, true);
            elseif (!FileSystem::isWritable($strContainerPath))
                chmod($strContainerPath, $intMode);
            self::$booContainerPath = true;
        }
        return $strContainerPath;
    }

    public static function setEvalErrorHandler($strEvalErrorHandler, $arrLevelReportingToEval)
    {
        if (empty($strEvalErrorHandler))
            return false;
        if ((!empty($arrLevelReportingToEval)) && (!is_array($arrLevelReportingToEval)))
            $arrLevelReportingToEval = array($arrLevelReportingToEval);
        self::$arrEvalErrorHandler = array(
            $strEvalErrorHandler,
            $arrLevelReportingToEval
        );
        return true;
    }

    public static function getEvalErrorHandler()
    {
        return self::$arrEvalErrorHandler;
    }

    private function execEvalErrorHandler($strLevelReportingToEval)
    {
        $arrEvalErrorHandler = self::getEvalErrorHandler();
        if ((!array_key_exists(0, $arrEvalErrorHandler)) || (empty($arrEvalErrorHandler[0])))
            return false;
        if ((array_key_exists(1, $arrEvalErrorHandler)) && (!empty($arrEvalErrorHandler[1])) && (!empty($strLevelReportingToEval))) {
            if (!in_array($strLevelReportingToEval, $arrEvalErrorHandler[1]))
                return false;
        }
        eval($arrEvalErrorHandler[0]);
        return true;
    }

    public function setTraceLevel($strLevel = null)
    {
        $this->strTraceLevel = $strLevel;
        return $this;
    }

    private function getTraceLevel()
    {
        return $this->strTraceLevel;
    }

    public function setTracePath($strPath = null)
    {
        $this->strTracePath = $strPath;
        return $this;
    }

    private function getTracePath()
    {
        return $this->strTracePath;
    }

}
