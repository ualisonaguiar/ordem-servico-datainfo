<?php

namespace InepZend\Module\Log\Service;

use InepZend\Service\AbstractServiceManager;
use InepZend\Log\Log;
use InepZend\Module\Log\Service\LogError as LogErrorService;
use InepZend\Module\Log\Service\LogInterface;
use InepZend\Module\Log\Service\LogModule as LogModuleService;

/**
 * Classe responsavel pelo tratamento de arquivos de log do nivel critical.
 *
 * @package Log
 */
class LogCritical extends AbstractServiceManager implements LogInterface
{

    /**
     * Metodo responsavel pelas informacoes do log.
     *
     * @param string $strLineMessageLog
     * @return array
     */
    public static function getInformationLog($strLineMessageLog)
    {
        $arrLineMessageLog = explode('} {', $strLineMessageLog);
        $strMessageCritical = $arrLineMessageLog[0] . '}';
        $strParameterUser = '{' . $arrLineMessageLog[1];
        $mixMessageCritical = json_decode($strMessageCritical);
        $arrLogInformation = array();
        $arrLogInformation[LogModuleService::TYPE_KEY_DATA] = LogErrorService::formatStructureLogUser($strParameterUser);
        foreach ($mixMessageCritical as $strInfo => $strValue) {
            if ($strInfo == 'xdebug_message')
                $arrLogInformation[LogModuleService::TYPE_FILE]['message'] = Log::printDecodeContent($strMessageCritical);
            else
                $arrLogInformation[LogModuleService::TYPE_FILE][$strInfo] = $strValue;
        }
        unset($mixMessageCritical);
        return $arrLogInformation;
    }

}
