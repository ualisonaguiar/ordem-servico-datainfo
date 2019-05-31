<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistQuestQuestaoItem
 *
 * @ORM\Table(name="SQI.TB_HIST_QUEST_QUESTAO_ITEM")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\HistQuestQuestaoItemRepository")
 */
class HistQuestQuestaoItem extends Entity
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
     * @ORM\Column(name="ID_QUESTAO_ITEM_CONFIGURACAO", type="integer", nullable=true)
     */
    private $idQuestaoItemConfiguracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_QUESTIONARIO_PROJETO", type="integer", nullable=true)
     */
    private $idQuestionarioProjeto;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_QUESTIONARIO_QUESTAO_ITEM", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idQuestionarioQuestaoItem;

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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistQuestQuestaoItem
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
     * @return HistQuestQuestaoItem
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
     * Set idQuestionarioProjeto
     *
     * @param integer $idQuestionarioProjeto
     *
     * @return HistQuestQuestaoItem
     */
    public function setIdQuestionarioProjeto($idQuestionarioProjeto)
    {
        $this->idQuestionarioProjeto = $idQuestionarioProjeto;
        return $this;
    }

    /**
     * Get idQuestionarioProjeto
     *
     * @return integer 
     */
    public function getIdQuestionarioProjeto()
    {
        return $this->idQuestionarioProjeto;
    }

    /**
     * Set idQuestionarioQuestaoItem
     *
     * @param integer $idQuestionarioQuestaoItem
     *
     * @return HistQuestQuestaoItem
     */
    public function setIdQuestionarioQuestaoItem($idQuestionarioQuestaoItem)
    {
        $this->idQuestionarioQuestaoItem = $idQuestionarioQuestaoItem;
        return $this;
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
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistQuestQuestaoItem
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
     * @return HistQuestQuestaoItem
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

