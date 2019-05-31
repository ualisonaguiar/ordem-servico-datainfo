<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * VwSistema
 *
 * @ORM\Table(name="SSI.VW_SISTEMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\VwSistemaRepository")
 */
class VwSistema extends Entity
{

    /**
     * @var string
     *
     * @ORM\Column(name="CO_CLIENTE", type="string", length=100, nullable=true)
     */
    private $coCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_SISTEMA", type="string", length=500, nullable=true)
     */
    private $dsSistema;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SISTEMA", type="smallint", nullable=false)
     * @ORM\Id
     */
    private $idSistema;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_2FATOR", type="boolean", nullable=false)
     */
    private $in2fator = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SISTEMA", type="string", length=250, nullable=false)
     */
    private $noSistema;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_SISTEMA", type="string", length=20, nullable=true)
     */
    private $sgSistema;

    /**
     * Set coCliente
     *
     * @param string $coCliente
     *
     * @return VwSistema
     */
    public function setCoCliente($coCliente)
    {
        $this->coCliente = $coCliente;
        return $this;
    }

    /**
     * Get coCliente
     *
     * @return string 
     */
    public function getCoCliente()
    {
        return $this->coCliente;
    }

    /**
     * Set dsSistema
     *
     * @param string $dsSistema
     *
     * @return VwSistema
     */
    public function setDsSistema($dsSistema)
    {
        $this->dsSistema = $dsSistema;
        return $this;
    }

    /**
     * Get dsSistema
     *
     * @return string 
     */
    public function getDsSistema()
    {
        return $this->dsSistema;
    }

    /**
     * Get idSistema
     *
     * @return integer 
     */
    public function getIdSistema()
    {
        return $this->idSistema;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return VwSistema
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

    /**
     * Set in2fator
     *
     * @param boolean $in2fator
     *
     * @return VwSistema
     */
    public function setIn2fator($in2fator)
    {
        $this->in2fator = $in2fator;
        return $this;
    }

    /**
     * Get in2fator
     *
     * @return boolean 
     */
    public function getIn2fator()
    {
        return $this->in2fator;
    }

    /**
     * Set noSistema
     *
     * @param string $noSistema
     *
     * @return VwSistema
     */
    public function setNoSistema($noSistema)
    {
        $this->noSistema = $noSistema;
        return $this;
    }

    /**
     * Get noSistema
     *
     * @return string 
     */
    public function getNoSistema()
    {
        return $this->noSistema;
    }

    /**
     * Set sgSistema
     *
     * @param string $sgSistema
     *
     * @return VwSistema
     */
    public function setSgSistema($sgSistema)
    {
        $this->sgSistema = $sgSistema;
        return $this;
    }

    /**
     * Get sgSistema
     *
     * @return string 
     */
    public function getSgSistema()
    {
        return $this->sgSistema;
    }

}
