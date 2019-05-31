<?php

namespace InepZend\Log;

use InepZend\Module\Log\Service\LogModule;

/**
 * Trait responsavel pela auditoria de operacoes de banco de dados.
 *
 * [-] LogStatic
 *      [-] LogRegister
 *          [-] LogTrace
 *              [-] LogTraceInstance
 *              [-] LogCall
 *          [+] LogPersistence
 *
 * @package InepZend
 * @subpackage Log
 */
trait LogPersistence
{

    use LogRegister;

    protected function persistence($strMethod = null, $mixArgument = null, $strClass = null, $mixMessage = null, $strLogMethod = null)
    {
        if (@$GLOBALS[LogModule::KEY_ROOT][LogModule::KEY_OPTION][LogModule::KEY_OPTION_PERSISTENCE] === true)
            return $this->register($strMethod, $mixArgument, $strClass, $mixMessage, $strLogMethod);
        return false;
    }

    protected function persistenceMessage($mixMessage)
    {
        if (empty($mixMessage))
            return false;
        return $this->persistence(null, null, null, $mixMessage);
    }

}
