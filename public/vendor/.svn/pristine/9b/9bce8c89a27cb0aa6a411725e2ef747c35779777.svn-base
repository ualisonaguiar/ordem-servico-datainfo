<?php

echo '<h1>Memcache</h1>';
$memcache = new \Memcache();
$memcache->connect('localhost', 11211);
if ($memcache->flush())
    echo 'Os dados armazenados no servidor Memcached foram limpos.<br />';
else
    echo 'Os dados armazenados no servidor Memcached <b>n&atilde;o</b> podem ser limpo.<br />';
echo '<h1>OPCache</h1>';
if (function_exists('opcache_reset')) {
    if (opcache_reset())
        echo 'Os dados contidos no cache referente ao OPcache foram limpos.<br />';
    else
        echo 'Os dados contidos no cache referente ao OPcache <b>n&atilde;o</b> podem limpos.<br />';
} else
    echo '<b style="color: red;">N&atilde;o instalado</b> no servidor.<br />';
