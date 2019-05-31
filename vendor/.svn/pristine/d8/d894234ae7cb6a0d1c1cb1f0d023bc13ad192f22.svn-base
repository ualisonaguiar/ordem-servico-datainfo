<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogPerfilDependencia
 *
 * @ORM\Table(name="SSI.TB_LOG_PERFIL_DEPENDENCIA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogPerfilDependenciaRepository")
 */
class LogPerfilDependencia extends Entity
{
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
     * @ORM\Column(name="ID_PERFIL_DEPENDENCIA", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idPerfilDependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PERFIL_PAI", type="integer", nullable=false)
     */
    private $idPerfilPai;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=true)
     */
    private $inAtivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogPerfilDependencia
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
     * @return LogPerfilDependencia
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
     * @return LogPerfilDependencia
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
     * Set idPerfilDependencia
     *
     * @param integer $idPerfilDependencia
     *
     * @return LogPerfilDependencia
     */
    public function setIdPerfilDependencia($idPerfilDependencia)
    {
        $this->idPerfilDependencia = $idPerfilDependencia;
        return $this;
    }

    /**
     * Get idPerfilDependencia
     *
     * @return integer 
     */
    public function getIdPerfilDependencia()
    {
        return $this->idPerfilDependencia;
    }

    /**
     * Set idPerfilPai
     *
     * @param integer $idPerfilPai
     *
     * @return LogPerfilDependencia
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
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return LogPerfilDependencia
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return LogPerfilDependencia
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

