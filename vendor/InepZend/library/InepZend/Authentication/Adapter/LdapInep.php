<?php

namespace InepZend\Authentication\Adapter;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Ldap\Ldap;
use InepZend\Util\DebugExec;
use \Exception as ExceptionNative;
use InepZend\Util\ApplicationProperties;

class LdapInep implements AdapterInterface
{
    
    use DebugExec;
    
    const DEBUG = false;

    protected $login;
    protected $pass;
    protected $serviceManager;

    public function __construct($arrConfig = array(), $booUnitTest = null, $serviceManager = null)
    {
        $this->setServiceManager($serviceManager);
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($strLogin)
    {
        $this->login = $strLogin . '@inep.gov.br';
        return $this;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($strPass)
    {
        $this->pass = $strPass;
        return $this;
    }

    public function authenticate()
    {
        $arrOptions = array(
            'host' => ApplicationProperties::get('auth.ldap.endereco'),
            'port' => ApplicationProperties::get('auth.ldap.porta'),
            'accountDomainName' => ApplicationProperties::get('auth.ladp.accountDomainName'),
            'baseDn' => ApplicationProperties::get('auth.ladp.baseDn'),
        );
        try {
            $ldap = new Ldap($arrOptions);
            $ldap->bind($this->getLogin(), $this->getPass());
            $this->debugExecFile($ldap);
            $strDnLdap = $ldap->getCanonicalAccountName($this->getLogin(), Ldap::ACCTNAME_FORM_DN);
            $this->debugExecFile($strDnLdap);
            $arrInfoLadp = $ldap->getEntry($strDnLdap);
            $this->debugExecFile($arrInfoLadp);
            $strEmail = reset(array_key_exists('mail', $arrInfoLadp) ? $arrInfoLadp['mail'] : $arrInfoLadp['userprincipalname']);
            $infoUsuario = (object) array(
                'usuarioSistema' => (object) array(
                    'id' => null,
                    'dataSituacao' => null,
                    'perfis' => array(
                        (object) array(
                            'id' => null,
                            'descricao' => null,
                            'nome' => reset($arrInfoLadp['title']),
                            'acoes' => array()
                        )
                    ),
                    'sistema' => (object) array(
                        'id' => null,
                        'descricao' => null,
                        'nome' => null,
                    ),
                    'usuario' => (object) array(
                        'id' => null,
                        'login' => reset($arrInfoLadp['samaccountname']),
                        'pass' => $this->getPass(),
                        'nome' => reset($arrInfoLadp['cn']),
                        'email' => $strEmail,
                        'senhaTemporaria' => false,
                    ),
                )
            );
            $this->debugExecFile($infoUsuario);
            $authenticateResult = new Result(Result::SUCCESS, $infoUsuario, array('Autenticado com sucesso'));
        } catch (ExceptionNative $exception) {
            $this->debugExecFile($exception);
            $authenticateResult = new Result(Result::FAILURE_UNCATEGORIZED, null, array('Usuário/senha incorretos'));
        }
        return $authenticateResult;
    }

    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    public function setServiceManager($serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

}
