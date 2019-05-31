<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistInstGrupoQuestao
 *
 * @ORM\Table(name="SQI.TB_HIST_INST_GRUPO_QUESTAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\HistInstGrupoQuestaoRepository")
 */
class HistInstGrupoQuestao extends Entity
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
     * @ORM\Column(name="ID_INSTRUCAO", type="smallint", nullable=true)
     */
    private $idInstrucao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_INSTRUCAO_GRUPO_QUESTAO", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idInstrucaoGrupoQuestao;

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
     * @return HistInstGrupoQuestao
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
     * @return HistInstGrupoQuestao
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
     * Set idInstrucao
     *
     * @param integer $idInstrucao
     *
     * @return HistInstGrupoQuestao
     */
    public function setIdInstrucao($idInstrucao)
    {
        $this->idInstrucao = $idInstrucao;
        return $this;
    }

    /**
     * Get idInstrucao
     *
     * @return integer 
     */
    public function getIdInstrucao()
    {
        return $this->idInstrucao;
    }

    /**
     * Set idInstrucaoGrupoQuestao
     *
     * @param integer $idInstrucaoGrupoQuestao
     *
     * @return HistInstGrupoQuestao
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
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistInstGrupoQuestao
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
     * @return HistInstGrupoQuestao
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

