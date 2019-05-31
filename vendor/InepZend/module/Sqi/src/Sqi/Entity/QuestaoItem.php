<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * QuestaoItem
 *
 * @ORM\Table(name="SQI.TB_QUESTAO_ITEM")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\QuestaoItemRepository")
 */
class QuestaoItem extends Entity
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
     * @ORM\Column(name="ID_QUESTAO_ITEM", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_QUESTAO_ITEM_ID_QUESTAO_ITE", allocationSize=1, initialValue=1)
     */
    private $idQuestaoItem;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     */
    private $nuOperacao;

    /**
     * @var \InepZend\Module\Sqi\Entity\Item
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\Item")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_ITEM", referencedColumnName="ID_ITEM")
     * })
     */
    private $idItem;

    /**
     * @var \InepZend\Module\Sqi\Entity\Questao
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\Questao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_QUESTAO", referencedColumnName="ID_QUESTAO")
     * })
     */
    private $idQuestao;

    /**
     * @var \InepZend\Module\Sqi\Entity\TipoQuestao
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\TipoQuestao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_TIPO_QUESTAO", referencedColumnName="ID_TIPO_QUESTAO")
     * })
     */
    private $idTipoQuestao;

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
     * @return QuestaoItem
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
     * Get idQuestaoItem
     *
     * @return integer 
     */
    public function getIdQuestaoItem()
    {
        return $this->idQuestaoItem;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return QuestaoItem
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
     * Set idItem
     *
     * @param \InepZend\Module\Sqi\Entity\Item $idItem
     *
     * @return QuestaoItem
     */
    public function setIdItem(\InepZend\Module\Sqi\Entity\Item $idItem = null)
    {
        $this->idItem = $idItem;
        return $this;
    }

    /**
     * Get idItem
     *
     * @return \InepZend\Module\Sqi\Entity\Item 
     */
    public function getIdItem()
    {
        return $this->idItem;
    }

    /**
     * Set idQuestao
     *
     * @param \InepZend\Module\Sqi\Entity\Questao $idQuestao
     *
     * @return QuestaoItem
     */
    public function setIdQuestao(\InepZend\Module\Sqi\Entity\Questao $idQuestao = null)
    {
        $this->idQuestao = $idQuestao;
        return $this;
    }

    /**
     * Get idQuestao
     *
     * @return \InepZend\Module\Sqi\Entity\Questao 
     */
    public function getIdQuestao()
    {
        return $this->idQuestao;
    }

    /**
     * Set idTipoQuestao
     *
     * @param \InepZend\Module\Sqi\Entity\TipoQuestao $idTipoQuestao
     *
     * @return QuestaoItem
     */
    public function setIdTipoQuestao(\InepZend\Module\Sqi\Entity\TipoQuestao $idTipoQuestao = null)
    {
        $this->idTipoQuestao = $idTipoQuestao;
        return $this;
    }

    /**
     * Get idTipoQuestao
     *
     * @return \InepZend\Module\Sqi\Entity\TipoQuestao 
     */
    public function getIdTipoQuestao()
    {
        return $this->idTipoQuestao;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param $idUsuarioAlteracao
     *
     * @return QuestaoItem
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

