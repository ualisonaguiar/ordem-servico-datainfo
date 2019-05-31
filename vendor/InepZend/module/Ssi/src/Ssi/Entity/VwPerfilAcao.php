<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * PerfilAcao
 *
 * @ORM\Table(name="SSI.VW_PERFIL_ACAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\VwPerfilAcaoRepository")
 */
class VwPerfilAcao extends Entity
{

    const TP_ACAO_TELA = 1;
    const TP_ACAO_MENU = 2;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_ACAO", type="string", length=512, nullable=true)
     */
    private $dsAcao;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_PERFIL", type="string", length=512, nullable=true)
     */
    private $dsPerfil;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_ACAO", type="integer", nullable=false)
     */
    private $idAcao;

    /**
     * @var integer
     * 
     * @ORM\Id
     * @ORM\Column(name="ID_PERFIL", type="integer", nullable=false)
     */
    private $idPerfil;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PERFIL_ACAO", type="bigint", nullable=false)
     */
    private $idPerfilAcao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PERFIL_PAI", type="integer", nullable=true)
     */
    private $idPerfilPai;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_SISTEMA", type="smallint", nullable=false)
     */
    private $idSistema;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO_ACAO", type="boolean", nullable=false)
     */
    private $inAtivoAcao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO_PERFIL", type="boolean", nullable=false)
     */
    private $inAtivoPerfil;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO_PERFIL_ACAO", type="boolean", nullable=false)
     */
    private $inAtivoPerfilAcao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO_SISTEMA", type="boolean", nullable=false)
     */
    private $inAtivoSistema;

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="NO_ACAO", type="string", length=120, nullable=false)
     */
    private $noAcao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PERFIL", type="string", length=120, nullable=false)
     */
    private $noPerfil;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SISTEMA", type="string", length=250, nullable=false)
     */
    private $noSistema;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_PERFIL", type="string", length=50, nullable=true)
     */
    private $noTipoPerfil;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_ACAO", type="string", length=50, nullable=false)
     */
    private $sgAcao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="TP_ACAO", type="integer", nullable=false)
     */
    private $tpAcao;

    /**
     * Set dsAcao
     *
     * @param string $dsAcao
     *
     * @return PerfilAcao
     */
    public function setDsAcao($dsAcao)
    {
        $this->dsAcao = $dsAcao;
        return $this;
    }

    /**
     * Get dsAcao
     *
     * @return string 
     */
    public function getDsAcao()
    {
        return $this->dsAcao;
    }

    /**
     * Set dsPerfil
     *
     * @param string $dsPerfil
     *
     * @return PerfilAcao
     */
    public function setDsPerfil($dsPerfil)
    {
        $this->dsPerfil = $dsPerfil;
        return $this;
    }

    /**
     * Get dsPerfil
     *
     * @return string 
     */
    public function getDsPerfil()
    {
        return $this->dsPerfil;
    }

    /**
     * Set idAcao
     *
     * @param integer $idAcao
     *
     * @return PerfilAcao
     */
    public function setIdAcao($idAcao)
    {
        $this->idAcao = $idAcao;
        return $this;
    }

    /**
     * Get idAcao
     *
     * @return integer 
     */
    public function getIdAcao()
    {
        return $this->idAcao;
    }

    /**
     * Set idPerfil
     *
     * @param integer $idPerfil
     *
     * @return PerfilAcao
     */
    public function setIdPerfil($idPerfil)
    {
        $this->idPerfil = $idPerfil;
        return $this;
    }

    /**
     * Get idPerfil
     *
     * @return integer 
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    /**
     * Set idPerfilAcao
     *
     * @param integer $idPerfilAcao
     *
     * @return PerfilAcao
     */
    public function setIdPerfilAcao($idPerfilAcao)
    {
        $this->idPerfilAcao = $idPerfilAcao;
        return $this;
    }

    /**
     * Get idPerfilAcao
     *
     * @return integer 
     */
    public function getIdPerfilAcao()
    {
        return $this->idPerfilAcao;
    }

    /**
     * Set idPerfilPai
     *
     * @param integer $idPerfilPai
     *
     * @return PerfilAcao
     */
    public function setIdPerfilPai($idPerfilPai)
    {
        $this->idPerfilPai = $idPerfilPai;
        return $this;
    }

    /**
     * Get idPerfilPai
     *
     * @return integer 
     */
    public function getIdPerfilPai()
    {
        return $this->idPerfilPai;
    }

    /**
     * Set idSistema
     *
     * @param integer $idSistema
     *
     * @return PerfilAcao
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
     * Set inAtivoAcao
     *
     * @param boolean $inAtivoAcao
     *
     * @return PerfilAcao
     */
    public function setInAtivoAcao($inAtivoAcao)
    {
        $this->inAtivoAcao = $inAtivoAcao;
        return $this;
    }

    /**
     * Get inAtivoAcao
     *
     * @return boolean 
     */
    public function getInAtivoAcao()
    {
        return $this->inAtivoAcao;
    }

    /**
     * Set inAtivoPerfil
     *
     * @param boolean $inAtivoPerfil
     *
     * @return PerfilAcao
     */
    public function setInAtivoPerfil($inAtivoPerfil)
    {
        $this->inAtivoPerfil = $inAtivoPerfil;
        return $this;
    }

    /**
     * Get inAtivoPerfil
     *
     * @return boolean 
     */
    public function getInAtivoPerfil()
    {
        return $this->inAtivoPerfil;
    }

    /**
     * Set inAtivoPerfilAcao
     *
     * @param boolean $inAtivoPerfilAcao
     *
     * @return PerfilAcao
     */
    public function setInAtivoPerfilAcao($inAtivoPerfilAcao)
    {
        $this->inAtivoPerfilAcao = $inAtivoPerfilAcao;
        return $this;
    }

    /**
     * Get inAtivoPerfilAcao
     *
     * @return boolean 
     */
    public function getInAtivoPerfilAcao()
    {
        return $this->inAtivoPerfilAcao;
    }

    /**
     * Set inAtivoSistema
     *
     * @param boolean $inAtivoSistema
     *
     * @return PerfilAcao
     */
    public function setInAtivoSistema($inAtivoSistema)
    {
        $this->inAtivoSistema = $inAtivoSistema;
        return $this;
    }

    /**
     * Get inAtivoSistema
     *
     * @return boolean 
     */
    public function getInAtivoSistema()
    {
        return $this->inAtivoSistema;
    }

    /**
     * Set noAcao
     *
     * @param string $noAcao
     *
     * @return PerfilAcao
     */
    public function setNoAcao($noAcao)
    {
        $this->noAcao = $noAcao;
        return $this;
    }

    /**
     * Get noAcao
     *
     * @return string 
     */
    public function getNoAcao()
    {
        return $this->noAcao;
    }

    /**
     * Set noPerfil
     *
     * @param string $noPerfil
     *
     * @return PerfilAcao
     */
    public function setNoPerfil($noPerfil)
    {
        $this->noPerfil = $noPerfil;
        return $this;
    }

    /**
     * Get noPerfil
     *
     * @return string 
     */
    public function getNoPerfil()
    {
        return $this->noPerfil;
    }

    /**
     * Set noSistema
     *
     * @param string $noSistema
     *
     * @return PerfilAcao
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
     * Set noTipoPerfil
     *
     * @param string $noTipoPerfil
     *
     * @return PerfilAcao
     */
    public function setNoTipoPerfil($noTipoPerfil)
    {
        $this->noTipoPerfil = $noTipoPerfil;
        return $this;
    }

    /**
     * Get noTipoPerfil
     *
     * @return string 
     */
    public function getNoTipoPerfil()
    {
        return $this->noTipoPerfil;
    }

    /**
     * Set sgAcao
     *
     * @param string $sgAcao
     *
     * @return PerfilAcao
     */
    public function setSgAcao($sgAcao)
    {
        $this->sgAcao = $sgAcao;
        return $this;
    }

    /**
     * Get sgAcao
     *
     * @return string 
     */
    public function getSgAcao()
    {
        return $this->sgAcao;
    }

    /**
     * Set tpAcao
     *
     * @param boolean $tpAcao
     *
     * @return PerfilAcao
     */
    public function setTpAcao($tpAcao)
    {
        $this->tpAcao = $tpAcao;
        return $this;
    }

    /**
     * Get tpAcao
     *
     * @return boolean 
     */
    public function getTpAcao()
    {
        return $this->tpAcao;
    }

}
