<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * QuestionarioProjeto
 *
 * @ORM\Table(name="SQI.TB_QUESTIONARIO_PROJETO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\QuestionarioProjetoRepository")
 */
class QuestionarioProjeto extends Entity
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
     * @ORM\Column(name="ID_QUESTIONARIO_PROJETO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_QUESTIONARIO_PROJETO_ID_QUE", allocationSize=1, initialValue=1)
     */
    private $idQuestionarioProjeto;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     */
    private $nuOperacao;

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
     * @var \InepZend\Module\Sqi\Entity\Questionario
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\Questionario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CO_QUESTIONARIO", referencedColumnName="CO_QUESTIONARIO")
     * })
     */
    private $coQuestionario;

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
     * @return QuestionarioProjeto
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
     * Get idQuestionarioProjeto
     *
     * @return integer 
     */
    public function getIdQuestionarioProjeto()
    {
        return $this->idQuestionarioProjeto;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return QuestionarioProjeto
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
     * Set coProjeto
     *
     * @param $coProjeto
     *
     * @return QuestionarioProjeto
     */
    public function setCoProjeto($coProjeto = null)
    {
        $this->coProjeto = $coProjeto;
        return $this;
    }

    /**
     * Get coProjeto
     *
     * @return QuestionarioProjeto
     */
    public function getCoProjeto()
    {
        return $this->coProjeto;
    }

    /**
     * Set coEvento
     *
     * @param $coEvento
     *
     * @return QuestionarioProjeto
     */
    public function setCoEvento($coEvento = null)
    {
        $this->coEvento = $coEvento;
        return $this;
    }

    /**
     * Get coProjeto
     *
     * @return QuestionarioProjeto
     */
    public function getCoEvento()
    {
        return $this->coEvento;
    }

    /**
     * Set coQuestionario
     *
     * @param \InepZend\Module\Sqi\Entity\Questionario $coQuestionario
     *
     * @return QuestionarioProjeto
     */
    public function setIdQuestionario(\InepZend\Module\Sqi\Entity\Questionario $coQuestionario = null)
    {
        $this->coQuestionario = $coQuestionario;
        return $this;
    }

    /**
     * Get coQuestionario
     *
     * @return \InepZend\Module\Sqi\Entity\Questionario 
     */
    public function getIdQuestionario()
    {
        return $this->coQuestionario;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param \InepZend\Module\Sqi\Entity\ $idUsuarioAlteracao
     *
     * @return QuestionarioProjeto
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

