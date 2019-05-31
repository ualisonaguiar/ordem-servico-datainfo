<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * PessoaEnderecoLog
 *
 * @ORM\Table(name="CORP.TC_PESSOA_ENDERECO_LOG")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\PessoaEnderecoLogRepository")
 */
class PessoaEnderecoLog extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="CO_CEP", type="string", length=8, nullable=false)
     */
    protected $coCep;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_MUNICIPIO", type="integer", nullable=true)
     */
    protected $coMunicipio;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PAIS", type="integer", nullable=false)
     */
    protected $coPais;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_COMPLEMENTO", type="string", length=100, nullable=true)
     */
    protected $dsComplemento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_OPERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtOperacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_ENDERECO", type="integer", nullable=false)
     */
    protected $idPessoaEndereco;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_ENDERECO_LOG", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_PESSOA_ENDERECO_LOG_ID_PESS", allocationSize=1, initialValue=1)
     */
    protected $idPessoaEnderecoLog;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_FISICA", type="integer", nullable=false)
     */
    protected $idPessoaFisica;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_SISTEMA_OPERACAO", type="integer", nullable=true)
     */
    protected $idUsuarioSistemaOperacao;

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
     * @ORM\Column(name="SG_USUARIO_BD", type="string", length=30, nullable=true)
     */
    protected $sgUsuarioBd;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_ENDERECO", type="string", length=1, nullable=true)
     */
    protected $tpEndereco;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_OPERACAO", type="string", length=1, nullable=false)
     */
    protected $tpOperacao;


    /**
     * Set coCep
     *
     * @param string $coCep
     *
     * @return PessoaEnderecoLog
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
     * @return PessoaEnderecoLog
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
     * Set coPais
     *
     * @param integer $coPais
     *
     * @return PessoaEnderecoLog
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
     * Set dsComplemento
     *
     * @param string $dsComplemento
     *
     * @return PessoaEnderecoLog
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
     * Set dtOperacao
     *
     * @param \DateTime $dtOperacao
     *
     * @return PessoaEnderecoLog
     */
    public function setDtOperacao($dtOperacao)
    {
        $this->dtOperacao = $dtOperacao;
        return $this;
    }

    /**
     * Get dtOperacao
     *
     * @return \DateTime 
     */
    public function getDtOperacao()
    {
        return Date::convertDate($this->dtOperacao, "d/m/Y");
    }

    /**
     * Set idPessoaEndereco
     *
     * @param integer $idPessoaEndereco
     *
     * @return PessoaEnderecoLog
     */
    public function setIdPessoaEndereco($idPessoaEndereco)
    {
        $this->idPessoaEndereco = $idPessoaEndereco;
        return $this;
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
     * Get idPessoaEnderecoLog
     *
     * @return integer 
     */
    public function getIdPessoaEnderecoLog()
    {
        return $this->idPessoaEnderecoLog;
    }

    /**
     * Set idPessoaFisica
     *
     * @param integer $idPessoaFisica
     *
     * @return PessoaEnderecoLog
     */
    public function setIdPessoaFisica($idPessoaFisica)
    {
        $this->idPessoaFisica = $idPessoaFisica;
        return $this;
    }

    /**
     * Get idPessoaFisica
     *
     * @return integer 
     */
    public function getIdPessoaFisica()
    {
        return $this->idPessoaFisica;
    }

    /**
     * Set idUsuarioSistemaOperacao
     *
     * @param integer $idUsuarioSistemaOperacao
     *
     * @return PessoaEnderecoLog
     */
    public function setIdUsuarioSistemaOperacao($idUsuarioSistemaOperacao)
    {
        $this->idUsuarioSistemaOperacao = $idUsuarioSistemaOperacao;
        return $this;
    }

    /**
     * Get idUsuarioSistemaOperacao
     *
     * @return integer 
     */
    public function getIdUsuarioSistemaOperacao()
    {
        return $this->idUsuarioSistemaOperacao;
    }

    /**
     * Set noBairro
     *
     * @param string $noBairro
     *
     * @return PessoaEnderecoLog
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
     * @return PessoaEnderecoLog
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
     * @return PessoaEnderecoLog
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
     * Set sgUsuarioBd
     *
     * @param string $sgUsuarioBd
     *
     * @return PessoaEnderecoLog
     */
    public function setSgUsuarioBd($sgUsuarioBd)
    {
        $this->sgUsuarioBd = $sgUsuarioBd;
        return $this;
    }

    /**
     * Get sgUsuarioBd
     *
     * @return string 
     */
    public function getSgUsuarioBd()
    {
        return $this->sgUsuarioBd;
    }

    /**
     * Set tpEndereco
     *
     * @param string $tpEndereco
     *
     * @return PessoaEnderecoLog
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
     * Set tpOperacao
     *
     * @param string $tpOperacao
     *
     * @return PessoaEnderecoLog
     */
    public function setTpOperacao($tpOperacao)
    {
        $this->tpOperacao = $tpOperacao;
        return $this;
    }

    /**
     * Get tpOperacao
     *
     * @return string 
     */
    public function getTpOperacao()
    {
        return $this->tpOperacao;
    }
}

