<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * PessoaContatoLog
 *
 * @ORM\Table(name="CORP.TC_PESSOA_CONTATO_LOG")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\PessoaContatoLogRepository")
 */
class PessoaContatoLog extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_OPERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtOperacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_CONTATO", type="integer", nullable=false)
     */
    protected $idPessoaContato;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_CONTATO_LOG", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_PESSOA_CONTATO_LOG_ID_PESSO", allocationSize=1, initialValue=1)
     */
    protected $idPessoaContatoLog;

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
     * @var integer
     *
     * @ORM\Column(name="NU_DDD", type="integer", nullable=true)
     */
    protected $nuDdd;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_DDI", type="integer", nullable=true)
     */
    protected $nuDdi;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_RAMAL", type="integer", nullable=true)
     */
    protected $nuRamal;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_USUARIO_BD", type="string", length=30, nullable=true)
     */
    protected $sgUsuarioBd;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_CONTATO", type="string", length=20, nullable=false)
     */
    protected $tpContato;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_OPERACAO", type="string", length=1, nullable=false)
     */
    protected $tpOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_CONTATO", type="string", length=150, nullable=false)
     */
    protected $txContato;


    /**
     * Set dtOperacao
     *
     * @param \DateTime $dtOperacao
     *
     * @return PessoaContatoLog
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
     * Set idPessoaContato
     *
     * @param integer $idPessoaContato
     *
     * @return PessoaContatoLog
     */
    public function setIdPessoaContato($idPessoaContato)
    {
        $this->idPessoaContato = $idPessoaContato;
        return $this;
    }

    /**
     * Get idPessoaContato
     *
     * @return integer 
     */
    public function getIdPessoaContato()
    {
        return $this->idPessoaContato;
    }

    /**
     * Get idPessoaContatoLog
     *
     * @return integer 
     */
    public function getIdPessoaContatoLog()
    {
        return $this->idPessoaContatoLog;
    }

    /**
     * Set idPessoaFisica
     *
     * @param integer $idPessoaFisica
     *
     * @return PessoaContatoLog
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
     * @return PessoaContatoLog
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
     * Set nuDdd
     *
     * @param integer $nuDdd
     *
     * @return PessoaContatoLog
     */
    public function setNuDdd($nuDdd)
    {
        $this->nuDdd = $nuDdd;
        return $this;
    }

    /**
     * Get nuDdd
     *
     * @return integer 
     */
    public function getNuDdd()
    {
        return $this->nuDdd;
    }

    /**
     * Set nuDdi
     *
     * @param integer $nuDdi
     *
     * @return PessoaContatoLog
     */
    public function setNuDdi($nuDdi)
    {
        $this->nuDdi = $nuDdi;
        return $this;
    }

    /**
     * Get nuDdi
     *
     * @return integer 
     */
    public function getNuDdi()
    {
        return $this->nuDdi;
    }

    /**
     * Set nuRamal
     *
     * @param integer $nuRamal
     *
     * @return PessoaContatoLog
     */
    public function setNuRamal($nuRamal)
    {
        $this->nuRamal = $nuRamal;
        return $this;
    }

    /**
     * Get nuRamal
     *
     * @return integer 
     */
    public function getNuRamal()
    {
        return $this->nuRamal;
    }

    /**
     * Set sgUsuarioBd
     *
     * @param string $sgUsuarioBd
     *
     * @return PessoaContatoLog
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
     * Set tpContato
     *
     * @param string $tpContato
     *
     * @return PessoaContatoLog
     */
    public function setTpContato($tpContato)
    {
        $this->tpContato = $tpContato;
        return $this;
    }

    /**
     * Get tpContato
     *
     * @return string 
     */
    public function getTpContato()
    {
        return $this->tpContato;
    }

    /**
     * Set tpOperacao
     *
     * @param string $tpOperacao
     *
     * @return PessoaContatoLog
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
     * Set txContato
     *
     * @param string $txContato
     *
     * @return PessoaContatoLog
     */
    public function setTxContato($txContato)
    {
        $this->txContato = $txContato;
        return $this;
    }

    /**
     * Get txContato
     *
     * @return string 
     */
    public function getTxContato()
    {
        return $this->txContato;
    }
}

