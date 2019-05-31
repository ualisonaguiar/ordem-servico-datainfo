<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * CartorioEndereco
 *
 * @ORM\Table(name="CORP.TC_CARTORIO_ENDERECO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\CartorioEnderecoRepository")
 */
class CartorioEndereco extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="CO_CEP", type="string", length=8, nullable=true)
     */
    protected $coCep;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_COMPLEMENTO", type="string", length=200, nullable=true)
     */
    protected $dsComplemento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_CARTORIO_ENDERECO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_CARTORIO_ENDERECO_ID_CARTOR", allocationSize=1, initialValue=1)
     */
    protected $idCartorioEndereco;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    protected $inAtivo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="NO_BAIRRO", type="string", length=200, nullable=true)
     */
    protected $noBairro;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_LOGRADOURO", type="string", length=200, nullable=true)
     */
    protected $noLogradouro;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_ENDERECO", type="string", length=20, nullable=true)
     */
    protected $nuEndereco;

    /**
     * @var \InepZend\Module\Corporative\Entity\Cartorio
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Cartorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_CARTORIO", referencedColumnName="ID_CARTORIO")
     * })
     */
    protected $idCartorio;

    /**
     * @var \InepZend\Module\Corporative\Entity\Municipio
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Municipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_MUNICIPIO", referencedColumnName="CO_MUNICIPIO")
     * })
     */
    protected $coMunicipio;


    /**
     * Set coCep
     *
     * @param string $coCep
     *
     * @return CartorioEndereco
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
     * Set dsComplemento
     *
     * @param string $dsComplemento
     *
     * @return CartorioEndereco
     */
    public function setDsComplemento($dsComplemento)
    {
        $this->dsComplemento = $dsComplemento;
        return $this;
    }

    /**
     * Get dsComplemento
     *
     * @return string 
     */
    public function getDsComplemento()
    {
        return $this->dsComplemento;
    }

    /**
     * Get idCartorioEndereco
     *
     * @return integer 
     */
    public function getIdCartorioEndereco()
    {
        return $this->idCartorioEndereco;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return CartorioEndereco
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
     * Set noBairro
     *
     * @param string $noBairro
     *
     * @return CartorioEndereco
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
     * Set noLogradouro
     *
     * @param string $noLogradouro
     *
     * @return CartorioEndereco
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

    /**
     * Set nuEndereco
     *
     * @param string $nuEndereco
     *
     * @return CartorioEndereco
     */
    public function setNuEndereco($nuEndereco)
    {
        $this->nuEndereco = $nuEndereco;
        return $this;
    }

    /**
     * Get nuEndereco
     *
     * @return string 
     */
    public function getNuEndereco()
    {
        return $this->nuEndereco;
    }

    /**
     * Set idCartorio
     *
     * @param \InepZend\Module\Corporative\Entity\Cartorio $idCartorio
     *
     * @return CartorioEndereco
     */
    public function setIdCartorio(\InepZend\Module\Corporative\Entity\Cartorio $idCartorio = null)
    {
        $this->idCartorio = $idCartorio;
        return $this;
    }

    /**
     * Get idCartorio
     *
     * @return \InepZend\Module\Corporative\Entity\Cartorio 
     */
    public function getIdCartorio()
    {
        return $this->idCartorio;
    }

    /**
     * Set coMunicipio
     *
     * @param \InepZend\Module\Corporative\Entity\Municipio $coMunicipio
     *
     * @return CartorioEndereco
     */
    public function setCoMunicipio(\InepZend\Module\Corporative\Entity\Municipio $coMunicipio = null)
    {
        $this->coMunicipio = $coMunicipio;
        return $this;
    }

    /**
     * Get coMunicipio
     *
     * @return \InepZend\Module\Corporative\Entity\Municipio 
     */
    public function getCoMunicipio()
    {
        return $this->coMunicipio;
    }
}

