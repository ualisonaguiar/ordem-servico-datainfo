<?php

namespace InepZend\Doctrine\ORM\Mapping;

use Doctrine\ORM\Mapping\DefaultQuoteStrategy as DoctrineDefaultQuoteStrategy;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class DefaultQuoteStrategy extends DoctrineDefaultQuoteStrategy
{

    public function getColumnAlias($strColumnName, $intCounter, AbstractPlatform $platform, ClassMetadata $class = null)
    {
        $strColumnAlias = parent::getColumnAlias($strColumnName, $intCounter, $platform, $class);
        if (strpos($strColumnAlias, '_') === 0)
            $strColumnAlias = substr($strColumnAlias, 1);
        $strSufix = str_ireplace($strColumnName, '', $strColumnAlias);
        if (strpos($strSufix, '_') === 0)
            $strColumnAlias = substr($strColumnAlias, 0, (strlen($strColumnAlias) - strlen($strSufix))) . substr($strSufix, 1);
        return $strColumnAlias;
    }

    public function getTableName(ClassMetadata $class, AbstractPlatform $platform)
    {
        $strTableName = parent::getTableName($class, $platform);
        if (stripos($strTableName, 'SELECT ') === 0)
            $strTableName = '(' . $strTableName . ')';
        return $strTableName;
    }

}
