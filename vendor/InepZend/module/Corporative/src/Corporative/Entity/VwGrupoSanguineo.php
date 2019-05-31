<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * GrupoSanguineo
 *
 * @ORM\Table(name="CORP.VW_GRUPO_SANGUINEO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwGrupoSanguineoRepository")
 */
class VwGrupoSanguineo extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_GRUPO_SANGUINEO", type="integer", nullable=false)
     */
    protected $idGrupoSanguineo;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_GRUPO_SANGUINEO", type="string", length=3, nullable=false)
     */
    protected $sgGrupoSanguineo;


    /**
     * Set idGrupoSanguineo
     *
     * @param integer $idGrupoSanguineo
     *
     * @return GrupoSanguineo
     */
    public function setIdGrupoSanguineo($idGrupoSanguineo)
    {
        $this->idGrupoSanguineo = $idGrupoSanguineo;
        return $this;
    }

    /**
     * Get idGrupoSanguineo
     *
     * @return integer 
     */
    public function getIdGrupoSanguineo()
    {
        return $this->idGrupoSanguineo;
    }

    /**
     * Set sgGrupoSanguineo
     *
     * @param string $sgGrupoSanguineo
     *
     * @return GrupoSanguineo
     */
    public function setSgGrupoSanguineo($sgGrupoSanguineo)
    {
        $this->sgGrupoSanguineo = $sgGrupoSanguineo;
        return $this;
    }

    /**
     * Get sgGrupoSanguineo
     *
     * @return string 
     */
    public function getSgGrupoSanguineo()
    {
        return $this->sgGrupoSanguineo;
    }
}

