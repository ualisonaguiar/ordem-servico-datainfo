<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * Cep
 *
 * @ORM\Table(name="CORP.VW_CEP")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwCepRepository")
 */
class VwCep extends Entity
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="CO_CEP", type="string", length=8, nullable=false)
     */
    protected $coCep;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_MUNICIPIO", type="integer", nullable=false)
     */
    protected $coMunicipio;

    /**
     * @var string
     *
     * @ORM\Column(name="CO_UF", type="string", length=2, nullable=false)
     */
    protected $coUf;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_TIPO", type="string", length=36, nullable=true)
     */
    protected $dsTipo;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_BAIRRO", type="string", length=72, nullable=true)
     */
    protected $noBairro;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_CIDADE", type="string", length=72, nullable=false)
     */
    protected $noCidade;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_LOGRADOURO", type="string", length=100, nullable=true)
     */
    protected $noLogradouro;


    /**
     * Set coCep
     *
     * @param string $coCep
     *
     * @return Cep
     */
    public function setCoCep($coCep)
    {
        $this->coCep = $coCep;
        return $this;
    }

    /**
     * Get coCep
     *
     * @return string 
     */
    public function getCoCep()
    {
        return $this->coCep;
    }

    /**
     * Set coMunicipio
     *
     * @param integer $coMunicipio
     *
     * @return Cep
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
     * Set coUf
     *
     * @param string $coUf
     *
     * @return Cep
     */
    public function setCoUf($coUf)
    {
        $this->coUf = $coUf;
        return $this;
    }

    /**
     * Get coUf
     *
     * @return string 
     */
    public function getCoUf()
    {
        return $this->coUf;
    }

    /**
     * Set dsTipo
     *
     * @param string $dsTipo
     *
     * @return Cep
     */
    public function setDsTipo($dsTipo)
    {
        $this->dsTipo = $dsTipo;
        return $this;
    }

    /**
     * Get dsTipo
     *
     * @return string 
     */
    public function getDsTipo()
    {
        return $this->dsTipo;
    }

    /**
     * Set noBairro
     *
     * @param string $noBairro
     *
     * @return Cep
     */
    public function setNoBairro($noBairro)
    {
        $this->noBairro = $noBairro;
        return $this;
    }

    /**
     * Get noBairro
     *
     * @return string 
     */
    public function getNoBairro()
    {
        return $this->noBairro;
    }

    /**
     * Set noCidade
     *
     * @param string $noCidade
     *
     * @return Cep
     */
    public function setNoCidade($noCidade)
    {
        $this->noCidade = $noCidade;
        return $this;
    }

    /**
     * Get noCidade
     *
     * @return string 
     */
    public function getNoCidade()
    {
        return $this->noCidade;
    }

    /**
     * Set noLogradouro
     *
     * @param string $noLogradouro
     *
     * @return Cep
     */
    public function setNoLogradouro($noLogradouro)
    {
        $this->noLogradouro = $noLogradouro;
        return $this;
    }

    /**
     * Get noLogradouro
     *
     * @return string 
     */
    public function getNoLogradouro()
    {
        return $this->noLogradouro;
    }
}

