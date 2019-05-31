<?php

namespace InepZend\Module\Oauth\Vendor\ZendOAuth\Token;

use ZendOAuth\Token\Access as ZendAccess;
use Zend\Http\Response as HTTPResponse;
use InepZend\Module\Oauth\Vendor\ZendOAuth\Http\Utility as HTTPUtility;

class Access extends ZendAccess
{

    /**
     * Constructor; basic setup for any Token subclass.
     *
     * @param  null|\Zend\Http\Response $response
     * @param  null|\ZendOAuth\Http\Utility $utility
     * @return void
     */
    public function __construct(HTTPResponse $response = null, HTTPUtility $utility = null)
    {
        if ($response !== null) {
            $this->_response = $response;
            $params = $this->_parseParameters($response);
            if (count($params) > 0)
                $this->setParams($params);
        }
        $this->_httpUtility = new HTTPUtility;
    }

    public function setHttpUtility(HTTPUtility $utility = null)
    {
        $this->_httpUtility = $utility;
        return $this;
    }

}
