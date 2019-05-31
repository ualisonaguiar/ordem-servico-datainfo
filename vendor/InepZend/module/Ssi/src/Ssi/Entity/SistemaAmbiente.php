<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * SistemaAmbiente
 *
 * @ORM\Table(name="SSI.TB_SISTEMA_AMBIENTE")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\SistemaAmbienteRepository")
 */
class SistemaAmbiente extends Entity
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
     * @ORM\Column(name="ID_SISTEMA_AMBIENTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_SISTEMA_AMBIENTE_ID_SISTEMA", allocationSize=1, initialValue=1)
     */
    private $idSistemaAmbiente;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_ATIVO", type="boolean", nullable=false)
     */
    private $inAtivo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     */
    private $nuOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_URL_APLICACAO", type="string", length=100, nullable=false)
     */
    private $txUrlAplicacao;

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
     * @var \InepZend\Module\Ssi\Entity\Sistema
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\Sistema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_SISTEMA", referencedColumnName="ID_SISTEMA")
     * })
     */
    private $idSistema;

    /**
     * @var \InepZend\Module\Ssi\Entity\TipoAmbiente
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\TipoAmbiente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_TIPO_AMBIENTE", referencedColumnName="ID_TIPO_AMBIENTE")
     * })
     */
    private $idTipoAmbiente;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return SistemaAmbiente
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
     * Get idSistemaAmbiente
     *
     * @return integer 
     */
    public function getIdSistemaAmbiente()
    {
        return $this->idSistemaAmbiente;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return SistemaAmbiente
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
     * @return SistemaAmbiente
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
     * @return SistemaAmbiente
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

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return SistemaAmbiente
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

    /**
     * Set idSistema
     *
     * @param \InepZend\Module\Ssi\Entity\Sistema $idSistema
     *
     * @return SistemaAmbiente
     */
    public function setIdSistema(\InepZend\Module\Ssi\Entity\Sistema $idSistema = null)
    {
        $this->idSistema = $idSistema;
        return $this;
    }

    /**
     * Get idSistema
     *
     * @return \InepZend\Module\Ssi\Entity\Sistema 
     */
    public function getIdSistema()
    {
        return $this->idSistema;
    }

    /**
     * Set idTipoAmbiente
     *
     * @param \InepZend\Module\Ssi\Entity\TipoAmbiente $idTipoAmbiente
     *
     * @return SistemaAmbiente
     */
    public function setIdTipoAmbiente(\InepZend\Module\Ssi\Entity\TipoAmbiente $idTipoAmbiente = null)
    {
        $this->idTipoAmbiente = $idTipoAmbiente;
        return $this;
    }

    /**
     * Get idTipoAmbiente
     *
     * @return \InepZend\Module\Ssi\Entity\TipoAmbiente 
     */
    public function getIdTipoAmbiente()
    {
        return $this->idTipoAmbiente;
    }
}

