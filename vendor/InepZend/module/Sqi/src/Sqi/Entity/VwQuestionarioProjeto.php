<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * VwQuestionarioProjeto
 * 
 * @ORM\Table(name="SQI.VW_QUESTIONARIO_PROJETO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\VwQuestionarioProjetoRepository")
 */
class VwQuestionarioProjeto extends Entity
{

    const TIPO_QUESTAO_ITEM_TETX = 'TEXT';
    const TIPO_QUESTAO_ITEM_RADIOBUTTON = 'RADIOBUTTON';
    const TIPO_QUESTAO_ITEM_TEXTAREA = 'TEXTAREA';
    const TIPO_QUESTAO_ITEM_CHECKBOX = 'CHECKBOX';

    /**
     * @var boolean
     * 
     * @ORM\Column(name="IN_EXIBE_SUBGRUPO", type="boolean", nullable=true)
     */
    private $inExibeSubgrupo;

    /**
     * @var integer
     * 
     * @ORM\Column(name="ID_QUESTIONARIO_PROJETO", type="integer", nullable=false)
     */
    private $idQuestionarioProjeto;

    /**
     * @var integer
     * 
     * @ORM\Column(name="ID_TX_INS_SUBGRUPO_QUESTAO", type="smallint", nullable=true)
     */
    private $idTxInsSubgrupoQuestao;

    /**
     * @var integer
     * 
     * @ORM\Column(name="ID_TX_INS_GRUPO_QUESTAO", type="smallint", nullable=true)
     */
    private $idTxInsGrupoQuestao;

    /**
     * @var integer
     * 
     * @ORM\Column(name="ID_GRUPO_QUESTAO", type="smallint", nullable=true)
     */
    private $idGrupoQuestao;

    /**
     * @var integer
     * 
     * @ORM\Column(name="ID_SUBGRUPO", type="smallint", nullable=true)
     */
    private $idSubgrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="TX_INSTRUCAO_GRUPO_QUESTAO", type="string", length=1000, nullable=true)
     */
    private $txInstrucaoGrupoQuestao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_IDENTIFICADOR", type="string", length=50, nullable=true)
     */
    private $noIdentificador;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_ORDEM_GRUPO", type="integer", nullable=true)
     */
    private $nuOrdemGrupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_ORDEM_SUBGRUPO", type="integer", nullable=true)
     */
    private $nuOrdemSubgrupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_ORDEM_QUESTAO", type="integer", nullable=true)
     */
    private $nuOrdemQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_ORDEM_ITEM", type="integer", nullable=true)
     */
    private $nuOrdemItem;

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
     * @var boolean
     * 
     * @ORM\Column(name="IN_OBRIGATORIEDADE_QUESTAO", type="boolean", nullable=true)
     */
    private $inObrigatoriedadeQuestao;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="IN_EXIBE_GRUPO", type="boolean", nullable=true)
     */
    private $inExibeGrupo;

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
     * @var integer
     * 
     * @ORM\Column(name="CO_QUESTIONARIO", type="integer", nullable=true)
     */
    private $coQuestionario;

    /**
     * @var string
     * 
     * @ORM\Column(name="NO_QUESTIONARIO", type="string", length=100, nullable=true)
     */
    private $noQuestionario;

    /**
     * @var string
     * 
     * @ORM\Column(name="DS_QUESTIONARIO", type="string", length=200, nullable=true)
     */
    private $dsQuestionario;

    /**
     * @var integer
     * 
     * @ORM\Column(name="ID_QUESTIONARIO_QUESTAO_ITEM", type="integer", nullable=false)
     */
    private $idQuestionarioQuestaoItem;

    /**
     * @var string
     * 
     * @ORM\Column(name="NO_SUBGRUPO_QUESTAO", type="string", length=1000, nullable=true)
     */
    private $noSubgrupoQuestao;

    /**
     * @var string
     * 
     * @ORM\Column(name="TX_INSTRUCAO_SUBGRUPO_QUESTAO", type="string", length=1000, nullable=true)
     */
    private $txInstrucaoSubgrupoQuestao;

    /**
     * @var string
     * 
     * @ORM\Column(name="TX_QUESTAO", type="string", length=2000, nullable=true)
     */
    private $txQuestao;

    /**
     * @var string
     * 
     * @ORM\Column(name="TX_ITEM", type="string", length=500, nullable=true)
     */
    private $txItem;

    /**
     * @var string
     * 
     * @ORM\Column(name="NO_GRUPO_QUESTAO", type="string", length=100, nullable=false)
     */
    private $noGrupoQuestao;

    /**
     * @var string
     * 
     * @ORM\Column(name="TX_LEGENDA_ITEM", type="string", length=200, nullable=true)
     */
    private $txLegendaItem;

    /**
     * @var integer
     * 
     * @ORM\Column(name="ID_QUESTAO", type="integer", nullable=true)
     */
    private $idQuestao;

    /**
     * @var integer
     * 
     * @ORM\Id
     * @ORM\Column(name="ID_QUESTAO_ITEM_CONFIGURACAO", type="integer", nullable=true)
     */
    private $idQuestaoItemConfiguracao;
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="ID_ITEM", type="smallint", nullable=false)
     */
    private $idItem;

    /**
     * Set inExibeSubGrupo
     *
     * @param boolean $inExibeSubgrupo
     *
     * @return VwQuestionarioProjeto
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
     * Set idQuestionarioProjeto
     * 
     * @param integer $idQuestionarioProjeto
     * 
     * @return VwQuestionarioProjeto
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
     * Set idTxInsGrupoQuestao
     * 
     * @param integer $idTxInsGrupoQuestao
     * 
     * @return VwQuestionarioProjeto
     */
    public function setIdTxInsGrupoQuestao($idTxInsGrupoQuestao)
    {
        $this->idTxInsGrupoQuestao = $idTxInsGrupoQuestao;
        return $this;
    }

    /**
     * Get idTxInsGrupoQuestao
     * 
     * @return integer
     */
    public function getIdTxInsGrupoQuestao()
    {
        return $this->idTxInsGrupoQuestao;
    }

    /**
     * Set idTxInsSubgrupoQuestao
     * 
     * @param integer $idTxInsSubgrupoQuestao
     * 
     * @return VwQuestionarioProjeto
     */
    public function setIdTxInsSubgrupoQuestao($idTxInsSubgrupoQuestao)
    {
        $this->idTxInsSubgrupoQuestao = $idTxInsSubgrupoQuestao;
        return $this;
    }

    /**
     * Get idTxInsSubgrupoQuestao
     * 
     * @return integer
     */
    public function getIdTxInsSubgrupoQuestao()
    {
        return $this->idTxInsSubgrupoQuestao;
    }

    /**
     * Set idGrupoQuestao
     * 
     * @param integer $idGrupoQuestao
     * 
     * @return VwQuestionarioProjeto
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
     * Set idSubgrupo
     * 
     * @param integer $idSubgrupoQuestao
     * 
     * @return VwQuestionarioProjeto
     */
    public function setIdSubgrupoQuestao($idSubgrupoQuestao)
    {
        $this->idSubgrupo = $idSubgrupoQuestao;
        return $this;
    }

    /**
     * Get SubgrupoQuestao
     * 
     * @return integer
     */
    public function getIdSubgrupoQuestao()
    {
        return $this->idSubgrupo;
    }

    /**
     * Set txInstrucaoGrupoQuestao
     * 
     * @param string $txInstrucaoGrupoQuestao
     * 
     * @return VwQuestionarioProjeto
     */
    public function setTxInstrucaoGrupoQuestao($txInstrucaoGrupoQuestao)
    {
        $this->txInstrucaoGrupoQuestao = $txInstrucaoGrupoQuestao;
        return $this;
    }

    /**
     * Get txInstrucaoGrupoQuestao
     * 
     * @return string
     */
    public function getTxInstrucaoGrupoQuestao()
    {
        return $this->txInstrucaoGrupoQuestao;
    }

    /**
     * Set noIdentificador
     * 
     * @param string $noIdentificador
     * 
     * @return VwQuestionarioProjeto
     */
    public function setNoIdentificador($noIdentificador)
    {
        $this->noIdentificador = $noIdentificador;
        return $this;
    }

    /**
     * Get noIdentificador
     * 
     * @return string
     */
    public function getNoIdentificador()
    {
        return $this->noIdentificador;
    }

    /**
     * Set nuOrdemGrupo
     * 
     * @param integer $nuOrdemGrupo
     * 
     * @return VwQuestionarioProjeto
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
     * Set nuOrdemSubgrupo
     * 
     * @param integer $nuOrdemSubgrupo
     * 
     * @return VwQuestionarioProjeto
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
     * Set nuOrdemQuestao
     * 
     * @param integer $nuOrdemQuestao
     * 
     * @return VwQuestionarioProjeto
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
     * Set nuOrdemItem
     * 
     * @param integer $nuOrdemItem
     * 
     * @return VwQuestionarioProjeto
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
     * Set txLegendaQuestao
     * 
     * @param string $txLegendaQuestao
     * 
     * @return VwQuestionarioProjeto
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
     * @param decimal $vlItem
     * 
     * @return VwQuestionarioProjeto
     */
    public function setVlItem($vlItem)
    {
        $this->vlItem = $vlItem;
        return $this;
    }

    /**
     * Get vlItem
     * 
     * @return decimal
     */
    public function getVlItem()
    {
        return $this->vlItem;
    }

    /**
     * Set inObrigatoriedadeQuestao
     * 
     * @param boolean $inObrigatoriedadeQuestao
     * 
     * @return VwQuestionarioProjeto
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
     * Set inExibeGrupo
     * 
     * @param boolean $inExibeGrupo
     * 
     * @return VwQuestionarioProjeto
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
     * Set coProjeto
     * 
     * @param integer $coProjeto
     * 
     * @return VwQuestionarioProjeto
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
     * Set coEvento
     * 
     * @param integer $coEvento
     * 
     * @return VwQuestionarioProjeto
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
     * Set coQuestionario
     * 
     * @param integer $coQuestionario
     * 
     * @return VwQuestionarioProjeto
     */
    public function setCoQuestionario($coQuestionario)
    {
        $this->coQuestionario = $coQuestionario;
        return $this;
    }

    /**
     * Get coQuestionario
     * 
     * @return integer
     */
    public function getCoQuestionario()
    {
        return $this->coQuestionario;
    }

    /**
     * Set noQuestionario
     * 
     * @param string $noQuestionario
     * 
     * @return VwQuestionarioProjeto
     */
    public function setNoQuestionario($noQuestionario)
    {
        $this->noQuestionario = $noQuestionario;
        return $this;
    }

    /**
     * Get noQuestionario
     * 
     * @return string
     */
    public function getNoQuestionario()
    {
        return $this->noQuestionario;
    }

    /**
     * Set dsQuestionario
     * 
     * @param string $dsQuestionario
     * 
     * @return VwQuestionarioProjeto
     */
    public function setDsQuestionario($dsQuestionario)
    {
        $this->dsQuestionario = $dsQuestionario;
        return $this;
    }

    /**
     * Get dsQuestionario
     * 
     * @return string
     */
    public function getDsQuestionario()
    {
        return $this->dsQuestionario;
    }

    /**
     * Set idQuestionarioQuestaoItem
     * 
     * @param integer $idQuestionarioQuestaoItem
     * 
     * @return VwQuestionarioProjeto
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
     * Set noSubgrupoQuestao
     * 
     * @param string $noSubgrupoQuestao
     * 
     * @return VwQuestionarioProjeto
     */
    public function setNoSubgrupoQuestao($noSubgrupoQuestao)
    {
        $this->noSubgrupoQuestao = $noSubgrupoQuestao;
        return $this;
    }

    /**
     * Get noSubgrupoQuestao
     * 
     * @return string
     */
    public function getNoSubgrupoQuestao()
    {
        return $this->noSubgrupoQuestao;
    }

    /**
     * Set txInstrucaoSubgrupoQuestao
     * 
     * @param string $txInstrucaoSubgrupoQuestao
     * 
     * @return VwQuestionarioProjeto
     */
    public function setTxInstrucaoSubgrupoQuestao($txInstrucaoSubgrupoQuestao)
    {
        $this->txInstrucaoSubgrupoQuestao = $txInstrucaoSubgrupoQuestao;
        return $this;
    }

    /**
     * Get txInstrucaoSubgrupoQuestao
     * 
     * @return string
     */
    public function getTxInstrucaoSubgrupoQuestao()
    {
        return $this->txInstrucaoSubgrupoQuestao;
    }

    /**
     * Set txQuestao
     * 
     * @param string $txQuestao
     * 
     * @return VwQuestionarioProjeto
     */
    public function setTxQuestao($txQuestao)
    {
        $this->txQuestao = $txQuestao;
        return $this;
    }

    /**
     * Get txQuestao
     * 
     * @return string
     */
    public function getTxQuestao()
    {
        return $this->txQuestao;
    }

    /**
     * Set txItem
     * 
     * @param string $txItem
     * 
     * @return VwQuestionarioProjeto
     */
    public function setTxItem($txItem)
    {
        $this->txItem = $txItem;
        return $this;
    }

    /**
     * Get txItem
     * 
     * @return string
     */
    public function getTxItem()
    {
        return $this->txItem;
    }

    /**
     * Set noGrupoQuestao
     * 
     * @param string $noGrupoQuestao
     * 
     * @return VwQuestionarioProjeto
     */
    public function setNoGrupoQuestao($noGrupoQuestao)
    {
        $this->noGrupoQuestao = $noGrupoQuestao;
        return $this;
    }

    /**
     * Get noGrupoQuestao
     * 
     * @return string
     */
    public function getNoGrupoQuestao()
    {
        return $this->noGrupoQuestao;
    }

    /**
     * Set txLegendaItem
     * 
     * @param string $txLegendaItem
     * 
     * @return VwQuestionarioProjeto
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
     * Set idQuestao
     * 
     * @param integer $idQuestao
     * 
     * @return VwQuestionarioProjeto
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
     * Set idQuestaoItemConfiguracao
     * 
     * @param integer $idQuestaoItemConfiguracao
     * 
     * @return VwQuestionarioProjeto
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
     * Set idItem
     * 
     * @param integer $idItem
     * 
     * @return VwQuestionarioProjeto
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

}
