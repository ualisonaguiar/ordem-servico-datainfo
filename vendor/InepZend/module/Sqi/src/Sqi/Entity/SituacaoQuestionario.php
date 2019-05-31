<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * SituacaoQuestionario
 *
 * @ORM\Table(name="SQI.TB_SITUACAO_QUESTIONARIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\SituacaoQuestionarioRepository")
 */
class SituacaoQuestionario extends Entity
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
     * @ORM\Column(name="ID_SITUACAO_QUESTIONARIO", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_SITUACAO_QUESTIONARIO_ID_SI", allocationSize=1, initialValue=1)
     */
    private $idSituacaoQuestionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     */
    private $nuOperacao;

    /**
     * @var \InepZend\Module\Sqi\Entity\QuestionarioProjeto
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\QuestionarioProjeto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_QUESTIONARIO_PROJETO", referencedColumnName="ID_QUESTIONARIO_PROJETO")
     * })
     */
    private $idQuestionarioProjeto;

    /**
     * @var \InepZend\Module\Sqi\Entity\TipoSituacaoQuestionario
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\TipoSituacaoQuestionario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_TIPO_SITUACAO_QUESTIONARIO", referencedColumnName="ID_TIPO_SITUACAO_QUESTIONARIO")
     * })
     */
    private $idTipoSituacaoQuestionario;

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
     * @return SituacaoQuestionario
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
     * @return SituacaoQuestionario
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
     * Get idSituacaoQuestionario
     *
     * @return integer 
     */
    public function getIdSituacaoQuestionario()
    {
        return $this->idSituacaoQuestionario;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return SituacaoQuestionario
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
     * Set idQuestionarioProjeto
     *
     * @param \InepZend\Module\Sqi\Entity\QuestionarioProjeto $idQuestionarioProjeto
     *
     * @return SituacaoQuestionario
     */
    public function setIdQuestionarioProjeto(\InepZend\Module\Sqi\Entity\QuestionarioProjeto $idQuestionarioProjeto = null)
    {
        $this->idQuestionarioProjeto = $idQuestionarioProjeto;
        return $this;
    }

    /**
     * Get idQuestionarioProjeto
     *
     * @return \InepZend\Module\Sqi\Entity\QuestionarioProjeto 
     */
    public function getIdQuestionarioProjeto()
    {
        return $this->idQuestionarioProjeto;
    }

    /**
     * Set idTipoSituacaoQuestionario
     *
     * @param \InepZend\Module\Sqi\Entity\TipoSituacaoQuestionario $idTipoSituacaoQuestionario
     *
     * @return SituacaoQuestionario
     */
    public function setIdTipoSituacaoQuestionario(\InepZend\Module\Sqi\Entity\TipoSituacaoQuestionario $idTipoSituacaoQuestionario = null)
    {
        $this->idTipoSituacaoQuestionario = $idTipoSituacaoQuestionario;
        return $this;
    }

    /**
     * Get idTipoSituacaoQuestionario
     *
     * @return \InepZend\Module\Sqi\Entity\TipoSituacaoQuestionario 
     */
    public function getIdTipoSituacaoQuestionario()
    {
        return $this->idTipoSituacaoQuestionario;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param $idUsuarioAlteracao
     *
     * @return SituacaoQuestionario
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

