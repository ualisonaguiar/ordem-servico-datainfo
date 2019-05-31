<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * TipoFeriado
 *
 * @ORM\Table(name="CORP.TC_TIPO_FERIADO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\TipoFeriadoRepository")
 */
class TipoFeriado extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_TIPO_FERIADO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_TIPO_FERIADO_CO_TIPO_FERIAD", allocationSize=1, initialValue=1)
     */
    protected $coTipoFeriado;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_TIPO_FERIADO", type="string", length=100, nullable=false)
     */
    protected $dsTipoFeriado;


    /**
     * Get coTipoFeriado
     *
     * @return integer 
     */
    public function getCoTipoFeriado()
    {
        return $this->coTipoFeriado;
    }

    /**
     * Set dsTipoFeriado
     *
     * @param string $dsTipoFeriado
     *
     * @return TipoFeriado
     */
    public function setDsTipoFeriado($dsTipoFeriado)
    {
        $this->dsTipoFeriado = $dsTipoFeriado;
        return $this;
    }

    /**
     * Get dsTipoFeriado
     *
     * @return string 
     */
    public function getDsTipoFeriado()
    {
        return $this->dsTipoFeriado;
    }
}

