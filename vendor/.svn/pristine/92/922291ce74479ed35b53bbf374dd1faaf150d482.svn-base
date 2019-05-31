<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistQuestaoItem
 *
 * @ORM\Table(name="SQI.TB_HIST_QUESTAO_ITEM")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\HistQuestaoItemRepository")
 */
class HistQuestaoItem extends Entity
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
     * @ORM\Column(name="ID_ITEM", type="integer", nullable=true)
     */
    private $idItem;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_QUESTAO", type="integer", nullable=true)
     */
    private $idQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_QUESTAO_ITEM", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idQuestaoItem;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_QUESTAO", type="integer", nullable=true)
     */
    private $idTipoQuestao;

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
     * @return HistQuestaoItem
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
     * Set idItem
     *
     * @param integer $idItem
     *
     * @return HistQuestaoItem
     */
    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;
        return $this;
    }

    /**
     * Get idItem
     *
     * @return integer 
     */
    public function getIdItem()
    {
        return $this->idItem;
    }

    /**
     * Set idQuestao
     *
     * @param integer $idQuestao
     *
     * @return HistQuestaoItem
     */
    public function setIdQuestao($idQuestao)
    {
        $this->idQuestao = $idQuestao;
        return $this;
    }

    /**
     * Get idQuestao
     *
     * @return integer 
     */
    public function getIdQuestao()
    {
        return $this->idQuestao;
    }

    /**
     * Set idQuestaoItem
     *
     * @param integer $idQuestaoItem
     *
     * @return HistQuestaoItem
     */
    public function setIdQuestaoItem($idQuestaoItem)
    {
        $this->idQuestaoItem = $idQuestaoItem;
        return $this;
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
     * Set idTipoQuestao
     *
     * @param integer $idTipoQuestao
     *
     * @return HistQuestaoItem
     */
    public function setIdTipoQuestao($idTipoQuestao)
    {
        $this->idTipoQuestao = $idTipoQuestao;
        return $this;
    }

    /**
     * Get idTipoQuestao
     *
     * @return integer 
     */
    public function getIdTipoQuestao()
    {
        return $this->idTipoQuestao;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistQuestaoItem
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
     * @return HistQuestaoItem
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

