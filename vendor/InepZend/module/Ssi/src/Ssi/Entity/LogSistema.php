<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogSistema
 *
 * @ORM\Table(name="SSI.TB_LOG_SISTEMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogSistemaRepository")
 */
class LogSistema extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="CO_CLIENTE", type="string", length=100, nullable=true)
     */
    private $coCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="CO_SECRETO", type="string", length=100, nullable=true)
     */
    private $coSecreto;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_SISTEMA", type="string", length=500, nullable=true)
     */
    private $dsSistema;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=false)
     */
    private $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_HISTORICO_ACESSO", type="integer", nullable=false)
     */
    private $idHistoricoAcesso;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SERVIDOR_GERENTE", type="integer", nullable=true)
     */
    private $idServidorGerente;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SERVIDOR_GESTOR", type="integer", nullable=true)
     */
    private $idServidorGestor;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SISTEMA", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idSistema;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SISTEMA", type="string", length=250, nullable=false)
     */
    private $noSistema;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="SG_SISTEMA", type="string", length=20, nullable=true)
     */
    private $sgSistema;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_SVN_DOCUMENTO", type="string", length=100, nullable=true)
     */
    private $txSvnDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_SVN_FONTE", type="string", length=100, nullable=true)
     */
    private $txSvnFonte;


    /**
     * Set coCliente
     *
     * @param string $coCliente
     *
     * @return LogSistema
     */
    public function setCoCliente($coCliente)
    {
        $this->coCliente = $coCliente;
        return $this;
    }

    /**
     * Get coCliente
     *
     * @return string 
     */
    public function getCoCliente()
    {
        return $this->coCliente;
    }

    /**
     * Set coSecreto
     *
     * @param string $coSecreto
     *
     * @return LogSistema
     */
    public function setCoSecreto($coSecreto)
    {
        $this->coSecreto = $coSecreto;
        return $this;
    }

    /**
     * Get coSecreto
     *
     * @return string 
     */
    public function getCoSecreto()
    {
        return $this->coSecreto;
    }

    /**
     * Set dsSistema
     *
     * @param string $dsSistema
     *
     * @return LogSistema
     */
    public function setDsSistema($dsSistema)
    {
        $this->dsSistema = $dsSistema;
        return $this;
    }

    /**
     * Get dsSistema
     *
     * @return string 
     */
    public function getDsSistema()
    {
        return $this->dsSistema;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogSistema
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
     * Set idHistoricoAcesso
     *
     * @param integer $idHistoricoAcesso
     *
     * @return LogSistema
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
     * Set idServidorGerente
     *
     * @param integer $idServidorGerente
     *
     * @return LogSistema
     */
    public function setIdServidorGerente($idServidorGerente)
    {
        $this->idServidorGerente = $idServidorGerente;
        return $this;
    }

    /**
     * Get idServidorGerente
     *
     * @return integer 
     */
    public function getIdServidorGerente()
    {
        return $this->idServidorGerente;
    }

    /**
     * Set idServidorGestor
     *
     * @param integer $idServidorGestor
     *
     * @return LogSistema
     */
    public function setIdServidorGestor($idServidorGestor)
    {
        $this->idServidorGestor = $idServidorGestor;
        return $this;
    }

    /**
     * Get idServidorGestor
     *
     * @return integer 
     */
    public function getIdServidorGestor()
    {
        return $this->idServidorGestor;
    }

    /**
     * Set idSistema
     *
     * @param integer $idSistema
     *
     * @return LogSistema
     */
    public function setIdSistema($idSistema)
    {
        $this->idSistema = $idSistema;
        return $this;
    }

    /**
     * Get idSistema
     *
     * @return integer 
     */
    public function getIdSistema()
    {
        return $this->idSistema;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return LogSistema
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
     * Set noSistema
     *
     * @param string $noSistema
     *
     * @return LogSistema
     */
    public function setNoSistema($noSistema)
    {
        $this->noSistema = $noSistema;
        return $this;
    }

    /**
     * Get noSistema
     *
     * @return string 
     */
    public function getNoSistema()
    {
        return $this->noSistema;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return LogSistema
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
     * Set sgSistema
     *
     * @param string $sgSistema
     *
     * @return LogSistema
     */
    public function setSgSistema($sgSistema)
    {
        $this->sgSistema = $sgSistema;
        return $this;
    }

    /**
     * Get sgSistema
     *
     * @return string 
     */
    public function getSgSistema()
    {
        return $this->sgSistema;
    }

    /**
     * Set txSvnDocumento
     *
     * @param string $txSvnDocumento
     *
     * @return LogSistema
     */
    public function setTxSvnDocumento($txSvnDocumento)
    {
        $this->txSvnDocumento = $txSvnDocumento;
        return $this;
    }

    /**
     * Get txSvnDocumento
     *
     * @return string 
     */
    public function getTxSvnDocumento()
    {
        return $this->txSvnDocumento;
    }

    /**
     * Set txSvnFonte
     *
     * @param string $txSvnFonte
     *
     * @return LogSistema
     */
    public function setTxSvnFonte($txSvnFonte)
    {
        $this->txSvnFonte = $txSvnFonte;
        return $this;
    }

    /**
     * Get txSvnFonte
     *
     * @return string 
     */
    public function getTxSvnFonte()
    {
        return $this->txSvnFonte;
    }
}

