<?php

namespace InepZend\Module\Log\Service;

use InepZend\Module\Log\Service\LogError as LogErrorService;
use InepZend\Service\AbstractServiceManager;
use InepZend\Module\Log\Service\LogModule as LogModuleService;
use InepZend\Util\String;
use InepZend\Module\Log\Service\LogInterface;

/**
 * Classe responsavel pelo tratamento de arquivos de log do nivel info.
 *
 * @package Log
 */
class LogInfo extends AbstractServiceManager implements LogInterface
{

    const CO_TYPE_LOG_EVENT = 'evento';
    const CO_TYPE_LOG_SGDB = 'banco';

    public static $arrMethodEvent = array(
        'GLOBALS',
        'HTTP_RAW_POST_DATA',
        '_COOKIE',
        '_ENV',
        '_FILES',
        '_GET',
        '_POST',
        '_REQUEST',
        '_SERVER',
        '_SERVER["REQUEST_URI"]',
        '_SESSION',
        'argc',
        'argv',
        'http_response_header',
        'php_errormsg',
    );
    public static $arrTransaction = array(
        '"COMMIT"',
        '"ROLLBACK"',
        '"START TRANSACTION"',
        '"BEGIN TRANSACTION"',
    );

    /**
     * Metodo responsavel pelas informacoes do log.
     *
     * @param string $strLineMessageLog
     * @return array
     */
    public static function getInformationLog($strLineMessageLog)
    {
        $strTypeLog = self::hasTypeLog($strLineMessageLog);
        return ($strTypeLog == self::CO_TYPE_LOG_EVENT) ?
                self::treatLogEvent($strLineMessageLog) :
                self::treatLogSGDB($strLineMessageLog);
    }

    /**
     * Metodo responsavel pelo tratamento da informacoes de log refernete ao banco de dados.
     *
     * @param string $strLineMessageLog
     * @return array
     */
    public static function treatLogSGDB($strLineMessageLog)
    {
        $arrLineMessageLog = explode('] {', $strLineMessageLog);
        $arrInformationSGDB = array(
            LogModuleService::TYPE_KEY_DATA => LogErrorService::formatStructureLogUser('{' . $arrLineMessageLog[1])
        );
        $mixLineSGDB = json_decode($arrLineMessageLog[0] . ']');
        if (is_float($mixLineSGDB[0]))
            $arrInformationSGDB[LogModuleService::TYPE_FILE]['tempo de execucao'] = $mixLineSGDB[0];
        else {
            if (in_array($mixLineSGDB[0], self::$arrTransaction) === true)
                $arrInformationSGDB[LogModuleService::TYPE_FILE]['transação'] = $mixLineSGDB[0];
            else
                $arrInformationSGDB[LogModuleService::TYPE_FILE]['sql'] = $mixLineSGDB[0];
        }
        if (count($mixLineSGDB) > 1) {
            foreach ($mixLineSGDB[1] as $intKey => $mixValueParameter)
                $arrInformationSGDB[LogModuleService::TYPE_FILE]['argumento_' . ($intKey + 1)] = $mixValueParameter;
        }
        return $arrInformationSGDB;
    }

    /**
     * Metodo responsavel pelo tratamento da informacoes de log referente aos evento da aplicacao.
     *
     * @param string $strLineMessageLog
     * @return array
     */
    public static function treatLogEvent($strLineMessageLog)
    {
        $arrLineMessageLog = explode('} {', $strLineMessageLog);
        if (array_key_exists(1, $arrLineMessageLog))
            $arrInformationEvent = array(
                LogModuleService::TYPE_KEY_DATA => LogErrorService::formatStructureLogUser('{' . $arrLineMessageLog[1])
            );
        else
            $arrInformationEvent = array(
                LogModuleService::TYPE_KEY_DATA => array(
                    'name' => LogModuleService::ANONYMOUS_USER,
                    'usersystem' => LogModuleService::CO_ANONYMOUS_USER
                )
            );
        $mixLineLogEvent = json_decode($arrLineMessageLog[0]);
        if (String::isNullEmpty($mixLineLogEvent))
            $mixLineLogEvent = json_decode($arrLineMessageLog[0] . '}');
        $arrInformationEvent[LogModuleService::TYPE_FILE] = self::getDetailLogEvent($mixLineLogEvent);
        return $arrInformationEvent;
    }

    /**
     * Metodo responsavel pelo detalhes do log de evento.
     *
     * @param mix $mixLineLogEvent
     * @return array
     */
    public static function getDetailLogEvent($mixLineLogEvent)
    {
        $arrDetail = array();
        foreach ((array) $mixLineLogEvent as $mixParameter => $mixLogEvent) {
            if (in_array($mixParameter, self::$arrMethodEvent) && $mixParameter != '')
                $arrDetail['variável reservada'] = $mixParameter;
            if ($mixLogEvent instanceof \stdClass || is_array($mixLogEvent)) {
                $arrInformationLog = self::getDetailLogEvent($mixLogEvent);
                $arrDetail = array_merge($arrDetail, $arrInformationLog);
                unset($arrInformationLog);
            } elseif ($mixLogEvent) {
                if (is_numeric($mixParameter))
                    $mixParameter = 'argument_' . $mixParameter;
                $arrDetail[$mixParameter] = $mixLogEvent;
            }
        }
        unset($mixLogEvent);
        unset($mixLineLogEvent);
        return $arrDetail;
    }

    /**
     * Metodo responsavel para verificar qual o tipo de log referente ao arquivo de info.
     *
     * @param string $strLineMessageLog
     * @return string
     */
    public static function hasTypeLog($strLineMessageLog)
    {
        $arrLineMessageLog = explode('] {', $strLineMessageLog);
        return (count($arrLineMessageLog) > 1) ? self::CO_TYPE_LOG_SGDB : self::CO_TYPE_LOG_EVENT;
    }

}
