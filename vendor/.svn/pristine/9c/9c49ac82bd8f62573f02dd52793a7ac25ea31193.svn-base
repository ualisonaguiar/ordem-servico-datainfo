<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Subdistrito
 *
 * @ORM\Table(name="CORP.VW_SUBDISTRITO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwSubdistritoRepository")
 */
class VwSubdistrito extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_DISTRITO", type="integer", nullable=false)
     */
    protected $coDistrito;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_SUBDISTRITO", type="integer", nullable=false)
     */
    protected $coSubdistrito;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SUBDISTRITO", type="string", length=150, nullable=false)
     */
    protected $noSubdistrito;


    /**
     * Set coDistrito
     *
     * @param integer $coDistrito
     *
     * @return Subdistrito
     */
    public function setCoDistrito($coDistrito)
    {
        $this->coDistrito = $coDistrito;
        return $this;
    }

    /**
     * Get coDistrito
     *
     * @return integer 
     */
    public function getCoDistrito()
    {
        return $this->coDistrito;
    }

    /**
     * Set coSubdistrito
     *
     * @param integer $coSubdistrito
     *
     * @return Subdistrito
     */
    public function setCoSubdistrito($coSubdistrito)
    {
        $this->coSubdistrito = $coSubdistrito;
        return $this;
    }

    /**
     * Get coSubdistrito
     *
     * @return integer 
     */
    public function getCoSubdistrito()
    {
        return $this->coSubdistrito;
    }

    /**
     * Set noSubdistrito
     *
     * @param string $noSubdistrito
     *
     * @return Subdistrito
     */
    public function setNoSubdistrito($noSubdistrito)
    {
        $this->noSubdistrito = $noSubdistrito;
        return $this;
    }

    /**
     * Get noSubdistrito
     *
     * @return string 
     */
    public function getNoSubdistrito()
    {
        return $this->noSubdistrito;
    }
}

