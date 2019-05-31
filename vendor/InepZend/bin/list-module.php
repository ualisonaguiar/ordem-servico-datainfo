<?php

require_once(__DIR__ . '/../../../../vendor/InepZend/library/InepZend/Util/Functions/Server.php');

$arrModulesFsw = include_once getReplacedBasePathApplication('/../../../config/application.config.php');
echo str_replace(array('./module/', './module', './vendor'), '', implode("\n", $arrModulesFsw['module_listener_options']['module_paths']));
