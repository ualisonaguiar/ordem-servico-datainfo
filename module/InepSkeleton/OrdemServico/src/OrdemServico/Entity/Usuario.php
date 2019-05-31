<?php

namespace OrdemServico\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Format;
use InepZend\Authentication\Module\Entity\InterfaceUsuarioAuthentication;

/**
 * @ORM\Entity(repositoryClass="OrdemServico\Entity\UsuarioRepository")
 * @ORM\Table(name="tb_usuario")
 */
class Usuario extends Entity implements InterfaceUsuarioAuthentication
{
    const CO_SITUACAO_ATIVO = 1;
    const CO_SITUACAO_INATIVO = 0;

    const CO_PERFIL_FUNCIONARIO = 1;
    const CO_PERFIL_PREPOSTO = 2;
    const CO_PERFIL_SERVIDOR = 3;
    const CO_PERFIL_GESTOR = 4;
    const CO_PERFIL_CE = 5;

    public $st_ativo;

    public static $arrPerfilUsuario = [
        self::CO_PERFIL_FUNCIONARIO => 'Funcionário',
        self::CO_PERFIL_PREPOSTO => 'Preposto',
        self::CO_PERFIL_SERVIDOR => 'Servidor',
        self::CO_PERFIL_GESTOR => 'Gestor',
        self::CO_PERFIL_CE => 'Consultor Externo',
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    protected $id_usuario;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(300)")
     * @var string
     * @@__toString
     */
    protected $no_usuario;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(12)")
     * @var string
     */
    protected $nu_pis;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(150)")
     * @var string
     */
    protected $ds_email;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(150)")
     * @var string
     */
    protected $ds_login;

    /**
     * @ORM\Column(type="integer")
     * @var string
     */
    protected $tp_vinculo;

    /**
     * @ORM\Column(type="boolean")
     * @var string
     */
    protected $in_ativo = self::CO_SITUACAO_ATIVO;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(500)")
     * @var string
     */
    protected $ds_hash_apex;

    /**
     * @ORM\Column(type="string", columnDefinition="VARCHAR(32)")
     * @var string
     */
    protected $ds_senha;

    /**
     * @return int
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param int $id_usuario
     * @return Usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    /**
     * @return string
     */
    public function getNoUsuario()
    {
        return $this->no_usuario;
    }

    /**
     * @param string $no_usuario
     * @return Usuario
     */
    public function setNoUsuario($no_usuario)
    {
        $this->no_usuario = $no_usuario;
        return $this;
    }

    /**
     * @return string
     */
    public function getNuPis()
    {
        return $this->nu_pis;
    }

    /**
     * @param string $nu_pis
     * @return Usuario
     */
    public function setNuPis($nu_pis)
    {
        $this->nu_pis = Format::clearMask($nu_pis);
        return $this;
    }

    /**
     * @return string
     */
    public function getDsEmail()
    {
        return $this->ds_email;
    }

    /**
     * @param string $ds_email
     * @return Usuario
     */
    public function setDsEmail($ds_email)
    {
        $this->ds_email = $ds_email;
        return $this;
    }

    /**
     * @return string
     */
    public function getDsLogin()
    {
        return $this->ds_login;
    }

    /**
     * @param string $ds_login
     * @return Usuario
     */
    public function setDsLogin($ds_login)
    {
        $this->ds_login = $ds_login;
        return $this;
    }

    /**
     * @return string
     */
    public function getInAtivo()
    {
        return $this->in_ativo;
    }

    /**
     * @param string $in_ativo
     * @return Usuario
     */
    public function setInAtivo($in_ativo)
    {
        $this->in_ativo = $in_ativo;
        return $this;
    }

    /**
     * @return string
     */
    public function getTpVinculo()
    {
        return $this->tp_vinculo;
    }

    /**
     * @param string $tp_vinculo
     * @return Usuario
     */
    public function setTpVinculo($tp_vinculo)
    {
        $this->tp_vinculo = $tp_vinculo;
        return $this;
    }

    /**
     * @return string
     */
    public function getDsHashApex()
    {
        return $this->ds_hash_apex;
    }

    /**
     * @param string $ds_hash_apex
     * @return Usuario
     */
    public function setDsHashApex($ds_hash_apex)
    {
        $this->ds_hash_apex = $ds_hash_apex;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStAtivo()
    {
        return $this->st_ativo;
    }

    /**
     * @param mixed $st_ativo
     * @return Usuario
     */
    public function setStAtivo($st_ativo)
    {
        $this->st_ativo = $st_ativo;
        return $this;
    }

    /**
     * @return string
     */
    public function getDsSenha()
    {
        return $this->ds_senha;
    }

    /**
     * @param string $ds_senha
     * @return Usuario
     */
    public function setDsSenha($ds_senha)
    {
        $this->ds_senha = md5($ds_senha);
        return $this;
    }

    public function getTpPerfil()
    {
        return $this->getTpVinculo();
    }
}
