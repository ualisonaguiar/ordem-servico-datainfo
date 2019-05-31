<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistQuestaoItemDep
 *
 * @ORM\Table(name="SQI.TB_HIST_QUESTAO_ITEM_DEP")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\HistQuestaoItemDepRepository")
 */
class HistQuestaoItemDep extends Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CO_EVENTO", type="integer", nullable=true)
     */
    private $coEvento;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_PROJETO", type="integer", nullable=true)
     */
    private $coProjeto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_QUESTAO_ITEM_CONFIGURACAO", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idQuestaoItemConfiguracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_QUESTAO_ITEM_CONFIG_PAI", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idQuestaoItemConfigPai;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    private $idUsuarioAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="TP_ACAO", type="boolean", nullable=true)
     */
    private $tpAcao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="TP_DEPENDENCIA", type="boolean", nullable=true)
     */
    private $tpDependencia;


    /**
     * Set coEvento
     *
     * @param integer $coEvento
     *
     * @return HistQuestaoItemDep
     */
    public function setCoEvento($coEvento)
    {
        $this->coEvento = $coEvento;
        return $this;
    }

    /**
     * Get coEvento
     *
     * @return integer 
     */
    public function getCoEvento()
    {
        return $this->coEvento;
    }

    /**
     * Set coProjeto
     *
     * @param integer $coProjeto
     *
     * @return HistQuestaoItemDep
     */
    public function setCoProjeto($coProjeto)
    {
        $this->coProjeto = $coProjeto;
        return $this;
    }

    /**
     * Get coProjeto
     *
     * @return integer 
     */
    public function getCoProjeto()
    {
        return $this->coProjeto;
    }

    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistQuestaoItemDep
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
     * Set idQuestaoItemConfiguracao
     *
     * @param integer $idQuestaoItemConfiguracao
     *
     * @return HistQuestaoItemDep
     */
    public function setIdQuestaoItemConfiguracao($idQuestaoItemConfiguracao)
    {
        $this->idQuestaoItemConfiguracao = $idQuestaoItemConfiguracao;
        return $this;
    }

    /**
     * Get idQuestaoItemConfiguracao
     *
     * @return integer 
     */
    public function getIdQuestaoItemConfiguracao()
    {
        return $this->idQuestaoItemConfiguracao;
    }

    /**
     * Set idQuestaoItemConfigPai
     *
     * @param integer $idQuestaoItemConfigPai
     *
     * @return HistQuestaoItemDep
     */
    public function setIdQuestaoItemConfigPai($idQuestaoItemConfigPai)
    {
        $this->idQuestaoItemConfigPai = $idQuestaoItemConfigPai;
        return $this;
    }

    /**
     * Get idQuestaoItemConfigPai
     *
     * @return integer 
     */
    public function getIdQuestaoItemConfigPai()
    {
        return $this->idQuestaoItemConfigPai;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistQuestaoItemDep
     */
    public function setIdUsuarioAlteracao($idUsuarioAlteracao)
    {
        $this->idUsuarioAlteracao = $idUsuarioAlteracao;
        return $this;
    }

    /**
     * Get idUsuarioAlteracao
     *
     * @return integer 
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->idUsuarioAlteracao;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistQuestaoItemDep
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
     * Set tpAcao
     *
     * @param boolean $tpAcao
     *
     * @return HistQuestaoItemDep
     */
    public function setTpAcao($tpAcao)
    {
        $this->tpAcao = $tpAcao;
        return $this;
    }

    /**
     * Get tpAcao
     *
     * @return boolean 
     */
    public function getTpAcao()
    {
        return $this->tpAcao;
    }

    /**
     * Set tpDependencia
     *
     * @param boolean $tpDependencia
     *
     * @return HistQuestaoItemDep
     */
    public function setTpDependencia($tpDependencia)
    {
        $this->tpDependencia = $tpDependencia;
        return $this;
    }

    /**
     * Get tpDependencia
     *
     * @return boolean 
     */
    public function getTpDependencia()
    {
        return $this->tpDependencia;
    }
}

