<?php

namespace InepZend\Module\Oauth\Adapter;

interface AdapterInterface
{

    public function getConsumer();

    public function getAccessToken($arrQueryData = null, $token = null, $strHttpMethod = null, $request = null);

    public function getRequestTokenUrl();
}
