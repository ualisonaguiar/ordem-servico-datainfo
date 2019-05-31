<?php

namespace InepZend\Module\Oauth\Vendor\ZendOAuth;

use ZendOAuth\Consumer as ZendConsumer;
use ZendOAuth\Http\UserAuthorization;
use ZendOAuth\Token\Request;
use ZendOAuth\Token\AuthorizedRequest;
use InepZend\Module\Oauth\Vendor\ZendOAuth\Http\AccessToken;
use ZendOAuth\Exception\InvalidArgumentException;
use InepZend\Module\Oauth\Vendor\ZendOAuth\Http\RequestToken;
use InepZend\Module\Oauth\Service\AbstractService;
use InepZend\Util\DebugExec;
use InepZend\Util\Uri;
use \Exception as ExceptionNative;

class Consumer extends ZendConsumer
{

    use DebugExec;

    const DEBUG = AbstractService::DEBUG;

    /**
     * Attempts to retrieve a Request Token from an OAuth Provider which is
     * later exchanged for an authorized Access Token used to access the
     * protected resources exposed by a web service API.
     *
     * @param  null|array $arrCustomServiceParameter Non-OAuth Provider-specified parameters
     * @param  null|string $strHttpMethod
     * @param  null|ZendOAuth\Http\RequestToken $request
     * @return ZendOAuth\Token\Request
     */
    public function getRequestToken(array $arrCustomServiceParameter = null, $strHttpMethod = null, RequestToken $request = null)
    {
        if ($request === null)
            $request = new RequestToken($this, $arrCustomServiceParameter);
        elseif ($arrCustomServiceParameter !== null)
            $request->setParameters($arrCustomServiceParameter);
        if ($strHttpMethod !== null)
            $request->setMethod($strHttpMethod);
        else
            $request->setMethod($this->getRequestMethod());
        $this->debugExecFile($request);
        try {
            $this->_requestToken = $request->execute();
        } catch (ExceptionNative $exception) {
            if (self::DEBUG === true)
                $this->debugExecFile($exception);
            else
                throw $exception;
        }
        $this->debugExecFile($this->_requestToken);
        return $this->_requestToken;
    }

    /**
     * Rather than retrieve a redirect URL for use, e.g. from a controller,
     * one may perform an immediate redirect.
     *
     * Sends headers and exit()s on completion.
     *
     * @param  null|array $arrCustomServiceParameter
     * @param  null|ZendOAuth\Http\UserAuthorization $request
     * @param  boolean $booBrowser
     * @return void
     */
    public function redirect(array $arrCustomServiceParameter = null, UserAuthorization $request = null, $booBrowser = true)
    {
        $this->debugExecFile('=> Redirecionando para autenticacao do token');
        $strRedirectUrl = $this->getRedirectUrl($arrCustomServiceParameter, $request);
        $this->debugExecFile($strRedirectUrl, null, false, true, true);
        if ($booBrowser === false) {
            $arrRedirectUrl = parse_url($strRedirectUrl);
            $this->debugExecFile($arrRedirectUrl);
            $strReturn = Uri::execUrl($arrRedirectUrl['host'], $arrRedirectUrl['path'], $arrRedirectUrl['query'], $arrRedirectUrl['port']);
            $this->debugExecFile($strReturn);
            $arrReturn = explode('location: ', $strReturn);
            $strRedirectUrl = trim(reset(explode("\n", $arrReturn[1])));
            $this->debugExecFile($strRedirectUrl);
        }
        header('Location: ' . $strRedirectUrl);
        exit(1);
    }

    /**
     * Retrieve an Access Token in exchange for a previously received/authorized
     * Request Token.
     *
     * @param  array $arrQueryData GET data returned in user's redirect from Provider
     * @param  \ZendOAuth\Token\Request Request Token information
     * @param  string $strHttpMethod
     * @param  \ZendOAuth\Http\AccessToken $request
     * @return \ZendOAuth\Token\Access
     * @throws Exception\InvalidArgumentException on invalid authorization token, non-matching response authorization token, or unprovided authorization token
     */
    public function getAccessToken($arrQueryData, Request $token, $strHttpMethod = null, AccessToken $request = null)
    {
        $authorizedToken = new AuthorizedRequest($arrQueryData);
        if (!$authorizedToken->isValid())
            throw new InvalidArgumentException('Response from Service Provider is not a valid authorized request token');
        if ($request === null)
            $request = new AccessToken($this);
        if ($authorizedToken->getParam('oauth_verifier') !== null) {
            $arrParam = array_merge($request->getParameters(), array(
                'oauth_verifier' => $authorizedToken->getParam('oauth_verifier')
            ));
            $request->setParameters($arrParam);
        }
        if ($strHttpMethod !== null)
            $request->setMethod($strHttpMethod);
        else
            $request->setMethod($this->getRequestMethod());
        if (isset($token)) {
            if ($authorizedToken->getToken() !== $token->getToken())
                throw new InvalidArgumentException('Authorized token from Service Provider does not match supplied Request Token details');
        } else
            throw new InvalidArgumentException('Request token must be passed to method');
        $this->_requestToken = $token;
        $this->debugExecFile($request);
        $this->_accessToken = $request->execute();
        $this->debugExecFile($this->_accessToken);
        return $this->_accessToken;
    }

    public function getConfig()
    {
        return $this->_config;
    }

}
