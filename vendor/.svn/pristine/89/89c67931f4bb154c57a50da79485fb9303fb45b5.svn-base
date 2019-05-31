<?php

namespace InepZend\Module\Ssi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * LogServicoAmbienteSist
 *
 * @ORM\Table(name="SSI.TB_LOG_SERVICO_AMBIENTE_SIST")
 * @ORM\Entity(repositoryClass="InepZend\Module\Ssi\Entity\LogServicoAmbienteSistRepository")
 */
class LogServicoAmbienteSist extends Entity
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
     */
    private $idServicoAmbiente;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SERVICO_AMBIENTE_SISTEMA", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
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
     * @return LogServicoAmbienteSist
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
     * @return LogServicoAmbienteSist
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
     * @return LogServicoAmbienteSist
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
     * @return LogServicoAmbienteSist
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
     * @return LogServicoAmbienteSist
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
     * @return LogServicoAmbienteSist
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
     * @return LogServicoAmbienteSist
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

