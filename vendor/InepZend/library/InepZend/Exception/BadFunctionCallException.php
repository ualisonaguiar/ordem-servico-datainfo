<?php

namespace InepZend\Exception;

use InepZend\Exception\ExceptionInterface;
use InepZend\Exception\ExceptionTrait;

class BadFunctionCallException extends \BadFunctionCallException implements ExceptionInterface
{

    use ExceptionTrait;
}
