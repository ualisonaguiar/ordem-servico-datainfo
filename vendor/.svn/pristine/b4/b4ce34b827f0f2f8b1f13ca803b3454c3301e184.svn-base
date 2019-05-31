<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Cartorio
 *
 * @ORM\Table(name="CORP.TB_CARTORIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\CartorioRepository")
 */
class Cartorio extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="CO_SERVENTIA", type="string", length=6, nullable=true)
     */
    protected $coServentia;

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
     * @ORM\Column(name="ID_CARTORIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_CARTORIO_ID_CARTORIO_seq", allocationSize=1, initialValue=1)
     */
    protected $idCartorio;

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
     * @ORM\Column(name="NO_SUBSTITUTO", type="string", length=80, nullable=true)
     */
    protected $noSubstituto;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TITULAR", type="string", length=80, nullable=true)
     */
    protected $noTitular;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_AREA_ABRANGENCIA", type="string", length=200, nullable=true)
     */
    protected $txAreaAbrangencia;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_EMAIL", type="string", length=100, nullable=true)
     */
    protected $txEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_OBSERVACAO", type="string", length=200, nullable=true)
     */
    protected $txObservacao;

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
     * @var \InepZend\Module\Corporative\Entity\Entrancia
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Corporative\Entity\Entrancia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_ENTRANCIA", referencedColumnName="ID_ENTRANCIA")
     * })
     */
    protected $idEntrancia;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="InepZend\Module\Corporative\Entity\TipoAtribuicaoCartorio", mappedBy="idCartorio")
     */
    protected $coTipoAtribuicaoCartorio;


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
     * Get idCartorio
     *
     * @return integer 
     */
    public function getIdCartorio()
    {
        return $this->idCartorio;
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
     * Set txEmail
     *
     * @param string $txEmail
     *
     * @return Cartorio
     */
    public function setTxEmail($txEmail)
    {
        $this->txEmail = $txEmail;
        return $this;
    }

    /**
     * Get txEmail
     *
     * @return string 
     */
    public function getTxEmail()
    {
        return $this->txEmail;
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

    /**
     * Set coMunicipio
     *
     * @param \InepZend\Module\Corporative\Entity\Municipio $coMunicipio
     *
     * @return Cartorio
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
     * Set idEntrancia
     *
     * @param \InepZend\Module\Corporative\Entity\Entrancia $idEntrancia
     *
     * @return Cartorio
     */
    public function setIdEntrancia(\InepZend\Module\Corporative\Entity\Entrancia $idEntrancia = null)
    {
        $this->idEntrancia = $idEntrancia;
        return $this;
    }

    /**
     * Get idEntrancia
     *
     * @return \InepZend\Module\Corporative\Entity\Entrancia 
     */
    public function getIdEntrancia()
    {
        return $this->idEntrancia;
    }

    /**
     * Add coTipoAtribuicaoCartorio
     *
     * @param \InepZend\Module\Corporative\Entity\TipoAtribuicaoCartorio $coTipoAtribuicaoCartorio
     *
     * @return Cartorio
     */
    public function addCoTipoAtribuicaoCartorio(\InepZend\Module\Corporative\Entity\TipoAtribuicaoCartorio $coTipoAtribuicaoCartorio)
    {
        $this->coTipoAtribuicaoCartorio[] = $coTipoAtribuicaoCartorio;
    
        return $this;
    }

    /**
     * Remove coTipoAtribuicaoCartorio
     *
     * @param \InepZend\Module\Corporative\Entity\TipoAtribuicaoCartorio $coTipoAtribuicaoCartorio
     */
    public function removeCoTipoAtribuicaoCartorio(\InepZend\Module\Corporative\Entity\TipoAtribuicaoCartorio $coTipoAtribuicaoCartorio)
    {
        $this->coTipoAtribuicaoCartorio->removeElement($coTipoAtribuicaoCartorio);
    }

    /**
     * Get coTipoAtribuicaoCartorio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCoTipoAtribuicaoCartorio()
    {
        return $this->coTipoAtribuicaoCartorio;
    }
}

