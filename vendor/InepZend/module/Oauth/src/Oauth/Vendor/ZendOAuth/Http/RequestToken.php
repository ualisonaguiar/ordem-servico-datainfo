<?php

namespace InepZend\Module\Oauth\Vendor\ZendOAuth\Http;

use ZendOAuth\Http\RequestToken as ZendRequestToken;
use Zend\Http\Client\Exception\ExceptionInterface;
use ZendOAuth\Exception\InvalidArgumentException;
use ZendOAuth\OAuth;
use InepZend\Module\Oauth\Service\AbstractService;
use InepZend\Util\DebugExec;

class RequestToken extends ZendRequestToken
{

    use DebugExec;

    const DEBUG = AbstractService::DEBUG;

    /**
     * Commence a request cycle where the current HTTP method and OAuth
     * request scheme set an upper preferred HTTP request style and where
     * failures generate a new HTTP request style further down the OAuth
     * preference list for OAuth Request Schemes.
     * On success, return the Request object that results for processing.
     *
     * @todo   Remove cycling?; Replace with upfront do-or-die configuration
     * @param  array $arrParam
     * @return \Zend\Http\Response
     * @throws Exception\InvalidArgumentException on HTTP request errors
     */
    public function startRequestCycle(array $arrParam)
    {
        $response = null;
        $body = null;
        $status = null;
        try {
            $response = $this->_attemptRequest($arrParam);
        } catch (ExceptionInterface $e) {
            throw new InvalidArgumentException(sprintf(
                    'Error in HTTP request: %s', $e->getMessage()
            ), null, $e);
        }
        if ($response !== null) {
            $body = $response->getBody();
            $status = $response->getStatusCode();
        }
        $this->debugExecFile($response, null, false, true);
        if ($response === null // Request failure/exception
                || $status == 500  // Internal Server Error
                || $status == 400  // Bad Request
                || $status == 401  // Unauthorized
                || empty($body)    // Missing token
        ) {
            $this->_assessRequestAttempt($response);
            $response = $this->startRequestCycle($arrParam);
        }
        return $response;
    }

    /**
     * Attempt a request based on the current configured OAuth Request Scheme and
     * return the resulting HTTP Response.
     *
     * @param  array $arrParam
     * @return \Zend\Http\Response
     */
    protected function _attemptRequest(array $arrParam)
    {
        switch ($this->_preferredRequestScheme) {
            case OAuth::REQUEST_SCHEME_HEADER:
                $httpClient = $this->getRequestSchemeHeaderClient($arrParam);
                break;
            case OAuth::REQUEST_SCHEME_POSTBODY:
                $httpClient = $this->getRequestSchemePostBodyClient($arrParam);
                break;
            case OAuth::REQUEST_SCHEME_QUERYSTRING:
                $httpClient = $this->getRequestSchemeQueryStringClient($arrParam, $this->_consumer->getRequestTokenUrl());
                break;
        }
        $this->debugExecFile($httpClient->getRequest(), null, false, true);
        $this->debugExecFile((string) $httpClient->getRequest(), null, false, true);
        return $httpClient->send();
    }

}
