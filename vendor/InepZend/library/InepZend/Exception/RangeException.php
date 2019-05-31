<?php

namespace InepZend\Exception;

use InepZend\Exception\ExceptionInterface;
use InepZend\Exception\ExceptionTrait;

class RangeException extends \RangeException implements ExceptionInterface
{

    use ExceptionTrait;
}
