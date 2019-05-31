<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistPrograma
 *
 * @ORM\Table(name="CORP.TB_HIST_PROGRAMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\HistProgramaRepository")
 */
class HistPrograma extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PROGRAMA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $coPrograma;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_PROGRAMA", type="string", length=500, nullable=true)
     */
    protected $dsPrograma;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=false)
     */
    protected $idUsuarioAlteracao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=true)
     */
    protected $inAtivo;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PROGRAMA", type="string", length=130, nullable=false)
     */
    protected $noPrograma;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $nuOperacao;


    /**
     * Set coPrograma
     *
     * @param integer $coPrograma
     *
     * @return HistPrograma
     */
    public function setCoPrograma($coPrograma)
    {
        $this->coPrograma = $coPrograma;
        return $this;
    }

    /**
     * Get coPrograma
     *
     * @return integer 
     */
    public function getCoPrograma()
    {
        return $this->coPrograma;
    }

    /**
     * Set dsPrograma
     *
     * @param string $dsPrograma
     *
     * @return HistPrograma
     */
    public function setDsPrograma($dsPrograma)
    {
        $this->dsPrograma = $dsPrograma;
        return $this;
    }

    /**
     * Get dsPrograma
     *
     * @return string 
     */
    public function getDsPrograma()
    {
        return $this->dsPrograma;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistPrograma
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
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistPrograma
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
     * @return HistPrograma
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
     * Set noPrograma
     *
     * @param string $noPrograma
     *
     * @return HistPrograma
     */
    public function setNoPrograma($noPrograma)
    {
        $this->noPrograma = $noPrograma;
        return $this;
    }

    /**
     * Get noPrograma
     *
     * @return string 
     */
    public function getNoPrograma()
    {
        return $this->noPrograma;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistPrograma
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

