<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * CartorioBkp
 *
 * @ORM\Table(name="CORP.TC_CARTORIO_BKP")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\CartorioBkpRepository")
 */
class CartorioBkp extends Entity
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
     * @var string
     *
     * @ORM\Column(name="DS_HORARIO_FUNCIONAMENTO", type="string", length=60, nullable=true)
     */
    protected $dsHorarioFuncionamento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTUALIZACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtAltualizacao;

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
     * @ORM\Column(name="NO_CARTORIO_FANTASIA", type="string", length=200, nullable=true)
     */
    protected $noCartorioFantasia;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_CARTORIO_TITULAR", type="string", length=200, nullable=true)
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
     * Set coMunicipio
     *
     * @param integer $coMunicipio
     *
     * @return CartorioBkp
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
     * @return CartorioBkp
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
     * @return CartorioBkp
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
     * Set dtAltualizacao
     *
     * @param \DateTime $dtAltualizacao
     *
     * @return CartorioBkp
     */
    public function setDtAltualizacao($dtAltualizacao)
    {
        $this->dtAltualizacao = $dtAltualizacao;
        return $this;
    }

    /**
     * Get dtAltualizacao
     *
     * @return \DateTime 
     */
    public function getDtAltualizacao()
    {
        return Date::convertDate($this->dtAltualizacao, "d/m/Y");
    }

    /**
     * Set dtInstalacaoCartorio
     *
     * @param \DateTime $dtInstalacaoCartorio
     *
     * @return CartorioBkp
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
     * @return CartorioBkp
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
     * @return CartorioBkp
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
     * @return CartorioBkp
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
     * @return CartorioBkp
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
     * @return CartorioBkp
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
     * @return CartorioBkp
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
     * @return CartorioBkp
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
     * @return CartorioBkp
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
     * @return CartorioBkp
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
     * @return CartorioBkp
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
     * @return CartorioBkp
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
     * @return CartorioBkp
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

