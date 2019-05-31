<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * ProjetoPerfil
 *
 * @ORM\Table(name="CORP.VW_PROJETO_PERFIL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwProjetoPerfilRepository")
 */
class VwProjetoPerfil extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_PROJETO", type="integer", nullable=false)
     */
    protected $coProjeto;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_PERFIL", type="integer", nullable=false)
     */
    protected $idPerfil;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    protected $inAtivo;


    /**
     * Set coProjeto
     *
     * @param integer $coProjeto
     *
     * @return ProjetoPerfil
     */
    public function setCoProjeto($coProjeto)
    {
        $this->coProjeto = $coProjeto;
        return $this;
    }

    /**
     * Get coProjeto
     *
     * @return integer 
     */
    public function getCoProjeto()
    {
        return $this->coProjeto;
    }

    /**
     * Set idPerfil
     *
     * @param integer $idPerfil
     *
     * @return ProjetoPerfil
     */
    public function setIdPerfil($idPerfil)
    {
        $this->idPerfil = $idPerfil;
        return $this;
    }

    /**
     * Get idPerfil
     *
     * @return integer 
     */
    public function getIdPerfil()
    {
        return $this->idPerfil;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return ProjetoPerfil
     */
    public function setInAtivo($inAtivo)
    {
        $this->inAtivo = $inAtivo;
        return $this;
    }

    /**
     * Get inAtivo
     *
     * @return boolean 
     */
    public function getInAtivo()
    {
        return $this->inAtivo;
    }
}

