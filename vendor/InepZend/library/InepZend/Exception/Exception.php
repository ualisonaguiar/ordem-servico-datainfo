<?php

namespace InepZend\Exception;

use InepZend\Exception\ExceptionInterface;
use InepZend\Exception\ExceptionTrait;

class Exception extends \Exception implements ExceptionInterface
{

    use ExceptionTrait;
}
