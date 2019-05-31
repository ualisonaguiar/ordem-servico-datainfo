<?php

namespace InepZend\Log;

use InepZend\Util\MethodArgumentTrait;
use InepZend\Util\Reflection;
use InepZend\Exception\Exception;

/**
 * Trait responsavel pela auditoria automatica de rastros/informacao de metodos protegidos.
 *
 * [-] LogStatic
 *      [-] LogRegister
 *          [-] LogTrace
 *              [-] LogTraceInstance
 *              [+] LogCall
 *          [-] LogPersistence
 *
 * @package InepZend
 * @subpackage Log
 */
trait LogCall
{

    use MethodArgumentTrait,
        LogTrace;

    public function __call($strMethod, $mixArgument)
    {
        if (!method_exists($this, $strMethod))
            return;
        $class = Reflection::getReflectionClass($this);
        if ($class->getMethod($strMethod)->isPrivate()) {
            throw new Exception('Call to private method ' . get_class($this) . '::' . $strMethod . '().');
            return;
        }
        $this->trace($strMethod, $mixArgument);
        if ((!empty($mixArgument)) && (!is_array($mixArgument)))
            $mixArgument = array($mixArgument);
        return $this->execThisMethod($strMethod, $mixArgument);
    }

}
