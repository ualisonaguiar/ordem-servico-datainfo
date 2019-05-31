<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * UsuarioSemSistema
 *
 * @ORM\Table(name="SSI.VW_USUARIO_SEM_SISTEMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\VwUsuarioSemSistemaRepository")
 */
class VwUsuarioSemSistema extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_NASCIMENTO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtNascimento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_SITUACAO_USUARIO", type="integer", nullable=false)
     */
    private $idTipoSituacaoUsuario;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_USUARIO", type="integer", nullable=false)
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_LOGIN", type="string", length=255, nullable=true)
     */
    private $noLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_MAE", type="string", length=150, nullable=true)
     */
    private $noMae;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_SITUACAO_USUARIO", type="string", length=50, nullable=false)
     */
    private $noTipoSituacaoUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_USUARIO", type="string", length=120, nullable=false)
     */
    private $noUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CPF", type="string", length=11, nullable=true)
     */
    private $nuCpf;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_SEXO", type="string", length=1, nullable=false)
     */
    private $tpSexo;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_EMAIL", type="string", length=4000, nullable=true)
     */
    private $txEmail;


    /**
     * Set dtNascimento
     *
     * @param \DateTime $dtNascimento
     *
     * @return UsuarioSemSistema
     */
    public function setDtNascimento($dtNascimento)
    {
        $this->dtNascimento = $dtNascimento;
        return $this;
    }

    /**
     * Get dtNascimento
     *
     * @return \DateTime 
     */
    public function getDtNascimento()
    {
        return Date::convertDate($this->dtNascimento, "d/m/Y");
    }

    /**
     * Set idTipoSituacaoUsuario
     *
     * @param integer $idTipoSituacaoUsuario
     *
     * @return UsuarioSemSistema
     */
    public function setIdTipoSituacaoUsuario($idTipoSituacaoUsuario)
    {
        $this->idTipoSituacaoUsuario = $idTipoSituacaoUsuario;
        return $this;
    }

    /**
     * Get idTipoSituacaoUsuario
     *
     * @return integer 
     */
    public function getIdTipoSituacaoUsuario()
    {
        return $this->idTipoSituacaoUsuario;
    }

    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     *
     * @return UsuarioSemSistema
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return integer 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set noLogin
     *
     * @param string $noLogin
     *
     * @return UsuarioSemSistema
     */
    public function setNoLogin($noLogin)
    {
        $this->noLogin = $noLogin;
        return $this;
    }

    /**
     * Get noLogin
     *
     * @return string 
     */
    public function getNoLogin()
    {
        return $this->noLogin;
    }

    /**
     * Set noMae
     *
     * @param string $noMae
     *
     * @return UsuarioSemSistema
     */
    public function setNoMae($noMae)
    {
        $this->noMae = $noMae;
        return $this;
    }

    /**
     * Get noMae
     *
     * @return string 
     */
    public function getNoMae()
    {
        return $this->noMae;
    }

    /**
     * Set noTipoSituacaoUsuario
     *
     * @param string $noTipoSituacaoUsuario
     *
     * @return UsuarioSemSistema
     */
    public function setNoTipoSituacaoUsuario($noTipoSituacaoUsuario)
    {
        $this->noTipoSituacaoUsuario = $noTipoSituacaoUsuario;
        return $this;
    }

    /**
     * Get noTipoSituacaoUsuario
     *
     * @return string 
     */
    public function getNoTipoSituacaoUsuario()
    {
        return $this->noTipoSituacaoUsuario;
    }

    /**
     * Set noUsuario
     *
     * @param string $noUsuario
     *
     * @return UsuarioSemSistema
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
     * @return UsuarioSemSistema
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
     * Set tpSexo
     *
     * @param string $tpSexo
     *
     * @return UsuarioSemSistema
     */
    public function setTpSexo($tpSexo)
    {
        $this->tpSexo = $tpSexo;
        return $this;
    }

    /**
     * Get tpSexo
     *
     * @return string 
     */
    public function getTpSexo()
    {
        return $this->tpSexo;
    }

    /**
     * Set txEmail
     *
     * @param string $txEmail
     *
     * @return UsuarioSemSistema
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
}

