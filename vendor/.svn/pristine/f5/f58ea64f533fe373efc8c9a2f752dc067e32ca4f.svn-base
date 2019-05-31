<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogSistemaAmbiente
 *
 * @ORM\Table(name="SSI.TB_LOG_SISTEMA_AMBIENTE")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogSistemaAmbienteRepository")
 */
class LogSistemaAmbiente extends Entity
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
     * @ORM\Column(name="ID_HISTORICO_ACESSO", type="integer", nullable=false)
     */
    private $idHistoricoAcesso;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SISTEMA", type="smallint", nullable=false)
     */
    private $idSistema;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SISTEMA_AMBIENTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idSistemaAmbiente;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_AMBIENTE", type="integer", nullable=false)
     */
    private $idTipoAmbiente;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo;

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
     * @ORM\Column(name="TX_URL_APLICACAO", type="string", length=100, nullable=false)
     */
    private $txUrlAplicacao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogSistemaAmbiente
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
     * @return LogSistemaAmbiente
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
     * Set idSistema
     *
     * @param integer $idSistema
     *
     * @return LogSistemaAmbiente
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
     * Set idSistemaAmbiente
     *
     * @param integer $idSistemaAmbiente
     *
     * @return LogSistemaAmbiente
     */
    public function setIdSistemaAmbiente($idSistemaAmbiente)
    {
        $this->idSistemaAmbiente = $idSistemaAmbiente;
        return $this;
    }

    /**
     * Get idSistemaAmbiente
     *
     * @return integer 
     */
    public function getIdSistemaAmbiente()
    {
        return $this->idSistemaAmbiente;
    }

    /**
     * Set idTipoAmbiente
     *
     * @param integer $idTipoAmbiente
     *
     * @return LogSistemaAmbiente
     */
    public function setIdTipoAmbiente($idTipoAmbiente)
    {
        $this->idTipoAmbiente = $idTipoAmbiente;
        return $this;
    }

    /**
     * Get idTipoAmbiente
     *
     * @return integer 
     */
    public function getIdTipoAmbiente()
    {
        return $this->idTipoAmbiente;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return LogSistemaAmbiente
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return LogSistemaAmbiente
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
     * Set txUrlAplicacao
     *
     * @param string $txUrlAplicacao
     *
     * @return LogSistemaAmbiente
     */
    public function setTxUrlAplicacao($txUrlAplicacao)
    {
        $this->txUrlAplicacao = $txUrlAplicacao;
        return $this;
    }

    /**
     * Get txUrlAplicacao
     *
     * @return string 
     */
    public function getTxUrlAplicacao()
    {
        return $this->txUrlAplicacao;
    }
}

