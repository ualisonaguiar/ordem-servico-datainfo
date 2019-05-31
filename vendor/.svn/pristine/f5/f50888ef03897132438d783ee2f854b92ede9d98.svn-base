<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * PerfilDependencia
 *
 * @ORM\Table(name="SSI.TB_PERFIL_DEPENDENCIA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\PerfilDependenciaRepository")
 */
class PerfilDependencia extends Entity
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
     * @ORM\Column(name="ID_PERFIL_DEPENDENCIA", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_PERFIL_DEPENDENCIA_ID_PERFI", allocationSize=1, initialValue=1)
     */
    private $idPerfilDependencia;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     */
    private $nuOperacao;

    /**
     * @var \InepZend\Module\Ssi\Entity\HistoricoAcesso
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\HistoricoAcesso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_HISTORICO_ACESSO", referencedColumnName="ID_HISTORICO_ACESSO")
     * })
     */
    private $idHistoricoAcesso;

    /**
     * @var \InepZend\Module\Ssi\Entity\Perfil
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\Perfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_PERFIL_PAI", referencedColumnName="ID_PERFIL")
     * })
     */
    private $idPerfilPai;

    /**
     * @var \InepZend\Module\Ssi\Entity\Perfil
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\Perfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_PERFIL", referencedColumnName="ID_PERFIL")
     * })
     */
    private $idPerfil;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return PerfilDependencia
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
     * Get idPerfilDependencia
     *
     * @return integer 
     */
    public function getIdPerfilDependencia()
    {
        return $this->idPerfilDependencia;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return PerfilDependencia
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
     * @return PerfilDependencia
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

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return PerfilDependencia
     */
    public function setIdHistoricoAcesso(\InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso = null)
    {
        $this->idHistoricoAcesso = $idHistoricoAcesso;
        return $this;
    }

    /**
     * Get idHistoricoAcesso
     *
     * @return \InepZend\Module\Ssi\Entity\HistoricoAcesso 
     */
    public function getIdHistoricoAcesso()
    {
        return $this->idHistoricoAcesso;
    }

    /**
     * Set idPerfilPai
     *
     * @param \InepZend\Module\Ssi\Entity\Perfil $idPerfilPai
     *
     * @return PerfilDependencia
     */
    public function setIdPerfilPai(\InepZend\Module\Ssi\Entity\Perfil $idPerfilPai = null)
    {
        $this->idPerfilPai = $idPerfilPai;
        return $this;
    }

    /**
     * Get idPerfilPai
     *
     * @return \InepZend\Module\Ssi\Entity\Perfil 
     */
    public function getIdPerfilPai()
    {
        return $this->idPerfilPai;
    }

    /**
     * Set idPerfil
     *
     * @param \InepZend\Module\Ssi\Entity\Perfil $idPerfil
     *
     * @return PerfilDependencia
     */
    public function setIdPerfil(\InepZend\Module\Ssi\Entity\Perfil $idPerfil = null)
    {
        $this->idPerfil = $idPerfil;
        return $this;
    }

    /**
     * Get idPerfil
     *
     * @return \InepZend\Module\Ssi\Entity\Perfil 
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }
}

