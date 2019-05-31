<?php

namespace InepZend\Doctrine\DBAL\Event\Listeners;

use Doctrine\DBAL\Event\Listeners\OracleSessionInit as DoctrineOracleSessionInit;
use Doctrine\DBAL\Event\ConnectionEventArgs;

class OracleSessionInit extends DoctrineOracleSessionInit
{
    private static $booExecuted = false;

    /**
     * @var array
     */
    protected $_defaultSessionVars = array(
        'NLS_TIME_FORMAT' => "HH24:MI:SS",
        'NLS_DATE_FORMAT' => "YYYY-MM-DD HH24:MI:SS",
        'NLS_TIMESTAMP_FORMAT' => "YYYY-MM-DD HH24:MI:SS",
        'NLS_TIMESTAMP_TZ_FORMAT' => "YYYY-MM-DD HH24:MI:SS TZH:TZM",
        'NLS_NUMERIC_CHARACTERS' => ".,",
        'NLS_SORT' => "binary_ai",
    );

    /**
     * @param \Doctrine\DBAL\Event\ConnectionEventArgs $args
     *
     * @return void
     */
    public function postConnect(ConnectionEventArgs $args)
    {
        if (!self::$booExecuted) {
            parent::postConnect($args);
            self::$booExecuted = true;
        }
    }
}
