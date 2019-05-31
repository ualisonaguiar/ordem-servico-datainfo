<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * TipoSituacaoQuestionario
 *
 * @ORM\Table(name="SQI.TB_TIPO_SITUACAO_QUESTIONARIO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\TipoSituacaoQuestionarioRepository")
 */
class TipoSituacaoQuestionario extends Entity
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
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_TIPO_SITUACAO_QUESTIONARIO_", allocationSize=1, initialValue=1)
     */
    private $idTipoSituacaoQuestionario;

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
     */
    private $nuOperacao;

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
     * @return TipoSituacaoQuestionario
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
     * Get idTipoSituacaoQuestionario
     *
     * @return integer 
     */
    public function getIdTipoSituacaoQuestionario()
    {
        return $this->idTipoSituacaoQuestionario;
    }

    /**
     * Set noIdentificador
     *
     * @param string $noIdentificador
     *
     * @return TipoSituacaoQuestionario
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
     * @return TipoSituacaoQuestionario
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
     * @return TipoSituacaoQuestionario
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
     * @return TipoSituacaoQuestionario
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

