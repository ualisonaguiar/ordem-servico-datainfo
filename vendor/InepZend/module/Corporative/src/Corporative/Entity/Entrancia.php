<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Entrancia
 *
 * @ORM\Table(name="CORP.TB_ENTRANCIA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\EntranciaRepository")
 */
class Entrancia extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_ENTRANCIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_ENTRANCIA_ID_ENTRANCIA_seq", allocationSize=1, initialValue=1)
     */
    protected $idEntrancia;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_ENTRANCIA", type="string", length=50, nullable=false)
     */
    protected $noEntrancia;


    /**
     * Get idEntrancia
     *
     * @return integer 
     */
    public function getIdEntrancia()
    {
        return $this->idEntrancia;
    }

    /**
     * Set noEntrancia
     *
     * @param string $noEntrancia
     *
     * @return Entrancia
     */
    public function setNoEntrancia($noEntrancia)
    {
        $this->noEntrancia = $noEntrancia;
        return $this;
    }

    /**
     * Get noEntrancia
     *
     * @return string 
     */
    public function getNoEntrancia()
    {
        return $this->noEntrancia;
    }
}

