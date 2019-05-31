<?php

namespace InepZend\Exception;

use \Exception as ExceptionNative;

trait ExceptionTrait
{

    public static function cloneException($exception = null)
    {
        if (!is_object($exception))
            $exception = new ExceptionNative();
        $strInepZendExceptionClass = __CLASS__;
        $inepZendException = new $strInepZendExceptionClass($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        $inepZendException->file = $exception->file;
        $inepZendException->line = $exception->line;
        return $inepZendException;
    }

}
