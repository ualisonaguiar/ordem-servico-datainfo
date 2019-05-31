<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Pais
 *
 * @ORM\Table(name="CORP.TC_PAIS")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\PaisRepository")
 */
class Pais extends Entity
{

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PAIS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $coPais;

    /**
     * @var string
     *
     * @ORM\Column(name="CO_PAIS_ISO", type="string", length=3, nullable=true)
     */
    protected $coPaisIso;

    /**
     * @var string
     *
     * @ORM\Column(name="CO_PAIS_ISO_ALPHA2", type="string", length=2, nullable=true)
     */
    protected $coPaisIsoAlpha2;

//    protected $coPaisIsoNum;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PAIS", type="string", length=80, nullable=true)
     */
    protected $noPais;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_NACIONALIDADE", type="string", length=30, nullable=true)
     */
    protected $noNacionalidade;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DDI", type="string", length=7, nullable=true)
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
     * Set coPaisIso
     *
     * @param string $coPaisIso
     *
     * @return Pais
     */
    public function setCoPaisIso($coPaisIso)
    {
        $this->coPaisIso = $coPaisIso;
        return $this;
    }

    /**
     * Get coPaisIso
     *
     * @return string 
     */
    public function getCoPaisIso()
    {
        return $this->coPaisIso;
    }

    /**
     * Set coPaisIsoAlpha2
     *
     * @param string $coPaisIsoAlpha2
     *
     * @return Pais
     */
    public function setCoPaisIsoAlpha2($coPaisIsoAlpha2)
    {
        $this->coPaisIsoAlpha2 = $coPaisIsoAlpha2;
        return $this;
    }

    /**
     * Get coPaisIsoAlpha2
     *
     * @return string 
     */
    public function getCoPaisIsoAlpha2()
    {
        return $this->coPaisIsoAlpha2;
    }

    /**
     * Set coPaisIsoNum
     *
     * @param string $coPaisIsoNum
     *
     * @return Pais
     */
    public function setCoPaisIsoNum($coPaisIsoNum)
    {
        $this->coPaisIsoNum = $coPaisIsoNum;
        return $this;
    }

    /**
     * Get coPaisIsoNum
     *
     * @return string 
     */
    public function getCoPaisIsoNum()
    {
        return $this->coPaisIsoNum;
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
     * @@__toString
     *
     * @return string 
     */
    public function getNoPais()
    {
        return $this->noPais;
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
     * Set nuDdi
     *
     * @param string $nuDdi
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
     * @return string 
     */
    public function getNuDdi()
    {
        return $this->nuDdi;
    }

}
