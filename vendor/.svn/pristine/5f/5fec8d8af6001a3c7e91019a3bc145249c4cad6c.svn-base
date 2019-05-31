<?php

namespace InepZend\Module\Oauth\Vendor\ZendOAuth\Http;

use ZendOAuth\Http\Utility as ZendUtility;

class Utility extends ZendUtility
{

    /**
     * Cast to authorization header
     *
     * @param  array $arrParam
     * @param  null|string $strRealm
     * @param  bool $booExcludeCustomParam
     * @return void
     */
    public function toAuthorizationHeader(array $arrParam, $strRealm = null, $booExcludeCustomParam = true)
    {
        $arrHeaderValue = array();
        foreach ($arrParam as $strKey => $mixValue) {
            if (($booExcludeCustomParam) && (!preg_match("/^oauth_/", $strKey)))
                continue;
            $arrHeaderValue[] = self::urlEncode($strKey) . '="' . self::urlEncode($mixValue) . '"';
        }
        return 'OAuth ' . implode(',', $arrHeaderValue);
    }

}
