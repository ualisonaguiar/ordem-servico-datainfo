<?php

$strPath = '/vendor/InepZend/php/';
$strGroup = end(explode($strPath, str_ireplace('.php', '', $_SERVER['PHP_SELF'])));
echo '<h1>' . str_replace('.', ': ', $strGroup) . '</h1>';
$memcache = new \Memcache();
$memcache->connect('localhost', 11211);
switch (strtolower($_SERVER['QUERY_STRING']{0})) {
    case 'e': // habilita
        $memcache->set($strGroup, 'enable');
        $strStatus = '<b style="color: green;">HABILITADO</b>'; 
        break;
    case 'd': // desabilita
        $memcache->set($strGroup, 'disable');
        $strStatus = '<b style="color: red;">DESABILITADO</b>';
        break;
    default: // limpa
        $memcache->delete($strGroup);
        $strStatus = '<b style="color: blue;">PADRÃO</b>';
        break;
}
echo 'Os dados foram manipulados no servidor Memcached: ' . $strStatus . '.<br />';
