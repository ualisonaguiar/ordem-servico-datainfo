<?php

namespace InepZend\Exception;

use InepZend\Exception\ExceptionInterface;
use InepZend\Exception\ExceptionTrait;

class LogicException extends \LogicException implements ExceptionInterface
{

    use ExceptionTrait;
}
