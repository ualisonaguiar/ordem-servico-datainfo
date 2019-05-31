<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Regiao
 *
 * @ORM\Table(name="CORP.TC_REGIAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\RegiaoRepository")
 */
class Regiao extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_REGIAO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_REGIAO_CO_REGIAO_seq", allocationSize=1, initialValue=1)
     */
    protected $coRegiao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_REGIAO", type="string", length=20, nullable=true)
     */
    protected $noRegiao;

    /**
     * @var string
     *
     * @ORM\Column(name="SGL_REGIAO", type="string", length=2, nullable=true)
     */
    protected $sglRegiao;


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
     * Set sglRegiao
     *
     * @param string $sglRegiao
     *
     * @return Regiao
     */
    public function setSglRegiao($sglRegiao)
    {
        $this->sglRegiao = $sglRegiao;
        return $this;
    }

    /**
     * Get sglRegiao
     *
     * @return string 
     */
    public function getSglRegiao()
    {
        return $this->sglRegiao;
    }
}

