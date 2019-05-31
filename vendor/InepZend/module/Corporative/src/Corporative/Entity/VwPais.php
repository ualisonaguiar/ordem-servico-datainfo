<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Pais
 *
 * @ORM\Table(name="CORP.VW_PAIS")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwPaisRepository")
 */
class VwPais extends Entity
{

    const CO_PAIS_BRASIL = 76;
//    const CO_PAIS_BRASIL = 10;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_PAIS", type="integer", nullable=false)
     */
    protected $coPais;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_RELACAO_DIPLOMATICA", type="boolean", nullable=false)
     */
    protected $inRelacaoDiplomatica;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_NACIONALIDADE", type="string", length=30, nullable=true)
     */
    protected $noNacionalidade;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PAIS", type="string", length=80, nullable=false)
     */
    protected $noPais;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_DDI", type="integer", nullable=true)
     */
    protected $nuDdi;

    /**
     * Set coPais
     *
     * @param integer $coPais
     *
     * @return Pais
     */
    public function setCoPais($coPais)
    {
        $this->coPais = $coPais;
        return $this;
    }

    /**
     * Get coPais
     *
     * @return integer 
     */
    public function getCoPais()
    {
        return $this->coPais;
    }

    /**
     * Set inRelacaoDiplomatica
     *
     * @param boolean $inRelacaoDiplomatica
     *
     * @return Pais
     */
    public function setInRelacaoDiplomatica($inRelacaoDiplomatica)
    {
        $this->inRelacaoDiplomatica = $inRelacaoDiplomatica;
        return $this;
    }

    /**
     * Get inRelacaoDiplomatica
     *
     * @return boolean 
     */
    public function getInRelacaoDiplomatica()
    {
        return $this->inRelacaoDiplomatica;
    }

    /**
     * Set noNacionalidade
     *
     * @param string $noNacionalidade
     *
     * @return Pais
     */
    public function setNoNacionalidade($noNacionalidade)
    {
        $this->noNacionalidade = $noNacionalidade;
        return $this;
    }

    /**
     * Get noNacionalidade
     *
     * @return string 
     */
    public function getNoNacionalidade()
    {
        return $this->noNacionalidade;
    }

    /**
     * Set noPais
     *
     * @param string $noPais
     *
     * @return Pais
     */
    public function setNoPais($noPais)
    {
        $this->noPais = $noPais;
        return $this;
    }

    /**
     * Get noPais
     *
     * @return string 
     */
    public function getNoPais()
    {
        return $this->noPais;
    }

    /**
     * Set nuDdi
     *
     * @param integer $nuDdi
     *
     * @return Pais
     */
    public function setNuDdi($nuDdi)
    {
        $this->nuDdi = $nuDdi;
        return $this;
    }

    /**
     * Get nuDdi
     *
     * @return integer 
     */
    public function getNuDdi()
    {
        return $this->nuDdi;
    }

}
