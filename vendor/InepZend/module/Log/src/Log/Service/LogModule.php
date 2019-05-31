<?php

namespace InepZend\Module\Log\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Paginator\Paginator;
use InepZend\Module\Log\Service\LogInfo as LogInfoService;
use InepZend\Module\Log\Service\LogError as LogErrorService;
use InepZend\Module\Log\Service\LogCritical as LogCriticalService;
use InepZend\Module\Log\Adapter\Container\ContainerFactory;
use InepZend\Module\Log\Form\Log;
use InepZend\Util\PhpIni;
use InepZend\Util\FileSystem;
use InepZend\Util\Date;
use InepZend\Util\String;
use InepZend\Util\DebugExec;
use InepZend\Util\Format;
use InepZend\Util\Server;
use \DateTime;

/**
 * Classe responsavel pelo tratamento de arquivos de log.
 *
 * @package Log
 */
class LogModule extends AbstractServiceManager
{

    use DebugExec;

    const DEBUG = false;
    const QTD_CARACTER_DATA_LOG = 25;
    const CO_LEVEL_ERROR = 'error';
    const CO_LEVEL_CRITICAL = 'critical';
    const CO_LEVEL_INFO = 'info';
    const ANONYMOUS_USER = 'Anonymous';
    const CO_ANONYMOUS_USER = 0;
    const PATH_LOG = 'data/log/';
    const TYPE_FILE = 'log';
    const TYPE_KEY_DATA = 'data';
    const DEFAULT_ADAPTER = ContainerFactory::FILE_ADAPTER;
    const KEY_ROOT = 'logEvent';
    const KEY_RESERVED_VARIABLE = 'reservedVariables';
    const KEY_RESERVED_VARIABLE_HTTP_RAW_POST_DATA = 'HTTP_RAW_POST_DATA';
    const KEY_RESERVED_VARIABLE_COOKIE = '_COOKIE';
    const KEY_RESERVED_VARIABLE_ENV = '_ENV';
    const KEY_RESERVED_VARIABLE_FILES = '_FILES';
    const KEY_RESERVED_VARIABLE_GET = '_GET';
    const KEY_RESERVED_VARIABLE_POST = '_POST';
    const KEY_RESERVED_VARIABLE_REQUEST = '_REQUEST';
    const KEY_RESERVED_VARIABLE_SERVER = '_SERVER';
    const KEY_RESERVED_VARIABLE_SERVER_REQUEST_URI = "_SERVER['REQUEST_URI']";
    const KEY_RESERVED_VARIABLE_SESSION = '_SESSION';
    const KEY_RESERVED_VARIABLE_ARGC = 'argc';
    const KEY_RESERVED_VARIABLE_ARGV = 'argv';
    const KEY_RESERVED_VARIABLE_HTTP_RESPONSE_HEADER = 'http_response_header';
    const KEY_RESERVED_VARIABLE_PHP_ERRORMSG = 'php_errormsg';
    const KEY_OPTION = 'options';
    const KEY_OPTION_TRACE = 'trace';
    const KEY_OPTION_PERSISTENCE = 'persistence';
    const KEY_OPTION_SHOW = 'show';
    const KEY_OPTION_ERROR_HANDLER = 'errorHandler';
    const KEY_NAMESPACE = 'namespaces';
    const KEY_NAMESPACE_CONTROLLER = 'Controller';
    const KEY_NAMESPACE_SERVICE = 'Service';
    const KEY_NAMESPACE_REPOSITORY = 'Repository';
    const KEY_USER_SYSTEM = 'usersSystem';
    const KEY_CPF = 'cpfs';

    protected $arrTypeLogIgnorado = array(
        'this', 'arrDataLog', 'arrInfoLog', 'arrLog', 'strInformacaoLog', 'xdebug_message',
        'submit_x', 'submit_y', 'arrDadosLog'
    );

    /**
     * Construct
     */
    public function __construct()
    {
        PhpIni::setTimeLimit(0);
        PhpIni::allocatesMemory(-1);
    }

    /**
     * Metodo responsavel pela informacao do arquivo.
     *
     * @param string $strPath
     * @return array
     */
    public function getInformationFile($strPath)
    {
        if (!String::isUTF8($strPath))
            $strPath = utf8_encode($strPath);
        $strNameFile = end($arrExplode = explode('/', $strPath));
        $arrNameFile = explode('-', $strNameFile);
        return array(
            'noFile' => $strNameFile,
            'dtCreate' => Date::convertDate($arrNameFile[0], 'Y-m-d'),
            'tpLevel' => reset($arrExplode = explode('.', $arrNameFile[1]))
        );
    }

    /**
     * Metodo responsavel para salvar as informacoes do log.
     *
     * @param array $arrInformationLog
     */
    public function setInformationLogSession($arrInformationLog, $strIndentityContainer)
    {
        ContainerFactory::getInstance(self::DEFAULT_ADAPTER)->write($arrInformationLog, $strIndentityContainer);
    }

    /**
     * Metodo responsavel para recupear as informacoes do log.
     *
     * @return array
     */
    public function getInformationLog($strIndentityContainer)
    {
        return ContainerFactory::getInstance(self::DEFAULT_ADAPTER)->read($strIndentityContainer);
    }

    /**
     * Metodo responsavel para remover os dados do log.
     *
     * @param string $strIndentityContainer
     */
    public function clearInformationLog($strIndentityContainer = null)
    {
        ContainerFactory::getInstance(self::DEFAULT_ADAPTER)->delete($strIndentityContainer);
    }

    /**
     * Metodo responsavel pela lista dos niveis aplicados na geracao dos arquivos
     * de log.
     *
     * @return array
     */
    public static function getTpLevel()
    {
        return array(
            self::CO_LEVEL_CRITICAL => self::CO_LEVEL_CRITICAL,
            self::CO_LEVEL_ERROR => self::CO_LEVEL_ERROR,
            self::CO_LEVEL_INFO => self::CO_LEVEL_INFO,
        );
    }

    /**
     * Metodo responsavel pela lista das variaveis reservadas do PHP que poderao
     * auditadas.
     *
     * @return array
     */
    public static function getReservedVariable()
    {
        return array(
            self::KEY_RESERVED_VARIABLE_HTTP_RAW_POST_DATA => self::KEY_RESERVED_VARIABLE_HTTP_RAW_POST_DATA,
            self::KEY_RESERVED_VARIABLE_COOKIE => self::KEY_RESERVED_VARIABLE_COOKIE,
            self::KEY_RESERVED_VARIABLE_ENV => self::KEY_RESERVED_VARIABLE_ENV,
            self::KEY_RESERVED_VARIABLE_FILES => self::KEY_RESERVED_VARIABLE_FILES,
            self::KEY_RESERVED_VARIABLE_GET => self::KEY_RESERVED_VARIABLE_GET,
            self::KEY_RESERVED_VARIABLE_POST => self::KEY_RESERVED_VARIABLE_POST,
            self::KEY_RESERVED_VARIABLE_REQUEST => self::KEY_RESERVED_VARIABLE_REQUEST,
            self::KEY_RESERVED_VARIABLE_SERVER => self::KEY_RESERVED_VARIABLE_SERVER,
            self::KEY_RESERVED_VARIABLE_SERVER_REQUEST_URI => self::KEY_RESERVED_VARIABLE_SERVER_REQUEST_URI,
            self::KEY_RESERVED_VARIABLE_SESSION => self::KEY_RESERVED_VARIABLE_SESSION,
            self::KEY_RESERVED_VARIABLE_ARGC => self::KEY_RESERVED_VARIABLE_ARGC,
            self::KEY_RESERVED_VARIABLE_ARGV => self::KEY_RESERVED_VARIABLE_ARGV,
            self::KEY_RESERVED_VARIABLE_HTTP_RESPONSE_HEADER => self::KEY_RESERVED_VARIABLE_HTTP_RESPONSE_HEADER,
            self::KEY_RESERVED_VARIABLE_PHP_ERRORMSG => self::KEY_RESERVED_VARIABLE_PHP_ERRORMSG,
        );
    }

    /**
     * Metodo responsavel pela lista das opcoes de auditoria.
     *
     * @return array
     */
    public static function getOptionAudit()
    {
        return array(
            self::KEY_OPTION_TRACE => 'Rotas/passos de execução',
            self::KEY_OPTION_PERSISTENCE => 'Operações com o banco de dados',
            self::KEY_OPTION_ERROR_HANDLER => 'Erros de PHP',
            self::KEY_OPTION_SHOW => 'Impressão em tela',
        );
    }

    /**
     * Metodo responsavel pela lista dos namespaces para auditoria.
     *
     * @return array
     */
    public static function getNamespaceType()
    {
        return array(
            self::KEY_NAMESPACE_CONTROLLER => self::KEY_NAMESPACE_CONTROLLER,
            self::KEY_NAMESPACE_SERVICE => self::KEY_NAMESPACE_SERVICE,
            self::KEY_NAMESPACE_REPOSITORY => self::KEY_NAMESPACE_REPOSITORY,
        );
    }

    /**
     * Metodo responsavel pela pesquisa dos arquivos.
     *
     * @param array $arrCriteria
     * @param string $strSortName
     * @param string $strSortOrder
     * @param intger $intPage
     * @param intger $intItemPerPage
     * @param mix $mixDQL
     * @return \InepZend\Paginator\Paginator
     */
    protected function findByPaged(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = Paginator::ITENS_PER_PAGE_DEFAULT, $mixDQL = null)
    {
        $arrLog = array();
        $strPathLog = self::PATH_LOG;
        $arrFile = FileSystem::globRecursive(Server::getReplacedBasePathApplication('/../../../../../../../' . $strPathLog), self::TYPE_FILE);
        foreach ($arrFile as $strFile) {
            if (!String::isUTF8($strFile))
                $strFile = utf8_encode($strFile);
            $arrInfFile = $this->getInformationFile($strFile);
            $strNoFile = $arrInfFile['noFile'];
            $strDtCreate = $arrInfFile['dtCreate'];
            $strDtCreateBase = $arrInfFile['dtCreate'];
            $strTypeLevel = $arrInfFile['tpLevel'];
            if ((is_array($arrCriteria)) && (count($arrCriteria) > 0)) {
                $strDtCreateStart = (array_key_exists('dt_create_inicio', $arrCriteria)) ? $arrCriteria['dt_create_inicio'] : null;
                $strDtCreateEnd = (array_key_exists('dt_create_fim', $arrCriteria)) ? $arrCriteria['dt_create_fim'] : null;
                $strTypeLevelFilter = (array_key_exists('tp_level', $arrCriteria)) ? $arrCriteria['tp_level'] : null;
                if ((is_array($strTypeLevelFilter)) && (array_key_exists(0, $strTypeLevelFilter)))
                    $strTypeLevelFilter = reset($strTypeLevelFilter);
                if ((!empty($strDtCreateStart)) && ($strDtCreateBase < $strDtCreateStart))
                    continue;
                if ((!empty($strDtCreateEnd)) && ($strDtCreateBase > $strDtCreateEnd))
                    continue;
                if ((!empty($strTypeLevelFilter)) && (strtolower($strTypeLevel) != strtolower($strTypeLevelFilter)))
                    continue;
            }
            $arrLog[$strNoFile] = array('NO_FILE' => $strNoFile, 'DS_PATH' => $strPathLog . end($arrExplode = explode($strPathLog, $strFile)), 'DS_SIZE' => FileSystem::filesizeFormated($strFile), 'DT_CREATE' => Date::convertDate($strDtCreate, 'd/m/Y'), 'TP_LEVEL' => $strTypeLevel);
        }
        unset($arrFile);
        if (empty($strSortOrder))
            $strSortOrder = 'desc';
        if (strtolower($strSortOrder) == 'asc')
            ksort($arrLog);
        else
            krsort($arrLog);
        $arrLog = array_values($arrLog);
        return new Paginator($arrLog, $intPage, $intItemPerPage);
    }

    /**
     * Metodo responsavel pelas informacoes.
     *
     * @param string $strPath
     */
    protected function getApplicationLogInformation($strPath)
    {
        $this->debugExec($strPath);
        $arrLineFile = file($strPath, FILE_SKIP_EMPTY_LINES);
        $arrInfoFile = $this->getInformationFile($strPath);
        $strTypeLevel = $arrInfoFile['tpLevel'];
        unset($arrInfoFile);
        $arrInformationLog = array();
        foreach ($arrLineFile as $intLine => $strValueLine) {
            $strDateTime = substr($strValueLine, 0, self::QTD_CARACTER_DATA_LOG);
            if (!strtotime($strDateTime))
                continue;
            $intTimestamp = (new DateTime($strDateTime))->getTimestamp();
            $strValueLine = substr($strValueLine, self::QTD_CARACTER_DATA_LOG);
            $strLineMessageLog = substr($strValueLine, strpos($strValueLine, ': ') + strlen(': '));
            unset($arrLineFile[$intLine]);
            switch ($strTypeLevel) {
                case self::CO_LEVEL_CRITICAL:
                    $arrInformationLogFile = LogCriticalService::getInformationLog($strLineMessageLog);
                    break;
                case self::CO_LEVEL_ERROR:
                    $arrInformationLogFile = LogErrorService::getInformationLog($strLineMessageLog);
                    break;
                case self::CO_LEVEL_INFO:
                    $arrInformationLogFile = LogInfoService::getInformationLog($strLineMessageLog);
                    break;
            }
            $arrInformationLogFile = $this->formatStructureLog($arrInformationLogFile);
            $arrDataUser = $this->formatDataLog($arrInformationLogFile[self::TYPE_KEY_DATA]);
            $arrInformationLogFile[self::TYPE_FILE]['level'] = $strTypeLevel;
            $arrDataLog = $this->formatDataLog($arrInformationLogFile[self::TYPE_FILE]);
            unset($arrInformationLogFile);
            unset($arrDataLog['name']);
            $arrInformationLog[$arrDataUser['usersystem']][self::TYPE_KEY_DATA] = $arrDataUser;
            $arrInformationLog[$arrDataUser['usersystem']][self::TYPE_FILE][$intTimestamp][$intLine] = $arrDataLog;
            unset($arrDataLog);
            unset($arrDataUser);
        }
        return $arrInformationLog;
    }

    /**
     * Metodo responsavel pela montagem de estrutura do array contem informacoes do log.
     *
     * @param array $arrInformationLogFile
     * @return array
     */
    protected function formatStructureLog($arrInformationLogFile)
    {
        $arrKey = array('ip', 'ipserver', 'pid', 'timestamp');
        foreach ($arrKey as $strKey) {
            if (array_key_exists($strKey, $arrInformationLogFile[self::TYPE_KEY_DATA]))
                $arrInformationLogFile[self::TYPE_FILE][$strKey] = $arrInformationLogFile[self::TYPE_KEY_DATA][$strKey];
        }
        return $arrInformationLogFile;
    }

    /**
     * Metodo responsavel pela formatacao dos dados.
     *
     * @param array $arrDataLog
     * @return array
     */
    protected function formatDataLog($arrDataLog)
    {
        if (array_key_exists('timestamp', $arrDataLog))
            $arrDataLog['timestamp'] = date('d/m/Y H:i:s', $arrDataLog['timestamp']);
        if (!array_key_exists('usersystem', $arrDataLog))
            $arrDataLog['usersystem'] = self::CO_ANONYMOUS_USER;
        if (array_key_exists('name', $arrDataLog))
            $arrDataLog['name'] = String::beautifulProperName($arrDataLog['name']);
        if (array_key_exists('cpf', $arrDataLog))
            $arrDataLog['cpf'] = Format::formatCpfCnpj($arrDataLog['cpf']);
        if (array_key_exists('senha', $arrDataLog))
            $arrDataLog['senha'] = str_repeat('*', strlen($arrDataLog['senha']));
        if (array_key_exists('password', $arrDataLog))
            $arrDataLog['password'] = str_repeat('*', strlen($arrDataLog['password']));
        if (array_key_exists('filename', $arrDataLog) || array_key_exists('file', $arrDataLog)) {
            $strKeyLog = (array_key_exists('filename', $arrDataLog)) ? 'filename' : 'file';
            $arrPath = preg_split('/((module|vendor|Module|Vendor){1})/', $arrDataLog[$strKeyLog]);
            $strPathFile = str_replace($arrPath[0], '', $arrDataLog[$strKeyLog]);
            $arrDataLog[$strKeyLog] = $strPathFile;
        }
        foreach ($this->arrTypeLogIgnorado as $strTypeLogUnknown) {
            if (array_key_exists($strTypeLogUnknown, $arrDataLog))
                unset($arrDataLog[$strTypeLogUnknown]);
        }
        return $arrDataLog;
    }

    /**
     * Metodo responsavel pelo merge dos arquivo aos niveis de info, critical e error.
     *
     * @param string $strDateFile
     * @return array
     */
    protected function mergeTypeLvelFileLog($strDateFile)
    {
        $arrLogType = array();
        $arrFilePrepend = FileSystem::scandirRecursive(Server::getReplacedBasePathApplication('/../../../../../../../' . self::PATH_LOG), 'log');
        foreach ($arrFilePrepend as $strFile) {
            if (stripos($strFile, self::PATH_LOG . $strDateFile) === false)
                continue;
            $arrLogType = $this->mergerFile($this->getApplicationLogInformation($strFile), $arrLogType);
        }
        return $arrLogType;
    }

    /**
     * Metodo responsavel pelo merge entre arquivos.
     *
     * @param array $arrFileLogFirst
     * @param array $arrFileLogSecond
     * @return array
     */
    protected function mergerFile($arrFileLogFirst, $arrFileLogSecond)
    {
        foreach ($arrFileLogFirst as $intKeyUsuer => $arrInfoLogFist) {
            if (!array_key_exists($intKeyUsuer, $arrFileLogSecond)) {
                $arrFileLogSecond[$intKeyUsuer] = $arrInfoLogFist;
                break;
            }
            foreach ($arrInfoLogFist[self::TYPE_FILE] as $intTimestamp => $arrLog) {
                $arrInfoLog = $arrFileLogSecond[$intKeyUsuer][self::TYPE_FILE];
                $arrLog = array_key_exists($intTimestamp, $arrInfoLog) ? array_merge($arrInfoLog[$intTimestamp], $arrLog) : $arrLog;
                $arrFileLogSecond[$intKeyUsuer][self::TYPE_FILE][$intTimestamp] = $arrLog;
                unset($arrLog);
            }
        }
        unset($arrFileLogFirst);
        return $arrFileLogSecond;
    }

    protected function saveConfig($arrData = null)
    {
        return $this->getService('InepZend\Module\Application\Service\AutoloadConfig')->mergeAutoloadConfig($this->convertDataToConfig($arrData));
    }

    protected function convertDataToConfig($arrData = null)
    {
        $arrConfig = array();
        if (is_array($arrData)) {
            if (array_key_exists(Log::KEY_RESERVED_VARIABLE, $arrData))
                $arrConfig[self::KEY_RESERVED_VARIABLE] = $arrData[Log::KEY_RESERVED_VARIABLE];
            foreach (self::getOptionAudit() as $strValue => $strLabel) {
                if (array_key_exists(Log::KEY_OPTION . '[' . $strValue . ']', $arrData)) {
                    if (!array_key_exists(self::KEY_OPTION, $arrConfig))
                        $arrConfig[self::KEY_OPTION] = array();
                    $arrConfig[self::KEY_OPTION][$strValue] = ($arrData[Log::KEY_OPTION . '[' . $strValue . ']'] == 1);
                }
            }
            foreach (self::getNamespaceType() as $strNamespaceType) {
                if (array_key_exists(Log::KEY_NAMESPACE . '[' . $strNamespaceType . ']', $arrData)) {
                    if (!array_key_exists(self::KEY_NAMESPACE, $arrConfig))
                        $arrConfig[self::KEY_NAMESPACE] = array();
                    $arrConfig[self::KEY_NAMESPACE][$strNamespaceType] = $this->convertDataValueToArray($arrData[Log::KEY_NAMESPACE . '[' . $strNamespaceType . ']']);
                }
            }
            if (array_key_exists(Log::KEY_CPF, $arrData))
                $arrConfig[self::KEY_CPF] = $this->convertDataValueToArray($arrData[Log::KEY_CPF]);
            if (array_key_exists(Log::KEY_USER_SYSTEM, $arrData))
                $arrConfig[self::KEY_USER_SYSTEM] = $this->convertDataValueToArray($arrData[Log::KEY_USER_SYSTEM]);
        }
        return array(self::KEY_ROOT => $arrConfig);
    }

    protected function convertConfigToData($arrConfig = null)
    {
        $arrData = array();
        if ((is_array($arrConfig)) && (array_key_exists(self::KEY_ROOT, $arrConfig))) {
            foreach ($arrConfig[self::KEY_ROOT] as $strKey => $mixValueKey) {
                switch ($strKey) {
                    case self::KEY_RESERVED_VARIABLE:
                        $arrData[$this->getKeyForm($strKey)] = $mixValueKey;
                        break;
                    case self::KEY_OPTION:
                    case self::KEY_NAMESPACE:
                        foreach ($mixValueKey as $strKeyIntern => $mixValueKeyIntern)
                            $arrData[$this->getKeyForm($strKey) . '[' . $strKeyIntern . ']'] = (is_array($mixValueKeyIntern)) ? implode('; ', $mixValueKeyIntern) : (($mixValueKeyIntern === false) ? '0' : (string) $mixValueKeyIntern);
                        break;
                    case self::KEY_CPF:
                    case self::KEY_USER_SYSTEM:
                        $arrData[$this->getKeyForm($strKey)] = implode('; ', (array) $mixValueKey);
                        break;
                }
            }
        }
        return $arrData;
    }

    private function getKeyForm($strKey = null)
    {
        $strKeyForm = null;
        switch ($strKey) {
            case self::KEY_RESERVED_VARIABLE:
                $strKeyForm = Log::KEY_RESERVED_VARIABLE;
                break;
            case self::KEY_OPTION:
                $strKeyForm = Log::KEY_OPTION;
                break;
            case self::KEY_NAMESPACE:
                $strKeyForm = Log::KEY_NAMESPACE;
                break;
            case self::KEY_CPF:
                $strKeyForm = Log::KEY_CPF;
                break;
            case self::KEY_USER_SYSTEM:
                $strKeyForm = Log::KEY_USER_SYSTEM;
                break;
        }
        return $strKeyForm;
    }

    private function convertDataValueToArray($mixValue = null)
    {
        return (empty($mixValue)) ? array() : explode(';', str_replace(array("\n", ',', ' ', ';;'), ';', $mixValue));
    }

}
