<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * MunicipioDdd
 *
 * @ORM\Table(name="CORP.VW_MUNICIPIO_DDD")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwMunicipioDddRepository")
 */
class VwMunicipioDdd extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_MUNICIPIO", type="integer", nullable=false)
     */
    protected $coMunicipio;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_DDD", type="integer", nullable=false)
     */
    protected $nuDdd;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_TAMANHO_TELEFONE", type="integer", nullable=true)
     */
    protected $nuTamanhoTelefone;


    /**
     * Set coMunicipio
     *
     * @param integer $coMunicipio
     *
     * @return MunicipioDdd
     */
    public function setCoMunicipio($coMunicipio)
    {
        $this->coMunicipio = $coMunicipio;
        return $this;
    }

    /**
     * Get coMunicipio
     *
     * @return integer 
     */
    public function getCoMunicipio()
    {
        return $this->coMunicipio;
    }

    /**
     * Set nuDdd
     *
     * @param integer $nuDdd
     *
     * @return MunicipioDdd
     */
    public function setNuDdd($nuDdd)
    {
        $this->nuDdd = $nuDdd;
        return $this;
    }

    /**
     * Get nuDdd
     *
     * @return integer 
     */
    public function getNuDdd()
    {
        return $this->nuDdd;
    }

    /**
     * Set nuTamanhoTelefone
     *
     * @param integer $nuTamanhoTelefone
     *
     * @return MunicipioDdd
     */
    public function setNuTamanhoTelefone($nuTamanhoTelefone)
    {
        $this->nuTamanhoTelefone = $nuTamanhoTelefone;
        return $this;
    }

    /**
     * Get nuTamanhoTelefone
     *
     * @return integer 
     */
    public function getNuTamanhoTelefone()
    {
        return $this->nuTamanhoTelefone;
    }
}

