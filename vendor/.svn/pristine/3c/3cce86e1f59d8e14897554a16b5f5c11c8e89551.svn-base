<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogServicoAmbiente
 *
 * @ORM\Table(name="SSI.TB_LOG_SERVICO_AMBIENTE")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogServicoAmbienteRepository")
 */
class LogServicoAmbiente extends Entity
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
     * @ORM\Column(name="ID_SERVICO_AMBIENTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idServicoAmbiente;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SERVICO_SISTEMA", type="smallint", nullable=false)
     */
    private $idServicoSistema;

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
     * @ORM\Column(name="TX_URL_SERVICO_AMBIENTE", type="string", length=100, nullable=false)
     */
    private $txUrlServicoAmbiente;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_VERSAO", type="string", length=10, nullable=false)
     */
    private $txVersao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogServicoAmbiente
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
     * @return LogServicoAmbiente
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
     * Set idServicoAmbiente
     *
     * @param integer $idServicoAmbiente
     *
     * @return LogServicoAmbiente
     */
    public function setIdServicoAmbiente($idServicoAmbiente)
    {
        $this->idServicoAmbiente = $idServicoAmbiente;
        return $this;
    }

    /**
     * Get idServicoAmbiente
     *
     * @return integer 
     */
    public function getIdServicoAmbiente()
    {
        return $this->idServicoAmbiente;
    }

    /**
     * Set idServicoSistema
     *
     * @param integer $idServicoSistema
     *
     * @return LogServicoAmbiente
     */
    public function setIdServicoSistema($idServicoSistema)
    {
        $this->idServicoSistema = $idServicoSistema;
        return $this;
    }

    /**
     * Get idServicoSistema
     *
     * @return integer 
     */
    public function getIdServicoSistema()
    {
        return $this->idServicoSistema;
    }

    /**
     * Set idTipoAmbiente
     *
     * @param integer $idTipoAmbiente
     *
     * @return LogServicoAmbiente
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
     * @return LogServicoAmbiente
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
     * @return LogServicoAmbiente
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
     * Set txUrlServicoAmbiente
     *
     * @param string $txUrlServicoAmbiente
     *
     * @return LogServicoAmbiente
     */
    public function setTxUrlServicoAmbiente($txUrlServicoAmbiente)
    {
        $this->txUrlServicoAmbiente = $txUrlServicoAmbiente;
        return $this;
    }

    /**
     * Get txUrlServicoAmbiente
     *
     * @return string 
     */
    public function getTxUrlServicoAmbiente()
    {
        return $this->txUrlServicoAmbiente;
    }

    /**
     * Set txVersao
     *
     * @param string $txVersao
     *
     * @return LogServicoAmbiente
     */
    public function setTxVersao($txVersao)
    {
        $this->txVersao = $txVersao;
        return $this;
    }

    /**
     * Get txVersao
     *
     * @return string 
     */
    public function getTxVersao()
    {
        return $this->txVersao;
    }
}

