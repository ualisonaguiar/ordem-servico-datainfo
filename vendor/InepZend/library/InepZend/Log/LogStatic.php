<?php

namespace InepZend\Log;

/**
 * Trait responsavel pela captura da instancia monolog/logger (atributo estatico).
 *
 * [+] LogStatic
 *      [-] LogRegister
 *          [-] LogTrace
 *              [-] LogTraceInstance
 *              [-] LogCall
 *          [-] LogPersistence
 *
 * @package InepZend
 * @subpackage Log
 */
trait LogStatic
{

    private static $log;

    public static function setLog($log = null)
    {
        self::$log = $log;
        return;
    }

    public static function getLog()
    {
        $log = self::$log;
        if (!is_object($log)) {
            $log = new Log();
            self::setLog($log);
        }
        return $log;
    }

    public static function hasLog()
    {
        return is_object(self::getLog());
    }

}
