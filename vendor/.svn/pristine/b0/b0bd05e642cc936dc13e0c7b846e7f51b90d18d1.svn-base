<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Municipio
 *
 * @ORM\Table(name="CORP.TC_MUNICIPIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\MunicipioRepository")
 */
class Municipio extends Entity
{

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_MUNICIPIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $coMunicipio;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_MUNICIPIO_INEP", type="integer", nullable=false)
     */
    protected $coMunicipioInep;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_MUNICIPIO_OLD", type="integer", nullable=true)
     */
    protected $coMunicipioOld;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_MUNICIPIO", type="string", length=150, nullable=false)
     */
    protected $noMunicipio;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_MUNICIPIO_EXIBICAO", type="string", length=150, nullable=true)
     */
    protected $noMunicipioExibicao;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_UF", type="integer", nullable=false)
     */
    protected $coUf;

    /**
     * @var string
     *
     * @ORM\Column(name="NUM_DDD", type="string", length=2, nullable=true)
     */
    protected $numDdd;

    /**
     * @var integer
     *
     * @ORM\Column(name="NUM_CEP_INICIAL", type="integer", nullable=true)
     */
    protected $numCepInicial;

    /**
     * @var integer
     *
     * @ORM\Column(name="NUM_CEP_FINAL", type="integer", nullable=true)
     */
    protected $numCepFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="ANO_MUNICIPIO", type="string", length=4, nullable=false)
     */
    protected $anoMunicipio;

    /**
     * @var string
     *
     * @ORM\Column(name="IN_LOCAL_PROVA_ENEM", type="string", length=1, nullable=false)
     */
    protected $inLocalProvaEnem;

    /**
     * Set coMunicipio
     *
     * @param integer $coMunicipio
     *
     * @return Municipio
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
     * Set coMunicipioInep
     *
     * @param integer $coMunicipioInep
     *
     * @return Municipio
     */
    public function setCoMunicipioInep($coMunicipioInep)
    {
        $this->coMunicipioInep = $coMunicipioInep;
        return $this;
    }

    /**
     * Get coMunicipioInep
     *
     * @return integer 
     */
    public function getCoMunicipioInep()
    {
        return $this->coMunicipioInep;
    }

    /**
     * Set coMunicipioOld
     *
     * @param integer $coMunicipioOld
     *
     * @return Municipio
     */
    public function setCoMunicipioOld($coMunicipioOld)
    {
        $this->coMunicipioOld = $coMunicipioOld;
        return $this;
    }

    /**
     * Get coMunicipioOld
     *
     * @return integer 
     */
    public function getCoMunicipioOld()
    {
        return $this->coMunicipioOld;
    }

    /**
     * Set noMunicipio
     *
     * @param string $noMunicipio
     *
     * @return Municipio
     */
    public function setNoMunicipio($noMunicipio)
    {
        $this->noMunicipio = $noMunicipio;
        return $this;
    }

    /**
     * Get noMunicipio
     * @@__toString
     *
     * @return string 
     */
    public function getNoMunicipio()
    {
        return $this->noMunicipio;
    }

    /**
     * Set noMunicipioExibicao
     *
     * @param string $noMunicipioExibicao
     *
     * @return Municipio
     */
    public function setNoMunicipioExibicao($noMunicipioExibicao)
    {
        $this->noMunicipioExibicao = $noMunicipioExibicao;
        return $this;
    }

    /**
     * Get noMunicipioExibicao
     *
     * @return string 
     */
    public function getNoMunicipioExibicao()
    {
        return $this->noMunicipioExibicao;
    }

    /**
     * Set coUf
     *
     * @param integer $coUf
     *
     * @return Municipio
     */
    public function setCoUf($coUf)
    {
        $this->coUf = $coUf;
        return $this;
    }

    /**
     * Get coUf
     *
     * @return integer 
     */
    public function getCoUf()
    {
        return $this->coUf;
    }

    /**
     * Set numDdd
     *
     * @param string $numDdd
     *
     * @return Municipio
     */
    public function setNumDdd($numDdd)
    {
        $this->numDdd = $numDdd;
        return $this;
    }

    /**
     * Get numDdd
     *
     * @return string 
     */
    public function getNumDdd()
    {
        return $this->numDdd;
    }

    /**
     * Set numCepInicial
     *
     * @param integer $numCepInicial
     *
     * @return Municipio
     */
    public function setNumCepInicial($numCepInicial)
    {
        $this->numCepInicial = $numCepInicial;
        return $this;
    }

    /**
     * Get numCepInicial
     *
     * @return integer 
     */
    public function getNumCepInicial()
    {
        return $this->numCepInicial;
    }

    /**
     * Set numCepFinal
     *
     * @param integer $numCepFinal
     *
     * @return Municipio
     */
    public function setNumCepFinal($numCepFinal)
    {
        $this->numCepFinal = $numCepFinal;
        return $this;
    }

    /**
     * Get numCepFinal
     *
     * @return integer 
     */
    public function getNumCepFinal()
    {
        return $this->numCepFinal;
    }

    /**
     * Set anoMunicipio
     *
     * @param string $anoMunicipio
     *
     * @return Municipio
     */
    public function setAnoMunicipio($anoMunicipio)
    {
        $this->anoMunicipio = $anoMunicipio;
        return $this;
    }

    /**
     * Get anoMunicipio
     *
     * @return string 
     */
    public function getAnoMunicipio()
    {
        return $this->anoMunicipio;
    }

    /**
     * Set inLocalProvaEnem
     *
     * @param string $inLocalProvaEnem
     *
     * @return Municipio
     */
    public function setInLocalProvaEnem($inLocalProvaEnem)
    {
        $this->inLocalProvaEnem = $inLocalProvaEnem;
        return $this;
    }

    /**
     * Get inLocalProvaEnem
     *
     * @return string 
     */
    public function getInLocalProvaEnem()
    {
        return $this->inLocalProvaEnem;
    }

    public function getNoMunicipioSgUf()
    {
        return $this->getNoMunicipio() . '/' . $this->getSgUf();
    }

}
