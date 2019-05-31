<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistQuestaoItemConfig
 *
 * @ORM\Table(name="SQI.TB_HIST_QUESTAO_ITEM_CONFIG")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\HistQuestaoItemConfigRepository")
 */
class HistQuestaoItemConfig extends Entity
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
     * @ORM\Column(name="ID_GRUPO_QUESTAO", type="smallint", nullable=true)
     */
    private $idGrupoQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_INSTRUCAO_GRUPO_QUESTAO", type="integer", nullable=true)
     */
    private $idInstrucaoGrupoQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_INSTRUCAO_SUBGRUPO_QUESTAO", type="integer", nullable=true)
     */
    private $idInstrucaoSubgrupoQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_QUESTAO_ITEM", type="integer", nullable=true)
     */
    private $idQuestaoItem;

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
     * @ORM\Column(name="ID_SUBGRUPO_QUESTAO", type="smallint", nullable=true)
     */
    private $idSubgrupoQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    private $idUsuarioAlteracao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_EXIBE_GRUPO", type="boolean", nullable=true)
     */
    private $inExibeGrupo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_EXIBE_SUBGRUPO", type="boolean", nullable=true)
     */
    private $inExibeSubgrupo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IN_OBRIGATORIEDADE_QUESTAO", type="boolean", nullable=true)
     */
    private $inObrigatoriedadeQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_ORDEM_GRUPO", type="integer", nullable=true)
     */
    private $nuOrdemGrupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_ORDEM_ITEM", type="integer", nullable=true)
     */
    private $nuOrdemItem;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_ORDEM_QUESTAO", type="integer", nullable=true)
     */
    private $nuOrdemQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_ORDEM_SUBGRUPO", type="integer", nullable=true)
     */
    private $nuOrdemSubgrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="PC_ITEM", type="decimal", precision=5, scale=2, nullable=true)
     */
    private $pcItem;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_LEGENDA_ITEM", type="string", length=200, nullable=true)
     */
    private $txLegendaItem;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_LEGENDA_QUESTAO", type="string", length=200, nullable=true)
     */
    private $txLegendaQuestao;

    /**
     * @var string
     *
     * @ORM\Column(name="VL_ITEM", type="decimal", precision=5, scale=2, nullable=true)
     */
    private $vlItem;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistQuestaoItemConfig
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
     * Set idGrupoQuestao
     *
     * @param integer $idGrupoQuestao
     *
     * @return HistQuestaoItemConfig
     */
    public function setIdGrupoQuestao($idGrupoQuestao)
    {
        $this->idGrupoQuestao = $idGrupoQuestao;
        return $this;
    }

    /**
     * Get idGrupoQuestao
     *
     * @return integer 
     */
    public function getIdGrupoQuestao()
    {
        return $this->idGrupoQuestao;
    }

    /**
     * Set idInstrucaoGrupoQuestao
     *
     * @param integer $idInstrucaoGrupoQuestao
     *
     * @return HistQuestaoItemConfig
     */
    public function setIdInstrucaoGrupoQuestao($idInstrucaoGrupoQuestao)
    {
        $this->idInstrucaoGrupoQuestao = $idInstrucaoGrupoQuestao;
        return $this;
    }

    /**
     * Get idInstrucaoGrupoQuestao
     *
     * @return integer 
     */
    public function getIdInstrucaoGrupoQuestao()
    {
        return $this->idInstrucaoGrupoQuestao;
    }

    /**
     * Set idInstrucaoSubgrupoQuestao
     *
     * @param integer $idInstrucaoSubgrupoQuestao
     *
     * @return HistQuestaoItemConfig
     */
    public function setIdInstrucaoSubgrupoQuestao($idInstrucaoSubgrupoQuestao)
    {
        $this->idInstrucaoSubgrupoQuestao = $idInstrucaoSubgrupoQuestao;
        return $this;
    }

    /**
     * Get idInstrucaoSubgrupoQuestao
     *
     * @return integer 
     */
    public function getIdInstrucaoSubgrupoQuestao()
    {
        return $this->idInstrucaoSubgrupoQuestao;
    }

    /**
     * Set idQuestaoItem
     *
     * @param integer $idQuestaoItem
     *
     * @return HistQuestaoItemConfig
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
     * Set idQuestaoItemConfiguracao
     *
     * @param integer $idQuestaoItemConfiguracao
     *
     * @return HistQuestaoItemConfig
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
     * Set idSubgrupoQuestao
     *
     * @param integer $idSubgrupoQuestao
     *
     * @return HistQuestaoItemConfig
     */
    public function setIdSubgrupoQuestao($idSubgrupoQuestao)
    {
        $this->idSubgrupoQuestao = $idSubgrupoQuestao;
        return $this;
    }

    /**
     * Get idSubgrupoQuestao
     *
     * @return integer 
     */
    public function getIdSubgrupoQuestao()
    {
        return $this->idSubgrupoQuestao;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistQuestaoItemConfig
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
     * Set inExibeGrupo
     *
     * @param boolean $inExibeGrupo
     *
     * @return HistQuestaoItemConfig
     */
    public function setInExibeGrupo($inExibeGrupo)
    {
        $this->inExibeGrupo = $inExibeGrupo;
        return $this;
    }

    /**
     * Get inExibeGrupo
     *
     * @return boolean 
     */
    public function getInExibeGrupo()
    {
        return $this->inExibeGrupo;
    }

    /**
     * Set inExibeSubgrupo
     *
     * @param boolean $inExibeSubgrupo
     *
     * @return HistQuestaoItemConfig
     */
    public function setInExibeSubgrupo($inExibeSubgrupo)
    {
        $this->inExibeSubgrupo = $inExibeSubgrupo;
        return $this;
    }

    /**
     * Get inExibeSubgrupo
     *
     * @return boolean 
     */
    public function getInExibeSubgrupo()
    {
        return $this->inExibeSubgrupo;
    }

    /**
     * Set inObrigatoriedadeQuestao
     *
     * @param boolean $inObrigatoriedadeQuestao
     *
     * @return HistQuestaoItemConfig
     */
    public function setInObrigatoriedadeQuestao($inObrigatoriedadeQuestao)
    {
        $this->inObrigatoriedadeQuestao = $inObrigatoriedadeQuestao;
        return $this;
    }

    /**
     * Get inObrigatoriedadeQuestao
     *
     * @return boolean 
     */
    public function getInObrigatoriedadeQuestao()
    {
        return $this->inObrigatoriedadeQuestao;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistQuestaoItemConfig
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
     * Set nuOrdemGrupo
     *
     * @param integer $nuOrdemGrupo
     *
     * @return HistQuestaoItemConfig
     */
    public function setNuOrdemGrupo($nuOrdemGrupo)
    {
        $this->nuOrdemGrupo = $nuOrdemGrupo;
        return $this;
    }

    /**
     * Get nuOrdemGrupo
     *
     * @return integer 
     */
    public function getNuOrdemGrupo()
    {
        return $this->nuOrdemGrupo;
    }

    /**
     * Set nuOrdemItem
     *
     * @param integer $nuOrdemItem
     *
     * @return HistQuestaoItemConfig
     */
    public function setNuOrdemItem($nuOrdemItem)
    {
        $this->nuOrdemItem = $nuOrdemItem;
        return $this;
    }

    /**
     * Get nuOrdemItem
     *
     * @return integer 
     */
    public function getNuOrdemItem()
    {
        return $this->nuOrdemItem;
    }

    /**
     * Set nuOrdemQuestao
     *
     * @param integer $nuOrdemQuestao
     *
     * @return HistQuestaoItemConfig
     */
    public function setNuOrdemQuestao($nuOrdemQuestao)
    {
        $this->nuOrdemQuestao = $nuOrdemQuestao;
        return $this;
    }

    /**
     * Get nuOrdemQuestao
     *
     * @return integer 
     */
    public function getNuOrdemQuestao()
    {
        return $this->nuOrdemQuestao;
    }

    /**
     * Set nuOrdemSubgrupo
     *
     * @param integer $nuOrdemSubgrupo
     *
     * @return HistQuestaoItemConfig
     */
    public function setNuOrdemSubgrupo($nuOrdemSubgrupo)
    {
        $this->nuOrdemSubgrupo = $nuOrdemSubgrupo;
        return $this;
    }

    /**
     * Get nuOrdemSubgrupo
     *
     * @return integer 
     */
    public function getNuOrdemSubgrupo()
    {
        return $this->nuOrdemSubgrupo;
    }

    /**
     * Set pcItem
     *
     * @param string $pcItem
     *
     * @return HistQuestaoItemConfig
     */
    public function setPcItem($pcItem)
    {
        $this->pcItem = $pcItem;
        return $this;
    }

    /**
     * Get pcItem
     *
     * @return string 
     */
    public function getPcItem()
    {
        return $this->pcItem;
    }

    /**
     * Set txLegendaItem
     *
     * @param string $txLegendaItem
     *
     * @return HistQuestaoItemConfig
     */
    public function setTxLegendaItem($txLegendaItem)
    {
        $this->txLegendaItem = $txLegendaItem;
        return $this;
    }

    /**
     * Get txLegendaItem
     *
     * @return string 
     */
    public function getTxLegendaItem()
    {
        return $this->txLegendaItem;
    }

    /**
     * Set txLegendaQuestao
     *
     * @param string $txLegendaQuestao
     *
     * @return HistQuestaoItemConfig
     */
    public function setTxLegendaQuestao($txLegendaQuestao)
    {
        $this->txLegendaQuestao = $txLegendaQuestao;
        return $this;
    }

    /**
     * Get txLegendaQuestao
     *
     * @return string 
     */
    public function getTxLegendaQuestao()
    {
        return $this->txLegendaQuestao;
    }

    /**
     * Set vlItem
     *
     * @param string $vlItem
     *
     * @return HistQuestaoItemConfig
     */
    public function setVlItem($vlItem)
    {
        $this->vlItem = $vlItem;
        return $this;
    }

    /**
     * Get vlItem
     *
     * @return string 
     */
    public function getVlItem()
    {
        return $this->vlItem;
    }
}

