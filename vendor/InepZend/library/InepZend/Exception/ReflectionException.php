<?php

namespace InepZend\Exception;

use InepZend\Exception\ExceptionInterface;
use InepZend\Exception\ExceptionTrait;

class ReflectionException extends \ReflectionException implements ExceptionInterface
{

    use ExceptionTrait;
}
