<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Moeda
 *
 * @ORM\Table(name="CORP.TC_MOEDA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\MoedaRepository")
 */
class Moeda extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_MOEDA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_MOEDA_ID_MOEDA_seq", allocationSize=1, initialValue=1)
     */
    protected $idMoeda;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_MOEDA", type="string", length=100, nullable=true)
     */
    protected $noMoeda;


    /**
     * Get idMoeda
     *
     * @return integer 
     */
    public function getIdMoeda()
    {
        return $this->idMoeda;
    }

    /**
     * Set noMoeda
     *
     * @param string $noMoeda
     *
     * @return Moeda
     */
    public function setNoMoeda($noMoeda)
    {
        $this->noMoeda = $noMoeda;
        return $this;
    }

    /**
     * Get noMoeda
     *
     * @return string 
     */
    public function getNoMoeda()
    {
        return $this->noMoeda;
    }
}

