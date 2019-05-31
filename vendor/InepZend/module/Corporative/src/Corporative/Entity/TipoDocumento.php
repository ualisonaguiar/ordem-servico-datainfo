<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * TipoDocumento
 *
 * @ORM\Table(name="CORP.TC_TIPO_DOCUMENTO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\TipoDocumentoRepository")
 */
class TipoDocumento extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_TIPO_DOCUMENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_TIPO_DOCUMENTO_CO_TIPO_DOCU", allocationSize=1, initialValue=1)
     */
    protected $coTipoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_DOCUMENTO", type="string", length=60, nullable=false)
     */
    protected $noTipoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_TIPO_DOCUMENTO", type="string", length=10, nullable=true)
     */
    protected $sgTipoDocumento;


    /**
     * Get coTipoDocumento
     *
     * @return integer 
     */
    public function getCoTipoDocumento()
    {
        return $this->coTipoDocumento;
    }

    /**
     * Set noTipoDocumento
     *
     * @param string $noTipoDocumento
     *
     * @return TipoDocumento
     */
    public function setNoTipoDocumento($noTipoDocumento)
    {
        $this->noTipoDocumento = $noTipoDocumento;
        return $this;
    }

    /**
     * Get noTipoDocumento
     *
     * @return string 
     */
    public function getNoTipoDocumento()
    {
        return $this->noTipoDocumento;
    }

    /**
     * Set sgTipoDocumento
     *
     * @param string $sgTipoDocumento
     *
     * @return TipoDocumento
     */
    public function setSgTipoDocumento($sgTipoDocumento)
    {
        $this->sgTipoDocumento = $sgTipoDocumento;
        return $this;
    }

    /**
     * Get sgTipoDocumento
     *
     * @return string 
     */
    public function getSgTipoDocumento()
    {
        return $this->sgTipoDocumento;
    }
}

