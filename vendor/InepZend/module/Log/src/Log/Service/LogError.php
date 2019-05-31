<?php

namespace InepZend\Module\Log\Service;

use InepZend\Module\Log\Service\LogModule as LogModuleService;
use InepZend\Service\AbstractServiceManager;
use InepZend\Module\Log\Service\LogInterface;
use InepZend\Util\String;

/**
 * Classe responsavel pelo tratamento de arquivos de log do nivel error.
 *
 * @package Log
 */
class LogError extends AbstractServiceManager implements LogInterface
{

    public static $arrKeyDataUser = array(
        'usersystem',
        'cpf',
        'name',
        'ip',
        'ipserver',
        'pid',
        'timestamp',
    );

    /**
     * Metodo responsavel pelas informacoes do log.
     *
     * @param string $strLineMessageLog
     * @return array
     */
    public static function getInformationLog($strLineMessageLog)
    {
        $arrLineMessageLog = explode(' {"', $strLineMessageLog);
        $arrErrorLog = array(
            LogModuleService::TYPE_FILE => array(
                'context' => $arrLineMessageLog[0]
            )
        );
        if ($arrLineMessageLog[1]) {
            $strParameterDetailLog = '{"' . $arrLineMessageLog[1];
            $arrErrorLog[LogModuleService::TYPE_KEY_DATA] = self::formatStructureLogUser($strParameterDetailLog);
            $arrErrorLog[LogModuleService::TYPE_FILE] = array_merge(
                    self::formatStructLogInfoError($strParameterDetailLog), $arrErrorLog[LogModuleService::TYPE_FILE]
            );
        }
        return $arrErrorLog;
    }

    /**
     * Metodo responsavel pela montagem da estrutura do array que contem informacoes
     * sobre o log.
     *
     * @param string $strParameterDetailLog
     * @return array
     */
    public static function formatStructLogInfoError($strParameterDetailLog)
    {
        $arrLineUserParameter = (array) json_decode($strParameterDetailLog);
        $arrInformationLogErro = array();
        foreach ($arrLineUserParameter as $strKeyParameter => $strValueParameter)
            if (!array_key_exists($strKeyParameter, self::$arrKeyDataUser))
                $arrInformationLogErro[$strKeyParameter] = $strValueParameter;
        unset($arrLineUserParameter);
        return $arrInformationLogErro;
    }

    /**
     * Meotodo responsavel pela montagem da estrutura de informacoes do usuario no array
     * de informacoes sobre o log.
     *
     * @param string $strParameterDetailLog
     * @return array
     */
    public static function formatStructureLogUser($strParameterDetailLog)
    {
        $lineUserParameter = json_decode($strParameterDetailLog);
        if (is_object($lineUserParameter) && !isset($lineUserParameter->usersystem)) {
            $lineUserParameter->usersystem = LogModuleService::CO_ANONYMOUS_USER;
            $lineUserParameter->name = LogModuleService::ANONYMOUS_USER;
            if (String::isUTF8($lineUserParameter->name))
                $lineUserParameter->name = utf8_decode($lineUserParameter->name);
        }
        $arrInformationUsuerLog = array();
        foreach (self::$arrKeyDataUser as $strKeyUsuario)
            if (isset($lineUserParameter->$strKeyUsuario))
                $arrInformationUsuerLog[$strKeyUsuario] = $lineUserParameter->$strKeyUsuario;
        return $arrInformationUsuerLog;
    }

}
