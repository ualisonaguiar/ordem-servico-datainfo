<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * TipoContato
 *
 * @ORM\Table(name="CORP.TB_TIPO_CONTATO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\TipoContatoRepository")
 */
class TipoContato extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_CONTATO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_TIPO_CONTATO_ID_TIPO_CONTAT", allocationSize=1, initialValue=1)
     */
    protected $idTipoContato;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_CONTATO", type="string", length=100, nullable=false)
     */
    protected $noTipoContato;


    /**
     * Get idTipoContato
     *
     * @return integer 
     */
    public function getIdTipoContato()
    {
        return $this->idTipoContato;
    }

    /**
     * Set noTipoContato
     *
     * @param string $noTipoContato
     *
     * @return TipoContato
     */
    public function setNoTipoContato($noTipoContato)
    {
        $this->noTipoContato = $noTipoContato;
        return $this;
    }

    /**
     * Get noTipoContato
     *
     * @return string 
     */
    public function getNoTipoContato()
    {
        return $this->noTipoContato;
    }
}

