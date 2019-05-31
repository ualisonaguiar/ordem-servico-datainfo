<?php

namespace InepZend\WebService\Client\Corporative\Inep\RestCcp;

use InepZend\Util\AttributeStaticTrait;
use InepZend\Authentication\AuthTrait;

trait RestCcpTrait
{

    use AuthTrait,
        AttributeStaticTrait;

    private static $booRestCcp = true;

    public static function setRestCcp($booRestCcp = null)
    {
        return self::setAttributeStatic('booRestCcp', $booRestCcp);
    }

    public static function getRestCcp()
    {
        return self::getAttributeStatic('booRestCcp');
    }

    public static function getInstanceRestCcp()
    {
        return self::getAttributeStaticInstance('InepZend\WebService\Client\Corporative\Inep\RestCcp');
    }

}
