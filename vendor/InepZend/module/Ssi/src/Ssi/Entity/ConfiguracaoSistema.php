<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * ConfiguracaoSistema
 *
 * @ORM\Table(name="SSI.TB_CONFIGURACAO_SISTEMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\ConfiguracaoSistemaRepository")
 */
class ConfiguracaoSistema extends Entity
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
     * @ORM\Column(name="ID_CONFIGURACAO_SISTEMA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_CONFIGURACAO_SISTEMA_ID_CON", allocationSize=1, initialValue=1)
     */
    private $idConfiguracaoSistema;

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
     */
    private $nuOperacao;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_CONFIGURACAO", type="string", length=500, nullable=false)
     */
    private $txConfiguracao;

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
     * @var \InepZend\Module\Ssi\Entity\TipoConfiguracao
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Ssi\Entity\TipoConfiguracao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_TIPO_CONFIGURACAO", referencedColumnName="ID_TIPO_CONFIGURACAO")
     * })
     */
    private $idTipoConfiguracao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return ConfiguracaoSistema
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
     * Get idConfiguracaoSistema
     *
     * @return integer 
     */
    public function getIdConfiguracaoSistema()
    {
        return $this->idConfiguracaoSistema;
    }

    /**
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return ConfiguracaoSistema
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
     * @return ConfiguracaoSistema
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
     * Set txConfiguracao
     *
     * @param string $txConfiguracao
     *
     * @return ConfiguracaoSistema
     */
    public function setTxConfiguracao($txConfiguracao)
    {
        $this->txConfiguracao = $txConfiguracao;
        return $this;
    }

    /**
     * Get txConfiguracao
     *
     * @return string 
     */
    public function getTxConfiguracao()
    {
        return $this->txConfiguracao;
    }

    /**
     * Set idHistoricoAcesso
     *
     * @param \InepZend\Module\Ssi\Entity\HistoricoAcesso $idHistoricoAcesso
     *
     * @return ConfiguracaoSistema
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
     * @return ConfiguracaoSistema
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
     * Set idTipoConfiguracao
     *
     * @param \InepZend\Module\Ssi\Entity\TipoConfiguracao $idTipoConfiguracao
     *
     * @return ConfiguracaoSistema
     */
    public function setIdTipoConfiguracao(\InepZend\Module\Ssi\Entity\TipoConfiguracao $idTipoConfiguracao = null)
    {
        $this->idTipoConfiguracao = $idTipoConfiguracao;
        return $this;
    }

    /**
     * Get idTipoConfiguracao
     *
     * @return \InepZend\Module\Ssi\Entity\TipoConfiguracao 
     */
    public function getIdTipoConfiguracao()
    {
        return $this->idTipoConfiguracao;
    }
}

