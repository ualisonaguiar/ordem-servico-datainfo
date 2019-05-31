<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * PessoaFisicaLog
 *
 * @ORM\Table(name="CORP.TC_PESSOA_FISICA_LOG")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\PessoaFisicaLogRepository")
 */
class PessoaFisicaLog extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_COR_RACA", type="integer", nullable=true)
     */
    protected $coCorRaca;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_ESTADO_CIVIL", type="integer", nullable=true)
     */
    protected $coEstadoCivil;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_MUNICIPIO_NASCIMENTO", type="integer", nullable=true)
     */
    protected $coMunicipioNascimento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_NASCIMENTO", type="string", columnDefinition="DATE", nullable=false)
     */
    protected $dtNascimento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_OPERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtOperacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_GRUPO_SANGUINEO", type="integer", nullable=true)
     */
    protected $idGrupoSanguineo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_FISICA", type="integer", nullable=false)
     */
    protected $idPessoaFisica;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_FISICA_LOG", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_PESSOA_FISICA_LOG_ID_PESSOA", allocationSize=1, initialValue=1)
     */
    protected $idPessoaFisicaLog;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_SISTEMA_OPERACAO", type="integer", nullable=true)
     */
    protected $idUsuarioSistemaOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_MAE", type="string", length=150, nullable=false)
     */
    protected $noMae;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PAI", type="string", length=150, nullable=true)
     */
    protected $noPai;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_PESSOA_FISICA", type="string", length=130, nullable=false)
     */
    protected $noPessoaFisica;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CPF", type="string", length=11, nullable=true)
     */
    protected $nuCpf;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_USUARIO_BD", type="string", length=30, nullable=true)
     */
    protected $sgUsuarioBd;

    /**
     * @var integer
     *
     * @ORM\Column(name="TP_NACIONALIDADE", type="integer", nullable=true)
     */
    protected $tpNacionalidade;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_OPERACAO", type="string", length=1, nullable=false)
     */
    protected $tpOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_SEXO", type="string", length=1, nullable=false)
     */
    protected $tpSexo;


    /**
     * Set coCorRaca
     *
     * @param integer $coCorRaca
     *
     * @return PessoaFisicaLog
     */
    public function setCoCorRaca($coCorRaca)
    {
        $this->coCorRaca = $coCorRaca;
        return $this;
    }

    /**
     * Get coCorRaca
     *
     * @return integer 
     */
    public function getCoCorRaca()
    {
        return $this->coCorRaca;
    }

    /**
     * Set coEstadoCivil
     *
     * @param integer $coEstadoCivil
     *
     * @return PessoaFisicaLog
     */
    public function setCoEstadoCivil($coEstadoCivil)
    {
        $this->coEstadoCivil = $coEstadoCivil;
        return $this;
    }

    /**
     * Get coEstadoCivil
     *
     * @return integer 
     */
    public function getCoEstadoCivil()
    {
        return $this->coEstadoCivil;
    }

    /**
     * Set coMunicipioNascimento
     *
     * @param integer $coMunicipioNascimento
     *
     * @return PessoaFisicaLog
     */
    public function setCoMunicipioNascimento($coMunicipioNascimento)
    {
        $this->coMunicipioNascimento = $coMunicipioNascimento;
        return $this;
    }

    /**
     * Get coMunicipioNascimento
     *
     * @return integer 
     */
    public function getCoMunicipioNascimento()
    {
        return $this->coMunicipioNascimento;
    }

    /**
     * Set dtNascimento
     *
     * @param \DateTime $dtNascimento
     *
     * @return PessoaFisicaLog
     */
    public function setDtNascimento($dtNascimento)
    {
        $this->dtNascimento = $dtNascimento;
        return $this;
    }

    /**
     * Get dtNascimento
     *
     * @return \DateTime 
     */
    public function getDtNascimento()
    {
        return Date::convertDate($this->dtNascimento, "d/m/Y");
    }

    /**
     * Set dtOperacao
     *
     * @param \DateTime $dtOperacao
     *
     * @return PessoaFisicaLog
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
     * Set idGrupoSanguineo
     *
     * @param integer $idGrupoSanguineo
     *
     * @return PessoaFisicaLog
     */
    public function setIdGrupoSanguineo($idGrupoSanguineo)
    {
        $this->idGrupoSanguineo = $idGrupoSanguineo;
        return $this;
    }

    /**
     * Get idGrupoSanguineo
     *
     * @return integer 
     */
    public function getIdGrupoSanguineo()
    {
        return $this->idGrupoSanguineo;
    }

    /**
     * Set idPessoaFisica
     *
     * @param integer $idPessoaFisica
     *
     * @return PessoaFisicaLog
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
     * Get idPessoaFisicaLog
     *
     * @return integer 
     */
    public function getIdPessoaFisicaLog()
    {
        return $this->idPessoaFisicaLog;
    }

    /**
     * Set idUsuarioSistemaOperacao
     *
     * @param integer $idUsuarioSistemaOperacao
     *
     * @return PessoaFisicaLog
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
     * Set noMae
     *
     * @param string $noMae
     *
     * @return PessoaFisicaLog
     */
    public function setNoMae($noMae)
    {
        $this->noMae = $noMae;
        return $this;
    }

    /**
     * Get noMae
     *
     * @return string 
     */
    public function getNoMae()
    {
        return $this->noMae;
    }

    /**
     * Set noPai
     *
     * @param string $noPai
     *
     * @return PessoaFisicaLog
     */
    public function setNoPai($noPai)
    {
        $this->noPai = $noPai;
        return $this;
    }

    /**
     * Get noPai
     *
     * @return string 
     */
    public function getNoPai()
    {
        return $this->noPai;
    }

    /**
     * Set noPessoaFisica
     *
     * @param string $noPessoaFisica
     *
     * @return PessoaFisicaLog
     */
    public function setNoPessoaFisica($noPessoaFisica)
    {
        $this->noPessoaFisica = $noPessoaFisica;
        return $this;
    }

    /**
     * Get noPessoaFisica
     *
     * @return string 
     */
    public function getNoPessoaFisica()
    {
        return $this->noPessoaFisica;
    }

    /**
     * Set nuCpf
     *
     * @param string $nuCpf
     *
     * @return PessoaFisicaLog
     */
    public function setNuCpf($nuCpf)
    {
        $this->nuCpf = $nuCpf;
        return $this;
    }

    /**
     * Get nuCpf
     *
     * @return string 
     */
    public function getNuCpf()
    {
        return $this->nuCpf;
    }

    /**
     * Set sgUsuarioBd
     *
     * @param string $sgUsuarioBd
     *
     * @return PessoaFisicaLog
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
     * Set tpNacionalidade
     *
     * @param integer $tpNacionalidade
     *
     * @return PessoaFisicaLog
     */
    public function setTpNacionalidade($tpNacionalidade)
    {
        $this->tpNacionalidade = $tpNacionalidade;
        return $this;
    }

    /**
     * Get tpNacionalidade
     *
     * @return integer 
     */
    public function getTpNacionalidade()
    {
        return $this->tpNacionalidade;
    }

    /**
     * Set tpOperacao
     *
     * @param string $tpOperacao
     *
     * @return PessoaFisicaLog
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

    /**
     * Set tpSexo
     *
     * @param string $tpSexo
     *
     * @return PessoaFisicaLog
     */
    public function setTpSexo($tpSexo)
    {
        $this->tpSexo = $tpSexo;
        return $this;
    }

    /**
     * Get tpSexo
     *
     * @return string 
     */
    public function getTpSexo()
    {
        return $this->tpSexo;
    }
}

