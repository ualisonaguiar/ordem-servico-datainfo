<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistComponenteOrg
 *
 * @ORM\Table(name="CORP.TB_HIST_COMPONENTE_ORG")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\HistComponenteOrgRepository")
 */
class HistComponenteOrg extends Entity
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
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $idComponenteOrganizacional;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_COMPONENTE_ORG_PAI", type="smallint", nullable=true)
     */
    protected $idComponenteOrgPai;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=false)
     */
    protected $idUsuarioAlteracao;

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
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
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
     * Set dsComponenteOrganizacional
     *
     * @param string $dsComponenteOrganizacional
     *
     * @return HistComponenteOrg
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
     * @return HistComponenteOrg
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
     * Set idComponenteOrganizacional
     *
     * @param integer $idComponenteOrganizacional
     *
     * @return HistComponenteOrg
     */
    public function setIdComponenteOrganizacional($idComponenteOrganizacional)
    {
        $this->idComponenteOrganizacional = $idComponenteOrganizacional;
        return $this;
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
     * Set idComponenteOrgPai
     *
     * @param integer $idComponenteOrgPai
     *
     * @return HistComponenteOrg
     */
    public function setIdComponenteOrgPai($idComponenteOrgPai)
    {
        $this->idComponenteOrgPai = $idComponenteOrgPai;
        return $this;
    }

    /**
     * Get idComponenteOrgPai
     *
     * @return integer 
     */
    public function getIdComponenteOrgPai()
    {
        return $this->idComponenteOrgPai;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistComponenteOrg
     */
    public function setIdUsuarioAlteracao($idUsuarioAlteracao)
    {
        $this->idUsuarioAlteracao = $idUsuarioAlteracao;
        return $this;
    }

    /**
     * Get idUsuarioAlteracao
     *
     * @return integer 
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->idUsuarioAlteracao;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return HistComponenteOrg
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
     * @return HistComponenteOrg
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
     * @return HistComponenteOrg
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
     * @return HistComponenteOrg
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
     * @return HistComponenteOrg
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
}

