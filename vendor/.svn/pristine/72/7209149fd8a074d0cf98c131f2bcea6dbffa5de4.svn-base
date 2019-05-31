<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistTipoSituacaoQuest
 *
 * @ORM\Table(name="SQI.TB_HIST_TIPO_SITUACAO_QUEST")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\HistTipoSituacaoQuestRepository")
 */
class HistTipoSituacaoQuest extends Entity
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
     * @ORM\Column(name="ID_TIPO_SITUACAO_QUESTIONARIO", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idTipoSituacaoQuestionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    private $idUsuarioAlteracao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_IDENTIFICADOR", type="string", length=50, nullable=true)
     */
    private $noIdentificador;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_SITUACAO_QUESTIONARIO", type="string", length=100, nullable=true)
     */
    private $noTipoSituacaoQuestionario;

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
     * @return HistTipoSituacaoQuest
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
     * Set idTipoSituacaoQuestionario
     *
     * @param integer $idTipoSituacaoQuestionario
     *
     * @return HistTipoSituacaoQuest
     */
    public function setIdTipoSituacaoQuestionario($idTipoSituacaoQuestionario)
    {
        $this->idTipoSituacaoQuestionario = $idTipoSituacaoQuestionario;
        return $this;
    }

    /**
     * Get idTipoSituacaoQuestionario
     *
     * @return integer 
     */
    public function getIdTipoSituacaoQuestionario()
    {
        return $this->idTipoSituacaoQuestionario;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistTipoSituacaoQuest
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
     * Set noIdentificador
     *
     * @param string $noIdentificador
     *
     * @return HistTipoSituacaoQuest
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
     * Set noTipoSituacaoQuestionario
     *
     * @param string $noTipoSituacaoQuestionario
     *
     * @return HistTipoSituacaoQuest
     */
    public function setNoTipoSituacaoQuestionario($noTipoSituacaoQuestionario)
    {
        $this->noTipoSituacaoQuestionario = $noTipoSituacaoQuestionario;
        return $this;
    }

    /**
     * Get noTipoSituacaoQuestionario
     *
     * @return string 
     */
    public function getNoTipoSituacaoQuestionario()
    {
        return $this->noTipoSituacaoQuestionario;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return HistTipoSituacaoQuest
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

