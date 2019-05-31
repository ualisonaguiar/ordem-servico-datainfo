<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * PessoaEndereco
 *
 * @ORM\Table(name="CORP.TC_PESSOA_ENDERECO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\PessoaEnderecoRepository")
 */
class PessoaEndereco extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="CO_CEP", type="string", length=8, nullable=false)
     */
    protected $coCep;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_COMPLEMENTO", type="string", length=100, nullable=true)
     */
    protected $dsComplemento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_ENDERECO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CORP.SEQ_PESSOA_ENDERECO", allocationSize=1, initialValue=1)
     */
    protected $idPessoaEndereco;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_BAIRRO", type="string", length=100, nullable=true)
     */
    protected $noBairro;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_LOGRADOURO", type="string", length=100, nullable=false)
     */
    protected $noLogradouro;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_ENDERECO", type="string", length=20, nullable=false)
     */
    protected $nuEndereco;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_ENDERECO", type="string", length=1, nullable=false)
     */
    protected $tpEndereco;

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
     * @var \InepZend\Module\Corporative\Entity\Pais
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Pais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_PAIS", referencedColumnName="CO_PAIS")
     * })
     */
    protected $coPais;

    /**
     * @var \InepZend\Module\Corporative\Entity\PessoaFisica
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\PessoaFisica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_PESSOA_FISICA", referencedColumnName="ID_PESSOA_FISICA")
     * })
     */
    protected $idPessoaFisica;


    /**
     * Set coCep
     *
     * @param string $coCep
     *
     * @return PessoaEndereco
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
     * @return PessoaEndereco
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
     * Get idPessoaEndereco
     *
     * @return integer 
     */
    public function getIdPessoaEndereco()
    {
        return $this->idPessoaEndereco;
    }

    /**
     * Set noBairro
     *
     * @param string $noBairro
     *
     * @return PessoaEndereco
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
     * @return PessoaEndereco
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
     * @return PessoaEndereco
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
     * Set tpEndereco
     *
     * @param string $tpEndereco
     *
     * @return PessoaEndereco
     */
    public function setTpEndereco($tpEndereco)
    {
        $this->tpEndereco = $tpEndereco;
        return $this;
    }

    /**
     * Get tpEndereco
     *
     * @return string 
     */
    public function getTpEndereco()
    {
        return $this->tpEndereco;
    }

    /**
     * Set coMunicipio
     *
     * @param \InepZend\Module\Corporative\Entity\Municipio $coMunicipio
     *
     * @return PessoaEndereco
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

    /**
     * Set coPais
     *
     * @param \InepZend\Module\Corporative\Entity\Pais $coPais
     *
     * @return PessoaEndereco
     */
    public function setCoPais(\InepZend\Module\Corporative\Entity\Pais $coPais = null)
    {
        $this->coPais = $coPais;
        return $this;
    }

    /**
     * Get coPais
     *
     * @return \InepZend\Module\Corporative\Entity\Pais 
     */
    public function getCoPais()
    {
        return $this->coPais;
    }

    /**
     * Set idPessoaFisica
     *
     * @param \InepZend\Module\Corporative\Entity\PessoaFisica $idPessoaFisica
     *
     * @return PessoaEndereco
     */
    public function setIdPessoaFisica(\InepZend\Module\Corporative\Entity\PessoaFisica $idPessoaFisica = null)
    {
        $this->idPessoaFisica = $idPessoaFisica;
        return $this;
    }

    /**
     * Get idPessoaFisica
     *
     * @return \InepZend\Module\Corporative\Entity\PessoaFisica 
     */
    public function getIdPessoaFisica()
    {
        return $this->idPessoaFisica;
    }
}

