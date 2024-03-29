<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_OAuth
 */

namespace InepZend\Module\Oauth\Vendor\ZendOAuth2\Http;

use ZendOAuth\Config\ConfigInterface;

/**
 * @category   Zend
 * @package    Zend_OAuth
 */
class Utility extends \ZendOAuth\Http\Utility
{
    /**
     * Assemble all parameters for a generic OAuth request - i.e. no special
     * params other than the defaults expected for any OAuth query.
     *
     * @param  string $url
     * @param  ConfigInterface $config
     * @param  null|array $serviceProviderParams
     * @return array
     */
    public function assembleParams(
        $url,
        ConfigInterface $config,
        array $serviceProviderParams = null
    ) {
        $params = array();

        if ($config->getToken()->getToken() != null) {
            $params['access_token'] = $config->getToken()->getToken();
        }

        if ($serviceProviderParams !== null) {
            $params = array_merge($params, $serviceProviderParams);
        }

        return $params;
    }

    /**
     * Given both OAuth parameters and any custom parameters, generate an
     * encoded query string. This method expects parameters to have been
     * assembled and signed beforehand.
     *
     * @param array $params
     * @param bool $customParamsOnly Ignores OAuth params e.g. for requests using OAuth Header
     * @return string
     */
    public function toEncodedQueryString(array $params, $customParamsOnly = false)
    {
        if ($customParamsOnly) {
            foreach ($params as $key=>$value) {
                if (preg_match("/^oauth_/", $key)) {
                    unset($params[$key]);
                }
            }
        }
        $encodedParams = array();
        foreach ($params as $key => $value) {
            $encodedParams[] = self::urlEncode($key)
                             . '='
                             . self::urlEncode($value);
        }
        return implode('&', $encodedParams);
    }

    /**
     * Cast to authorization header
     *
     * @param  array $params
     * @param  null|string $realm
     * @param  bool $excludeCustomParams
     * @return void
     */
    public function toAuthorizationHeader(array $params, $realm = null, $excludeCustomParams = true)
    {
        $headerValue = array(
            'OAuth realm="' . $realm . '"',
        );

        foreach ($params as $key => $value) {
            if ($excludeCustomParams) {
                if (!preg_match("/^oauth_/", $key)) {
                    continue;
                }
            }
            $headerValue[] = self::urlEncode($key)
                           . '="'
                           . self::urlEncode($value) . '"';
        }
        return implode(",", $headerValue);
    }

    /**
     * Sign request
     *
     * @param  array $params
     * @param  string $signatureMethod
     * @param  string $consumerSecret
     * @param  null|string $tokenSecret
     * @param  null|string $method
     * @param  null|string $url
     * @return string
     */
    public function sign(
        array $params, $signatureMethod, $consumerSecret, $tokenSecret = null, $method = null, $url = null
    ) {
        $className = '';
        $hashAlgo  = null;
        $parts     = explode('-', $signatureMethod);
        if (count($parts) > 1) {
            $className = 'ZendOAuth\Signature\\' . ucfirst(strtolower($parts[0]));
            $hashAlgo  = $parts[1];
        } else {
            $className = 'ZendOAuth\Signature\\' . ucfirst(strtolower($signatureMethod));
        }

        $signatureObject = new $className($consumerSecret, $tokenSecret, $hashAlgo);
        return $signatureObject->sign($params, $method, $url);
    }

    /**
     * Parse query string
     *
     * @param  mixed $query
     * @return array
     */
    public function parseQueryString($query)
    {
        $params = array();
        if (empty($query)) {
            return array();
        }

        // Not remotely perfect but beats parse_str() which converts
        // periods and uses urldecode, not rawurldecode.
        $parts = explode('&', $query);
        foreach ($parts as $pair) {
            $kv = explode('=', $pair);
            $params[rawurldecode($kv[0])] = rawurldecode($kv[1]);
        }
        return $params;
    }

    /**
     * Generate nonce
     *
     * @return string
     */
    public function generateNonce()
    {
        return md5(uniqid(rand(), true));
    }

    /**
     * Generate timestamp
     *
     * @return int
     */
    public function generateTimestamp()
    {
        return time();
    }

    /**
     * urlencode a value
     *
     * @param  string $value
     * @return string
     */
    public static function urlEncode($value)
    {
        $encoded = rawurlencode($value);
        $encoded = str_replace('%7E', '~', $encoded);
        return $encoded;
    }
}
