<?php

namespace InepZend\Module\Corporative\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * PessoaJuridicaLog
 *
 * @ORM\Table(name="CORP.TC_PESSOA_JURIDICA_LOG")
 * @ORM\Entity(repositoryClass="InepZend\Module\Corporative\Entity\PessoaJuridicaLogRepository")
 */
class PessoaJuridicaLog extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_PESSOA_JURIDICA", type="string", length=250, nullable=true)
     */
    protected $dsPessoaJuridica;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_OPERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    protected $dtOperacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_JURIDICA", type="integer", nullable=false)
     */
    protected $idPessoaJuridica;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_PESSOA_JURIDICA_LOG", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TC_PESSOA_JURIDICA_LOG_ID_PESS", allocationSize=1, initialValue=1)
     */
    protected $idPessoaJuridicaLog;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_SISTEMA_OPERACAO", type="integer", nullable=true)
     */
    protected $idUsuarioSistemaOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_FANTASIA", type="string", length=150, nullable=true)
     */
    protected $noFantasia;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_RAZAO_SOCIAL", type="string", length=150, nullable=false)
     */
    protected $noRazaoSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_CNPJ", type="string", length=14, nullable=false)
     */
    protected $nuCnpj;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_USUARIO_BD", type="string", length=30, nullable=true)
     */
    protected $sgUsuarioBd;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_OPERACAO", type="string", length=1, nullable=false)
     */
    protected $tpOperacao;


    /**
     * Set dsPessoaJuridica
     *
     * @param string $dsPessoaJuridica
     *
     * @return PessoaJuridicaLog
     */
    public function setDsPessoaJuridica($dsPessoaJuridica)
    {
        $this->dsPessoaJuridica = $dsPessoaJuridica;
        return $this;
    }

    /**
     * Get dsPessoaJuridica
     *
     * @return string 
     */
    public function getDsPessoaJuridica()
    {
        return $this->dsPessoaJuridica;
    }

    /**
     * Set dtOperacao
     *
     * @param \DateTime $dtOperacao
     *
     * @return PessoaJuridicaLog
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
     * Set idPessoaJuridica
     *
     * @param integer $idPessoaJuridica
     *
     * @return PessoaJuridicaLog
     */
    public function setIdPessoaJuridica($idPessoaJuridica)
    {
        $this->idPessoaJuridica = $idPessoaJuridica;
        return $this;
    }

    /**
     * Get idPessoaJuridica
     *
     * @return integer 
     */
    public function getIdPessoaJuridica()
    {
        return $this->idPessoaJuridica;
    }

    /**
     * Get idPessoaJuridicaLog
     *
     * @return integer 
     */
    public function getIdPessoaJuridicaLog()
    {
        return $this->idPessoaJuridicaLog;
    }

    /**
     * Set idUsuarioSistemaOperacao
     *
     * @param integer $idUsuarioSistemaOperacao
     *
     * @return PessoaJuridicaLog
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
     * Set noFantasia
     *
     * @param string $noFantasia
     *
     * @return PessoaJuridicaLog
     */
    public function setNoFantasia($noFantasia)
    {
        $this->noFantasia = $noFantasia;
        return $this;
    }

    /**
     * Get noFantasia
     *
     * @return string 
     */
    public function getNoFantasia()
    {
        return $this->noFantasia;
    }

    /**
     * Set noRazaoSocial
     *
     * @param string $noRazaoSocial
     *
     * @return PessoaJuridicaLog
     */
    public function setNoRazaoSocial($noRazaoSocial)
    {
        $this->noRazaoSocial = $noRazaoSocial;
        return $this;
    }

    /**
     * Get noRazaoSocial
     *
     * @return string 
     */
    public function getNoRazaoSocial()
    {
        return $this->noRazaoSocial;
    }

    /**
     * Set nuCnpj
     *
     * @param string $nuCnpj
     *
     * @return PessoaJuridicaLog
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
     * Set sgUsuarioBd
     *
     * @param string $sgUsuarioBd
     *
     * @return PessoaJuridicaLog
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
     * Set tpOperacao
     *
     * @param string $tpOperacao
     *
     * @return PessoaJuridicaLog
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

