<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * QuestaoItemDependencia
 *
 * @ORM\Table(name="SQI.TB_QUESTAO_ITEM_DEPENDENCIA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\QuestaoItemDependenciaRepository")
 */
class QuestaoItemDependencia extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
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
     * @var integer
     *
     * @ORM\Column(name="CO_PROJETO", type="integer", nullable=true)
     */
    private $coProjeto;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_EVENTO", type="integer", nullable=true)
     */
    private $coEvento;  

    /**
     * @var \InepZend\Module\Sqi\Entity\QuestaoItemConfiguracao
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="InepZend\Module\Sqi\Entity\QuestaoItemConfiguracao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_QUESTAO_ITEM_CONFIGURACAO", referencedColumnName="ID_QUESTAO_ITEM_CONFIGURACAO")
     * })
     */
    private $idQuestaoItemConfiguracao;

    /**
     * @var \InepZend\Module\Sqi\Entity\QuestaoItemConfiguracao
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="InepZend\Module\Sqi\Entity\QuestaoItemConfiguracao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_QUESTAO_ITEM_CONFIG_PAI", referencedColumnName="ID_QUESTAO_ITEM_CONFIGURACAO")
     * })
     */
    private $idQuestaoItemConfigPai;

    /**
     * @var \InepZend\Module\Sqi\Entity\
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    private $idUsuarioAlteracao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return QuestaoItemDependencia
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return QuestaoItemDependencia
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
     * @return QuestaoItemDependencia
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
     * @return QuestaoItemDependencia
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

    /**
     * Set coProjeto
     *
     * @param $coProjeto
     *
     * @return QuestionarioProjeto
     */
    public function setCoProjeto($coProjeto = null)
    {
        $this->coProjeto = $coProjeto;
        return $this;
    }

    /**
     * Get coProjeto
     *
     * @return QuestionarioProjeto
     */
    public function getCoProjeto()
    {
        return $this->coProjeto;
    }

    /**
     * Set coEvento
     *
     * @param $coEvento
     *
     * @return QuestionarioProjeto
     */
    public function setCoEvento($coEvento = null)
    {
        $this->coEvento = $coEvento;
        return $this;
    }

    /**
     * Get coProjeto
     *
     * @return QuestionarioProjeto
     */
    public function getCoEvento()
    {
        return $this->coEvento;
    }

    /**
     * Set idQuestaoItemConfiguracao
     *
     * @param \InepZend\Module\Sqi\Entity\QuestaoItemConfiguracao $idQuestaoItemConfiguracao
     *
     * @return QuestaoItemDependencia
     */
    public function setIdQuestaoItemConfiguracao(\InepZend\Module\Sqi\Entity\QuestaoItemConfiguracao $idQuestaoItemConfiguracao)
    {
        $this->idQuestaoItemConfiguracao = $idQuestaoItemConfiguracao;
        return $this;
    }

    /**
     * Get idQuestaoItemConfiguracao
     *
     * @return \InepZend\Module\Sqi\Entity\QuestaoItemConfiguracao 
     */
    public function getIdQuestaoItemConfiguracao()
    {
        return $this->idQuestaoItemConfiguracao;
    }

    /**
     * Set idQuestaoItemConfigPai
     *
     * @param \InepZend\Module\Sqi\Entity\QuestaoItemConfiguracao $idQuestaoItemConfigPai
     *
     * @return QuestaoItemDependencia
     */
    public function setIdQuestaoItemConfigPai(\InepZend\Module\Sqi\Entity\QuestaoItemConfiguracao $idQuestaoItemConfigPai)
    {
        $this->idQuestaoItemConfigPai = $idQuestaoItemConfigPai;
        return $this;
    }

    /**
     * Get idQuestaoItemConfigPai
     *
     * @return \InepZend\Module\Sqi\Entity\QuestaoItemConfiguracao 
     */
    public function getIdQuestaoItemConfigPai()
    {
        return $this->idQuestaoItemConfigPai;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param $idUsuarioAlteracao
     *
     * @return QuestaoItemDependencia
     */
    public function setIdUsuarioAlteracao($idUsuarioAlteracao = null)
    {
        $this->idUsuarioAlteracao = $idUsuarioAlteracao;
        return $this;
    }

    /**
     * Get idUsuarioAlteracao
     *
     * @return \InepZend\Module\Sqi\Entity\ 
     */
    public function getIdUsuarioAlteracao()
    {
        return $this->idUsuarioAlteracao;
    }
}

