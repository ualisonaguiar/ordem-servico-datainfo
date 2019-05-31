<?php

namespace InepZend\Exception;

use InepZend\Exception\ExceptionInterface;
use InepZend\Exception\ExceptionTrait;

class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface
{

    use ExceptionTrait;
}
