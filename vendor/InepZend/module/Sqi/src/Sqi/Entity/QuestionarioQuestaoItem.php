<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * QuestionarioQuestaoItem
 *
 * @ORM\Table(name="SQI.TB_QUESTIONARIO_QUESTAO_ITEM")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\QuestionarioQuestaoItemRepository")
 */
class QuestionarioQuestaoItem extends Entity
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
     * @ORM\Column(name="ID_QUESTIONARIO_QUESTAO_ITEM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_QUESTIONARIO_QUESTAO_ITEM_I", allocationSize=1, initialValue=1)
     */
    private $idQuestionarioQuestaoItem;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     */
    private $nuOperacao;

    /**
     * @var \InepZend\Module\Sqi\Entity\QuestaoItemConfiguracao
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\QuestaoItemConfiguracao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_QUESTAO_ITEM_CONFIGURACAO", referencedColumnName="ID_QUESTAO_ITEM_CONFIGURACAO")
     * })
     */
    private $idQuestaoItemConfiguracao;

    /**
     * @var \InepZend\Module\Sqi\Entity\QuestionarioProjeto
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\QuestionarioProjeto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_QUESTIONARIO_PROJETO", referencedColumnName="ID_QUESTIONARIO_PROJETO")
     * })
     */
    private $idQuestionarioProjeto;

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
     * @return QuestionarioQuestaoItem
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
     * Get idQuestionarioQuestaoItem
     *
     * @return integer 
     */
    public function getIdQuestionarioQuestaoItem()
    {
        return $this->idQuestionarioQuestaoItem;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return QuestionarioQuestaoItem
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
     * Set idQuestaoItemConfiguracao
     *
     * @param \InepZend\Module\Sqi\Entity\QuestaoItemConfiguracao $idQuestaoItemConfiguracao
     *
     * @return QuestionarioQuestaoItem
     */
    public function setIdQuestaoItemConfiguracao(\InepZend\Module\Sqi\Entity\QuestaoItemConfiguracao $idQuestaoItemConfiguracao = null)
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
     * Set idQuestionarioProjeto
     *
     * @param \InepZend\Module\Sqi\Entity\QuestionarioProjeto $idQuestionarioProjeto
     *
     * @return QuestionarioQuestaoItem
     */
    public function setIdQuestionarioProjeto(\InepZend\Module\Sqi\Entity\QuestionarioProjeto $idQuestionarioProjeto = null)
    {
        $this->idQuestionarioProjeto = $idQuestionarioProjeto;
        return $this;
    }

    /**
     * Get idQuestionarioProjeto
     *
     * @return \InepZend\Module\Sqi\Entity\QuestionarioProjeto 
     */
    public function getIdQuestionarioProjeto()
    {
        return $this->idQuestionarioProjeto;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param $idUsuarioAlteracao
     *
     * @return QuestionarioQuestaoItem
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

