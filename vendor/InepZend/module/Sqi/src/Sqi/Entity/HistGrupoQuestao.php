<?php

namespace InepZend\Module\Sqi\Entity;

use Doctrine\ORM\Mapping as ORM;
use InepZend\Entity\Entity;
use InepZend\Util\Date;

/**
 * HistGrupoQuestao
 *
 * @ORM\Table(name="SQI.TB_HIST_GRUPO_QUESTAO")
 * @ORM\Entity(repositoryClass="InepZend\Module\Sqi\Entity\HistGrupoQuestaoRepository")
 */
class HistGrupoQuestao extends Entity
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
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idGrupoQuestao;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_USUARIO_ALTERACAO", type="integer", nullable=true)
     */
    private $idUsuarioAlteracao;

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
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $nuOperacao;


    /**
     * Set dtAlteracao
     *
     * @param \DateTime $dtAlteracao
     *
     * @return HistGrupoQuestao
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
     * Set idGrupoQuestao
     *
     * @param integer $idGrupoQuestao
     *
     * @return HistGrupoQuestao
     */
    public function setIdGrupoQuestao($idGrupoQuestao)
    {
        $this->idGrupoQuestao = $idGrupoQuestao;
        return $this;
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
     * Set idUsuarioAlteracao
     *
     * @param integer $idUsuarioAlteracao
     *
     * @return HistGrupoQuestao
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
     * Set noGrupoQuestao
     *
     * @param string $noGrupoQuestao
     *
     * @return HistGrupoQuestao
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
     * @return HistGrupoQuestao
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

