<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistSituacaoQuestionario
 *
 * @ORM\Table(name="SQI.TB_HIST_SITUACAO_QUESTIONARIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\HistSituacaoQuestionarioRepository")
 */
class HistSituacaoQuestionario extends Entity
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtAlteracao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_SITUACAO_QUESTIONARIO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtSituacaoQuestionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_QUESTIONARIO", type="smallint", nullable=true)
     */
    private $idQuestionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_QUESTIONARIO_PROJETO", type="integer", nullable=true)
     */
    private $idQuestionarioProjeto;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SITUACAO_QUESTIONARIO", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idSituacaoQuestionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_SITUACAO_QUESTIONARIO", type="integer", nullable=true)
     */
    private $idTipoSituacaoQuestionario;

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
     * @return HistSituacaoQuestionario
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
     * Set dtSituacaoQuestionario
     *
     * @param \DateTime $dtSituacaoQuestionario
     *
     * @return HistSituacaoQuestionario
     */
    public function setDtSituacaoQuestionario($dtSituacaoQuestionario)
    {
        $this->dtSituacaoQuestionario = $dtSituacaoQuestionario;
        return $this;
    }

    /**
     * Get dtSituacaoQuestionario
     *
     * @return \DateTime 
     */
    public function getDtSituacaoQuestionario()
    {
        return Date::convertDate($this->dtSituacaoQuestionario, "d/m/Y");
    }

    /**
     * Set idQuestionario
     *
     * @param integer $idQuestionario
     *
     * @return HistSituacaoQuestionario
     */
    public function setIdQuestionario($idQuestionario)
    {
        $this->idQuestionario = $idQuestionario;
        return $this;
    }

    /**
     * Get idQuestionario
     *
     * @return integer 
     */
    public function getIdQuestionario()
    {
        return $this->idQuestionario;
    }

    /**
     * Set idQuestionarioProjeto
     *
     * @param integer $idQuestionarioProjeto
     *
     * @return HistSituacaoQuestionario
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
     * Set idSituacaoQuestionario
     *
     * @param integer $idSituacaoQuestionario
     *
     * @return HistSituacaoQuestionario
     */
    public function setIdSituacaoQuestionario($idSituacaoQuestionario)
    {
        $this->idSituacaoQuestionario = $idSituacaoQuestionario;
        return $this;
    }

    /**
     * Get idSituacaoQuestionario
     *
     * @return integer 
     */
    public function getIdSituacaoQuestionario()
    {
        return $this->idSituacaoQuestionario;
    }

    /**
     * Set idTipoSituacaoQuestionario
     *
     * @param integer $idTipoSituacaoQuestionario
     *
     * @return HistSituacaoQuestionario
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
     * @return HistSituacaoQuestionario
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
     * @return HistSituacaoQuestionario
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

