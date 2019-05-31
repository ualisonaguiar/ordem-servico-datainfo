<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Usuario
 *
 * @ORM\Table(name="CORP.TC_USUARIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\UsuarioRepository")
 */
class Usuario extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_USUARIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_USUARIO_CO_USUARIO_seq", allocationSize=1, initialValue=1)
     */
    protected $coUsuario;

    /**
     * @var boolean
     *
     * @ORM\Column(name="FL_ATIVO", type="boolean", nullable=true)
     */
    protected $flAtivo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_SENHA_TEMPORARIA", type="boolean", nullable=false)
     */
    protected $inSenhaTemporaria;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_USUARIO", type="string", length=120, nullable=false)
     */
    protected $noUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CPF", type="string", length=11, nullable=true)
     */
    protected $nuCpf;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DDD", type="string", length=2, nullable=true)
     */
    protected $nuDdd;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DDD2", type="string", length=3, nullable=true)
     */
    protected $nuDdd2;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DDD3", type="string", length=3, nullable=true)
     */
    protected $nuDdd3;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_TELEFONE", type="string", length=8, nullable=true)
     */
    protected $nuTelefone;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_TELEFONE2", type="string", length=8, nullable=true)
     */
    protected $nuTelefone2;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_TELEFONE3", type="string", length=8, nullable=true)
     */
    protected $nuTelefone3;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_USUARIO", type="string", length=20, nullable=true)
     */
    protected $sgUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_EMAIL", type="string", length=120, nullable=true)
     */
    protected $txEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_EMAIL2", type="string", length=210, nullable=true)
     */
    protected $txEmail2;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_SENHA", type="string", length=50, nullable=false)
     */
    protected $txSenha;


    /**
     * Get coUsuario
     *
     * @return integer 
     */
    public function getCoUsuario()
    {
        return $this->coUsuario;
    }

    /**
     * Set flAtivo
     *
     * @param boolean $flAtivo
     *
     * @return Usuario
     */
    public function setFlAtivo($flAtivo)
    {
        $this->flAtivo = $flAtivo;
        return $this;
    }

    /**
     * Get flAtivo
     *
     * @return boolean 
     */
    public function getFlAtivo()
    {
        return $this->flAtivo;
    }

    /**
     * Set inSenhaTemporaria
     *
     * @param boolean $inSenhaTemporaria
     *
     * @return Usuario
     */
    public function setInSenhaTemporaria($inSenhaTemporaria)
    {
        $this->inSenhaTemporaria = $inSenhaTemporaria;
        return $this;
    }

    /**
     * Get inSenhaTemporaria
     *
     * @return boolean 
     */
    public function getInSenhaTemporaria()
    {
        return $this->inSenhaTemporaria;
    }

    /**
     * Set noUsuario
     *
     * @param string $noUsuario
     *
     * @return Usuario
     */
    public function setNoUsuario($noUsuario)
    {
        $this->noUsuario = $noUsuario;
        return $this;
    }

    /**
     * Get noUsuario
     *
     * @return string 
     */
    public function getNoUsuario()
    {
        return $this->noUsuario;
    }

    /**
     * Set nuCpf
     *
     * @param string $nuCpf
     *
     * @return Usuario
     */
    public function setNuCpf($nuCpf)
    {
        $this->nuCpf = $nuCpf;
        return $this;
    }

    /**
     * Get nuCpf
     *
     * @return string 
     */
    public function getNuCpf()
    {
        return $this->nuCpf;
    }

    /**
     * Set nuDdd
     *
     * @param string $nuDdd
     *
     * @return Usuario
     */
    public function setNuDdd($nuDdd)
    {
        $this->nuDdd = $nuDdd;
        return $this;
    }

    /**
     * Get nuDdd
     *
     * @return string 
     */
    public function getNuDdd()
    {
        return $this->nuDdd;
    }

    /**
     * Set nuDdd2
     *
     * @param string $nuDdd2
     *
     * @return Usuario
     */
    public function setNuDdd2($nuDdd2)
    {
        $this->nuDdd2 = $nuDdd2;
        return $this;
    }

    /**
     * Get nuDdd2
     *
     * @return string 
     */
    public function getNuDdd2()
    {
        return $this->nuDdd2;
    }

    /**
     * Set nuDdd3
     *
     * @param string $nuDdd3
     *
     * @return Usuario
     */
    public function setNuDdd3($nuDdd3)
    {
        $this->nuDdd3 = $nuDdd3;
        return $this;
    }

    /**
     * Get nuDdd3
     *
     * @return string 
     */
    public function getNuDdd3()
    {
        return $this->nuDdd3;
    }

    /**
     * Set nuTelefone
     *
     * @param string $nuTelefone
     *
     * @return Usuario
     */
    public function setNuTelefone($nuTelefone)
    {
        $this->nuTelefone = $nuTelefone;
        return $this;
    }

    /**
     * Get nuTelefone
     *
     * @return string 
     */
    public function getNuTelefone()
    {
        return $this->nuTelefone;
    }

    /**
     * Set nuTelefone2
     *
     * @param string $nuTelefone2
     *
     * @return Usuario
     */
    public function setNuTelefone2($nuTelefone2)
    {
        $this->nuTelefone2 = $nuTelefone2;
        return $this;
    }

    /**
     * Get nuTelefone2
     *
     * @return string 
     */
    public function getNuTelefone2()
    {
        return $this->nuTelefone2;
    }

    /**
     * Set nuTelefone3
     *
     * @param string $nuTelefone3
     *
     * @return Usuario
     */
    public function setNuTelefone3($nuTelefone3)
    {
        $this->nuTelefone3 = $nuTelefone3;
        return $this;
    }

    /**
     * Get nuTelefone3
     *
     * @return string 
     */
    public function getNuTelefone3()
    {
        return $this->nuTelefone3;
    }

    /**
     * Set sgUsuario
     *
     * @param string $sgUsuario
     *
     * @return Usuario
     */
    public function setSgUsuario($sgUsuario)
    {
        $this->sgUsuario = $sgUsuario;
        return $this;
    }

    /**
     * Get sgUsuario
     *
     * @return string 
     */
    public function getSgUsuario()
    {
        return $this->sgUsuario;
    }

    /**
     * Set txEmail
     *
     * @param string $txEmail
     *
     * @return Usuario
     */
    public function setTxEmail($txEmail)
    {
        $this->txEmail = $txEmail;
        return $this;
    }

    /**
     * Get txEmail
     *
     * @return string 
     */
    public function getTxEmail()
    {
        return $this->txEmail;
    }

    /**
     * Set txEmail2
     *
     * @param string $txEmail2
     *
     * @return Usuario
     */
    public function setTxEmail2($txEmail2)
    {
        $this->txEmail2 = $txEmail2;
        return $this;
    }

    /**
     * Get txEmail2
     *
     * @return string 
     */
    public function getTxEmail2()
    {
        return $this->txEmail2;
    }

    /**
     * Set txSenha
     *
     * @param string $txSenha
     *
     * @return Usuario
     */
    public function setTxSenha($txSenha)
    {
        $this->txSenha = $txSenha;
        return $this;
    }

    /**
     * Get txSenha
     *
     * @return string 
     */
    public function getTxSenha()
    {
        return $this->txSenha;
    }
}

