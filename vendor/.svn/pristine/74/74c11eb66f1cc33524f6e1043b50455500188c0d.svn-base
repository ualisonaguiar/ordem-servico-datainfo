<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * TipoNecessidadeEspecial
 *
 * @ORM\Table(name="CORP.TB_TIPO_NECESSIDADE_ESPECIAL")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\TipoNecessidadeEspecialRepository")
 */
class TipoNecessidadeEspecial extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_NECESSIDADE_ESPECIAL", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_TIPO_NECESSIDADE_ESPECIAL_I", allocationSize=1, initialValue=1)
     */
    protected $idTipoNecessidadeEspecial;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_NECESSIDADE_ESPECIAL", type="string", length=100, nullable=false)
     */
    protected $noTipoNecessidadeEspecial;


    /**
     * Get idTipoNecessidadeEspecial
     *
     * @return integer 
     */
    public function getIdTipoNecessidadeEspecial()
    {
        return $this->idTipoNecessidadeEspecial;
    }

    /**
     * Set noTipoNecessidadeEspecial
     *
     * @param string $noTipoNecessidadeEspecial
     *
     * @return TipoNecessidadeEspecial
     */
    public function setNoTipoNecessidadeEspecial($noTipoNecessidadeEspecial)
    {
        $this->noTipoNecessidadeEspecial = $noTipoNecessidadeEspecial;
        return $this;
    }

    /**
     * Get noTipoNecessidadeEspecial
     *
     * @return string 
     */
    public function getNoTipoNecessidadeEspecial()
    {
        return $this->noTipoNecessidadeEspecial;
    }
}

