<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Uf
 *
 * @ORM\Table(name="CORP.VW_UF")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwUfRepository")
 */
class VwUf extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_REGIAO", type="integer", nullable=false)
     */
    protected $coRegiao;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_UF", type="integer", nullable=false)
     */
    protected $coUf;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_REGIAO", type="string", length=20, nullable=false)
     */
    protected $noRegiao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_UF", type="string", length=50, nullable=false)
     */
    protected $noUf;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_REGIAO", type="string", length=2, nullable=false)
     */
    protected $sgRegiao;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_UF", type="string", length=2, nullable=false)
     */
    protected $sgUf;


    /**
     * Set coRegiao
     *
     * @param integer $coRegiao
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
     * @return integer 
     */
    public function getCoRegiao()
    {
        return $this->coRegiao;
    }

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
     *
     * @return string 
     */
    public function getNoUf()
    {
        return $this->noUf;
    }

    /**
     * Set sgRegiao
     *
     * @param string $sgRegiao
     *
     * @return Uf
     */
    public function setSgRegiao($sgRegiao)
    {
        $this->sgRegiao = $sgRegiao;
        return $this;
    }

    /**
     * Get sgRegiao
     *
     * @return string 
     */
    public function getSgRegiao()
    {
        return $this->sgRegiao;
    }

    /**
     * Set sgUf
     *
     * @param string $sgUf
     *
     * @return Uf
     */
    public function setSgUf($sgUf)
    {
        $this->sgUf = $sgUf;
        return $this;
    }

    /**
     * Get sgUf
     *
     * @return string 
     */
    public function getSgUf()
    {
        return $this->sgUf;
    }
}

