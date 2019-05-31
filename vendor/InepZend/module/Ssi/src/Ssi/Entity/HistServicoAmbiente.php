<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * HistServicoAmbiente
 *
 * @ORM\Table(name="SSI.TB_HIST_SERVICO_AMBIENTE")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\HistServicoAmbienteRepository")
 */
class HistServicoAmbiente extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_HIST_SERVICO_AMBIENTE", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_HIST_SERVICO_AMBIENTE_ID_HI", allocationSize=1, initialValue=1)
     */
    private $idHistServicoAmbiente;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SERVICO", type="smallint", nullable=false)
     */
    private $idServico;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SERVICO_AMBIENTE", type="integer", nullable=false)
     */
    private $idServicoAmbiente;

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
     * @var string
     *
     * @ORM\Column(name="TP_OPERACAO", type="string", length=1, nullable=false)
     */
    private $tpOperacao;

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
     * @var \InepZend\Module\Ssi\Entity\HistoricoAcesso
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\HistoricoAcesso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_HISTORICO_ACESSO", referencedColumnName="ID_HISTORICO_ACESSO")
     * })
     */
    private $idHistoricoAcesso;


    /**
     * Get idHistServicoAmbiente
     *
     * @return integer 
     */
    public function getIdHistServicoAmbiente()
    {
        return $this->idHistServicoAmbiente;
    }

    /**
     * Set idServico
     *
     * @param integer $idServico
     *
     * @return HistServicoAmbiente
     */
    public function setIdServico($idServico)
    {
        $this->idServico = $idServico;
        return $this;
    }

    /**
     * Get idServico
     *
     * @return integer 
     */
    public function getIdServico()
    {
        return $this->idServico;
    }

    /**
     * Set idServicoAmbiente
     *
     * @param integer $idServicoAmbiente
     *
     * @return HistServicoAmbiente
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
     * Set idTipoAmbiente
     *
     * @param integer $idTipoAmbiente
     *
     * @return HistServicoAmbiente
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
     * @return HistServicoAmbiente
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
     * Set tpOperacao
     *
     * @param string $tpOperacao
     *
     * @return HistServicoAmbiente
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
     * Set txUrlServicoAmbiente
     *
     * @param string $txUrlServicoAmbiente
     *
     * @return HistServicoAmbiente
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
     * @return HistServicoAmbiente
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

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return HistServicoAmbiente
     */
    public function setIdHistoricoAcesso(\InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso = null)
    {
        $this->idHistoricoAcesso = $idHistoricoAcesso;
        return $this;
    }

    /**
     * Get idHistoricoAcesso
     *
     * @return \InepZend\Module\Ssi\Entity\HistoricoAcesso 
     */
    public function getIdHistoricoAcesso()
    {
        return $this->idHistoricoAcesso;
    }
}

