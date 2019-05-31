<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * TipoConfiguracao
 *
 * @ORM\Table(name="SSI.TB_TIPO_CONFIGURACAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\TipoConfiguracaoRepository")
 */
class TipoConfiguracao extends Entity
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
     * @ORM\Column(name="ID_TIPO_CONFIGURACAO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_TIPO_CONFIGURACAO_ID_TIPO_C", allocationSize=1, initialValue=1)
     */
    private $idTipoConfiguracao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_CONFIGURACAO", type="string", length=50, nullable=false)
     */
    private $noConfiguracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=false)
     */
    private $nuOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_OBSERVACAO", type="string", length=2000, nullable=true)
     */
    private $txObservacao;

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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return TipoConfiguracao
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
     * Get idTipoConfiguracao
     *
     * @return integer 
     */
    public function getIdTipoConfiguracao()
    {
        return $this->idTipoConfiguracao;
    }

    /**
     * Set noConfiguracao
     *
     * @param string $noConfiguracao
     *
     * @return TipoConfiguracao
     */
    public function setNoConfiguracao($noConfiguracao)
    {
        $this->noConfiguracao = $noConfiguracao;
        return $this;
    }

    /**
     * Get noConfiguracao
     *
     * @return string 
     */
    public function getNoConfiguracao()
    {
        return $this->noConfiguracao;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return TipoConfiguracao
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
     * Set txObservacao
     *
     * @param string $txObservacao
     *
     * @return TipoConfiguracao
     */
    public function setTxObservacao($txObservacao)
    {
        $this->txObservacao = $txObservacao;
        return $this;
    }

    /**
     * Get txObservacao
     *
     * @return string 
     */
    public function getTxObservacao()
    {
        return $this->txObservacao;
    }

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return TipoConfiguracao
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

