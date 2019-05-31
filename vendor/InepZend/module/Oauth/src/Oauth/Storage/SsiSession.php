<?php

namespace InepZend\Module\Oauth\Storage;

use InepZend\Module\Oauth\Storage\AbstractSession;
use Zend\Session\ManagerInterface as Manager;

class SsiSession extends AbstractSession
{

    public function __construct($strNamespace = null, $strMember = null, Manager $manager = null)
    {
        $this->strNamespace = self::NAMESPACE_DEFAULT . '_SSI';
        parent::__construct($strNamespace, $strMember, $manager);
    }

}
