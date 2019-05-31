<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Uf
 *
 * @ORM\Table(name="CORP.TC_UF")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\UfRepository")
 */
class Uf extends Entity
{

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_UF", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $coUf;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_UF", type="string", length=30, nullable=false)
     */
    protected $noUf;

    /**
     * @var string
     *
     * @ORM\Column(name="SGL_UF", type="string", length=2, nullable=false)
     */
    protected $sglUf;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_REGIAO", type="integer", nullable=true)
     */
    protected $coRegiao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_REGIAO", type="string", length=30, nullable=true)
     */
    protected $noRegiao;

    /**
     * Set coUf
     *
     * @param integer $coUf
     *
     * @return Uf
     */
    public function setCoUf($coUf)
    {
        $this->coUf = $coUf;
        return $this;
    }

    /**
     * Get coUf
     *
     * @return integer 
     */
    public function getCoUf()
    {
        return $this->coUf;
    }

    /**
     * Set noUf
     *
     * @param string $noUf
     *
     * @return Uf
     */
    public function setNoUf($noUf)
    {
        $this->noUf = $noUf;
        return $this;
    }

    /**
     * Get noUf
     * @@__toString
     *
     * @return string 
     */
    public function getNoUf()
    {
        return trim($this->noUf);
    }

    /**
     * Set sglUf
     *
     * @param string $sglUf
     *
     * @return Uf
     */
    public function setSglUf($sglUf)
    {
        $this->sglUf = $sglUf;
        return $this;
    }

    /**
     * Get sglUf
     *
     * @return string 
     */
    public function getSglUf()
    {
        return $this->sglUf;
    }

    /**
     * Set coRegiao
     *
     * @param boolean $coRegiao
     *
     * @return Uf
     */
    public function setCoRegiao($coRegiao)
    {
        $this->coRegiao = $coRegiao;
        return $this;
    }

    /**
     * Get coRegiao
     *
     * @return boolean 
     */
    public function getCoRegiao()
    {
        return $this->coRegiao;
    }

    /**
     * Set noRegiao
     *
     * @param string $noRegiao
     *
     * @return Uf
     */
    public function setNoRegiao($noRegiao)
    {
        $this->noRegiao = $noRegiao;
        return $this;
    }

    /**
     * Get noRegiao
     *
     * @return string 
     */
    public function getNoRegiao()
    {
        return $this->noRegiao;
    }

}
