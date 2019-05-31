<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Distrito
 *
 * @ORM\Table(name="CORP.TC_DISTRITO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\DistritoRepository")
 */
class Distrito extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_DISTRITO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $coDistrito;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_MUNICIPIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $coMunicipio;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_DISTRITO", type="string", length=80, nullable=false)
     */
    protected $noDistrito;


    /**
     * Set coDistrito
     *
     * @param integer $coDistrito
     *
     * @return Distrito
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
     * Set coMunicipio
     *
     * @param integer $coMunicipio
     *
     * @return Distrito
     */
    public function setCoMunicipio($coMunicipio)
    {
        $this->coMunicipio = $coMunicipio;
        return $this;
    }

    /**
     * Get coMunicipio
     *
     * @return integer 
     */
    public function getCoMunicipio()
    {
        return $this->coMunicipio;
    }

    /**
     * Set noDistrito
     *
     * @param string $noDistrito
     *
     * @return Distrito
     */
    public function setNoDistrito($noDistrito)
    {
        $this->noDistrito = $noDistrito;
        return $this;
    }

    /**
     * Get noDistrito
     *
     * @return string 
     */
    public function getNoDistrito()
    {
        return $this->noDistrito;
    }
}

