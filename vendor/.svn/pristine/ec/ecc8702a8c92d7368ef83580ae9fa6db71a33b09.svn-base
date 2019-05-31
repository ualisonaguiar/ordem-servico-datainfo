<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * Questionario
 *
 * @ORM\Table(name="SQI.TB_QUESTIONARIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\QuestionarioRepository")
 */
class Questionario extends Entity
{
    /**
     * @var string
     *
     * @ORM\Column(name="DS_QUESTIONARIO", type="string", length=200, nullable=true)
     */
    private $dsQuestionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_ALTERACAO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtAlteracao;

    /**
     * @var integer
     *
     * @ORM\Column(name="CO_QUESTIONARIO", type="smallint", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="SEQ_QUESTIONARIO", allocationSize=1, initialValue=1)
     */
    private $coQuestionario;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_QUESTIONARIO", type="string", length=100, nullable=true)
     */
    private $noQuestionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     */
    private $nuOperacao;

    /**
     * @var \InepZend\Module\Sqi\Entity\
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    private $idUsuarioAlteracao;


    /**
     * Set dsQuestionario
     *
     * @param string $dsQuestionario
     *
     * @return Questionario
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
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return Questionario
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
     * Get coQuestionario
     *
     * @return integer 
     */
    public function getIdQuestionario()
    {
        return $this->coQuestionario;
    }

    /**
     * Set noQuestionario
     *
     * @param string $noQuestionario
     *
     * @return Questionario
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
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return Questionario
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
     * Set idUsuarioAlteracao
     *
     * @param $idUsuarioAlteracao
     *
     * @return Questionario
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

