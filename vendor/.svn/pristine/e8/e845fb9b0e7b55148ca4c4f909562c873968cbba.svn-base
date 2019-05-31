<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogContato
 *
 * @ORM\Table(name="SSI.TB_LOG_CONTATO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogContatoRepository")
 */
class LogContato extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    private $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_CONTATO", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idContato;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_HISTORICO_ACESSO", type="integer", nullable=false)
     */
    private $idHistoricoAcesso;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SUBTIPO_CONTATO", type="smallint", nullable=true)
     */
    private $idSubtipoContato;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO", type="integer", nullable=false)
     */
    private $idUsuario;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DDD", type="string", length=3, nullable=true)
     */
    private $nuDdd;

    /**
     * @var string
     *
     * @ORM\Column(name="NU_DDI", type="string", length=3, nullable=true)
     */
    private $nuDdi;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_RAMAL", type="integer", nullable=true)
     */
    private $nuRamal;

    /**
     * @var string
     *
     * @ORM\Column(name="TP_CONTATO", type="string", length=1, nullable=false)
     */
    private $tpContato;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_CONTATO", type="string", length=255, nullable=true)
     */
    private $txContato;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogContato
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
     * Set idContato
     *
     * @param integer $idContato
     *
     * @return LogContato
     */
    public function setIdContato($idContato)
    {
        $this->idContato = $idContato;
        return $this;
    }

    /**
     * Get idContato
     *
     * @return integer 
     */
    public function getIdContato()
    {
        return $this->idContato;
    }

    /**
     * Set idHistoricoAcesso
     *
     * @param integer $idHistoricoAcesso
     *
     * @return LogContato
     */
    public function setIdHistoricoAcesso($idHistoricoAcesso)
    {
        $this->idHistoricoAcesso = $idHistoricoAcesso;
        return $this;
    }

    /**
     * Get idHistoricoAcesso
     *
     * @return integer 
     */
    public function getIdHistoricoAcesso()
    {
        return $this->idHistoricoAcesso;
    }

    /**
     * Set idSubtipoContato
     *
     * @param integer $idSubtipoContato
     *
     * @return LogContato
     */
    public function setIdSubtipoContato($idSubtipoContato)
    {
        $this->idSubtipoContato = $idSubtipoContato;
        return $this;
    }

    /**
     * Get idSubtipoContato
     *
     * @return integer 
     */
    public function getIdSubtipoContato()
    {
        return $this->idSubtipoContato;
    }

    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     *
     * @return LogContato
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return integer 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return LogContato
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
     * Set nuDdd
     *
     * @param string $nuDdd
     *
     * @return LogContato
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
     * Set nuDdi
     *
     * @param string $nuDdi
     *
     * @return LogContato
     */
    public function setNuDdi($nuDdi)
    {
        $this->nuDdi = $nuDdi;
        return $this;
    }

    /**
     * Get nuDdi
     *
     * @return string 
     */
    public function getNuDdi()
    {
        return $this->nuDdi;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return LogContato
     */
    public function setNuOperacao($nuOperacao)
    {
        $this->nuOperacao = $nuOperacao;
        return $this;
    }

    /**
     * Get nuOperacao
     *
     * @return integer 
     */
    public function getNuOperacao()
    {
        return $this->nuOperacao;
    }

    /**
     * Set nuRamal
     *
     * @param integer $nuRamal
     *
     * @return LogContato
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
     * Set tpContato
     *
     * @param string $tpContato
     *
     * @return LogContato
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
     * Set txContato
     *
     * @param string $txContato
     *
     * @return LogContato
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

