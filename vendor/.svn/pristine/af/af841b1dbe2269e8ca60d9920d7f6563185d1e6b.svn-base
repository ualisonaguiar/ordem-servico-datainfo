<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogConfiguracaoSistema
 *
 * @ORM\Table(name="SSI.TB_LOG_CONFIGURACAO_SISTEMA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogConfiguracaoSistemaRepository")
 */
class LogConfiguracaoSistema extends Entity
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
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idConfiguracaoSistema;

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
     * @ORM\Column(name="ID_TIPO_CONFIGURACAO", type="integer", nullable=false)
     */
    private $idTipoConfiguracao;

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
     * @ORM\Column(name="TX_CONFIGURACAO", type="string", length=500, nullable=false)
     */
    private $txConfiguracao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogConfiguracaoSistema
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
     * Set idConfiguracaoSistema
     *
     * @param integer $idConfiguracaoSistema
     *
     * @return LogConfiguracaoSistema
     */
    public function setIdConfiguracaoSistema($idConfiguracaoSistema)
    {
        $this->idConfiguracaoSistema = $idConfiguracaoSistema;
        return $this;
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
     * Set idHistoricoAcesso
     *
     * @param integer $idHistoricoAcesso
     *
     * @return LogConfiguracaoSistema
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
     * @return LogConfiguracaoSistema
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
     * Set idTipoConfiguracao
     *
     * @param integer $idTipoConfiguracao
     *
     * @return LogConfiguracaoSistema
     */
    public function setIdTipoConfiguracao($idTipoConfiguracao)
    {
        $this->idTipoConfiguracao = $idTipoConfiguracao;
        return $this;
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
     * Set inAtivo
     *
     * @param boolean $inAtivo
     *
     * @return LogConfiguracaoSistema
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
     * @return LogConfiguracaoSistema
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
     * @return LogConfiguracaoSistema
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
}

