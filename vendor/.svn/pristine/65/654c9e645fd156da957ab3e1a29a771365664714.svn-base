<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Usuario
 *
 * @ORM\Table(name="SSI.VW_USUARIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\VwUsuarioRepository")
 */
class VwUsuario extends Entity
{

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_EXPIRACAO_USUARIO",type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtExpiracaoUsuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_NASCIMENTO",type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtNascimento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SISTEMA", type="smallint", nullable=false)
     */
    private $idSistema;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_SITUACAO_USUARIO", type="integer", nullable=false)
     */
    private $idTipoSituacaoUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_USUARIO", type="integer", nullable=false)
     */
    private $idTipoUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TP_SITUACAO_USUARIO_SISTEMA", type="integer", nullable=false)
     */
    private $idTpSituacaoUsuarioSistema;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO", type="integer", nullable=false)
     */
    private $idUsuario;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_USUARIO_SISTEMA", type="integer", nullable=false)
     */
    private $idUsuarioSistema;

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
     * @ORM\Column(name="NO_SISTEMA", type="string", length=250, nullable=false)
     */
    private $noSistema;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_SITUACAO_USUARIO", type="string", length=50, nullable=false)
     */
    private $noTipoSituacaoUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_USUARIO", type="string", length=100, nullable=false)
     */
    private $noTipoUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TP_SITUACAO_USUARIO_SISTEMA", type="string", length=50, nullable=false)
     */
    private $noTpSituacaoUsuarioSistema;

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
     * Set dtExpiracaoUsuario
     *
     * @param \DateTime $dtExpiracaoUsuario
     *
     * @return Usuario
     */
    public function setDtExpiracaoUsuario($dtExpiracaoUsuario)
    {
        $this->dtExpiracaoUsuario = $dtExpiracaoUsuario;
        return $this;
    }

    /**
     * Get dtExpiracaoUsuario
     *
     * @return \DateTime 
     */
    public function getDtExpiracaoUsuario()
    {
        return Date::convertDate($this->dtExpiracaoUsuario, 'd/m/Y');
    }

    /**
     * Set dtNascimento
     *
     * @param \DateTime $dtNascimento
     *
     * @return Usuario
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
        return Date::convertDate($this->dtNascimento, 'd/m/Y');
    }

    /**
     * Set idSistema
     *
     * @param integer $idSistema
     *
     * @return Usuario
     */
    public function setIdSistema($idSistema)
    {
        $this->idSistema = $idSistema;
        return $this;
    }

    /**
     * Get idSistema
     *
     * @return integer 
     */
    public function getIdSistema()
    {
        return $this->idSistema;
    }

    /**
     * Set idTipoSituacaoUsuario
     *
     * @param integer $idTipoSituacaoUsuario
     *
     * @return Usuario
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
     * Set idTipoUsuario
     *
     * @param integer $idTipoUsuario
     *
     * @return Usuario
     */
    public function setIdTipoUsuario($idTipoUsuario)
    {
        $this->idTipoUsuario = $idTipoUsuario;
        return $this;
    }

    /**
     * Get idTipoUsuario
     *
     * @return integer 
     */
    public function getIdTipoUsuario()
    {
        return $this->idTipoUsuario;
    }

    /**
     * Set idTpSituacaoUsuarioSistema
     *
     * @param integer $idTpSituacaoUsuarioSistema
     *
     * @return Usuario
     */
    public function setIdTpSituacaoUsuarioSistema($idTpSituacaoUsuarioSistema)
    {
        $this->idTpSituacaoUsuarioSistema = $idTpSituacaoUsuarioSistema;
        return $this;
    }

    /**
     * Get idTpSituacaoUsuarioSistema
     *
     * @return integer 
     */
    public function getIdTpSituacaoUsuarioSistema()
    {
        return $this->idTpSituacaoUsuarioSistema;
    }

    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     *
     * @return Usuario
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
     * Set idUsuarioSistema
     *
     * @param integer $idUsuarioSistema
     *
     * @return Usuario
     */
    public function setIdUsuarioSistema($idUsuarioSistema)
    {
        $this->idUsuarioSistema = $idUsuarioSistema;
        return $this;
    }

    /**
     * Get idUsuarioSistema
     *
     * @return integer 
     */
    public function getIdUsuarioSistema()
    {
        return $this->idUsuarioSistema;
    }

    /**
     * Set noLogin
     *
     * @param string $noLogin
     *
     * @return Usuario
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
     * @return Usuario
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
     * Set noSistema
     *
     * @param string $noSistema
     *
     * @return Usuario
     */
    public function setNoSistema($noSistema)
    {
        $this->noSistema = $noSistema;
        return $this;
    }

    /**
     * Get noSistema
     *
     * @return string 
     */
    public function getNoSistema()
    {
        return $this->noSistema;
    }

    /**
     * Set noTipoSituacaoUsuario
     *
     * @param string $noTipoSituacaoUsuario
     *
     * @return Usuario
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
     * Set noTipoUsuario
     *
     * @param string $noTipoUsuario
     *
     * @return Usuario
     */
    public function setNoTipoUsuario($noTipoUsuario)
    {
        $this->noTipoUsuario = $noTipoUsuario;
        return $this;
    }

    /**
     * Get noTipoUsuario
     *
     * @return string 
     */
    public function getNoTipoUsuario()
    {
        return $this->noTipoUsuario;
    }

    /**
     * Set noTpSituacaoUsuarioSistema
     *
     * @param string $noTpSituacaoUsuarioSistema
     *
     * @return Usuario
     */
    public function setNoTpSituacaoUsuarioSistema($noTpSituacaoUsuarioSistema)
    {
        $this->noTpSituacaoUsuarioSistema = $noTpSituacaoUsuarioSistema;
        return $this;
    }

    /**
     * Get noTpSituacaoUsuarioSistema
     *
     * @return string 
     */
    public function getNoTpSituacaoUsuarioSistema()
    {
        return $this->noTpSituacaoUsuarioSistema;
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
     * Set tpSexo
     *
     * @param string $tpSexo
     *
     * @return Usuario
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

}
