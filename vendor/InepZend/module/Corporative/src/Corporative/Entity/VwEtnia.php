<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Etnia
 *
 * @ORM\Table(name="CORP.VW_ETNIA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwEtniaRepository")
 */
class VwEtnia extends Entity
{

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_ETNIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $coEtnia;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_ETNIA", type="string", length=30, nullable=false)
     */
    protected $noEtnia;

    /**
     * Set coEtnia
     *
     * @param boolean $coEtnia
     *
     * @return Etnia
     */
    public function setCoEtnia($coEtnia)
    {
        $this->coEtnia = $coEtnia;
        return $this;
    }

    /**
     * Get coEtnia
     *
     * @return boolean 
     */
    public function getCoEtnia()
    {
        return $this->coEtnia;
    }

    /**
     * Set noEtnia
     *
     * @param string $noEtnia
     *
     * @return Etnia
     */
    public function setNoEtnia($noEtnia)
    {
        $this->noEtnia = $noEtnia;
        return $this;
    }

    /**
     * Get noEtnia
     *
     * @return string 
     */
    public function getNoEtnia()
    {
        return $this->noEtnia;
    }

}
