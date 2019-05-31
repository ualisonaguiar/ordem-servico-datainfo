<?php

namespace InepZend\Module\Log\Service;

/**
 * Modelo de classe a ser aplicado nas classes referente aos niveis a ser utilizado no sistema.
 *
 * @package Log
 */
interface LogInterface
{

    /**
     *
     * @param string $strLineMessageLog
     * @return array
     */
    public static function getInformationLog($strLineMessageLog);
}
