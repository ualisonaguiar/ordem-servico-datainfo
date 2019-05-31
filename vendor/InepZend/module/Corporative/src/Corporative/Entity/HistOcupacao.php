<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistOcupacao
 *
 * @ORM\Table(name="CORP.TB_HIST_OCUPACAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\HistOcupacaoRepository")
 */
class HistOcupacao extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="CO_CBO", type="string", length=4, nullable=true)
     * @ORM\Id
     */
    protected $coCbo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_OCUPACAO", type="smallint", nullable=true)
     */
    protected $idOcupacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    protected $idUsuarioAlteracao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_CBO", type="string", length=200, nullable=true)
     */
    protected $noCbo;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     */
    protected $nuOperacao;


    /**
     * Set coCbo
     *
     * @param string $coCbo
     *
     * @return HistOcupacao
     */
    public function setCoCbo($coCbo)
    {
        $this->coCbo = $coCbo;
        return $this;
    }

    /**
     * Get coCbo
     *
     * @return string 
     */
    public function getCoCbo()
    {
        return $this->coCbo;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistOcupacao
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
     * Set idOcupacao
     *
     * @param integer $idOcupacao
     *
     * @return HistOcupacao
     */
    public function setIdOcupacao($idOcupacao)
    {
        $this->idOcupacao = $idOcupacao;
        return $this;
    }

    /**
     * Get idOcupacao
     *
     * @return integer 
     */
    public function getIdOcupacao()
    {
        return $this->idOcupacao;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistOcupacao
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
     * Set noCbo
     *
     * @param string $noCbo
     *
     * @return HistOcupacao
     */
    public function setNoCbo($noCbo)
    {
        $this->noCbo = $noCbo;
        return $this;
    }

    /**
     * Get noCbo
     *
     * @return string 
     */
    public function getNoCbo()
    {
        return $this->noCbo;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistOcupacao
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

