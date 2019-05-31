<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * VwSituacaoQuestionario
 *
 * @ORM\Table(name="SQI.VW_SITUACAO_QUESTIONARIO") 
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\VwSituacaoQuestionarioRepository")
 */
class VwSituacaoQuestionario extends Entity
{

    const NO_IDENTIFICADOR_CONSTRUCAO = 'CONSTRUCAO';
    const NO_IDENTIFICADOR_FINALIZADO = 'FINALIZADO';

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="CO_QUESTIONARIO", type="smallint", nullable=true)
     */
    private $coQuestionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_QUESTIONARIO_PROJETO", type="integer", nullable=false)
     */
    private $idQuestionarioProjeto;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_QUESTIONARIO", type="string", length=100, nullable=true)
     */
    private $noQuestionario;

    /**
     * @var string
     *
     * @ORM\Column(name="DS_QUESTIONARIO", type="string", length=200, nullable=true)
     */
    private $dsQuestionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_SITUACAO_QUESTIONARIO", type="integer", nullable=true)
     */
    private $idSituacaoQuestionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DT_SITUACAO_QUESTIONARIO", type="string", columnDefinition="DATE", nullable=true)
     */
    private $dtSituacaoQuestionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_TIPO_SITUACAO_QUESTIONARIO", type="integer", nullable=true)
     */
    private $idTipoSituacaoQuestionario;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TIPO_SITUACAO_QUESTIONARIO", type="string", length=100, nullable=true)
     */
    private $noTipoSituacaoQuestionario;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_IDENTIFICADOR", type="string", length=50, nullable=true)
     */
    private $noIdentificador;

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
     * Set coQuestionario
     *
     * @param integer $coQuestionario
     *
     * @return VwSituacaoQuestionario
     */
    public function setCoQuestionario($coQuestionario)
    {
        $this->coQuestionario = $coQuestionario;
        return $this;
    }

    /**
     * Get coQuestionario
     *
     * @return integer 
     */
    public function getCoQuestionario()
    {
        return $this->coQuestionario;
    }

    /**
     * Set noQuestionario
     *
     * @param string $noQuestionario
     *
     * @return VwSituacaoQuestionario
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
     * Set dsQuestionario
     *
     * @param string $dsQuestionario
     *
     * @return VwSituacaoQuestionario
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
     * Set idSituacaoQuestionario
     *
     * @param integer $idSituacaoQuestionario
     *
     * @return VwSituacaoQuestionario
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
     * Set dtSituacaoQuestionario
     *
     * @param string $dtSituacaoQuestionario
     *
     * @return VwSituacaoQuestionario
     */
    public function setDtSituacaoQuestionario($dtSituacaoQuestionario)
    {
        $this->dtSituacaoQuestionario = $dtSituacaoQuestionario;
        return $this;
    }

    /**
     * Get dtSituacaoQuestionario
     *
     * @return string 
     */
    public function getDtSituacaoQuestionario()
    {
        return Date::convertDate($this->dtSituacaoQuestionario, 'd/m/Y');
    }

    /**
     * Set idTipoSituacaoQuestionario
     *
     * @param integer $idTipoSituacaoQuestionario
     *
     * @return VwSituacaoQuestionario
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
     * Set noTipoSituacaoQuestionario
     *
     * @param string $noTipoSituacaoQuestionario
     *
     * @return VwSituacaoQuestionario
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
     * Set noIdentificador
     *
     * @param string $noIdentificador
     *
     * @return VwSituacaoQuestionario
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
     * Set idQuestionarioProjeto
     *
     * @param integer $idQuestionarioProjeto
     *
     * @return VwSituacaoQuestionario
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
     * Set coProjeto
     *
     * @param integer $coProjeto
     *
     * @return VwSituacaoQuestionario
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
     * @return VwSituacaoQuestionario
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

}

