<?php

namespace InepZend\Permission;

use InepZend\Util\DebugExec;
use InepZend\Ssi\Service\PerfilAcao as PerfilAcaoService;
use InepZend\Ssi\Entity\PerfilAcao;
use InepZend\Session\SessionTrait;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;
use InepZend\Authentication\AuthTrait;
use InepZend\Module\Authentication\Service\Authentication as AuthenticationService;
use Doctrine\DBAL\Platforms\OraclePlatform;

class Permission
{

    use AuthTrait,
        SessionTrait,
        DebugExec;

    const DEBUG = false;
    const CONST_KEY_PREFIXO_RESOURCE = 'RSRC_';
    const CONST_KEY_PREFIXO_RESOURCE_FORM_ELEMENT = 'RSRC_FORM_';
    const CONST_KEY_SESSION_CONTAINER = 'sessionPermission';
    const CONST_KEY_SESSION_ACL = 'acl';
    const CONST_KEY_SESSION_PERFIL_ACAO = 'arrPerfilAcao';

    private $entityManager = null;
    private $arrPerfilAcao = null;
    private $acl = null;
    private $booValid = false;

    public function __construct($entityManager = null)
    {
        if (is_object($entityManager)) {
            $this->entityManager = $entityManager;
            if (
                (AuthenticationService::isLdap()) ||
                (AuthenticationService::isFacebook()) ||
                (AuthenticationService::isGoogle()) ||
                (AuthenticationService::isAuthBasic())
            )
                $this->booValid = true;
            else
                $this->loadPermissionFromSsi();
        }
    }

    public function loadPermissionFromSsi()
    {
        $booResult = $this->setRoleFromSsi();
        $this->debugExec($booResult);
        if ($booResult === true) {
            $booResult = $this->setResourceFromSsi();
            $this->debugExec($booResult);
            if ($booResult === true) {
                $booResult = $this->setAllowResourceFromSsi();
                $this->debugExec($booResult);
                if ($booResult === true) {
                    $booResult = $this->setAclSession();
                    $this->debugExec($booResult);
                }
            }
        }
        $this->booValid = $booResult;
        return $booResult;
    }

    public function setRole($strRole = null)
    {
        if (empty($strRole))
            return false;
        $acl = $this->getAclInstance();
        $role = new Role(trim(strtolower($strRole)));
        if (!$acl->hasRole($role))
            $acl->addRole($role);
        return true;
    }

    public function setResource($strResource = null)
    {
        if (empty($strResource))
            return false;
        $acl = $this->getAclInstance();
        $resource = new Resource(trim(strtolower($strResource)));
        if (!$acl->hasResource($resource))
            $acl->addResource($resource);
        return true;
    }

    public function setAllowResource($strRole = null, $strResource = null)
    {
        if ((empty($strRole)) || (empty($strResource)))
            return false;
        $acl = $this->getAclInstance();
        $acl->allow(trim(strtolower($strRole)), trim(strtolower($strResource)));
        return true;
    }

    public function setSession()
    {
        $this->setAclSession();
        $this->setPerfilAcaoSession();
        return true;
    }

    public function setAclSession($acl = null)
    {
        $session = self::getSessionInstance(self::CONST_KEY_SESSION_CONTAINER);
        $session->offsetSet(self::CONST_KEY_SESSION_ACL, (!is_object($acl)) ? $this->getAclInstance() : $acl);
        return true;
    }

    public function getAclSession()
    {
        $session = self::getSessionInstance(self::CONST_KEY_SESSION_CONTAINER);
        return $session->offsetGet(self::CONST_KEY_SESSION_ACL);
    }

    public function setPerfilAcaoSession($arrPerfilAcao = null)
    {
        $session = self::getSessionInstance(self::CONST_KEY_SESSION_CONTAINER);
        $session->offsetSet(self::CONST_KEY_SESSION_PERFIL_ACAO, (is_null($arrPerfilAcao)) ? $this->arrPerfilAcao : $arrPerfilAcao);
        return true;
    }

    public function getPerfilAcaoSession()
    {
        $session = self::getSessionInstance(self::CONST_KEY_SESSION_CONTAINER);
        return $session->offsetGet(self::CONST_KEY_SESSION_PERFIL_ACAO);
    }

    public function hasRole($strRole = null)
    {
        if (empty($strRole))
            return false;
        $acl = $this->getAclInstance();
        return $acl->hasRole(trim(strtolower($strRole)));
    }

    public function hasResource($strResource = null)
    {
        if (empty($strResource))
            return false;
        $acl = $this->getAclInstance();
        return $acl->hasResource(trim(strtolower($strResource)));
    }

    public function listPerfilAcao()
    {
        if (is_null($this->arrPerfilAcao)) {
            $this->arrPerfilAcao = $this->getPerfilAcaoSession();
            if (is_null($this->arrPerfilAcao)) {
                if (!is_object($this->entityManager))
                    return false;
                $arrPerfilAcaoResult = array();
                if ($this->entityManager->getConnection()->getDatabasePlatform() instanceof OraclePlatform) {
                    if (!$this->hasIdentity())
                        return false;
                    $perfilAcaoService = new PerfilAcaoService($this->entityManager);
                    $this->debugExec($this->getSystem()->id);
                    $arrPerfilAcao = $perfilAcaoService->findBy(array('id_sistema' => $this->getSystem()->id, 'in_ativo_perfil_acao' => 1));
                    $this->debugExec($arrPerfilAcao);
                    if (!is_array($arrPerfilAcao))
                        return false;
                    foreach ($arrPerfilAcao as $perfilAcao) {
                        if (($perfilAcao->getSgAcao() == PerfilAcao::ACAO_DEFAUT_SSI) || (stripos($perfilAcao->getSgAcao(), self::CONST_KEY_PREFIXO_RESOURCE) !== 0))
                            continue;
                        $arrPerfilAcaoResult[$perfilAcao->getIdPerfil() . '-' . $perfilAcao->getIdAcao()] = $perfilAcao;
                    }
                }
                $this->debugExec($arrPerfilAcaoResult);
                $this->arrPerfilAcao = array_values($arrPerfilAcaoResult);
                $this->debugExec($this->arrPerfilAcao);
            }
        }
        return $this->arrPerfilAcao;
    }

    public function clearPerfilAcao()
    {
        $this->arrPerfilAcao = null;
        return true;
    }

    public function getAclInstance()
    {
        if (!is_object($this->acl))
            $this->acl = (!is_object($this->getAclSession())) ? new Acl() : $this->getAclSession();
        return $this->acl;
    }

    public function clearAclInstance()
    {
        $this->acl = null;
        return true;
    }

    public function isValid()
    {
        $this->debugExec($this->booValid);
        return (bool) $this->booValid;
    }

    public function isAllowed($strRole = null, $strResource = null)
    {
        if ((empty($strRole)) || (empty($strResource)))
            return false;
        $acl = $this->getAclInstance();
        return $acl->isAllowed(trim(strtolower($strRole)), trim(strtolower($strResource)));
    }

    public function isAllowedIfExists($strRole = null, $strResource = null)
    {
        if ((empty($strRole)) || (empty($strResource)))
            return false;
        $booAllow = true;
        if (($this->hasRole($strRole)) && ($this->hasResource($strResource)))
            $booAllow = $this->isAllowed($strRole, $strResource);
        $this->debugExec($booAllow);
        return $booAllow;
    }

    public function isAllowedIdentity($strResource = null, $booHasRole = false)
    {
        if (empty($strResource))
            return false;
        if (!$this->hasIdentity())
            return false;
        $booAllow = false;
        $arrPerfil = $this->getProfile();
        $this->debugExec($booHasRole);
        $this->debugExec($arrPerfil);
        foreach ($arrPerfil as $perfil) {
            $strRole = $perfil->id . ' - ' . $perfil->nome;
            $this->debugExec($strRole);
            $this->debugExec($this->hasRole($strRole));
            if (($booHasRole === true) && (!$this->hasRole($strRole)))
                continue;
            $booAllow = $this->isAllowed($strRole, $strResource);
            $this->debugExec($booAllow);
            if ($booAllow === true)
                break;
        }
        $this->debugExec($booAllow);
        return $booAllow;
    }

    public function isAllowedIdentityIfExists($strResource = null)
    {
        if (empty($strResource))
            return false;
        $booAllow = true;
        if ($this->hasResource($strResource))
            $booAllow = $this->isAllowedIdentity($strResource, true);
        $this->debugExec($booAllow);
        return $booAllow;
    }

    public function loadRoleFromSsi($strNoPerfil = null)
    {
        $arrPerfilAcao = $this->listPerfilAcao();
        if (!is_array($arrPerfilAcao))
            return false;
        $this->debugExec($arrPerfilAcao);
        $arrRole = array();
        foreach ($arrPerfilAcao as $perfilAcao) {
            if ((!empty($strNoPerfil)) && ($perfilAcao->getPerfil()->getNoPerfil() != $strNoPerfil))
                continue;
            $arrRole[$perfilAcao->getPerfil()->getIdPerfil()] = $perfilAcao->getPerfil()->getIdPerfil() . ' - ' . $perfilAcao->getPerfil()->getNoPerfil();
        }
        $this->debugExec($arrRole);
        return $arrRole;
    }

    public function loadResourceFromSsi($strSgAcao = null)
    {
        $arrPerfilAcao = $this->listPerfilAcao();
        if (!is_array($arrPerfilAcao))
            return false;
        $arrResource = array();
        foreach ($arrPerfilAcao as $perfilAcao) {
            if ((!empty($strSgAcao)) && ($perfilAcao->getSgAcao() != $strSgAcao))
                continue;
//            $arrResource[$perfilAcao->getIdAcao()] = $perfilAcao->getIdAcao() . ' - ' . $perfilAcao->getSgAcao();
            $arrResource[$perfilAcao->getIdAcao()] = $perfilAcao->getSgAcao();
        }
        $this->debugExec($arrResource);
        return $arrResource;
    }

    private function setRoleFromSsi()
    {
        $arrRole = $this->loadRoleFromSsi();
        if (is_bool($arrRole))
            return false;
        foreach ($arrRole as $strRole)
            $this->setRole($strRole);
        return true;
    }

    private function setResourceFromSsi()
    {
        $arrResource = $this->loadResourceFromSsi();
        if (is_bool($arrResource))
            return false;
        foreach ($arrResource as $strResource)
            $this->setResource($strResource);
        return true;
    }

    private function setAllowResourceFromSsi()
    {
        $arrAllowResource = $this->loadAllowResourceFromSsi();
        if (is_bool($arrAllowResource))
            return false;
        foreach ($arrAllowResource as $arrAllowResourceIntern)
            $this->setAllowResource($arrAllowResourceIntern[0], $arrAllowResourceIntern[1]);
        return true;
    }

    private function loadAllowResourceFromSsi()
    {
        $arrPerfilAcao = $this->listPerfilAcao();
        if (!is_array($arrPerfilAcao))
            return false;
        $arrAllowResource = array();
        foreach ($arrPerfilAcao as $perfilAcao)
            $arrAllowResource[$perfilAcao->getPerfil()->getIdPerfil() . ' - ' . $perfilAcao->getIdAcao()] = array(
                $perfilAcao->getPerfil()->getIdPerfil() . ' - ' . $perfilAcao->getPerfil()->getNoPerfil(),
//                $perfilAcao->getIdAcao() . ' - ' . $perfilAcao->getSgAcao()
                $perfilAcao->getSgAcao()
            );
        $this->debugExec($arrAllowResource);
        return $arrAllowResource;
    }

}
