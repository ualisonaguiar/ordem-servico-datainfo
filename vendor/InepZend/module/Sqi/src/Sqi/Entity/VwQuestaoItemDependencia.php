<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;

/**
 * VwQuestaoItemDependencia
 * 
 * @ORM\Table(name="SQI.VW_QUESTAO_ITEM_DEPENDENCIA")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\VwQuestaoItemDependenciaRepository")
 */
class VwQuestaoItemDependencia extends Entity
{

    const TIPO_DEPENDENCIA_QUESTAO = 1;
    const TIPO_DEPENDENCIA_ITEM = 2;
    const TIPO_ACAO_HABILITAR = 1;
    const TIPO_ACAO_DESABILITAR = 2;
    const TIPO_ACAO_EXIBIR = 3;
    const TIPO_ACAO_OCULTAR = 4;

    /**
     * @var integer
     * 
     * @ORM\Id
     * @ORM\Column(name="ID_QUESTAO_ITEM_CONFIGURACAO", type="integer", nullable=true)
     */
    private $idQuestaoItemConfiguracao;

    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(name="ID_QUESTAO_ITEM_CONFIG_PAI", type="integer", nullable=true)
     */
    private $idQuestaoItemConfigPai;

    /**
     * @var integer
     *
     * @ORM\Column(name="TP_DEPENDENCIA", type="integer", nullable=true)
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
     * @var integer
     *
     * @ORM\Column(name="TP_ACAO", type="integer", nullable=true)
     */
    private $tpAcao;

    /**
     * Set idQuestaoItemConfiguracao
     * 
     * @param integer $idQuestaoItemConfiguracao
     * 
     * @return VwQuestaoItemDependencia
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
     * @return VwQuestaoItemDependencia
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
     * Set tpDependencia
     * 
     * @param integer $tpDependencia
     * 
     * @return VwQuestaoItemDependencia
     */
    public function setTpDependencia($tpDependencia)
    {
        $this->tpDependencia = $tpDependencia;
        return $this;
    }

    /**
     * Get tpDependencia
     * 
     * @return integer
     */
    public function getTpDependencia()
    {
        return $this->tpDependencia;
    }

    /**
     * Set coProjeto
     * 
     * @param integer $coProjeto
     * 
     * @return VwQuestaoItemDependencia
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
     * @return VwQuestaoItemDependencia
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
     * Set tpAcao
     * 
     * @param integer $tpAcao
     * 
     * @return VwQuestaoItemDependencia
     */
    public function setTpAcao($tpAcao)
    {
        $this->tpAcao = $tpAcao;
        return $this;
    }

    /**
     * Get tpAcao
     * 
     * @return integer
     */
    public function getTpAcao()
    {
        return $this->tpAcao;
    }

}

