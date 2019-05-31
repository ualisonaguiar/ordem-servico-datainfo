<?php

namespace InepZend\Exception;

use InepZend\Exception\ExceptionInterface;
use InepZend\Exception\ExceptionTrait;

class OutOfRangeException extends \OutOfRangeException implements ExceptionInterface
{

    use ExceptionTrait;
}
