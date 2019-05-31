<?php

namespace InepZend\Permission;

use InepZend\Permission\Permission;

trait PermissionTrait
{

    private $permission;

    public function getPermissionInstance()
    {
        if (!is_object($this->permission))
            $this->permission = new Permission();
        return $this->permission;
    }

    public function existsResource($strResource = null)
    {
        return $this->getPermissionInstance()->existsResource($strResource);
    }

    public function isAllowed($strRole = null, $strResource = null)
    {
        return $this->getPermissionInstance()->isAllowed($strRole, $strResource);
    }

    public function isAllowedIdentity($strResource = null)
    {
        return $this->getPermissionInstance()->isAllowedIdentity($strResource);
    }

    public function isAllowedIdentityIfExists($strResource = null)
    {
        return $this->getPermissionInstance()->isAllowedIdentityIfExists($strResource);
    }

    public function isPermitted($strResource = null)
    {
        $booPermitted = true;
        if (!empty($strResource))
            $booPermitted = $this->isAllowedIdentityIfExists($strResource);
        return $booPermitted;
    }

}
