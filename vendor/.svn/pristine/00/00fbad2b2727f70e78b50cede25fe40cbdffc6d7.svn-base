<?php

namespace InepZend\Module\Oauth\Service;

interface InterfaceService
{

    public function getAdapter();

//    private function setAdapter($strAdapter);

    public function getVersion();

//    private function setVersion($strVersion);

    public function getServiceLocator();

//    private function setServiceLocator($serviceLocator);

    public function getConfig();

//    private function setConfig($arrConfig);

    public function getOAuth();

//    private function setOAuth($oAuth);

    public function getOAuthInstance();

    public function setAccessTokenIntoOAuth($accessToken, $oAuth = null, $booRedirect = false);

    public function getAccessToken();

    public function getToken();

//    private function getSession();

    public function getLastRouteFromSession($booClear = false);

//    protected function setLastRouteIntoSession($controller = null);

    public function clearLastRouteFromSession();

    public function getAccessTokenFromSession();

    public function setAccessTokenIntoSession($accessToken);

    public function clearAccessTokenFromSession();

//    private function makeCall($strFunction, $arrParam = null, $strMethod = 'GET', $booAuth = false);
}
