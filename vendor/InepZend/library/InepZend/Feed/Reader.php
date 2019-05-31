<?php

namespace InepZend\Feed;

use Zend\Feed\Reader\Reader as ZendReader;
use Zend\Http\Client as HttpClient;
use InepZend\Util\Curl;

/**
 * Classe responsavel pela leitura de Feeds (RSS/Atom).
 * 
 * @package InepZend
 * @subpackage Feed
 */
class Reader extends ZendReader
{

    public function __construct()
    {
        $httpClient = new HttpClient();
        Curl::setAdapter($httpClient);
        $this->setHttpClient($httpClient);
    }

}
