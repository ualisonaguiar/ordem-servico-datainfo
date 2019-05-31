<?php

namespace InepZend\Authentication;

use Zend\Authentication\Storage\Session as StorageSession;
use Zend\Session\ManagerInterface as SessionManager;
use InepZend\Session\Session as SessionContainer;

class Session extends StorageSession
{

    const NAMESPACE_DEFAULT = 'authentication';

    public function __construct($strNamespace = null, $strMember = null, SessionManager $manager = null)
    {
        if ($strNamespace !== null)
            $this->namespace = $strNamespace;
        if ($strMember !== null)
            $this->member = $strMember;
        $this->session = new SessionContainer($this->namespace, $manager);
    }

}
