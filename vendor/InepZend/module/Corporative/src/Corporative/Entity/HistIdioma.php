<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistIdioma
 *
 * @ORM\Table(name="CORP.TB_HIST_IDIOMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\HistIdiomaRepository")
 */
class HistIdioma extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_IDIOMA", type="integer", nullable=false)
     * @ORM\Id
     */
    protected $coIdioma;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    protected $idUsuarioAlteracao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_IDIOMA", type="string", length=50, nullable=false)
     */
    protected $noIdioma;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     */
    protected $nuOperacao;


    /**
     * Set coIdioma
     *
     * @param integer $coIdioma
     *
     * @return HistIdioma
     */
    public function setCoIdioma($coIdioma)
    {
        $this->coIdioma = $coIdioma;
        return $this;
    }

    /**
     * Get coIdioma
     *
     * @return integer 
     */
    public function getCoIdioma()
    {
        return $this->coIdioma;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistIdioma
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
     * @return HistIdioma
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
     * Set noIdioma
     *
     * @param string $noIdioma
     *
     * @return HistIdioma
     */
    public function setNoIdioma($noIdioma)
    {
        $this->noIdioma = $noIdioma;
        return $this;
    }

    /**
     * Get noIdioma
     *
     * @return string 
     */
    public function getNoIdioma()
    {
        return $this->noIdioma;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistIdioma
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

