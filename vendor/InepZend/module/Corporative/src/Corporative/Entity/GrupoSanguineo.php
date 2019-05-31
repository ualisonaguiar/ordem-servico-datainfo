<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * GrupoSanguineo
 *
 * @ORM\Table(name="CORP.TB_GRUPO_SANGUINEO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\GrupoSanguineoRepository")
 */
class GrupoSanguineo extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_GRUPO_SANGUINEO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_GRUPO_SANGUINEO_ID_GRUPO_SA", allocationSize=1, initialValue=1)
     */
    protected $idGrupoSanguineo;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_GRUPO_SANGUINEO", type="string", length=3, nullable=false)
     */
    protected $sgGrupoSanguineo;


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

