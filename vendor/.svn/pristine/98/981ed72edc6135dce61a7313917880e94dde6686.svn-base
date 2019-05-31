<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * NecessidadeEspecial
 *
 * @ORM\Table(name="CORP.VW_NECESSIDADE_ESPECIAL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwNecessidadeEspecialRepository")
 */
class VwNecessidadeEspecial extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_NECESSIDADE_ESPECIAL", type="string", length=500, nullable=true)
     */
    protected $dsNecessidadeEspecial;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_NECESSIDADE_ESPECIAL", type="integer", nullable=false)
     */
    protected $idNecessidadeEspecial;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_NECESSIDADE_ESPECIAL", type="string", length=130, nullable=false)
     */
    protected $noNecessidadeEspecial;


    /**
     * Set dsNecessidadeEspecial
     *
     * @param string $dsNecessidadeEspecial
     *
     * @return NecessidadeEspecial
     */
    public function setDsNecessidadeEspecial($dsNecessidadeEspecial)
    {
        $this->dsNecessidadeEspecial = $dsNecessidadeEspecial;
        return $this;
    }

    /**
     * Get dsNecessidadeEspecial
     *
     * @return string 
     */
    public function getDsNecessidadeEspecial()
    {
        return $this->dsNecessidadeEspecial;
    }

    /**
     * Set idNecessidadeEspecial
     *
     * @param integer $idNecessidadeEspecial
     *
     * @return NecessidadeEspecial
     */
    public function setIdNecessidadeEspecial($idNecessidadeEspecial)
    {
        $this->idNecessidadeEspecial = $idNecessidadeEspecial;
        return $this;
    }

    /**
     * Get idNecessidadeEspecial
     *
     * @return integer 
     */
    public function getIdNecessidadeEspecial()
    {
        return $this->idNecessidadeEspecial;
    }

    /**
     * Set noNecessidadeEspecial
     *
     * @param string $noNecessidadeEspecial
     *
     * @return NecessidadeEspecial
     */
    public function setNoNecessidadeEspecial($noNecessidadeEspecial)
    {
        $this->noNecessidadeEspecial = $noNecessidadeEspecial;
        return $this;
    }

    /**
     * Get noNecessidadeEspecial
     *
     * @return string 
     */
    public function getNoNecessidadeEspecial()
    {
        return $this->noNecessidadeEspecial;
    }
}

