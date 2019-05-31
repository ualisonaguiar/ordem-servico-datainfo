<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistQuestionario
 *
 * @ORM\Table(name="SQI.TB_HIST_QUESTIONARIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\HistQuestionarioRepository")
 */
class HistQuestionario extends Entity
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
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $coQuestionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    private $idUsuarioAlteracao;

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
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;


    /**
     * Set dsQuestionario
     *
     * @param string $dsQuestionario
     *
     * @return HistQuestionario
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
     * @return HistQuestionario
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
     * Set coQuestionario
     *
     * @param integer $coQuestionario
     *
     * @return HistQuestionario
     */
    public function setIdQuestionario($coQuestionario)
    {
        $this->coQuestionario = $coQuestionario;
        return $this;
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
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistQuestionario
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
     * Set noQuestionario
     *
     * @param string $noQuestionario
     *
     * @return HistQuestionario
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
     * @return HistQuestionario
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

