<?php

namespace InepZend\Exception;

use InepZend\Exception\ExceptionInterface;
use InepZend\Exception\ExceptionTrait;

class OutOfBoundsException extends \OutOfBoundsException implements ExceptionInterface
{

    use ExceptionTrait;
}
