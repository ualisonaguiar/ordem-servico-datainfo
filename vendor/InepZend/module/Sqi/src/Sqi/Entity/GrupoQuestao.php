<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * GrupoQuestao
 *
 * @ORM\Table(name="SQI.TB_GRUPO_QUESTAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\GrupoQuestaoRepository")
 */
class GrupoQuestao extends Entity
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
     * @ORM\Column(name="ID_GRUPO_QUESTAO", type="smallint", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TB_GRUPO_QUESTAO_ID_GRUPO_QUES", allocationSize=1, initialValue=1)
     */
    private $idGrupoQuestao;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_GRUPO_QUESTAO", type="string", length=100, nullable=true)
     */
    private $noGrupoQuestao;

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
     * @return GrupoQuestao
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
     * Get idGrupoQuestao
     *
     * @return integer 
     */
    public function getIdGrupoQuestao()
    {
        return $this->idGrupoQuestao;
    }

    /**
     * Set noGrupoQuestao
     *
     * @param string $noGrupoQuestao
     *
     * @return GrupoQuestao
     */
    public function setNoGrupoQuestao($noGrupoQuestao)
    {
        $this->noGrupoQuestao = $noGrupoQuestao;
        return $this;
    }

    /**
     * Get noGrupoQuestao
     *
     * @return string 
     */
    public function getNoGrupoQuestao()
    {
        return $this->noGrupoQuestao;
    }

    /**
     * Set nuOperacao
     *
     * @param integer $nuOperacao
     *
     * @return GrupoQuestao
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
     * @return GrupoQuestao
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

