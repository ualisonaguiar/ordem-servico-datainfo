<?php

namespace InepZend\Exception;

use InepZend\Exception\ExceptionInterface;
use InepZend\Exception\ExceptionTrait;

class UnderflowException extends \UnderflowException implements ExceptionInterface
{

    use ExceptionTrait;
}
