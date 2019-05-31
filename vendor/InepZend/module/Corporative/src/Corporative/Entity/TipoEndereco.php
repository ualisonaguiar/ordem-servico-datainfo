<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * TipoEndereco
 *
 * @ORM\Table(name="CORP.TB_TIPO_ENDERECO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\TipoEnderecoRepository")
 */
class TipoEndereco extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_ENDERECO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_TIPO_ENDERECO_ID_TIPO_ENDER", allocationSize=1, initialValue=1)
     */
    protected $idTipoEndereco;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_ENDERECO", type="string", length=100, nullable=false)
     */
    protected $noTipoEndereco;


    /**
     * Get idTipoEndereco
     *
     * @return integer 
     */
    public function getIdTipoEndereco()
    {
        return $this->idTipoEndereco;
    }

    /**
     * Set noTipoEndereco
     *
     * @param string $noTipoEndereco
     *
     * @return TipoEndereco
     */
    public function setNoTipoEndereco($noTipoEndereco)
    {
        $this->noTipoEndereco = $noTipoEndereco;
        return $this;
    }

    /**
     * Get noTipoEndereco
     *
     * @return string 
     */
    public function getNoTipoEndereco()
    {
        return $this->noTipoEndereco;
    }
}

