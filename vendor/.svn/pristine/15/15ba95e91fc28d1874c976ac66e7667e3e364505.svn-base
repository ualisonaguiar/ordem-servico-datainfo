<?php

namespace InepZend\Doctrine\DBAL\Types;

use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class Utf8String extends StringType
{
    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        // convert from utf8 to latin1
        return mb_convert_encoding($value, 'ISO-8859-1', 'UTF-8');
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        // convert from latin1 to utf8
        return mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1');
    }
}
