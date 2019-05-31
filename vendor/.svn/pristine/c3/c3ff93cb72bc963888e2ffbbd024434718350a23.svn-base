<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * QuestaoItemConfiguracao
 *
 * @ORM\Table(name="SQI.TB_QUESTAO_ITEM_CONFIGURACAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\QuestaoItemConfiguracaoRepository")
 */
class QuestaoItemConfiguracao extends Entity
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
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_QUESTAO_ITEM_CONFIGURACAO_I", allocationSize=1, initialValue=1)
     */
    private $idQuestaoItemConfiguracao;

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
     * @var \InepZend\Module\Sqi\Entity\GrupoQuestao
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\GrupoQuestao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_GRUPO_QUESTAO", referencedColumnName="ID_GRUPO_QUESTAO")
     * })
     */
    private $idGrupoQuestao;

    /**
     * @var \InepZend\Module\Sqi\Entity\InstrucaoGrupoQuestao
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\InstrucaoGrupoQuestao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_INSTRUCAO_GRUPO_QUESTAO", referencedColumnName="ID_INSTRUCAO_GRUPO_QUESTAO")
     * })
     */
    private $idInstrucaoGrupoQuestao;

    /**
     * @var \InepZend\Module\Sqi\Entity\InstrucaoSubgrupoQuestao
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\InstrucaoSubgrupoQuestao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_INSTRUCAO_SUBGRUPO_QUESTAO", referencedColumnName="ID_INSTRUCAO_SUBGRUPO_QUESTAO")
     * })
     */
    private $idInstrucaoSubgrupoQuestao;

    /**
     * @var \InepZend\Module\Sqi\Entity\QuestaoItem
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\QuestaoItem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_QUESTAO_ITEM", referencedColumnName="ID_QUESTAO_ITEM")
     * })
     */
    private $idQuestaoItem;

    /**
     * @var \InepZend\Module\Sqi\Entity\SubgrupoQuestao
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\SubgrupoQuestao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_SUBGRUPO_QUESTAO", referencedColumnName="ID_SUBGRUPO_QUESTAO")
     * })
     */
    private $idSubgrupoQuestao;

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
     * @return QuestaoItemConfiguracao
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
     * Get idQuestaoItemConfiguracao
     *
     * @return integer 
     */
    public function getIdQuestaoItemConfiguracao()
    {
        return $this->idQuestaoItemConfiguracao;
    }

    /**
     * Set inExibeGrupo
     *
     * @param boolean $inExibeGrupo
     *
     * @return QuestaoItemConfiguracao
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
     * @return QuestaoItemConfiguracao
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
     * @return QuestaoItemConfiguracao
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
     * @return QuestaoItemConfiguracao
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
     * @return QuestaoItemConfiguracao
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
     * @return QuestaoItemConfiguracao
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
     * @return QuestaoItemConfiguracao
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
     * @return QuestaoItemConfiguracao
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
     * @return QuestaoItemConfiguracao
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
     * @return QuestaoItemConfiguracao
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
     * @return QuestaoItemConfiguracao
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
     * @return QuestaoItemConfiguracao
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

    /**
     * Set idGrupoQuestao
     *
     * @param \InepZend\Module\Sqi\Entity\GrupoQuestao $idGrupoQuestao
     *
     * @return QuestaoItemConfiguracao
     */
    public function setIdGrupoQuestao(\InepZend\Module\Sqi\Entity\GrupoQuestao $idGrupoQuestao = null)
    {
        $this->idGrupoQuestao = $idGrupoQuestao;
        return $this;
    }

    /**
     * Get idGrupoQuestao
     *
     * @return \InepZend\Module\Sqi\Entity\GrupoQuestao 
     */
    public function getIdGrupoQuestao()
    {
        return $this->idGrupoQuestao;
    }

    /**
     * Set idInstrucaoGrupoQuestao
     *
     * @param \InepZend\Module\Sqi\Entity\InstrucaoGrupoQuestao $idInstrucaoGrupoQuestao
     *
     * @return QuestaoItemConfiguracao
     */
    public function setIdInstrucaoGrupoQuestao(\InepZend\Module\Sqi\Entity\InstrucaoGrupoQuestao $idInstrucaoGrupoQuestao = null)
    {
        $this->idInstrucaoGrupoQuestao = $idInstrucaoGrupoQuestao;
        return $this;
    }

    /**
     * Get idInstrucaoGrupoQuestao
     *
     * @return \InepZend\Module\Sqi\Entity\InstrucaoGrupoQuestao 
     */
    public function getIdInstrucaoGrupoQuestao()
    {
        return $this->idInstrucaoGrupoQuestao;
    }

    /**
     * Set idInstrucaoSubgrupoQuestao
     *
     * @param \InepZend\Module\Sqi\Entity\InstrucaoSubgrupoQuestao $idInstrucaoSubgrupoQuestao
     *
     * @return QuestaoItemConfiguracao
     */
    public function setIdInstrucaoSubgrupoQuestao(\InepZend\Module\Sqi\Entity\InstrucaoSubgrupoQuestao $idInstrucaoSubgrupoQuestao = null)
    {
        $this->idInstrucaoSubgrupoQuestao = $idInstrucaoSubgrupoQuestao;
        return $this;
    }

    /**
     * Get idInstrucaoSubgrupoQuestao
     *
     * @return \InepZend\Module\Sqi\Entity\InstrucaoSubgrupoQuestao 
     */
    public function getIdInstrucaoSubgrupoQuestao()
    {
        return $this->idInstrucaoSubgrupoQuestao;
    }

    /**
     * Set idQuestaoItem
     *
     * @param \InepZend\Module\Sqi\Entity\QuestaoItem $idQuestaoItem
     *
     * @return QuestaoItemConfiguracao
     */
    public function setIdQuestaoItem(\InepZend\Module\Sqi\Entity\QuestaoItem $idQuestaoItem = null)
    {
        $this->idQuestaoItem = $idQuestaoItem;
        return $this;
    }

    /**
     * Get idQuestaoItem
     *
     * @return \InepZend\Module\Sqi\Entity\QuestaoItem 
     */
    public function getIdQuestaoItem()
    {
        return $this->idQuestaoItem;
    }

    /**
     * Set idSubgrupoQuestao
     *
     * @param \InepZend\Module\Sqi\Entity\SubgrupoQuestao $idSubgrupoQuestao
     *
     * @return QuestaoItemConfiguracao
     */
    public function setIdSubgrupoQuestao(\InepZend\Module\Sqi\Entity\SubgrupoQuestao $idSubgrupoQuestao = null)
    {
        $this->idSubgrupoQuestao = $idSubgrupoQuestao;
        return $this;
    }

    /**
     * Get idSubgrupoQuestao
     *
     * @return \InepZend\Module\Sqi\Entity\SubgrupoQuestao 
     */
    public function getIdSubgrupoQuestao()
    {
        return $this->idSubgrupoQuestao;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param $idUsuarioAlteracao
     *
     * @return QuestaoItemConfiguracao
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

