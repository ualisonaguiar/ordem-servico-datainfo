<?php

namespace InepZend\Module\Log\Adapter\Container;

use InepZend\Util\AttributeStaticTrait;

class ContainerFactory
{

    use AttributeStaticTrait;

    const FILE_ADAPTER = 'InepZend\Module\Log\Adapter\Container\FileAdapter';
    const SESSION_ADAPTER = 'InepZend\Module\Log\Adapter\Container\SessionAdapter';

    private static $arrInstance = array();

    /**
     *
     * @param string $strNamespace
     * @return object
     */
    public static function getInstance($strNamespace = null)
    {
        if (empty($strNamespace))
            $strNamespace = self::FILE_ADAPTER;
        return self::getAttributeStaticInstance($strNamespace, 'arrInstance', $strNamespace);
    }

}
