<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * ComponenteOrganizacional
 *
 * @ORM\Table(name="CORP.TB_COMPONENTE_ORGANIZACIONAL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\ComponenteOrganizacionalRepository")
 */
class ComponenteOrganizacional extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_COMPONENTE_ORGANIZACIONAL", type="string", length=500, nullable=true)
     */
    protected $dsComponenteOrganizacional;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_COMPONENTE_ORGANIZACIONAL", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_COMPONENTE_ORGANIZACIONAL_I", allocationSize=1, initialValue=1)
     */
    protected $idComponenteOrganizacional;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    protected $inAtivo;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_COMPONENTE_ORGANIZACIONAL", type="string", length=100, nullable=false)
     */
    protected $noComponenteOrganizacional;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     */
    protected $nuOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_COMPONENTE_ORGANIZACIONAL", type="string", length=50, nullable=false)
     */
    protected $sgComponenteOrganizacional;

    /**
     * @var integer
     *
     * @ORM\Column(name="TP_COMPONENTE", type="integer", nullable=false)
     */
    protected $tpComponente;

    /**
     * @var \InepZend\Module\Corporative\Entity\ComponenteOrganizacional
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\ComponenteOrganizacional")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_COMPONENTE_ORG_PAI", referencedColumnName="ID_COMPONENTE_ORGANIZACIONAL")
     * })
     */
    protected $idComponenteOrgPai;

    /**
     * @var \InepZend\Module\Corporative\Entity\UsuarioSistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\UsuarioSistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_USUARIO_ALTERACAO", referencedColumnName="CO_USUARIO_SISTEMA")
     * })
     */
    protected $idUsuarioAlteracao;


    /**
     * Set dsComponenteOrganizacional
     *
     * @param string $dsComponenteOrganizacional
     *
     * @return ComponenteOrganizacional
     */
    public function setDsComponenteOrganizacional($dsComponenteOrganizacional)
    {
        $this->dsComponenteOrganizacional = $dsComponenteOrganizacional;
        return $this;
    }

    /**
     * Get dsComponenteOrganizacional
     *
     * @return string 
     */
    public function getDsComponenteOrganizacional()
    {
        return $this->dsComponenteOrganizacional;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return ComponenteOrganizacional
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
     * Get idComponenteOrganizacional
     *
     * @return integer 
     */
    public function getIdComponenteOrganizacional()
    {
        return $this->idComponenteOrganizacional;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return ComponenteOrganizacional
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
     * Set noComponenteOrganizacional
     *
     * @param string $noComponenteOrganizacional
     *
     * @return ComponenteOrganizacional
     */
    public function setNoComponenteOrganizacional($noComponenteOrganizacional)
    {
        $this->noComponenteOrganizacional = $noComponenteOrganizacional;
        return $this;
    }

    /**
     * Get noComponenteOrganizacional
     *
     * @return string 
     */
    public function getNoComponenteOrganizacional()
    {
        return $this->noComponenteOrganizacional;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return ComponenteOrganizacional
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
     * Set sgComponenteOrganizacional
     *
     * @param string $sgComponenteOrganizacional
     *
     * @return ComponenteOrganizacional
     */
    public function setSgComponenteOrganizacional($sgComponenteOrganizacional)
    {
        $this->sgComponenteOrganizacional = $sgComponenteOrganizacional;
        return $this;
    }

    /**
     * Get sgComponenteOrganizacional
     *
     * @return string 
     */
    public function getSgComponenteOrganizacional()
    {
        return $this->sgComponenteOrganizacional;
    }

    /**
     * Set tpComponente
     *
     * @param integer $tpComponente
     *
     * @return ComponenteOrganizacional
     */
    public function setTpComponente($tpComponente)
    {
        $this->tpComponente = $tpComponente;
        return $this;
    }

    /**
     * Get tpComponente
     *
     * @return integer 
     */
    public function getTpComponente()
    {
        return $this->tpComponente;
    }

    /**
     * Set idComponenteOrgPai
     *
     * @param \InepZend\Module\Corporative\Entity\ComponenteOrganizacional $idComponenteOrgPai
     *
     * @return ComponenteOrganizacional
     */
    public function setIdComponenteOrgPai(\InepZend\Module\Corporative\Entity\ComponenteOrganizacional $idComponenteOrgPai = null)
    {
        $this->idComponenteOrgPai = $idComponenteOrgPai;
        return $this;
    }

    /**
     * Get idComponenteOrgPai
     *
     * @return \InepZend\Module\Corporative\Entity\ComponenteOrganizacional 
     */
    public function getIdComponenteOrgPai()
    {
        return $this->idComponenteOrgPai;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param \InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao
     *
     * @return ComponenteOrganizacional
     */
    public function setIdUsuarioAlteracao(\InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao = null)
    {
        $this->idUsuarioAlteracao = $idUsuarioAlteracao;
        return $this;
    }

    /**
     * Get idUsuarioAlteracao
     *
     * @return \InepZend\Module\Corporative\Entity\UsuarioSistema 
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->idUsuarioAlteracao;
    }
}

