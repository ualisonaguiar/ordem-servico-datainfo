<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Feriado
 *
 * @ORM\Table(name="CORP.TC_FERIADO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\FeriadoRepository")
 */
class Feriado extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_TIPO_FERIADO", type="integer", nullable=false)
     */
    protected $coTipoFeriado;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_FERIADO", type="string", length=150, nullable=true)
     */
    protected $dsFeriado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_FERIADO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtFeriado;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_FERIADO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_FERIADO_ID_FERIADO_seq", allocationSize=1, initialValue=1)
     */
    protected $idFeriado;


    /**
     * Set coTipoFeriado
     *
     * @param integer $coTipoFeriado
     *
     * @return Feriado
     */
    public function setCoTipoFeriado($coTipoFeriado)
    {
        $this->coTipoFeriado = $coTipoFeriado;
        return $this;
    }

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
     * Set dsFeriado
     *
     * @param string $dsFeriado
     *
     * @return Feriado
     */
    public function setDsFeriado($dsFeriado)
    {
        $this->dsFeriado = $dsFeriado;
        return $this;
    }

    /**
     * Get dsFeriado
     *
     * @return string 
     */
    public function getDsFeriado()
    {
        return $this->dsFeriado;
    }

    /**
     * Set dtFeriado
     *
     * @param \DateTime $dtFeriado
     *
     * @return Feriado
     */
    public function setDtFeriado($dtFeriado)
    {
        $this->dtFeriado = $dtFeriado;
        return $this;
    }

    /**
     * Get dtFeriado
     *
     * @return \DateTime 
     */
    public function getDtFeriado()
    {
        return Date::convertDate($this->dtFeriado, "d/m/Y");
    }

    /**
     * Get idFeriado
     *
     * @return integer 
     */
    public function getIdFeriado()
    {
        return $this->idFeriado;
    }
}

