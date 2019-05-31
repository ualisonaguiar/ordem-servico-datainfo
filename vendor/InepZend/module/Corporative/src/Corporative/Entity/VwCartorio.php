<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Cartorio
 *
 * @ORM\Table(name="CORP.VW_CARTORIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\VwCartorioRepository")
 */
class VwCartorio extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_MUNICIPIO", type="integer", nullable=true)
     */
    protected $coMunicipio;

    /**
     * @var string
     *
     * @ORM\Column(name="CO_SERVENTIA", type="string", length=6, nullable=true)
     */
    protected $coServentia;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_TIPO_ATRIBUICAO_CARTORIO", type="integer", nullable=true)
     */
    protected $coTipoAtribuicaoCartorio;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_UF", type="integer", nullable=true)
     */
    protected $coUf;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_HORARIO_FUNCIONAMENTO", type="string", length=60, nullable=true)
     */
    protected $dsHorarioFuncionamento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ATUALIZACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtAtualizacao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_INSTALACAO_CARTORIO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtInstalacaoCartorio;

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="ID_CARTORIO", type="integer", nullable=false)
     */
    protected $idCartorio;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_ENTRANCIA", type="integer", nullable=true)
     */
    protected $idEntrancia;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_CARTORIO_FANTASIA", type="string", length=200, nullable=false)
     */
    protected $noCartorioFantasia;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_CARTORIO_TITULAR", type="string", length=200, nullable=false)
     */
    protected $noCartorioTitular;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_COMARCA", type="string", length=80, nullable=true)
     */
    protected $noComarca;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_ENTRANCIA", type="string", length=50, nullable=true)
     */
    protected $noEntrancia;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_JUIZ_DIRETOR_VARA", type="string", length=80, nullable=true)
     */
    protected $noJuizDiretorVara;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_JUIZ_SUBSTITUTO", type="string", length=80, nullable=true)
     */
    protected $noJuizSubstituto;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_MUNICIPIO", type="string", length=150, nullable=true)
     */
    protected $noMunicipio;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SUBSTITUTO", type="string", length=80, nullable=true)
     */
    protected $noSubstituto;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_ATRIBUICAO_CARTORIO", type="string", length=80, nullable=true)
     */
    protected $noTipoAtribuicaoCartorio;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TITULAR", type="string", length=80, nullable=true)
     */
    protected $noTitular;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_UF", type="string", length=2, nullable=true)
     */
    protected $sgUf;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_AREA_ABRANGENCIA", type="string", length=200, nullable=true)
     */
    protected $txAreaAbrangencia;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_OBSERVACAO", type="string", length=200, nullable=true)
     */
    protected $txObservacao;


    /**
     * Set coMunicipio
     *
     * @param integer $coMunicipio
     *
     * @return Cartorio
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
     * Set coServentia
     *
     * @param string $coServentia
     *
     * @return Cartorio
     */
    public function setCoServentia($coServentia)
    {
        $this->coServentia = $coServentia;
        return $this;
    }

    /**
     * Get coServentia
     *
     * @return string 
     */
    public function getCoServentia()
    {
        return $this->coServentia;
    }

    /**
     * Set coTipoAtribuicaoCartorio
     *
     * @param integer $coTipoAtribuicaoCartorio
     *
     * @return Cartorio
     */
    public function setCoTipoAtribuicaoCartorio($coTipoAtribuicaoCartorio)
    {
        $this->coTipoAtribuicaoCartorio = $coTipoAtribuicaoCartorio;
        return $this;
    }

    /**
     * Get coTipoAtribuicaoCartorio
     *
     * @return integer 
     */
    public function getCoTipoAtribuicaoCartorio()
    {
        return $this->coTipoAtribuicaoCartorio;
    }

    /**
     * Set coUf
     *
     * @param integer $coUf
     *
     * @return Cartorio
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
     * Set dsHorarioFuncionamento
     *
     * @param string $dsHorarioFuncionamento
     *
     * @return Cartorio
     */
    public function setDsHorarioFuncionamento($dsHorarioFuncionamento)
    {
        $this->dsHorarioFuncionamento = $dsHorarioFuncionamento;
        return $this;
    }

    /**
     * Get dsHorarioFuncionamento
     *
     * @return string 
     */
    public function getDsHorarioFuncionamento()
    {
        return $this->dsHorarioFuncionamento;
    }

    /**
     * Set dtAtualizacao
     *
     * @param \DateTime $dtAtualizacao
     *
     * @return Cartorio
     */
    public function setDtAtualizacao($dtAtualizacao)
    {
        $this->dtAtualizacao = $dtAtualizacao;
        return $this;
    }

    /**
     * Get dtAtualizacao
     *
     * @return \DateTime 
     */
    public function getDtAtualizacao()
    {
        return Date::convertDate($this->dtAtualizacao, "d/m/Y");
    }

    /**
     * Set dtInstalacaoCartorio
     *
     * @param \DateTime $dtInstalacaoCartorio
     *
     * @return Cartorio
     */
    public function setDtInstalacaoCartorio($dtInstalacaoCartorio)
    {
        $this->dtInstalacaoCartorio = $dtInstalacaoCartorio;
        return $this;
    }

    /**
     * Get dtInstalacaoCartorio
     *
     * @return \DateTime 
     */
    public function getDtInstalacaoCartorio()
    {
        return Date::convertDate($this->dtInstalacaoCartorio, "d/m/Y");
    }

    /**
     * Set idCartorio
     *
     * @param integer $idCartorio
     *
     * @return Cartorio
     */
    public function setIdCartorio($idCartorio)
    {
        $this->idCartorio = $idCartorio;
        return $this;
    }

    /**
     * Get idCartorio
     *
     * @return integer 
     */
    public function getIdCartorio()
    {
        return $this->idCartorio;
    }

    /**
     * Set idEntrancia
     *
     * @param integer $idEntrancia
     *
     * @return Cartorio
     */
    public function setIdEntrancia($idEntrancia)
    {
        $this->idEntrancia = $idEntrancia;
        return $this;
    }

    /**
     * Get idEntrancia
     *
     * @return integer 
     */
    public function getIdEntrancia()
    {
        return $this->idEntrancia;
    }

    /**
     * Set noCartorioFantasia
     *
     * @param string $noCartorioFantasia
     *
     * @return Cartorio
     */
    public function setNoCartorioFantasia($noCartorioFantasia)
    {
        $this->noCartorioFantasia = $noCartorioFantasia;
        return $this;
    }

    /**
     * Get noCartorioFantasia
     *
     * @return string 
     */
    public function getNoCartorioFantasia()
    {
        return $this->noCartorioFantasia;
    }

    /**
     * Set noCartorioTitular
     *
     * @param string $noCartorioTitular
     *
     * @return Cartorio
     */
    public function setNoCartorioTitular($noCartorioTitular)
    {
        $this->noCartorioTitular = $noCartorioTitular;
        return $this;
    }

    /**
     * Get noCartorioTitular
     *
     * @return string 
     */
    public function getNoCartorioTitular()
    {
        return $this->noCartorioTitular;
    }

    /**
     * Set noComarca
     *
     * @param string $noComarca
     *
     * @return Cartorio
     */
    public function setNoComarca($noComarca)
    {
        $this->noComarca = $noComarca;
        return $this;
    }

    /**
     * Get noComarca
     *
     * @return string 
     */
    public function getNoComarca()
    {
        return $this->noComarca;
    }

    /**
     * Set noEntrancia
     *
     * @param string $noEntrancia
     *
     * @return Cartorio
     */
    public function setNoEntrancia($noEntrancia)
    {
        $this->noEntrancia = $noEntrancia;
        return $this;
    }

    /**
     * Get noEntrancia
     *
     * @return string 
     */
    public function getNoEntrancia()
    {
        return $this->noEntrancia;
    }

    /**
     * Set noJuizDiretorVara
     *
     * @param string $noJuizDiretorVara
     *
     * @return Cartorio
     */
    public function setNoJuizDiretorVara($noJuizDiretorVara)
    {
        $this->noJuizDiretorVara = $noJuizDiretorVara;
        return $this;
    }

    /**
     * Get noJuizDiretorVara
     *
     * @return string 
     */
    public function getNoJuizDiretorVara()
    {
        return $this->noJuizDiretorVara;
    }

    /**
     * Set noJuizSubstituto
     *
     * @param string $noJuizSubstituto
     *
     * @return Cartorio
     */
    public function setNoJuizSubstituto($noJuizSubstituto)
    {
        $this->noJuizSubstituto = $noJuizSubstituto;
        return $this;
    }

    /**
     * Get noJuizSubstituto
     *
     * @return string 
     */
    public function getNoJuizSubstituto()
    {
        return $this->noJuizSubstituto;
    }

    /**
     * Set noMunicipio
     *
     * @param string $noMunicipio
     *
     * @return Cartorio
     */
    public function setNoMunicipio($noMunicipio)
    {
        $this->noMunicipio = $noMunicipio;
        return $this;
    }

    /**
     * Get noMunicipio
     *
     * @return string 
     */
    public function getNoMunicipio()
    {
        return $this->noMunicipio;
    }

    /**
     * Set noSubstituto
     *
     * @param string $noSubstituto
     *
     * @return Cartorio
     */
    public function setNoSubstituto($noSubstituto)
    {
        $this->noSubstituto = $noSubstituto;
        return $this;
    }

    /**
     * Get noSubstituto
     *
     * @return string 
     */
    public function getNoSubstituto()
    {
        return $this->noSubstituto;
    }

    /**
     * Set noTipoAtribuicaoCartorio
     *
     * @param string $noTipoAtribuicaoCartorio
     *
     * @return Cartorio
     */
    public function setNoTipoAtribuicaoCartorio($noTipoAtribuicaoCartorio)
    {
        $this->noTipoAtribuicaoCartorio = $noTipoAtribuicaoCartorio;
        return $this;
    }

    /**
     * Get noTipoAtribuicaoCartorio
     *
     * @return string 
     */
    public function getNoTipoAtribuicaoCartorio()
    {
        return $this->noTipoAtribuicaoCartorio;
    }

    /**
     * Set noTitular
     *
     * @param string $noTitular
     *
     * @return Cartorio
     */
    public function setNoTitular($noTitular)
    {
        $this->noTitular = $noTitular;
        return $this;
    }

    /**
     * Get noTitular
     *
     * @return string 
     */
    public function getNoTitular()
    {
        return $this->noTitular;
    }

    /**
     * Set sgUf
     *
     * @param string $sgUf
     *
     * @return Cartorio
     */
    public function setSgUf($sgUf)
    {
        $this->sgUf = $sgUf;
        return $this;
    }

    /**
     * Get sgUf
     *
     * @return string 
     */
    public function getSgUf()
    {
        return $this->sgUf;
    }

    /**
     * Set txAreaAbrangencia
     *
     * @param string $txAreaAbrangencia
     *
     * @return Cartorio
     */
    public function setTxAreaAbrangencia($txAreaAbrangencia)
    {
        $this->txAreaAbrangencia = $txAreaAbrangencia;
        return $this;
    }

    /**
     * Get txAreaAbrangencia
     *
     * @return string 
     */
    public function getTxAreaAbrangencia()
    {
        return $this->txAreaAbrangencia;
    }

    /**
     * Set txObservacao
     *
     * @param string $txObservacao
     *
     * @return Cartorio
     */
    public function setTxObservacao($txObservacao)
    {
        $this->txObservacao = $txObservacao;
        return $this;
    }

    /**
     * Get txObservacao
     *
     * @return string 
     */
    public function getTxObservacao()
    {
        return $this->txObservacao;
    }
}

