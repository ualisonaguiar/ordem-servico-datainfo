<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Etnia
 *
 * @ORM\Table(name="CORP.TB_ETNIA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\EtniaRepository")
 */
class Etnia extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_ETNIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_ETNIA_CO_ETNIA_seq", allocationSize=1, initialValue=1)
     */
    protected $coEtnia;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_ETNIA", type="string", length=30, nullable=false)
     */
    protected $noEtnia;


    /**
     * Get coEtnia
     *
     * @return integer 
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

