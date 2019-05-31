<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * AgenciaBancaria
 *
 * @ORM\Table(name="CORP.TC_AGENCIA_BANCARIA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\AgenciaBancariaRepository")
 */
class AgenciaBancaria extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="CO_AGENCIA", type="string", length=8, nullable=false)
     */
    protected $coAgencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_BANCO", type="integer", nullable=false)
     */
    protected $coBanco;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_MUNICIPIO", type="integer", nullable=true)
     */
    protected $coMunicipio;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_UF", type="integer", nullable=true)
     */
    protected $coUf;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_COMPLEMENTO", type="string", length=100, nullable=true)
     */
    protected $dsComplemento;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_LOGRADOURO", type="string", length=100, nullable=true)
     */
    protected $dsLogradouro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtAlteracao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_CADASTRO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtCadastro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_CRIACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtCriacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_AGENCIA_BANCARIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_AGENCIA_BANCARIA_ID_AGENCIA", allocationSize=1, initialValue=1)
     */
    protected $idAgenciaBancaria;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=true)
     */
    protected $inAtivo;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_AGENCIA", type="string", length=100, nullable=true)
     */
    protected $noAgencia;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_BAIRRO", type="string", length=60, nullable=true)
     */
    protected $noBairro;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CEP", type="string", length=8, nullable=true)
     */
    protected $nuCep;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CNPJ", type="string", length=14, nullable=true)
     */
    protected $nuCnpj;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DDD", type="string", length=3, nullable=true)
     */
    protected $nuDdd;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DV", type="string", length=2, nullable=true)
     */
    protected $nuDv;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_TELEFONE", type="string", length=10, nullable=true)
     */
    protected $nuTelefone;


    /**
     * Set coAgencia
     *
     * @param string $coAgencia
     *
     * @return AgenciaBancaria
     */
    public function setCoAgencia($coAgencia)
    {
        $this->coAgencia = $coAgencia;
        return $this;
    }

    /**
     * Get coAgencia
     *
     * @return string 
     */
    public function getCoAgencia()
    {
        return $this->coAgencia;
    }

    /**
     * Set coBanco
     *
     * @param integer $coBanco
     *
     * @return AgenciaBancaria
     */
    public function setCoBanco($coBanco)
    {
        $this->coBanco = $coBanco;
        return $this;
    }

    /**
     * Get coBanco
     *
     * @return integer 
     */
    public function getCoBanco()
    {
        return $this->coBanco;
    }

    /**
     * Set coMunicipio
     *
     * @param integer $coMunicipio
     *
     * @return AgenciaBancaria
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
     * @param integer $coUf
     *
     * @return AgenciaBancaria
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
     * Set dsComplemento
     *
     * @param string $dsComplemento
     *
     * @return AgenciaBancaria
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
     * Set dsLogradouro
     *
     * @param string $dsLogradouro
     *
     * @return AgenciaBancaria
     */
    public function setDsLogradouro($dsLogradouro)
    {
        $this->dsLogradouro = $dsLogradouro;
        return $this;
    }

    /**
     * Get dsLogradouro
     *
     * @return string 
     */
    public function getDsLogradouro()
    {
        return $this->dsLogradouro;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return AgenciaBancaria
     */
    public function setDtAlteracao($dtAlteracao)
    {
        $this->dtAlteracao = $dtAlteracao;
        return $this;
    }

    /**
     * Get dtAlteracao
     *
     * @return \DateTime 
     */
    public function getDtAlteracao()
    {
        return Date::convertDate($this->dtAlteracao, "d/m/Y");
    }

    /**
     * Set dtCadastro
     *
     * @param \DateTime $dtCadastro
     *
     * @return AgenciaBancaria
     */
    public function setDtCadastro($dtCadastro)
    {
        $this->dtCadastro = $dtCadastro;
        return $this;
    }

    /**
     * Get dtCadastro
     *
     * @return \DateTime 
     */
    public function getDtCadastro()
    {
        return Date::convertDate($this->dtCadastro, "d/m/Y");
    }

    /**
     * Set dtCriacao
     *
     * @param \DateTime $dtCriacao
     *
     * @return AgenciaBancaria
     */
    public function setDtCriacao($dtCriacao)
    {
        $this->dtCriacao = $dtCriacao;
        return $this;
    }

    /**
     * Get dtCriacao
     *
     * @return \DateTime 
     */
    public function getDtCriacao()
    {
        return Date::convertDate($this->dtCriacao, "d/m/Y");
    }

    /**
     * Get idAgenciaBancaria
     *
     * @return integer 
     */
    public function getIdAgenciaBancaria()
    {
        return $this->idAgenciaBancaria;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return AgenciaBancaria
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
     * Set noAgencia
     *
     * @param string $noAgencia
     *
     * @return AgenciaBancaria
     */
    public function setNoAgencia($noAgencia)
    {
        $this->noAgencia = $noAgencia;
        return $this;
    }

    /**
     * Get noAgencia
     *
     * @return string 
     */
    public function getNoAgencia()
    {
        return $this->noAgencia;
    }

    /**
     * Set noBairro
     *
     * @param string $noBairro
     *
     * @return AgenciaBancaria
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
     * Set nuCep
     *
     * @param string $nuCep
     *
     * @return AgenciaBancaria
     */
    public function setNuCep($nuCep)
    {
        $this->nuCep = $nuCep;
        return $this;
    }

    /**
     * Get nuCep
     *
     * @return string 
     */
    public function getNuCep()
    {
        return $this->nuCep;
    }

    /**
     * Set nuCnpj
     *
     * @param string $nuCnpj
     *
     * @return AgenciaBancaria
     */
    public function setNuCnpj($nuCnpj)
    {
        $this->nuCnpj = $nuCnpj;
        return $this;
    }

    /**
     * Get nuCnpj
     *
     * @return string 
     */
    public function getNuCnpj()
    {
        return $this->nuCnpj;
    }

    /**
     * Set nuDdd
     *
     * @param string $nuDdd
     *
     * @return AgenciaBancaria
     */
    public function setNuDdd($nuDdd)
    {
        $this->nuDdd = $nuDdd;
        return $this;
    }

    /**
     * Get nuDdd
     *
     * @return string 
     */
    public function getNuDdd()
    {
        return $this->nuDdd;
    }

    /**
     * Set nuDv
     *
     * @param string $nuDv
     *
     * @return AgenciaBancaria
     */
    public function setNuDv($nuDv)
    {
        $this->nuDv = $nuDv;
        return $this;
    }

    /**
     * Get nuDv
     *
     * @return string 
     */
    public function getNuDv()
    {
        return $this->nuDv;
    }

    /**
     * Set nuTelefone
     *
     * @param string $nuTelefone
     *
     * @return AgenciaBancaria
     */
    public function setNuTelefone($nuTelefone)
    {
        $this->nuTelefone = $nuTelefone;
        return $this;
    }

    /**
     * Get nuTelefone
     *
     * @return string 
     */
    public function getNuTelefone()
    {
        return $this->nuTelefone;
    }
}

