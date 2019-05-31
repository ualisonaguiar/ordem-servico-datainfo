<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogTipoConfiguracao
 *
 * @ORM\Table(name="SSI.TB_LOG_TIPO_CONFIGURACAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogTipoConfiguracaoRepository")
 */
class LogTipoConfiguracao extends Entity
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
     * @ORM\Column(name="ID_TIPO_CONFIGURACAO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
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
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return LogTipoConfiguracao
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
     * @return LogTipoConfiguracao
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
     * Set idTipoConfiguracao
     *
     * @param integer $idTipoConfiguracao
     *
     * @return LogTipoConfiguracao
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
     * Set noConfiguracao
     *
     * @param string $noConfiguracao
     *
     * @return LogTipoConfiguracao
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
     * @return LogTipoConfiguracao
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
}

