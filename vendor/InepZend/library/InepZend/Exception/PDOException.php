<?php

namespace InepZend\Exception;

use InepZend\Exception\ExceptionInterface;
use InepZend\Exception\ExceptionTrait;

class PDOException extends \PDOException implements ExceptionInterface
{

    use ExceptionTrait;
}
