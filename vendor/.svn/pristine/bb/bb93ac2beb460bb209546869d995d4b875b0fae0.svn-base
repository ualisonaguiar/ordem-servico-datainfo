<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * VwAgenciaBancaria
 *
 * @ORM\Table(name="CORP.VW_AGENCIA_BANCARIA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwAgenciaBancariaRepository")
 */
class VwAgenciaBancaria extends Entity
{

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_AGENCIA_BANCARIA", type="integer", nullable=false)
     * @ORM\Id
     */
    protected $idAgenciaBancaria;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_BANCO", type="integer", nullable=false)
     */
    protected $coBanco;

    /**
     * @var string
     *
     * @ORM\Column(name="CO_AGENCIA", type="string", length=8, nullable=false)
     */
    protected $coAgencia;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DV", type="string", length=2, nullable=true)
     */
    protected $nuDv;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_AGENCIA", type="string", length=100, nullable=true)
     */
    protected $noAgencia;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CNPJ", type="string", length=14, nullable=true)
     */
    protected $nuCnpj;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_UF", type="integer", nullable=true)
     */
    protected $coUf;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_MUNICIPIO", type="integer", nullable=true)
     */
    protected $coMunicipio;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_LOGRADOURO", type="string", length=100, nullable=true)
     */
    protected $dsLogradouro;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_COMPLEMENTO", type="string", length=100, nullable=true)
     */
    protected $dsComplemento;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_BAIRRO", type="string", length=60, nullable=true)
     */
    protected $noBairro;

    /**
     * @var string
     *
     * @ORM\Column(name="CO_CEP", type="string", length=8, nullable=true)
     */
    protected $coCep;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DDD", type="string", length=3, nullable=true)
     */
    protected $nuDdd;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_TELEFONE", type="string", length=10, nullable=true)
     */
    protected $nuTelefone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_CRIACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtCriacao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=true)
     */
    protected $inAtivo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_CADASTRO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtCadastro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtAlteracao;

    /**
     * @var \InepZend\Module\Corporative\Entity\UsuarioSistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\UsuarioSistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_USUARIO_ALTERACAO", referencedColumnName="CO_USUARIO_SISTEMA")
     * })
     */
    protected $idUsuarioAlteracao;

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
     * Get coBanco
     *
     * @return integer
     */
    public function getCoBanco()
    {
        return $this->coBanco;
    }

    /**
     * Set coBanco
     *
     * @param integer $coBanco
     *
     * @return VwAgenciaBancaria
     */
    public function setCoBanco($coBanco)
    {
        $this->coBanco = $coBanco;
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
     * Set coAgencia
     *
     * @param string $coAgencia
     *
     * @return VwAgenciaBancaria
     */
    public function setCoAgencia($coAgencia)
    {
        $this->coAgencia = $coAgencia;
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
     * Set nuDv
     *
     * @param string $nuDv
     *
     * @return VwAgenciaBancaria
     */
    public function setNuDv($nuDv)
    {
        $this->nuDv = $nuDv;
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
     * Set noAgencia
     *
     * @param string $noAgencia
     *
     * @return VwAgenciaBancaria
     */
    public function setNoAgencia($noAgencia)
    {
        $this->noAgencia = $noAgencia;
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
     * Set nuCnpj
     *
     * @param string $nuCnpj
     *
     * @return VwAgenciaBancaria
     */
    public function setNuCnpj($nuCnpj)
    {
        $this->nuCnpj = $nuCnpj;
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
     * Set coUf
     *
     * @param integer $coUf
     *
     * @return VwAgenciaBancaria
     */
    public function setCoUf($coUf)
    {
        $this->coUf = $coUf;
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
     * Set coMunicipio
     *
     * @param integer $coMunicipio
     *
     * @return VwAgenciaBancaria
     */
    public function setCoMunicipio($coMunicipio)
    {
        $this->coMunicipio = $coMunicipio;
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
     * Set dsLogradouro
     *
     * @param string $dsLogradouro
     *
     * @return VwAgenciaBancaria
     */
    public function setDsLogradouro($dsLogradouro)
    {
        $this->dsLogradouro = $dsLogradouro;
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
     * Set dsComplemento
     *
     * @param string $dsComplemento
     *
     * @return VwAgenciaBancaria
     */
    public function setDsComplemento($dsComplemento)
    {
        $this->dsComplemento = $dsComplemento;
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
     * Set noBairro
     *
     * @param string $noBairro
     *
     * @return VwAgenciaBancaria
     */
    public function setNoBairro($noBairro)
    {
        $this->noBairro = $noBairro;
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
     * Set nuCep
     *
     * @param string $coCep
     *
     * @return VwAgenciaBancaria
     */
    public function setCoCep($coCep)
    {
        $this->coCep = $coCep;
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
     * Set nuDdd
     *
     * @param string $nuDdd
     *
     * @return VwAgenciaBancaria
     */
    public function setNuDdd($nuDdd)
    {
        $this->nuDdd = $nuDdd;
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

    /**
     * Set nuTelefone
     *
     * @param string $nuTelefone
     *
     * @return VwAgenciaBancaria
     */
    public function setNuTelefone($nuTelefone)
    {
        $this->nuTelefone = $nuTelefone;
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
     * Set dtCriacao
     *
     * @param \DateTime $dtCriacao
     *
     * @return VwAgenciaBancaria
     */
    public function setDtCriacao($dtCriacao)
    {
        $this->dtCriacao = $dtCriacao;
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
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return VwAgenciaBancaria
     */
    public function setInAtivo($inAtivo)
    {
        $this->inAtivo = $inAtivo;
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
     * Set dtCadastro
     *
     * @param \DateTime $dtCadastro
     *
     * @return VwAgenciaBancaria
     */
    public function setDtCadastro($dtCadastro)
    {
        $this->dtCadastro = $dtCadastro;
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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return VwAgenciaBancaria
     */
    public function setDtAlteracao($dtAlteracao)
    {
        $this->dtAlteracao = $dtAlteracao;
        return $this;
    }

    /**
     * Get idUsuarioAlteracao
     *
     * @return \InepZend\Module\Corporative\Entity\UsuarioSistema
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->idUsuarioAlteracao;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param \InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao
     *
     * @return VwAgenciaBancaria
     */
    public function setIdUsuarioAlteracao(\InepZend\Module\Corporative\Entity\UsuarioSistema $idUsuarioAlteracao = null)
    {
        $this->idUsuarioAlteracao = $idUsuarioAlteracao;
        return $this;
    }

}
