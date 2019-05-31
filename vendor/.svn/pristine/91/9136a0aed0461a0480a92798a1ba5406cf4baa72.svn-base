<?php

namespace InepZend\Log;

use InepZend\Util\AttributeStaticTrait;

/**
 * Classe responsavel pela captura da instancia via Singleton (atributo estatico).
 * 
 * [-] LogStatic
 *      [-] LogRegister
 *          [-] LogTrace
 *              [+] LogTraceInstance
 *              [-] LogCall
 *          [-] LogPersistence
 *
 * @package InepZend
 * @subpackage Log
 */
class LogTraceInstance
{

    use LogTrace,
        AttributeStaticTrait;

    public static function getInstance()
    {
        return self::getAttributeStaticInstance(__CLASS__);
    }

}
