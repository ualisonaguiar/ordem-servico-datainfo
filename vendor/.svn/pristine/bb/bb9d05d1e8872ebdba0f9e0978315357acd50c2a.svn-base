<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogPerfil
 *
 * @ORM\Table(name="SSI.TB_LOG_PERFIL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogPerfilRepository")
 */
class LogPerfil extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_PERFIL", type="string", length=512, nullable=true)
     */
    private $dsPerfil;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    private $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_HISTORICO_ACESSO", type="integer", nullable=false)
     */
    private $idHistoricoAcesso;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PERFIL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idPerfil;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PERFIL_PAI", type="integer", nullable=true)
     */
    private $idPerfilPai;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SISTEMA", type="smallint", nullable=false)
     */
    private $idSistema;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PERFIL", type="string", length=120, nullable=false)
     */
    private $noPerfil;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_PERFIL", type="string", length=50, nullable=true)
     */
    private $noTipoPerfil;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;


    /**
     * Set dsPerfil
     *
     * @param string $dsPerfil
     *
     * @return LogPerfil
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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogPerfil
     */
    public function setDtAlteracao($dtAlteracao)
    {
        $this->dtAlteracao = $dtAlteracao;
        return $this;
    }

    /**
     * Get dtAlteracao
     *
     * @return \DateTime 
     */
    public function getDtAlteracao()
    {
        return Date::convertDate($this->dtAlteracao, "d/m/Y");
    }

    /**
     * Set idHistoricoAcesso
     *
     * @param integer $idHistoricoAcesso
     *
     * @return LogPerfil
     */
    public function setIdHistoricoAcesso($idHistoricoAcesso)
    {
        $this->idHistoricoAcesso = $idHistoricoAcesso;
        return $this;
    }

    /**
     * Get idHistoricoAcesso
     *
     * @return integer 
     */
    public function getIdHistoricoAcesso()
    {
        return $this->idHistoricoAcesso;
    }

    /**
     * Set idPerfil
     *
     * @param integer $idPerfil
     *
     * @return LogPerfil
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
     * Set idPerfilPai
     *
     * @param integer $idPerfilPai
     *
     * @return LogPerfil
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
     * @return LogPerfil
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
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return LogPerfil
     */
    public function setInAtivo($inAtivo)
    {
        $this->inAtivo = $inAtivo;
        return $this;
    }

    /**
     * Get inAtivo
     *
     * @return boolean 
     */
    public function getInAtivo()
    {
        return $this->inAtivo;
    }

    /**
     * Set noPerfil
     *
     * @param string $noPerfil
     *
     * @return LogPerfil
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
     * Set noTipoPerfil
     *
     * @param string $noTipoPerfil
     *
     * @return LogPerfil
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return LogPerfil
     */
    public function setNuOperacao($nuOperacao)
    {
        $this->nuOperacao = $nuOperacao;
        return $this;
    }

    /**
     * Get nuOperacao
     *
     * @return integer 
     */
    public function getNuOperacao()
    {
        return $this->nuOperacao;
    }
}

