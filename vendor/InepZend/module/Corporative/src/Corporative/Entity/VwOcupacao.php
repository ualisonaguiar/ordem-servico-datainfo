<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Ocupacao
 *
 * @ORM\Table(name="CORP.VW_OCUPACAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwOcupacaoRepository")
 */
class VwOcupacao extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="CO_CBO", type="string", length=4, nullable=true)
     */
    protected $coCbo;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_OCUPACAO", type="smallint", nullable=false)
     */
    protected $idOcupacao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_CBO", type="string", length=200, nullable=true)
     */
    protected $noCbo;


    /**
     * Set coCbo
     *
     * @param string $coCbo
     *
     * @return Ocupacao
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
     * Set idOcupacao
     *
     * @param integer $idOcupacao
     *
     * @return Ocupacao
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
     * Set noCbo
     *
     * @param string $noCbo
     *
     * @return Ocupacao
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
}

