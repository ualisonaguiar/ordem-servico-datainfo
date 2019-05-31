<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Regiao
 *
 * @ORM\Table(name="CORP.VW_REGIAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwRegiaoRepository")
 */
class VwRegiao extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PAIS", type="integer", nullable=false)
     */
    protected $coPais;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_REGIAO", type="integer", nullable=false)
     */
    protected $coRegiao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_REGIAO", type="string", length=20, nullable=false)
     */
    protected $noRegiao;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_REGIAO", type="string", length=2, nullable=false)
     */
    protected $sgRegiao;


    /**
     * Set coPais
     *
     * @param integer $coPais
     *
     * @return Regiao
     */
    public function setCoPais($coPais)
    {
        $this->coPais = $coPais;
        return $this;
    }

    /**
     * Get coPais
     *
     * @return integer 
     */
    public function getCoPais()
    {
        return $this->coPais;
    }

    /**
     * Set coRegiao
     *
     * @param integer $coRegiao
     *
     * @return Regiao
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
     * Set noRegiao
     *
     * @param string $noRegiao
     *
     * @return Regiao
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
     * Set sgRegiao
     *
     * @param string $sgRegiao
     *
     * @return Regiao
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
}

