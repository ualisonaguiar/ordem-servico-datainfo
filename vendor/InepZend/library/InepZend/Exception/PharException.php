<?php

namespace InepZend\Exception;

use InepZend\Exception\ExceptionInterface;
use InepZend\Exception\ExceptionTrait;

class PharException extends \PharException implements ExceptionInterface
{

    use ExceptionTrait;
}
