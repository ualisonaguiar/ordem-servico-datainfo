<?php

namespace InepZend\Log;

use InepZend\Module\Log\Service\LogModule;

/**
 * Trait responsavel pela auditoria de rastros/informacao.
 *
 * [-] LogStatic
 *      [-] LogRegister
 *          [+] LogTrace
 *              [-] LogTraceInstance
 *              [-] LogCall
 *          [-] LogPersistence
 *
 * @package InepZend
 * @subpackage Log
 */
trait LogTrace
{

    use LogRegister;

    public function traceEvent($event = null)
    {
        if (!is_object($event))
            return false;
        return $this->trace(null, null, null, array('event' => $event->getName(), 'target' => get_class($event->getTarget())/* , 'parameters' => json_encode($event->getParams()) */));
    }

    public function traceMessage($mixMessage = null, $strLevel = null, $strPath = null, $booForce = null)
    {
        if (empty($mixMessage))
            return false;
        if (!is_bool($booForce))
            $booForce = (!empty($strLevel));
        return $this->trace(null, null, null, $mixMessage, null, $strLevel, $strPath, $booForce);
    }

    protected function trace($strMethod = null, $mixArgument = null, $strClass = null, $mixMessage = null, $strLogMethod = null, $strLevel = null, $strPath = null, $booForce = null)
    {
        $mixResult = false;
        if ((@$GLOBALS[LogModule::KEY_ROOT][LogModule::KEY_OPTION][LogModule::KEY_OPTION_TRACE] === true) || ($booForce === true)) {
            try {
                $mixResult = $this->register($strMethod, $mixArgument, $strClass, $mixMessage, $strLogMethod, $strLevel, $strPath);
            } catch (\Exception $exception) {
                
            }
        }
        return $mixResult;
    }

}
