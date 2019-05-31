<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistInstSubgrupoQuestao
 *
 * @ORM\Table(name="SQI.TB_HIST_INST_SUBGRUPO_QUESTAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\HistInstSubgrupoQuestaoRepository")
 */
class HistInstSubgrupoQuestao extends Entity
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
     * @ORM\Column(name="ID_INSTRUCAO", type="smallint", nullable=true)
     */
    private $idInstrucao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_INSTRUCAO_SUBGRUPO_QUESTAO", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idInstrucaoSubgrupoQuestao;

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
     * @return HistInstSubgrupoQuestao
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
     * Set idInstrucao
     *
     * @param integer $idInstrucao
     *
     * @return HistInstSubgrupoQuestao
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
     * Set idInstrucaoSubgrupoQuestao
     *
     * @param integer $idInstrucaoSubgrupoQuestao
     *
     * @return HistInstSubgrupoQuestao
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
     * Set idSubgrupoQuestao
     *
     * @param integer $idSubgrupoQuestao
     *
     * @return HistInstSubgrupoQuestao
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
     * @return HistInstSubgrupoQuestao
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
     * @return HistInstSubgrupoQuestao
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

