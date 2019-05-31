<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * InstrucaoGrupoQuestao
 *
 * @ORM\Table(name="SQI.TB_INSTRUCAO_GRUPO_QUESTAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\InstrucaoGrupoQuestaoRepository")
 */
class InstrucaoGrupoQuestao extends Entity
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
     * @ORM\Column(name="ID_INSTRUCAO_GRUPO_QUESTAO", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_INSTRUCAO_GRUPO_QUESTAO_ID_", allocationSize=1, initialValue=1)
     */
    private $idInstrucaoGrupoQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     */
    private $nuOperacao;

    /**
     * @var \InepZend\Module\Sqi\Entity\GrupoQuestao
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\GrupoQuestao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_GRUPO_QUESTAO", referencedColumnName="ID_GRUPO_QUESTAO")
     * })
     */
    private $idGrupoQuestao;

    /**
     * @var \InepZend\Module\Sqi\Entity\Instrucao
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\Instrucao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_INSTRUCAO", referencedColumnName="ID_INSTRUCAO")
     * })
     */
    private $idInstrucao;

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
     * @return InstrucaoGrupoQuestao
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
     * Get idInstrucaoGrupoQuestao
     *
     * @return integer 
     */
    public function getIdInstrucaoGrupoQuestao()
    {
        return $this->idInstrucaoGrupoQuestao;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return InstrucaoGrupoQuestao
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
     * Set idGrupoQuestao
     *
     * @param \InepZend\Module\Sqi\Entity\GrupoQuestao $idGrupoQuestao
     *
     * @return InstrucaoGrupoQuestao
     */
    public function setIdGrupoQuestao(\InepZend\Module\Sqi\Entity\GrupoQuestao $idGrupoQuestao = null)
    {
        $this->idGrupoQuestao = $idGrupoQuestao;
        return $this;
    }

    /**
     * Get idGrupoQuestao
     *
     * @return \InepZend\Module\Sqi\Entity\GrupoQuestao 
     */
    public function getIdGrupoQuestao()
    {
        return $this->idGrupoQuestao;
    }

    /**
     * Set idInstrucao
     *
     * @param \InepZend\Module\Sqi\Entity\Instrucao $idInstrucao
     *
     * @return InstrucaoGrupoQuestao
     */
    public function setIdInstrucao(\InepZend\Module\Sqi\Entity\Instrucao $idInstrucao = null)
    {
        $this->idInstrucao = $idInstrucao;
        return $this;
    }

    /**
     * Get idInstrucao
     *
     * @return \InepZend\Module\Sqi\Entity\Instrucao 
     */
    public function getIdInstrucao()
    {
        return $this->idInstrucao;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param $idUsuarioAlteracao
     *
     * @return InstrucaoGrupoQuestao
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

