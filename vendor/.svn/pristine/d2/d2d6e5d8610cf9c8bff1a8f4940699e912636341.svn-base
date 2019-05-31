<?php

namespace InepZend\Authentication\Adapter;

use InepZend\Authentication\Module\Entity\InterfaceUsuarioAuthentication;
use OrdemServico\Service\UsuarioFile;
use Zend\Authentication\Adapter\AdapterInterface;
use OrdemServico\Entity\Usuario as UsuarioEntity;
use Zend\Authentication\Result;

class AuthBasic implements AdapterInterface
{
    protected $login;
    protected $pass;
    protected $serviceManager;
    protected $arrConfig;

    public function __construct($arrConfig = array(), $booUnitTest = null, $serviceManager = null)
    {
        $this->setServiceManager($serviceManager);
        $this->setArrConfig($arrConfig);
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($strLogin)
    {
        $this->login = $strLogin;
        return $this;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($strPass)
    {
        $this->pass = md5($strPass);
        return $this;
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

    public function getArrConfig()
    {
        return $this->arrConfig;
    }

    public function setArrConfig($arrConfig)
    {
        $this->arrConfig = $arrConfig;
        return $this;
    }

    public function authenticate()
    {
        try {
            $arrConfig = $this->getArrConfig()['paramHeaderRequest'];
            $serviceUser = $this->getServiceManager()->get($arrConfig['service']);
            if (!array_key_exists(
                InterfaceUsuarioAuthentication::class,
                class_implements($serviceUser->getEntityName()))
            ) {
                throw new \Exception(
                    'A entidade do serviço informado não está implementada a interface: ' . InterfaceUsuarioAuthentication::class
                );
            }
            $arrUsuario = $serviceUser->findBy([
                $arrConfig['user'] => $this->getLogin(),
                $arrConfig['password'] => $this->getPass(),
            ]);
            if (!$arrUsuario) {
                throw new \Exception('Usuário/Senha incorreto.');
            }
            $usuario = $arrUsuario[0];
            if (!$usuario->getInAtivo()) {
                throw new \Exception('Usuário com acesso bloqueado.');
            }
            $arrPerfil = UsuarioEntity::$arrPerfilUsuario;

            $infoUsuario = (object) [
                'usuarioSistema' => (object) [
                    'id' => $usuario->getIdUsuario(),
                    'dataSituacao' => null,
                    'perfis' => [
                        (object) [
                            'id' => null,
                            'descricao' => null,
                            'nome' => $arrPerfil[$usuario->getTpVinculo()],
                            'acoes' => []
                        ]
                    ],
                    'sistema' => (object) [
                        'id' => null,
                        'descricao' => null,
                        'nome' => null,
                    ],
                    'usuario' => (object) [
                        'id' => $usuario->getIdUsuario(),
                        'login' => $usuario->getDsLogin(),
                        'pass' => $usuario->getDsSenha(),
                        'nome' => $usuario->getNoUsuario(),
                        'email' => $usuario->getDsEmail(),
                        'senhaTemporaria' => false,
                    ],
                ]
            ];
            $authenticateResult = new Result(Result::SUCCESS, $infoUsuario, array('Autenticado com sucesso'));
        } catch (\Exception $exception) {
            $authenticateResult = new Result(Result::FAILURE_UNCATEGORIZED, null, array($exception->getMessage()));
        }
        return $authenticateResult;
    }

    public function alterarSenha($intCoUsuario, $strSenhaAntiga, $strSenhaNova)
    {
        $retorno = new \stdClass();
        try {
            $strSenhaAntiga = $this->unhashPass($strSenhaAntiga);
            $strSenhaNova = $this->unhashPass($strSenhaNova);
            $arrUsuario = $this->getServiceManager()->get(UsuarioFile::class)->getUserSession();
            $arrUsuario = $arrUsuario[0]->toArray();
            if ($arrUsuario['ds_senha'] !== md5($strSenhaAntiga)) {
                throw new \Exception('A senha antiga informada não confere com está salvo no banco de dados');
            }
            $arrUsuario['ds_senha'] = $strSenhaNova;
            $this->getServiceManager()->get(UsuarioFile::class)->save($arrUsuario);
            $retorno->response = 'Senha alterada com sucesso';
            $retorno->status = 'OK';
            $retorno->messages = $retorno->response;

        } catch (\Exception $exception) {
            $retorno = new Result(Result::FAILURE_UNCATEGORIZED, null, $exception->getMessage());
            $retorno->status = 'FALHA';
        }
        return $retorno;

    }

    protected function unhashPass($strHash)
    {
        return (empty($strHash)) ? false : base64_decode(substr(base64_decode($strHash), strlen($this->getHex())));
    }

    private function getHex()
    {
        $strHash = hash('sha256', 'r&$T%$@#I%n*e@P');
        $strHex = '';
        for ($i = 0; $i < strlen($strHash); ++$i)
            $strHex .= dechex((int)$strHash[$i]);
        return $strHex;
    }

}