<?php

namespace InepZend\Module\Oauth\Storage;

use InepZend\Session\Session as SessionContainer;
use Zend\Session\ManagerInterface as Manager;

abstract class AbstractSession implements StorageInterface
{

    const NAMESPACE_DEFAULT = 'InepZend_Oauth';
    const MEMBER_DEFAULT = 'storage';

    protected $session;
    protected $strNamespace = self::NAMESPACE_DEFAULT;
    protected $strMember = self::MEMBER_DEFAULT;

    public function __construct($strNamespace = null, $strMember = null, Manager $manager = null)
    {
        if ($strNamespace !== null)
            $this->strNamespace = $strNamespace;
        if ($strMember !== null)
            $this->strMember = $strMember;
        $this->session = new SessionContainer($this->strNamespace, $manager);
    }

    public function getNamespace()
    {
        return $this->strNamespace;
    }

    public function getMember()
    {
        return $this->strMember;
    }

    public function isEmpty()
    {
        return !isset($this->session->{$this->strMember});
    }

    public function read()
    {
        return $this->session->{$this->strMember};
    }

    public function write($mixContents)
    {
        $this->session->{$this->strMember} = $mixContents;
    }

    public function clear()
    {
        unset($this->session->{$this->strMember});
    }

    public function saveRequestToken($mixRequestToken)
    {
        $this->strMember = 'requestToken';
        $this->write($mixRequestToken);
    }

    public function getRequestToken()
    {
        $this->strMember = 'requestToken';
        return $this->read();
    }

    public function clearRequestToken()
    {
        $this->strMember = 'requestToken';
        unset($this->session->{$this->strMember});
    }

    public function saveAccessToken($mixAccessToken)
    {
        $this->strMember = 'accessToken';
        $this->write($mixAccessToken);
    }

    public function getAccessToken()
    {
        $this->strMember = 'accessToken';
        return $this->read();
    }

    public function clearAccessToken()
    {
        $this->strMember = 'accessToken';
        unset($this->session->{$this->strMember});
    }

}
