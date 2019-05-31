<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * InstrucaoSubgrupoQuestao
 *
 * @ORM\Table(name="SQI.TB_INSTRUCAO_SUBGRUPO_QUESTAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\InstrucaoSubgrupoQuestaoRepository")
 */
class InstrucaoSubgrupoQuestao extends Entity
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
     * @ORM\Column(name="ID_INSTRUCAO_SUBGRUPO_QUESTAO", type="integer", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_INSTRUCAO_SUBGRUPO_QUESTAO_", allocationSize=1, initialValue=1)
     */
    private $idInstrucaoSubgrupoQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     */
    private $nuOperacao;

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
     * @var \InepZend\Module\Sqi\Entity\SubgrupoQuestao
     *
     * @ORM\ManyToOne(targetEntity="InepZend\Module\Sqi\Entity\SubgrupoQuestao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_SUBGRUPO_QUESTAO", referencedColumnName="ID_SUBGRUPO_QUESTAO")
     * })
     */
    private $idSubgrupoQuestao;

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
     * @return InstrucaoSubgrupoQuestao
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
     * Get idInstrucaoSubgrupoQuestao
     *
     * @return integer 
     */
    public function getIdInstrucaoSubgrupoQuestao()
    {
        return $this->idInstrucaoSubgrupoQuestao;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return InstrucaoSubgrupoQuestao
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
     * Set idInstrucao
     *
     * @param \InepZend\Module\Sqi\Entity\Instrucao $idInstrucao
     *
     * @return InstrucaoSubgrupoQuestao
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
     * Set idSubgrupoQuestao
     *
     * @param \InepZend\Module\Sqi\Entity\SubgrupoQuestao $idSubgrupoQuestao
     *
     * @return InstrucaoSubgrupoQuestao
     */
    public function setIdSubgrupoQuestao(\InepZend\Module\Sqi\Entity\SubgrupoQuestao $idSubgrupoQuestao = null)
    {
        $this->idSubgrupoQuestao = $idSubgrupoQuestao;
        return $this;
    }

    /**
     * Get idSubgrupoQuestao
     *
     * @return \InepZend\Module\Sqi\Entity\SubgrupoQuestao 
     */
    public function getIdSubgrupoQuestao()
    {
        return $this->idSubgrupoQuestao;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param $idUsuarioAlteracao
     *
     * @return InstrucaoSubgrupoQuestao
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

