<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * SubgrupoQuestao
 *
 * @ORM\Table(name="SQI.TB_SUBGRUPO_QUESTAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\SubgrupoQuestaoRepository")
 */
class SubgrupoQuestao extends Entity
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
     * @ORM\Column(name="ID_SUBGRUPO_QUESTAO", type="smallint", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_SUBGRUPO_QUESTAO_ID_SUBGRUP", allocationSize=1, initialValue=1)
     */
    private $idSubgrupoQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    private $idUsuarioAlteracao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_SUBGRUPO_QUESTAO", type="string", length=1000, nullable=true)
     */
    private $noSubgrupoQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="NU_OPERACAO", type="smallint", nullable=true)
     */
    private $nuOperacao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return SubgrupoQuestao
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
     * Get idSubgrupoQuestao
     *
     * @return integer 
     */
    public function getIdSubgrupoQuestao()
    {
        return $this->idSubgrupoQuestao;
    }

    /**
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return SubgrupoQuestao
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
     * Set noSubgrupoQuestao
     *
     * @param string $noSubgrupoQuestao
     *
     * @return SubgrupoQuestao
     */
    public function setNoSubgrupoQuestao($noSubgrupoQuestao)
    {
        $this->noSubgrupoQuestao = $noSubgrupoQuestao;
        return $this;
    }

    /**
     * Get noSubgrupoQuestao
     *
     * @return string 
     */
    public function getNoSubgrupoQuestao()
    {
        return $this->noSubgrupoQuestao;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return SubgrupoQuestao
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

