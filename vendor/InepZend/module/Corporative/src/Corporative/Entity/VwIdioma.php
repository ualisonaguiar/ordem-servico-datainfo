<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Idioma
 *
 * @ORM\Table(name="CORP.VW_IDIOMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwIdiomaRepository")
 */
class VwIdioma extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_IDIOMA", type="integer", nullable=false)
     */
    protected $coIdioma;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_IDIOMA", type="string", length=50, nullable=false)
     */
    protected $noIdioma;


    /**
     * Set coIdioma
     *
     * @param integer $coIdioma
     *
     * @return Idioma
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
     * Set noIdioma
     *
     * @param string $noIdioma
     *
     * @return Idioma
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
}

