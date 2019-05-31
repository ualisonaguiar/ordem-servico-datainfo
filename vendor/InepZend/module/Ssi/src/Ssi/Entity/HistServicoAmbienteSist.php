<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * HistServicoAmbienteSist
 *
 * @ORM\Table(name="SSI.TB_HIST_SERVICO_AMBIENTE_SIST")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\HistServicoAmbienteSistRepository")
 */
class HistServicoAmbienteSist extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_HIST_SERVICO_AMBIENTE_SIST", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_HIST_SERVICO_AMBIENTE_SIST_", allocationSize=1, initialValue=1)
     */
    private $idHistServicoAmbienteSist;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SERVICO_AMBIENTE", type="integer", nullable=false)
     */
    private $idServicoAmbiente;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SERVICO_AMBIENTE_SISTEMA", type="bigint", nullable=false)
     */
    private $idServicoAmbienteSistema;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SISTEMA", type="smallint", nullable=false)
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
     * @ORM\Column(name="TP_OPERACAO", type="string", length=1, nullable=false)
     */
    private $tpOperacao;

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
     * Get idHistServicoAmbienteSist
     *
     * @return integer 
     */
    public function getIdHistServicoAmbienteSist()
    {
        return $this->idHistServicoAmbienteSist;
    }

    /**
     * Set idServicoAmbiente
     *
     * @param integer $idServicoAmbiente
     *
     * @return HistServicoAmbienteSist
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
     * Set idServicoAmbienteSistema
     *
     * @param integer $idServicoAmbienteSistema
     *
     * @return HistServicoAmbienteSist
     */
    public function setIdServicoAmbienteSistema($idServicoAmbienteSistema)
    {
        $this->idServicoAmbienteSistema = $idServicoAmbienteSistema;
        return $this;
    }

    /**
     * Get idServicoAmbienteSistema
     *
     * @return integer 
     */
    public function getIdServicoAmbienteSistema()
    {
        return $this->idServicoAmbienteSistema;
    }

    /**
     * Set idSistema
     *
     * @param integer $idSistema
     *
     * @return HistServicoAmbienteSist
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
     * @return HistServicoAmbienteSist
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
     * @return HistServicoAmbienteSist
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
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return HistServicoAmbienteSist
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

