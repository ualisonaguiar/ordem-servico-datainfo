<?php

require_once(__DIR__ . '/../../vendor/InepZend/library/InepZend/Util/ApplicationProperties.php');
require_once(__DIR__ . '/../../vendor/InepZend/library/InepZend/Util/AttributeStaticTrait.php');
require_once(__DIR__ . '/../../vendor/InepZend/library/InepZend/Util/Server.php');
require_once(__DIR__ . '/../../vendor/InepZend/library/InepZend/Util/Environment.php');

use InepZend\Util\Environment;

$booShowError = true;
define('SHOW_ERROR', $booShowError);
ini_set('display_errors', (integer) $booShowError);
Locale::setDefault('pt_BR');
date_default_timezone_set('America/Sao_Paulo');
