<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Programa
 *
 * @ORM\Table(name="CORP.VW_PROGRAMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwProgramaRepository")
 */
class VwPrograma extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_PROGRAMA", type="integer", nullable=false)
     */
    protected $coPrograma;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_PROGRAMA", type="string", length=500, nullable=true)
     */
    protected $dsPrograma;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PROGRAMA", type="string", length=130, nullable=false)
     */
    protected $noPrograma;


    /**
     * Set coPrograma
     *
     * @param integer $coPrograma
     *
     * @return Programa
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
     * @return Programa
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
     * Set noPrograma
     *
     * @param string $noPrograma
     *
     * @return Programa
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
}

