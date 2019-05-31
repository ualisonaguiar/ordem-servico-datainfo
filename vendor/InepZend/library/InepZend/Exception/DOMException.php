<?php

namespace InepZend\Exception;

use InepZend\Exception\ExceptionInterface;
use InepZend\Exception\ExceptionTrait;

class DOMException extends \DOMException implements ExceptionInterface
{

    use ExceptionTrait;
}
