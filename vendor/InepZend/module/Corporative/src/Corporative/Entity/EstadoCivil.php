<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * EstadoCivil
 *
 * @ORM\Table(name="CORP.TB_ESTADO_CIVIL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\EstadoCivilRepository")
 */
class EstadoCivil extends Entity
{

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_ESTADO_CIVIL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $coEstadoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_ESTADO_CIVIL", type="string", length=50, nullable=false)
     */
    protected $noEstadoCivil;

    /**
     * Set coEstadoCivil
     *
     * @param integer $coEstadoCivil
     *
     * @return EstadoCivil
     */
    public function setCoEstadoCivil($coEstadoCivil)
    {
        $this->coEstadoCivil = $coEstadoCivil;
        return $this;
    }

    /**
     * Get coEstadoCivil
     *
     * @return integer 
     */
    public function getCoEstadoCivil()
    {
        return $this->coEstadoCivil;
    }

    /**
     * Set noEstadoCivil
     *
     * @param string $noEstadoCivil
     *
     * @return EstadoCivil
     */
    public function setNoEstadoCivil($noEstadoCivil)
    {
        $this->noEstadoCivil = $noEstadoCivil;
        return $this;
    }

    /**
     * Get noEstadoCivil
     * @@__toString
     *
     * @return string 
     */
    public function getNoEstadoCivil()
    {
        return $this->noEstadoCivil;
    }

}
